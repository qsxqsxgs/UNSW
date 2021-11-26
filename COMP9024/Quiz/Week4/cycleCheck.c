#include <stdio.h>
#include <stdlib.h>
#include <stdbool.h>
#include "Graph.h"

bool cycleCheck(Graph g, Vertex curr, Vertex prev, bool v[]) {
  int i;
  int num = numOfVertices(g);

  if (v[curr])
    return true;
  
  v[curr] = true;
  for (i = 0; i < num; i++)
    if (adjacent(g, curr, i) && i != prev)
      if (cycleCheck(g, i, curr, v))
        return true;

  return false;
}

void showResult(Graph g) {
  int  i;
  int  num = numOfVertices(g);
  bool result = false;
  bool visit[num];
  for (i = 0; i < num; i++)
    visit[i] = false;

  for (i = 0; i < num; i++)
    if (!visit[i])
      if (cycleCheck(g, i, i, visit))
        result = true;

  if (result)
    printf("The graph has a cycle.");
  else
    printf("The graph is acyclic.");
}

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
  showResult(g);
}