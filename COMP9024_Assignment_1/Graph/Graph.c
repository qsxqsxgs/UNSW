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
   char word[31];
} VertexRep;

Graph newGraph(int V) {
   assert(V >= 0);
   int i;

   Graph g = malloc(sizeof(GraphRep));
   assert(g != NULL);
   g->nV = V;
   g->nE = 0;

   // allocate memory for each row
   g->edges = malloc(V * sizeof(int));
   assert(g->edges != NULL);
   // allocate memory for each column and initialise with 0
   for (i = 0; i < V; i++) {
      g->edges[i] = calloc(V, sizeof(int));
      assert(g->edges[i] != NULL);
   }

   return g;
}

Vertex newVertex(int K, char* W) {
   assert(K >= 0);
   assert(strlen(W) > 0 && strlen(W) <= 31);

   Vertex v = malloc(sizeof(VertexRep));
   assert(v != NULL);
   v->key = K;
   // store string into vertex
   strcpy(v->word,W);
   
   return v;
}

// clarify relationship between vertices
bool checkVertices(Vertex v, Vertex w) {
   int  i,j;              // counters
   int  diff;             // differences between words
   bool flag;             // status check
   
   diff = 0;
   flag = false;

   // branch if two words have same length
   if (strlen(v->word) == strlen(w->word)) {
      for (i = 0; i < strlen(v->word); i++)
        if (v->word[i] != w->word[i])
          diff++;
   }
   // branch if two words have length of exactly 1 character difference
   else if (abs(strlen(v->word) - strlen(w->word)) == 1) {
      diff = 1;          // initialize difference

      // check if each character in the shorter word is contained in the longer one
      if (strlen(v->word) > strlen(w->word)) {
         for (i = 0; i < strlen(w->word); i++) {
            for (j = i; j < strlen(v->word); j++) {
               if (w->word[i] == v->word[j]) {
                  flag = true;
                  break;
               }
            }
            // return false if not contained
            if (!flag)
               return false;
            // reset flag
            flag = false;
         }
      }
      else {
         for (i = 0; i < strlen(v->word); i++) {
            for (j = i; j < strlen(w->word); j++) {
               if (v->word[i] == w->word[j]) {
                  flag = true;
                  break;
               }
            }
            if (!flag)
               return false;
            flag = false;
         }
      } 
   }
   // return false if length difference >= 1
   else
     return false;

   // return true if difference == 1
   if (diff == 1)
     return true;
   else
     return false;
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

// depth first search check longest path of each node
void DFS(Graph g, int i, int *length, bool *visit) {
   int j;
   int next;

   if (visit[i])
     return;

   visit[i] = true;
   for (j = i + 1; j < g->nV; j++) {
      if (g->edges[i][j] == 1) {
         next = j;
         if (!visit[next])
           DFS(g, next, length, visit);
         if (length[i] < length[next] + 1)
           length[i] = length[next] + 1;
      }
   }
}

void showGraph(Graph g, Vertex *v) {
   assert(g != NULL);
   int i, j;

   for (i = 0; i < g->nV; i++) {
      printf("%s:", &v[i]->word);
      for (j = i + 1; j < g->nV; j++) {
         if (g->edges[i][j])
           printf(" %s", &v[j]->word);
      }
      printf("\n");
   }
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