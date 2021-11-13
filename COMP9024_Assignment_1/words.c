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
   // show graph according to assignment format
   showGraph(words, w);

   printf("\n");

   int  max;
   int  length[num];        // store longest path of each node
   bool visit[num];         // store visited status of each node

   // initialize arrays
   for (i = 0; i < num; i++) {
      length[i] = 0;
      visit[i] = false;
   }

   // call DFS to traversal the graph
   for (i = 0; i < num; i++)
     if (!visit[i])
       DFS(words, i, length, visit);

   // calculate maximum sequence length
   max = 0;
   for (i = 0; i < num; i++)
     if (max < length[i])
       max = length[i];
   max = max + 1;

   printf("Maximum sequence length: %d\n", max);
}