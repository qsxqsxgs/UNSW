#include "stack.c"

#include <stdio.h>
#include <stdlib.h>

int main() {
  stack old = newStack();
  stack new = newStack();

  StackPush(old, 0);
  StackPush(old, 1);
  StackPush(old, 2);
  StackPush(old, 3);

  new = reverseStack(old);
  new = reverseStack(new);

  printf("%d\n", old->height);
  printf("%d\n", StackPop(new));
}