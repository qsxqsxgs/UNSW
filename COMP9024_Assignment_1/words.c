// Word Sequence Algorithms implementation ... COMP9024 21T3

#include <stdio.h>
#include <stdlib.h>
#include <assert.h>

#include "Graph/Graph.c"

int main() {
   int    i, j;           // counters
   int    num;            // number of vertices
   int    flag;           // status check
   char   word[31];       // input word
   Vertex w[100];         // vertex array

   printf("Enter a number: ");
   flag = scanf("%d", &num);
   
   assert(flag == 1);
   // initialize graph
   Graph words = newGraph(num);

   // initialize vertices with users input
   for (i = 0; i < num; i++) {
      printf("Enter a word: ");
      flag = scanf("%s", word);
      
      assert(flag == 1);
      w[i] = newVertex(i, word);
   }

   printf("\n");

   // insert edge to graph according to vertices relation
   for (i = 0; i < num; i++)
     for (j = i + 1; j < num; j++)
       if (checkVertices(w[i], w[j])) {
         Edge edge = {w[i], w[j]};
         insertEdge(words, edge);
       }
   //
   showGraph(words);
}