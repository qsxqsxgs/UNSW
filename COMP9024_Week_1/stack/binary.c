#include <stdio.h>
#include <stdlib.h>
#include "IntStack.h"

int main() {
  int n;
  int num;
  int count;

  printf("Enter a number: ");
  scanf("%d", &num);

  count = 0;
  while(num != 0) {
    n = num % 2;
    StackPush(n);
    num = num / 2;
    count++;
  }

  for (int i = 0; i < count; i++) {
     num = StackPop();
     printf("%d", num);
   }
}