#include <stdio.h>

void control(int num) {
  printf("%d\n", num);
  while (num != 1) {
    if (num % 2 == 0)
      num = num / 2;
    else
      num = 3 * num + 1;
    printf("%d\n", num);
  }
}

unsigned long long int fibonacci(int num) {
  if (num == 1)
    return 1;
  if (num == 2)
    return 1;
  return (fibonacci(num - 1) + fibonacci(num - 2));
}

int main() {
  int i,j;
  for (i = 1; i <= 10; i++) {
    j = fibonacci(i);
    printf("Fib[%d] = %d\n", i, j);
    control(j);
  }
  return 0;
}