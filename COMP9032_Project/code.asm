; Author: Group3, 21T3
; Course: COMP9032
; Project: Smart Airplane Window Controller

; Input: keypad and push button
; Output: LED and LCD

; PL3(OC5A, 16bits, timer5) to LED0
; PL4(OC5B, 16bits, timer5) to LED1
; PE3(OC3A, 16bits, timer3) to LED3
; PE4(OC3B, 16bits, timer3) to LED4
; PG0-PG4 to LED6-LED9

.include "m2560def.inc"

.def row	= r15					; current row number
.def col	= r16					; current column number
.def rmask  = r17					; mask for current row
.def cmask	= r18					; mask for current column
.def last_button = r19				; if is pushing a button

.def interrupt_flag = r20

.def param_1 = r21					; first parameter of the function
.def param_2 = r22					; second parameter of the function
.def variable_a = r23				; function variable a
.def variable_b = r24				; function variable b
.def variable_c = r25				; function variable b
.def result = r26					; function result
									; r29:r28 for Y

.def control_state = r0				; 0:Initial state(S); 1:Local control (L); 2:Central control(C);
.def emergency = r1					; 0:Not Emergency; 1:Emergency
.def win1_level = r2				; window 1 opacity level. levels: 0-clear; 1-light opaque; 2-medium opaque; 3-dark
.def win2_level = r3				; window 2 opacity level.

.equ sleep_for_keypad_ms = 1		; sleep 1 ms between key press

.equ PORTCDIR =0xF0			; use PortC for input/output from keypad: PC7-4, output, PC3-0, input
.equ INITCOLMASK = 0xEF		; scan from the leftmost column, the value to mask output
.equ INITROWMASK = 0x01		; scan from the bottom row
.equ ROWMASK = 0x0F			; low four bits are output from the keypad. This value mask the high 4 bits.

.org 0
	jmp RESET
.org INT0addr
	jmp OpO_interrupt

OpO_interrupt:
	push variable_a							; save register
	in variable_a, SREG						; save SREG(Status register)
	push variable_a

	cpi interrupt_flag, 0					;if interrupt_flag = 0 ignore this interrupt
	breq OpO_interrupt_end
	clr interrupt_flag						;set interrupt_flag = 0

	mov variable_a, emergency
	cpi variable_a, 1						;if it is in emergency quit
	breq OpO_interrupt_quit_emergency
	ldi variable_a, 1
	mov emergency, variable_a				;if not in, set to emergency
	rjmp OpO_interrupt_end

	OpO_interrupt_quit_emergency:
		ldi variable_a, 0
		mov emergency, variable_a
		call set_windows_brightness
		call LCD_display_states

	OpO_interrupt_end:
	pop variable_a							; restore SREG
	out SREG, variable_a
	pop variable_a							; restore register
	reti

RESET:
	ldi variable_a, low(RAMEND)
	out SPL, variable_a
	ldi variable_a, high(RAMEND)
	out SPH, variable_a

										; set type of signal
	ldi variable_a, (2 << ISC00)		; set INT0 as falling edge triggered interrupt
	sts EICRA, variable_a				; 2=1,0: falling edge will generate interrupt

	in variable_a, EIMSK				; enable INT0
	ori variable_a, (1<<INT0)
	out EIMSK, variable_a

	rcall lcd_init
	ldi param_1, LCD_FUNC_SET|(1<<LCD_DL)|(1<<LCD_N)|(0<<LCD_F)		; 8-bit (bus) size; 2-line display; 5 x 7 dots
	rcall lcd_command
	ldi param_1, LCD_ENTRY_SET|(1<<LCD_ID)|(0<<LCD_S)				; increment the address counter; no shift
	rcall lcd_command
																    ; init Keypad
	ldi variable_a, PORTCDIR								      	; rows PC7-PC4: inputs; columns PC3-PC0: outputs; R0_R1_R2_R3_C0_C1_C2_C3
	out	DDRC, variable_a


	ldi variable_a, 0b11111111									    ; init LED flashes
	out	DDRG, variable_a

	call PWM_init

	sei									                            ; Enable global interrupt

RESET_VALUE:
	ser variable_a
	mov last_button, variable_a

	rcall LCD_clear

	ldi variable_a, 0
	mov control_state, variable_a

	ldi variable_a, 0
	mov win1_level, variable_a

	ldi variable_a, 0
	mov win2_level, variable_a
	jmp set_brightness_and_LCD

	clr emergency

