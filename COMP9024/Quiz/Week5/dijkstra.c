// Starting code for Dijkstra's algorithm ... COMP9024 21T3

#include <stdio.h>
#include <stdbool.h>
#include "./PQueue/PQueue.h"

#define VERY_HIGH_VALUE 999999

void showPath(int v, int pred[]) {
   if (pred[v] == -1) {
      printf("%d", v);
   } else {
      showPath(pred[v], pred);
      printf("-%d", v);
   }
}

void dijkstraSSSP(Graph g, Vertex source) {
   int  dist[MAX_NODES];
   int  pred[MAX_NODES];
   bool vSet[MAX_NODES];  // vSet[v] = true <=> v has not been processed
   int s, t;

   PQueueInit();
   int nV = numOfVertices(g);
   for (s = 0; s < nV; s++) {
      joinPQueue(s);
      dist[s] = VERY_HIGH_VALUE;
      pred[s] = -1;
      vSet[s] = true;
   }
   dist[source] = 0;
   while (!PQueueIsEmpty()) {
      s = leavePQueue(dist);
      vSet[s] = false;
      for (t = 0; t < nV; t++) {
         if (vSet[t]) {
            int weight = adjacent(g,s,t);
            if (weight > 0 && dist[s]+weight < dist[t]) {  // relax along (s,t,weight)
               dist[t] = dist[s] + weight;
               pred[t] = s;
            }
         }
      }
   }
   for (s = 0; s < nV; s++) {
      printf("%d: ", s);
      if (dist[s] < VERY_HIGH_VALUE) {
         printf("distance = %d, shortest path: ", dist[s]);
         showPath(s, pred);
         putchar('\n');
      } else {
         printf("no path\n");
      }
   }
}

void reverseEdge(Edge *e) {
   Vertex temp = e->v;
   e->v = e->w;
   e->w = temp;
}

int main(void) {
   Edge e;
   int  n, source;

   printf("Enter the number of vertices: ");
   scanf("%d", &n);
   Graph g = newGraph(n);

   printf("Enter the source node: ");
   scanf("%d", &source);
   printf("Enter an edge (from): ");
   while (scanf("%d", &e.v) == 1) {
      printf("Enter an edge (to): ");
      scanf("%d", &e.w);
      printf("Enter the weight: ");
      scanf("%d", &e.weight);
      insertEdge(g, e);
      reverseEdge(&e);               // ensure to add edge in both directions
      insertEdge(g, e);
      printf("Enter an edge (from): ");
   }
   printf("Done.\n");
   
   dijkstraSSSP(g, source);
   freeGraph(g);
   return 0;
}