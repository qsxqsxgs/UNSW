// Integer Stack ADO tester ... COMP9024 21T3

#include <stdio.h>
#include <stdlib.h>
#include "IntStack.h"

#define INPUT_STRLEN 20

int main(void) {
   int i, n;
   char str[INPUT_STRLEN];

   StackInit();

   printf("Enter a positive number: ");
   scanf("%19s", str);
   if ((n = atoi(str)) > 0) {    // convert to int and test if positive
      for (i = 0; i < n; i++) {
	      printf("Enter a number: ");
	      scanf("%19s", str);
	      StackPush(atoi(str));
      }
   }

   int num;
   for (i = 0; i < n; i++) {
     num = StackPop();
     printf("%d\n", num);
   }

   return 0;
}