; Main function
; Check if emergency mode is activated
get_input:
	ldi interrupt_flag, 1

	mov variable_a, emergency			; check emergency status
	cpi variable_a, 1                   ; if emergency cleared, scan keypad
	brne get_input_do
	call set_windows_brightness         ; if emergency set
	call LCD_display_states
	call LED_flashes					; endless loop LEDs flash

; Keypad component
get_input_do:
	ldi cmask, INITCOLMASK				; initial column mask
	clr	col								; initial column. col = 0

colloop:
	cpi col, 4
	breq colloop_end
	out PORTC, cmask				; set column to mask value (one column off)

	ldi param_1, low(50)			; sleep (50 ns)
	ldi param_2, high(50)			;
	call sleep_n_ns

	in variable_a, PINC				; read PORTC
	andi variable_a, ROWMASK
	cpi variable_a, 0xF				; check if any rows are on
	breq nextcol
								; if yes, find which row is on
	ldi rmask, INITROWMASK		; initialise row check
	clr	row						; initial row

rowloop:
	cpi row, 4
	breq nextcol
	mov variable_b, variable_a
	and variable_b, rmask	    ; check masked bit
	breq convert 				; if bit is clear, convert the bitcode
	inc row						; else move to the next row
	lsl rmask					; shift the mask to the next bit
	jmp rowloop

nextcol:
	lsl cmask					; else get new mask by shifting and
	inc col						; increment column value
	jmp colloop					; and check the next column

; Interpret the input from keypad
convert:
	mov variable_a, row				; calculate switch button id
	lsl variable_a
	lsl variable_a					; variable_a = row * 4
	add variable_a, col				; variable_a = row * 4 + col
	cp variable_a, last_button		; still push the same button
	breq get_input
	mov last_button, variable_a

	mov variable_a, emergency       ; check emergency mode just in case
	cpi variable_a, 1
	brne convert_do
	jmp re_get_input

convert_do:
	cpi col, 3								; if column is 3 we have a letter
	breq letters
	cpi row, 3								; if row is 3 we have a symbol or 0
	breq symbols
											; otherwise we have a number in 1-9

	mov variable_a, control_state
	cpi variable_a, 2						; control_state = 0 or 1, push of number will action
	brlo numbers							; branch if Lower (Unsigned)
	jmp re_get_input

colloop_end:
	ser variable_a
	mov last_button, variable_a     ; no button pushed in this round
	rjmp get_input

; Numbers input handler
numbers:
	mov variable_a, row
	lsl variable_a					; variable_a = row * 2
	add variable_a, row				; variable_a = row * 2 + row = row * 3
	add variable_a, col				; variable_a = row * 3 + col = real_number - 1
	inc variable_a					; variable_a = row * 3 + col + 1

	cpi variable_a, 1
	breq decreasing_win1_level
	cpi variable_a, 4
	breq increasing_win1_level
	cpi variable_a, 2
	breq decreasing_win2_level
	cpi variable_a, 5
	breq increasing_win2_level
	jmp re_get_input

; Decrease or increase functions
; Either way change the value of corresponding register
decreasing_win1_level:		;bottom to 0
	mov variable_a, win1_level
	cpi variable_a, 0
	brne decreasing_win1_level_do
	jmp re_get_input
decreasing_win1_level_do:
	dec win1_level
	jmp set_brightness_and_LCD

increasing_win1_level:		;up to 3
	mov variable_a, win1_level
	cpi variable_a, 3
	brne increasing_win1_level_do
	jmp re_get_input
increasing_win1_level_do:
	inc win1_level
	jmp set_brightness_and_LCD

decreasing_win2_level:		;bottom to 0
	mov variable_a, win2_level
	cpi variable_a, 0
	brne decreasing_win2_level_do
	jmp re_get_input
decreasing_win2_level_do:
	dec win2_level
	jmp set_brightness_and_LCD

increasing_win2_level:		;up to 3
	mov variable_a, win2_level
	cpi variable_a, 3
	brne increasing_win2_level_do
	jmp re_get_input
increasing_win2_level_do:
	inc win2_level
	jmp set_brightness_and_LCD

; Do nothing if input is a symbol
symbols:
	jmp re_get_input

