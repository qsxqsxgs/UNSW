#include <stdio.h>
#include <stdlib.h>
#include "./WGraph/WGraph.h"

typedef struct Node {
   int key;
   int in;
   int out;
} Node;

void insertionSort(Node array[], int n) {
   int i;
   for (i = 1; i < n; i++) {
      int  j = i - 1;
      Node element = array[i];
      while (j >= 0 && array[j].in <= element.in) {
         if (array[j].in < element.in)
            array[j + 1] = array[j];
         if (array[j].in == element.in && array[j].out < element.out)
            array[j + 1] = array[j];
         if (array[j].in == element.in && array[j].out >= element.out)
            break;
         j--;
      }
      array[j + 1] = element;
   }
}

int main() {
   int   num;
   int   key;
   Edge  e;
   Graph g;

   printf("Enter the number of users: ");
   if (scanf("%d", &num) == 1)
     g = newGraph(num);
   else
     printf("Done.\n");
 
   while (1) {
     printf("Enter a user (follower): ");
     if (scanf("%d", &key) == 1)
       e.v = key;
     else
       break;
     printf("Enter a user (followed by %d): ", e.v);
     if (scanf("%d", &key) == 1)
       e.w = key;
     else
       break;
     e.weight = 1;
     insertEdge(g, e);
   }
   printf("Done.\n\n");
   printf("Ranking by follower base:\n");
  
   int  i,j;
   Node user[num];
   for (i = 0; i < num; i++) {
     user[i].key = i;
     user[i].in = 0;
     user[i].out = 0;
   }
   for (i = 0; i < num; i++) {
     for (j = 0; j < num; j++) {
       if (adjacent(g, i, j) == 1)
         user[i].out++;
       if (adjacent(g, j, i) == 1)
         user[i].in++;
     }
   }

   insertionSort(user, num);
   for (i = 0; i < num; i++)
      printf("%d has %d follower(s) and follows %d user(s).\n",
      user[i].key, user[i].in, user[i].out);
}