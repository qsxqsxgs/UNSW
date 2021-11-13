// Graph ADT interface ... COMP9024 21T3
#include <stdbool.h>

#include "stack.h"

typedef struct GraphRep  *Graph;
typedef struct VertexRep *Vertex;

// edges are pairs of vertices (end-points)
typedef struct Edge {
   Vertex v;
   Vertex w;
} Edge;

Graph  newGraph(int);
int    numOfVertices(Graph);
void   insertEdge(Graph, Edge);
void   removeEdge(Graph, Edge);
bool   adjacent(Graph, Vertex, Vertex);
void   freeGraph(Graph);

// new or revised functions
Vertex newVertex(int, char*);
bool   checkVertices(Vertex, Vertex);
void   DFS_max(Graph, int, int*, bool*);
void   DFS_path(Graph, Vertex*, stack, int, int);
void   showGraph(Graph, Vertex*);