; Letters input handler
letters:
	cpi row, 0						; 'A' is pressed, Central control decrease
	breq letters_A
	cpi row, 1						; 'B' is pressed, Central control increase
	breq letters_B
	cpi row, 2						; 'C' is pressed, exit Central control
	breq letters_C
	jmp re_get_input
; Set value of the corresponding registers
letters_A:
	ldi variable_a, 0					; set win1_level and win2_level to 0
	mov win1_level, variable_a
	mov win2_level, variable_a
	ldi variable_a, 2					; set control_state to Central control (2)
	mov control_state, variable_a
	jmp set_brightness_and_LCD
letters_B:
	ldi variable_a, 3					; set win1_level and win2_level to 3
	mov win1_level, variable_a
	mov win2_level, variable_a
	ldi variable_a, 2					; set control_state to Central control (2)
	mov control_state, variable_a
	jmp set_brightness_and_LCD
letters_C:
	mov variable_a, control_state
	cpi variable_a, 2					; control_state = 2, push of C will action
	breq letters_C_do
	jmp re_get_input
letters_C_do:
	ldi variable_a, 1
	mov control_state, variable_a		; set control_state to Local control (1)
	jmp set_brightness_and_LCD

re_get_input:
	call sleep_for_keypad
	jmp get_input

; Invoke set_windows_brightness and LCD_display_states
set_brightness_and_LCD:
	call set_windows_brightness
	call LCD_display_states
	jmp re_get_input


; LCD display states. Display current control_state, win1_level, and win2_level on LCD
; Input:
	; control_state				; 0:Initial state(S); 1:Local control (L); 2:Central control(C); 3:Emergency (!!!)
	; win1_level				; window 1 opacity level. levels: 0-clear; 1-light opaque; 2-medium opaque; 3-dark
	; win2_level				; window 2 opacity level.
LCD_display_states:
	call LCD_clear
	ldi param_1, LCD_SET_AC|0   ; set address of LCD
	rcall lcd_command

	mov variable_b, win1_level
	mov variable_c, win2_level

	mov variable_a, emergency   ; LCD information for emergency mode exclusively
	cpi variable_a, 1
	breq display_state_emergency

	mov variable_a, control_state
	cpi variable_a, 0
	breq display_state_0
	cpi variable_a, 1
	breq display_state_1
	cpi variable_a, 2
	breq display_state_2

	display_state_0:
		ldi param_1, 'S'
		call LCD_append_char
		rjmp display_state_end
	display_state_1:
		ldi param_1, 'L'
		call LCD_append_char
		rjmp display_state_end
	display_state_2:
		ldi param_1, 'C'
		call LCD_append_char
		rjmp display_state_end
	display_state_emergency:
		ldi param_1, '!'
		call LCD_append_char
		call LCD_append_char
		call LCD_append_char
		ldi variable_b, 0
		ldi variable_c, 0
		rjmp display_state_end
	display_state_end:
		ldi param_1, ':'
		call LCD_append_char

	ldi param_1, LCD_SET_AC|10		; set address of LCD
	rcall lcd_command
	ldi param_1, 'W'
	call LCD_append_char
	ldi param_1, '1'
	call LCD_append_char

	ldi param_1, LCD_SET_AC|13		; set address of LCD
	rcall lcd_command
	ldi param_1, 'W'
	call LCD_append_char
	ldi param_1, '2'
	call LCD_append_char

	ldi param_1, LCD_SET_AC|(64+11)	; set address of LCD
	rcall lcd_command
	mov param_1, variable_b
	subi param_1, -'0'
	call LCD_append_char

	ldi param_1, LCD_SET_AC|(64+14)	; set address of LCD
	rcall lcd_command
	mov param_1, variable_c
	subi param_1, -'0'
	call LCD_append_char

	ret

; LED flashes
LED_flashes:
	push variable_a

	LED_flashes_loop:
		mov variable_a, emergency   ; break the loop if emergency cleared
		cpi variable_a, 1
		brne LED_flashes_end

		ldi variable_a, 0b11111111
		out PORTG, variable_a
		sbi PORTE, 6
		sbi PORTE, 7
		call sleep_500ms
		ldi variable_a, 0b00000000
		out PORTG, variable_a
		cbi PORTE, 6
		cbi PORTE, 7
		call sleep_500ms
		rjmp LED_flashes_loop

	LED_flashes_end:
	pop variable_b
	ret

