#include "WGraph.h"

// Follower Base Alogrithms Implementation
// Edge Initialiaztion
Edge *newEdge(Vertex v, Vertex w) {
   Edge *new = malloc(sizeof(Edge));
   assert(new != NULL);
   new -> v = v;
   new -> w = w;
   new -> weight = 1;
   return new;
}
// List Initialization and Bubble Sort
typedef struct node {
  Vertex v;
  int f1;
  int f2;
  struct node *next;
}NodeT;

NodeT *newList(Graph g, Vertex v) {
  NodeT *p = malloc(sizeof(NodeT));
  assert(p != NULL);
  p -> v = v;
  p -> f1 = countFollow(g, v);
  p -> f2 = countFollowed(g, v);
  p -> next = NULL;
  return p;
}

NodeT *joinList(Graph g, Vertex v, NodeT *p) {
  NodeT *new = newList(g, v);
  p -> next = new;
  return new;
}

void freeList(NodeT *list) {
   NodeT *p, *temp;
   p = list;
   while (p != NULL) {
      temp = p->next;
      free(p);
      p = temp;
   }
}

NodeT *bubbleSort(NodeT *p) {
  if (p == NULL) {
    return p;
  }
  
  NodeT *out = p;
  NodeT *inside = p;

  int v;
  int f1;
  int f2;

  while (out != NULL) {
    for (inside = out -> next; inside != NULL;) {
      if (out -> f2 < inside -> f2) {
        v = out -> v;
        out -> v = inside -> v;
        inside -> v = v;

        f1 = out -> f1;
        out -> f1 = inside -> f1;
        inside -> f1 = f1;

        f2 = out -> f2;
        out -> f2 = inside -> f2;
        inside -> f2 = f2;
      } else if (out -> f2 == inside ->f2) {
        if (out -> f1 < inside -> f1) {
        v = out -> v;
        out -> v = inside -> v;
        inside -> v = v;

        f1 = out -> f1;
        out -> f1 = inside -> f1;
        inside -> f1 = f1;

        f2 = out -> f2;
        out -> f2 = inside -> f2;
        inside -> f2 = f2;
        } else if (out -> f1 == inside -> f1) {
          if (out -> v > inside -> v) {
          v = out -> v;
          out -> v = inside -> v;
          inside -> v = v;

          f1 = out -> f1;
          out -> f1 = inside -> f1;
          inside -> f1 = f1;

          f2 = out -> f2;
          out -> f2 = inside -> f2;
          inside -> f2 = f2;
          }
        }
      }
      inside = inside -> next;
    }
    out = out -> next;
  }
  return p;
}

// Count User's followers and following
int countFollow(Graph g, Vertex v) {
  int i;
  int count = 0;
  for (i = 0; i< g -> nV; i++) {
    if (g -> edges[v][i] != 0) {
      count++;
    }
  }
  return count;
}

int countFollowed(Graph g, Vertex v) {
  int i;
  int count = 0;
  for (i = 0; i< g -> nV; i++) {
    if (g -> edges[i][v] != 0) {
      count++;
    }
  }
  return count;
}

// Show Function
void showFollowBase(Graph g) {
  assert(g != NULL);
    int i;
    NodeT *all = NULL;
    NodeT *head = NULL;

    // Assign Value to Link List
    for (i = 0; i < g->nV; i++) {
      if(all == NULL) {
        all = newList(g,i);
        head = all;
      } else {
        all = joinList(g,i,all);
      }
    }

    head = bubbleSort(head);

    for (i = 0; i< g->nV; i++) {
      printf("%d has %d follower(s) and follows %d user(s).\n", head->v,head->f2,head->f1);
      head = head->next;
    }

    freeList(head);
}
//

int main() {
  int num;
  int flag1;

  printf("Enter the number of users: ");
  flag1 = scanf("%d", &num);
  if (flag1 == 1) {
    Graph platform = newGraph(num);
  
    int follower;
    int followed;
    int flag2;

    printf("Enter a user (follower): ");
    flag2 = scanf("%d", &follower);

    while (flag2 == 1 && validV(platform,follower)) {
      printf("Enter a user (followed by %d): ", follower);
      scanf("%d", &followed);
 
      assert(validV(platform,followed));
    
      Edge *e = newEdge(follower,followed);
      insertEdge(platform, *e);

      printf("Enter a user (follower): ");
      flag2 = scanf("%d", &follower);
    }

    printf("Done.\n\n");
    printf("Ranking by follower base:\n");
    showFollowBase(platform);
    freeGraph(platform);
  } else {
    printf("Done.");
  }
}