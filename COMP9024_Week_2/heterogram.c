#include <stdio.h>
#include <stdbool.h>
#include <string.h>

bool isHeterogram(char A[], int len) {
  int i,j;

  for (i = 0; i < len; i++)
    for (j = i + 1; j < len; j++)
      if (A[i] == A[j])
        return false;

  return true;
}

int main() {
  int  length;
  char word[31];

  printf("Enter a word: ");
  scanf("%s", word);

  length = strlen(word);
  if (isHeterogram(word, length))
    printf("yes");
  else
    printf("no");
}