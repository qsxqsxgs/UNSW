// Word Sequence Algorithms implementation ... COMP9024 21T3

#include <stdio.h>
#include <stdlib.h>
#include <assert.h>
#include <math.h>

#include "Graph/Graph.c"

int main() {
   int    i;
   int    num;
   int    flag;
   char   word[31];
   Vertex w[100];

   printf("Enter a number: ");
   flag = scanf("%d", &num);
   

   assert(flag == 1);

   Graph words = newGraph(num);
   for (i = 0; i < num; i++) {
      printf("Enter a word: ");
      flag = scanf("%s", word);
      
      assert(flag == 1);

      Vertex w[i] = newVertex(i, word);
   }
}