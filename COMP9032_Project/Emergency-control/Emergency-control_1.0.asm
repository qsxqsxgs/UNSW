; Author: Group3, 21T3
; Course: COMP9032
; Project: Smart Airplane Window Controller

; Input: keypad and push button
; Output: LED and LCD

.include "m2560def.inc"

.equ sleep_for_keypad_ms = 1		; sleep 1 ms between key press

.def row	= r16					; current row number
.def col	= r17					; current column number
.def rmask  = r18					; mask for current row
.def cmask	= r19					; mask for current column
.def last_button = r13				; if is pushing a button

.def flag = r21
.def param_1 = r22					; register for passing the first parameter of the function
.def param_2 = r23					; register for passing the second parameter of the function
.def variable_a = r24				; function variable a
.def variable_b = r25				; function variable b
.def result = r14					; function result
									; r29:r28 for Y

.def control_state = r0				; 0:Initial state(S); 1:Local control (L); 2:Central control(C); 3:Emergency (!!!)
.def win1_level = r1				; window 1 opacity level. levels: 0-clear; 1-light opaque; 2-medium opaque; 3-dark
.def win2_level = r2				; window 2 opacity level.

.equ PORTCDIR =0xF0			; use PortC for input/output from keypad: PC7-4, output, PC3-0, input
.equ INITCOLMASK = 0xEF		; scan from the leftmost column, the value to mask output
.equ INITROWMASK = 0x01		; scan from the bottom row
.equ ROWMASK  =0x0F			; low four bits are output from the keypad. This value mask the high 4 bits.

.org 0
	jmp RESET
.org INTOaddr
    jmp EXT_INT0

EXT_INT0:
    cpi flag, 0
	breq ACCEPT_INT0
	clr flag
	reti
ACCEPT_INT0:
    ; store LCD and LED status
	; change LCD display
	; change LED display
	ldi flag, 1
LED_flashes:
    cpi flag, 0
	breq EXIT_INT0
    ldi variable_a, 0b11111111
	out PORTG, variable_a			; turn on
	call sleep_500ms
	ldi variable_a, 0b00000000
	out PORTG, variable_a			; turn off
	rjmp LED_flashes
EXIT_INT0:
    ; retain LCD and LED status
	; change LCD display
	; change LED display
	reti

RESET:
	ldi variable_a, low(RAMEND)
	out SPL, variable_a
	ldi variable_a, high(RAMEND)
	out SPH, variable_a

	rcall lcd_init
	ldi param_1, LCD_FUNC_SET|(1<<LCD_DL)|(0<<LCD_N)|(1<<LCD_F)		; 8-bit (bus) size; 1-line display; 5 x 10 dots
	rcall lcd_command
	ldi param_1, LCD_ENTRY_SET|(1<<LCD_ID)|(0<<LCD_S)				; increment the address counter; no shift
	rcall lcd_command
																; init Keypad
	ldi variable_a, PORTCDIR									; rows PC7-PC4: inputs; columns PC3-PC0: outputs; R0_R1_R2_R3_C0_C1_C2_C3
	out	DDRC, variable_a

	ldi variable_a, 0b00001111
	out DDRG, variable_a

	ldi variable_a, (2 << ISC00)		; set INT0 as falling edge triggered interrupt
	sts EICRA, variable_a

	in variable_a, EIMSK				; enable INT0
	ori variable_a, (1<<INT0)
	out EIMSK, variable_a

	clr flag

	sei

RESET_VALUE:
	ser variable_a
	mov last_button, variable_a

	rcall LCD_clear

get_input:
	ldi cmask, INITCOLMASK		; initial column mask
	clr	col						; initial column. col = 0

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
	and variable_b, rmask				; check masked bit
	breq convert 				; if bit is clear, convert the bitcode
	inc row						; else move to the next row
	lsl rmask					; shift the mask to the next bit
	jmp rowloop

nextcol:
	lsl cmask					; else get new mask by shifting and
	inc col						; increment column value
	jmp colloop					; and check the next column

convert:
	mov variable_a, row				; calculate the button id
	lsl variable_a
	lsl variable_a					; variable_a = row * 4
	add variable_a, col				; variable_a = row * 4 + col
	cp variable_a, last_button		; still push the same button
	breq get_input
	mov last_button, variable_a

	cpi col, 3					; if column is 3 we have a letter
	breq letters
	cpi row, 3					; if row is 3 we have a symbol or 0
	breq symbols
									; otherwise we have a number in 1-9
	mov variable_a, row
	lsl variable_a					; variable_a = row * 2
	add variable_a, row				; variable_a = row * 2 + row = row * 3
	add variable_a, col				; variable_a = row * 3 + col = real_number - 1
	inc variable_a					; variable_a = row * 3 + col + 1
	mov param_1, variable_a
	jmp set_calculator_number

colloop_end:
	ser variable_a
	mov last_button, variable_a;	no button pushed in this round
	rjmp get_input

letters:
	cpi row, 2						; 'C' is pressed
	breq switch_format
	cpi row, 3						; 'D' is pressed
	breq letters_D
	jmp re_get_input