; LCD macros&functions start

; D0-D7 --- PF0-PF7
.equ LCD_RS = 7		;PA7
.equ LCD_E = 6		;PA6
.equ LCD_RW = 5		;PA5

; busy flag:
.equ LCD_BF = 7	 ;DB7

; Function Set:
.equ LCD_FUNC_SET = 0b00110000		;data 8-bit (bus) size, 1-line display,  5 x 7 dots
.equ LCD_DL = 4		;DB4
.equ LCD_N = 3		;DB3
.equ LCD_F = 2		;DB2

; Entry Mode Set:
.equ LCD_ENTRY_SET = 0b00000110		;increment the address, no shift
.equ LCD_ID = 1		;DB1
.equ LCD_S = 0		;DB0

; Clear Display:
.equ LCD_DISP_CLR = 0b00000001

; Display ON/OFF:
.equ LCD_DISP_ON = 0b00001110		;display is on, cursor is on, no blinks
.equ LCD_DISP_OFF = 0b00001000
.equ LCD_C = 1		;DB1

; Set DD RAM Address(AC/pointer)
; For 1-line display: 0x00-0x4F
; For 2-line display: 0x00-0x27(0-39) for the first line, 0x40-0x67(64-103) for the second line
.equ LCD_SET_AC = 0b10000000

.macro lcd_set
	sbi PORTA, @0
.endmacro
.macro lcd_clr
	cbi PORTA, @0
.endmacro

lcd_command:								; LCD write command
	out PORTF, param_1						; set the LCD data port's value up
	nop
	lcd_set LCD_E
	nop
	nop
	nop
	lcd_clr LCD_E
	nop
	nop
	nop
	rcall lcd_wait
	ret

; Send data to display
lcd_data:
	out PORTF, param_1						; set the data port's value up
	lcd_set LCD_RS
	nop
	nop
	nop
	lcd_set LCD_E
	nop
	nop
	nop
	lcd_clr LCD_E
	nop
	nop
	nop
	lcd_clr LCD_RS
	rcall lcd_wait
	ret

; Check LCD and wait until LCD is not busy
lcd_wait:
	push variable_a
	clr variable_a
	out DDRF, variable_a
	out PORTF, variable_a
	lcd_set LCD_RW
	lcd_wait_loop:
		nop
		lcd_set LCD_E
		nop
		nop
		nop
		in variable_a, PINF
		lcd_clr LCD_E
		sbrc variable_a, 7
		rjmp lcd_wait_loop
	lcd_clr LCD_RW
	ser variable_a
	out DDRF, variable_a
	pop variable_a
	ret

.macro do_lcd_command
	ldi param_1, @0
	rcall lcd_command
.endmacro

.macro do_lcd_data
	ldi param_1, @0
	rcall lcd_data
.endmacro

lcd_init:
	push variable_a
	ser variable_a
	out DDRF, variable_a
	out DDRA, variable_a
	clr variable_a
	out PORTF, variable_a
	out PORTA, variable_a

	ldi param_1, low(15)	  ; delay (15ms)
	ldi param_2, high(15)	  ;
	call sleep_n_ms

	do_lcd_command 0b00111000 ; 2x5x7
	rcall sleep_5_ms
	do_lcd_command 0b00111000 ; 2x5x7
	rcall sleep_1_ms
	do_lcd_command 0b00111000 ; 2x5x7
	do_lcd_command 0b00111000 ; 2x5x7
	do_lcd_command 0b00001000 ; display off
	do_lcd_command 0b00000001 ; clear display
	do_lcd_command 0b00000110 ; increment, no display shift
	do_lcd_command 0b00001110 ; cursor on, bar, no blink
	pop variable_a
	ret

; Append char on LCD function
LCD_append_char:
	rcall lcd_data
	ret

; Clear LCD
LCD_clear:
	push param_1
	ldi param_1, LCD_DISP_CLR
	rcall lcd_command		  ; clear Display
	pop param_1
	ret

; LCD macros&functions end

; Bright levels: 0-clear; 1-light opaque; 2-medium opaque; 3-dark
; More bigger more brighter.(range: 0-65536)
; The brighter the LEDs, the darker the window
.equ BRIGHT_LEVEL_0 = 2
.equ BRIGHT_LEVEL_1 = 10
.equ BRIGHT_LEVEL_2 = 100
.equ BRIGHT_LEVEL_3 = 65535

