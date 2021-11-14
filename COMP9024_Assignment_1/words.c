// Word Sequence Algorithms implementation ... COMP9024 21T3

#include <stdio.h>
#include <stdlib.h>
#include <assert.h>

#include "Graph.h"

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
   // show graph according to assignment format
   showGraph(words, w);

   printf("\n");

   int   max;                // maximum sequence length
   int   length[num];        // store longest path of each node
   bool  visit[num];         // store visited status of each node
   stack s = newStack();     // stack used in DFS_path

   // initialize arrays
   for (i = 0; i < num; i++) {
      length[i] = 0;
      visit[i]  = false;
   }

   // traversal the graph
   for (i = 0; i < num; i++)
     if (!visit[i])
       DFS_max(words, i, length, visit);

   // calculate maximum sequence length
   max = 0;
   for (i = 0; i < num; i++)
     if (max < length[i])
       max = length[i];
   max = max + 1;          // convert path length to sequence length

   printf("Maximum sequence length: %d\n", max);
   printf("Maximal sequence(s):\n");

   // convert sequence length to path length
   max = max - 1;
   // traversal the graph and print the maximal sequence(s)
   for (i = 0; i < num; i++)
     if (length[i] == max) {
       // initialize stack
       StackPush(s, i);
       DFS_path(words, w, s, i, max);
     }
   
   dropStack(s);
   freeGraph(words);
}