letters_D:
	jmp RESET_VALUE

symbols:
	cpi col, 0						; check if we have a star
	breq star
	cpi col, 1						; or if we have zero
	breq zero
	jmp calculate					; "#" key for "="
star:
	jmp set_calculation_symbol
zero:
	ldi param_1, 0					; set to zero
	jmp set_calculator_number

re_get_input:
	call sleep_for_keypad
	jmp get_input

; set the brightness of all windows
; Please flow the priority requirement through control_state. 3:Emergency > 2:Central control > 1:Local control
; input:
	; control_state				; 0:Initial state(S); 1:Local control (L); 2:Central control(C); 3:Emergency (!!!)
	; win1_level				; window 1 opacity level. levels: 0-clear; 1-light opaque; 2-medium opaque; 3-dark
	; win2_level				; window 2 opacity level.
set_windows_brightness:

	ret

; LCD display states. Display current control_state, win1_level, and win2_level on LCD
; input:
	; control_state				; 0:Initial state(S); 1:Local control (L); 2:Central control(C); 3:Emergency (!!!)
	; win1_level				; window 1 opacity level. levels: 0-clear; 1-light opaque; 2-medium opaque; 3-dark
	; win2_level				; window 2 opacity level.
LCD_display_states:

	ret

; LCD macros&functions ;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;

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
	out PORTF, param_1								; set the data port's value up
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

	ldi param_1, low(15)			; delay (15ms)
	ldi param_2, high(15)			;
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
	do_lcd_command 0b00001110 ; Cursor on, bar, no blink
	pop variable_a
	ret

; append char on LCD function
LCD_append_char:
	rcall lcd_data
	ret

; append char on LCD function
LCD_clear:
	ldi param_1, LCD_DISP_CLR
	rcall lcd_command					; Clear Display
	ret

; LCD macros&functions end ;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;

; sleep functions ;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;

; function sleep_1_ns
; use call to call this function
; .equ F_CPU = 16000000
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

; function sleep n nanosecond
; use call to call this function
; minimal input is 4
sleep_n_ns:
	; Prologue:
									  ; r29:r28 will be used as the frame pointer
	push YL						   ; Save r29:r28 in the stack
	push YH
	push variable_a						; Save registers used in the function body
	push variable_b
	in YL, SPL					   ; Initialize the stack frame pointer value
	in YH, SPH
	sbiw Y, 2						; Reserve space for local variables and parameters.
	out SPH, YH					  ; Update the stack pointer to point to the new stack top
	out SPL, YL
									 ; Pass the actual parameters
	std Y+1, param_1
	std Y+2, param_2
	; End of prologue

	; Function body
	ldd variable_a, Y+1							; Load b to registers
	ldd variable_b, Y+2
	sbiw variable_b:variable_a, 3
	nop
	delayloop_n_ns:
		;call sleep_1_ns
		nop nop nop nop nop nop nop nop nop nop nop nop
		sbiw variable_b:variable_a, 1
		brne delayloop_n_ns
	; End of function body

	adiw Y, 2			; De-allocate the reserved space
	out SPH, YH
	out SPL, YL
	pop variable_b			; Restore registers
	pop variable_a
	pop YH
	pop YL
	ret				  ; Return

; function sleep_1_ms
; use call to call this function
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

; function sleep_1_ms
; use call to call this function
_sleep_1_ms_for_n:
	ldi param_1, low(999)			; set parameter
	ldi param_2, high(999)			;
	call sleep_n_ns
	nop nop
	ret

; function sleep n millisecond
; use call to call this function
; This function has 45 cycles error
sleep_n_ms:
	; Prologue:
									  ; r29:r28 will be used as the frame pointer
	push YL						   ; Save r29:r28 in the stack
	push YH
	push variable_a						; Save registers used in the function body
	push variable_b
	in YL, SPL					   ; Initialize the stack frame pointer value
	in YH, SPH
	sbiw Y, 2						; Reserve space for local variables and parameters.
	out SPH, YH					  ; Update the stack pointer to point to the new stack top
	out SPL, YL
									 ; Pass the actual parameters
	std Y+1, param_1
	std Y+2, param_2
	; End of prologue

	; Function body
	ldd variable_a, Y+1							; Load b to registers
	ldd variable_b, Y+2
	delayloop_n_ms:
		call _sleep_1_ms_for_n
		sbiw variable_b:variable_a, 1
		brne delayloop_n_ms
	; End of function body

	;Epilogue
	adiw Y, 2			; De-allocate the reserved space
	out SPH, YH
	out SPL, YL
	pop variable_b			; Restore registers
	pop variable_a
	pop YH
	pop YL
	ret				  ; Return
	;End of epilogue

; function sleep_500ms
sleep_500ms:
	ldi param_1, low(500)			; set parameter
	ldi param_2, high(500)			;
	call sleep_n_ms
	ret

; function sleep_500ms
sleep_for_keypad:
	ldi param_1, low(sleep_for_keypad_ms)			; set parameter
	ldi param_2, high(sleep_for_keypad_ms)			;
	call sleep_n_ms
	ret

