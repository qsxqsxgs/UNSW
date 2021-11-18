#include <stdio.h>
#include <stdlib.h>
#include <assert.h>

int main() {
  int  key;
  int  flag;
  int  seed, length;
  char password[32];

  flag = scanf("%d", &seed);
  assert(flag == 1);
  srand(seed);

  flag = scanf("%d", &length);
  assert(flag == 1);

  for (int i = 0; i < length; i++) {
    key = rand() % (126 - 33 + 1) + 33;
    password[i] = key;
  }

  password[length] = 0;
  printf("%s", password);
}