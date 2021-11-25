#include <stdio.h>
#include <stdlib.h>

int main(int argc, char *argv[]) {
  int  key;
  int  seed = atoi(argv[1]);
  int  length = atoi(argv[2]);
  char password[32];

  srand(seed);

  for (int i = 0; i < length; i++) {
    key = rand() % (126 - 33 + 1) + 33;
    password[i] = key;
  }

  password[length] = 0;
  printf("%s", password);
}