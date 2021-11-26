#include <stdio.h>
#include <stdlib.h>
#include <assert.h>

typedef struct node {
   int data;
   struct node *next;
} NodeT;

NodeT *makeNode(int v) {
   NodeT *new = malloc(sizeof(NodeT));
   assert(new != NULL);
   new->data = v;       // initialise data
   new->next = NULL;    // initialise link to next node
   return new;          // return pointer to new node
}

NodeT *joinLL(NodeT *list, int v) {
   NodeT *p;
   NodeT *tail;

   p = makeNode(v);
   tail = list;

   if (tail == NULL)
     return p;

   while (tail->next != NULL)
     tail = tail->next;

   tail->next = p;
   return list;
}

void showLL(NodeT *list) {
   NodeT *p;
   for (p = list; p != NULL; p = p->next) {
      if (p->next == NULL)
        printf("%d", p->data);
      else
        printf("%d-->", p->data);
   }
}

void freeLL(NodeT *list) {
   NodeT *p, *temp;

   p = list;
   while (p != NULL) {
      temp = p->next;
      free(p);
      p = temp;
   }
}

int main() {
   int    num;
   int    flag;
   NodeT *all = NULL;

   printf("Enter a number: ");
   while (scanf("%d", &num) == 1) {
      all = joinLL(all, num);
      printf("Enter a number: ");
   }

   if (all != NULL) {
      printf("Done. List is ");
      showLL(all);
      freeLL(all);
   }
   else {
      printf("Done.");
   }
}