; PWM windows_brightness start
; PWM_init function
PWM_init:
	ldi variable_a, 0b00011000		;
	sts DDRL, variable_a			; Set PL3(OC5A),PL4(OC5B) as output
									; OC5A is the output of the timer5 waveform generation
	ldi variable_a, 0b11101000		; also open PE6-7 FOR LED
	out DDRE, variable_a			; Set PE3(OC3A),PE5(OC3C) as output
									; OC3A is the output of the timer3 waveform generation

	ldi variable_a, high(BRIGHT_LEVEL_3)		; the value controls the PWM duty cycle
	sts OCR5AH, variable_a
	sts OCR5BH, variable_a
	ldi variable_a, low(BRIGHT_LEVEL_3)
	sts OCR5AL, variable_a
	sts OCR5BL, variable_a

	ldi variable_a, high(BRIGHT_LEVEL_3)		; the value controls the PWM duty cycle
	sts OCR3AH, variable_a
	sts OCR3CH, variable_a
	ldi variable_a, low(BRIGHT_LEVEL_3)
	sts OCR3AL, variable_a
	sts OCR3CL, variable_a

										; Set Timer5,Timer3 to Phase Correct PWM mode.
	ldi variable_a, (1<<CS50)			; Set Timer clock frequency.
	sts TCCR5B, variable_a
	sts TCCR3B, variable_a
	ldi variable_a, (1<<WGM50)|(1<<COM5A1)|(1<<COM5B1)|(1<<COM5C1)
	sts TCCR5A, variable_a
	sts TCCR3A, variable_a

	ret

; Set the brightness of all windows
; Please flow the priority requirement through control_state. 3:Emergency > 2:Central control > 1:Local control
; Input:
	; control_state				; 0:Initial state(S); 1:Local control (L); 2:Central control(C); 3:Emergency (!!!)
	; win1_level				; window 1 opacity level. levels: 0-clear; 1-light opaque; 2-medium opaque; 3-dark
	; win2_level				; window 2 opacity level.
	; Emergency will set all windows to clear
set_windows_brightness:
	push param_1
	push variable_a
	mov variable_a, emergency
	cpi variable_a, 1
	breq set_windows_brightness_emergency

	mov param_1, win1_level
	call set_window1_brightness
	mov param_1, win2_level
	call set_window2_brightness
	rjmp set_windows_brightness_end

	set_windows_brightness_emergency:
		ldi param_1, 0
		call set_window1_brightness
		call set_window2_brightness

	set_windows_brightness_end:
	pop variable_a
	pop param_1
	ret

; set BRIGHT_LEVEL to variable_a, variable_B
set_BRIGHT_LEVEL:
	cpi param_1, 0
	breq set_BRIGHT_LEVEL_0
	cpi param_1, 1
	breq set_BRIGHT_LEVEL_1
	cpi param_1, 2
	breq set_BRIGHT_LEVEL_2
	cpi param_1, 3
	breq set_BRIGHT_LEVEL_3
	rjmp set_BRIGHT_LEVEL_end

	set_BRIGHT_LEVEL_0:
		ldi variable_a, low(BRIGHT_LEVEL_0)
		ldi variable_b, high(BRIGHT_LEVEL_0)
		rjmp set_BRIGHT_LEVEL_end
	set_BRIGHT_LEVEL_1:
		ldi variable_a, low(BRIGHT_LEVEL_1)
		ldi variable_b, high(BRIGHT_LEVEL_1)
		rjmp set_BRIGHT_LEVEL_end
	set_BRIGHT_LEVEL_2:
		ldi variable_a, low(BRIGHT_LEVEL_2)
		ldi variable_b, high(BRIGHT_LEVEL_2)
		rjmp set_BRIGHT_LEVEL_end
	set_BRIGHT_LEVEL_3:
		ldi variable_a, low(BRIGHT_LEVEL_3)
		ldi variable_b, high(BRIGHT_LEVEL_3)
		rjmp set_BRIGHT_LEVEL_end

	set_BRIGHT_LEVEL_end:
	ret

