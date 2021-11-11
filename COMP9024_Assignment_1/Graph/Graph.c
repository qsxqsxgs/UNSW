// Graph ADT
// Adjacency Matrix Representation ... COMP9024 21T3
#include "Graph.h"
#include <assert.h>
#include <stdlib.h>
#include <stdio.h>
#include <string.h>

typedef struct GraphRep {
   int  **edges;   // adjacency matrix
   int    nV;      // #vertices
   int    nE;      // #edges
} GraphRep;

// vertices are pairs of keys and words
typedef struct VertexRep {
   int  key;
   char word;
} VertexRep;

Graph newGraph(int V) {
   assert(V >= 0);
   int i;

   Graph g = malloc(sizeof(GraphRep));
   assert(g != NULL);
   g->nV = V;
   g->nE = 0;

   // allocate memory for each row
   g->edges = malloc(V * sizeof(Vertex));
   assert(g->edges != NULL);
   // allocate memory for each column and initialise with 0
   for (i = 0; i < V; i++) {
      g->edges[i] = calloc(V, sizeof(Vertex));
      assert(g->edges[i] != NULL);
   }

   return g;
}

Vertex newVertex(int K, char W) {
   assert(K >= 0);
   assert(strlen(&W) <= 31);
   
   Vertex v = malloc(sizeof(VertexRep));
   assert(v != NULL);
   v->key = K;
   v->word = W;
   
   return v;
}

int numOfVertices(Graph g) {
   return g->nV;
}

// check if vertex is valid in a graph
bool validV(Graph g, Vertex v) {
   return (g != NULL && v->key >= 0 && v->key < g->nV);
}

void insertEdge(Graph g, Edge e) {
   assert(g != NULL && validV(g,e.v) && validV(g,e.w));

   if (!g->edges[e.v->key][e.w->key]) {  // edge e not in graph
      g->edges[e.v->key][e.w->key] = 1;
      g->edges[e.v->key][e.w->key] = 1;
      g->nE++;
   }
}

void removeEdge(Graph g, Edge e) {
   assert(g != NULL && validV(g,e.v) && validV(g,e.w));

   if (g->edges[e.v->key][e.w->key]) {   // edge e in graph
      g->edges[e.v->key][e.w->key] = 0;
      g->edges[e.v->key][e.w->key] = 0;
      g->nE--;
   }
}

bool adjacent(Graph g, Vertex v, Vertex w) {
   assert(g != NULL && validV(g,v) && validV(g,w));

   return (g->edges[v->key][w->key] != 0);
}

void showGraph(Graph g) {
    assert(g != NULL);
    int i, j;

    printf("Number of vertices: %d\n", g->nV);
    printf("Number of edges: %d\n", g->nE);
    for (i = 0; i < g->nV; i++)
       for (j = i + 1; j < g->nV; j++)
	      if (g->edges[i][j])
	        printf("Edge %d - %d\n", i, j);
}

void freeGraph(Graph g) {
   assert(g != NULL);
   int i;

   for (i = 0; i < g->nV; i++) {
      free(g->edges[i]);
   }
   free(g->edges);
   free(g);
}