#include <stdio.h>
#include <stdlib.h>
#include "Graph.h"

int main() {
  int   num;
  int   key;
  Edge  e;
  Graph g;

  printf("Enter the number of vertices: ");
  if (scanf("%d", &num) == 1)
    g = newGraph(num);
  else
    printf("Done.\n");

  while (1) {
    printf("Enter an edge (from): ");
    if (scanf("%d", &key) == 1)
      e.v = key;
    else
      break;
    printf("Enter an edge (to): ");
    if (scanf("%d", &key) == 1)
      e.w = key;
    else
      break;
    insertEdge(g, e);
  }
  printf("Done.\n");

  int i,j,k;
  int count;

  for (i = 0; i < num; i++) {
    printf("Degree of node %d: ", i);
    count = 0;
    for (j = 0; j < num; j++)
      if (adjacent(g, i, j))
        count++;
    printf("%d\n", count);
  }

  printf("Triangles:\n");
  for (i = 0; i < num - 2; i++)
      for (j = i+1; j < num - 1; j++)
	      if (adjacent(g,i,j))
	        for (k = j+1; k < num; k++)
	          if (adjacent(g,i,k) && adjacent(g,j,k))
		          printf("%d-%d-%d\n", i, j, k);
}