set_window1_brightness:
	push variable_a
	push variable_b
	call set_BRIGHT_LEVEL
	sts OCR5AL, variable_a
	sts OCR5AH, variable_b
	sts OCR5BL, variable_a
	sts OCR5BH, variable_b
	pop variable_b
	pop variable_a
	ret

; param_1: level
set_window2_brightness:
	push variable_a
	push variable_b
	call set_BRIGHT_LEVEL
	sts OCR3AL, variable_a
	sts OCR3AH, variable_b
	sts OCR3CL, variable_a
	sts OCR3CH, variable_b
	pop variable_b
	pop variable_a
	ret

; PWM windows_brightness end

; Sleep functions start
; Sleep 1ns
sleep_1_ns:
											; call 5 cycles
	nop										; 6 nops
	nop
	nop
	nop
	nop
	nop
	ret										; 5 cycles
											; 5 + 6 + 5 = 16

; Sleep n nanosecond
; Minimal input 4
sleep_n_ns:
	; Prologue:
									  ; r29:r28 will be used as the frame pointer
	push YL						      ; save r29:r28 in the stack
	push YH
	push variable_a					  ; save registers used in the function body
	push variable_b
	in YL, SPL		    			  ; initialize the stack frame pointer value
	in YH, SPH
	sbiw Y, 2						  ; reserve space for local variables and parameters.
	out SPH, YH					      ; update the stack pointer to point to the new stack top
	out SPL, YL
									  ; pass the actual parameters
	std Y+1, param_1
	std Y+2, param_2
	; End of prologue

	; Function body
	ldd variable_a, Y+1							; load b to registers
	ldd variable_b, Y+2
	sbiw variable_b:variable_a, 3
	nop
	delayloop_n_ns:
		;call sleep_1_ns
		nop nop nop nop nop nop nop nop nop nop nop nop
		sbiw variable_b:variable_a, 1
		brne delayloop_n_ns
	; End of function body

	adiw Y, 2			    ; de-allocate the reserved space
	out SPH, YH
	out SPL, YL
	pop variable_b			; restore registers
	pop variable_a
	pop YH
	pop YL
	ret

; Function sleep 1 ms and 5 ms
sleep_1_ms:
	ldi param_1, low(999)			; set parameter
	ldi param_2, high(999)			;
	call sleep_n_ns
	nop nop nop nop nop nop
	ret

sleep_5_ms:
	rcall sleep_1_ms
	rcall sleep_1_ms
	rcall sleep_1_ms
	rcall sleep_1_ms
	rcall sleep_1_ms
	ret

; Function sleep_1_ms
; Exclusively for function sleep n millesecond
sleep_1_ms_for_n:
	ldi param_1, low(999)			; set parameter
	ldi param_2, high(999)			;
	call sleep_n_ns
	nop nop
	ret

; Function sleep n millisecond
; This function has 45 cycles error
sleep_n_ms:
	; Prologue:
									    ; r29:r28 will be used as the frame pointer
	push YL						        ; Save r29:r28 in the stack
	push YH
	push variable_a						; Save registers used in the function body
	push variable_b
	in YL, SPL					        ; Initialize the stack frame pointer value
	in YH, SPH
	sbiw Y, 2						    ; Reserve space for local variables and parameters.
	out SPH, YH					        ; Update the stack pointer to point to the new stack top
	out SPL, YL
									    ; Pass the actual parameters
	std Y+1, param_1
	std Y+2, param_2
	; End of prologue

	; Function body
	ldd variable_a, Y+1					; Load b to registers
	ldd variable_b, Y+2
	delayloop_n_ms:
		call _sleep_1_ms_for_n
		sbiw variable_b:variable_a, 1
		brne delayloop_n_ms
	; End of function body

	;Epilogue
	adiw Y, 2			    ; De-allocate the reserved space
	out SPH, YH
	out SPL, YL
	pop variable_b			; Restore registers
	pop variable_a
	pop YH
	pop YL
	ret
	;End of epilogue

; Function sleep_500ms
sleep_500ms:
	ldi param_1, low(500)			; set parameter
	ldi param_2, high(500)			;
	call sleep_n_ms
	ret

; Delay function for each loop of scanning keypad
; Parameter defined in the header comment
sleep_for_keypad:
	ldi param_1, low(sleep_for_keypad_ms)			; set parameter
	ldi param_2, high(sleep_for_keypad_ms)			;
	call sleep_n_ms
	ret