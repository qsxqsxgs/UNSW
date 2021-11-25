#include <stdio.h>
#include <stdlib.h>
#include <assert.h>

typedef struct node {
   int data;
   struct node *next;
} NodeT;

void freeLL(NodeT *list) {
   NodeT *p, *temp;
   p = list;
   while (p != NULL) {
      temp = p->next;
      free(p);
      p = temp;
   }
}

void showLL(NodeT *list) {
   NodeT *p;
   if (list == NULL){
      printf("Done.");
   } else {
      printf("Done. List is ");
      for (p = list; p != NULL; p = p->next){
         if (p->next == NULL){
            printf("%d", p->data);
         } else {
            printf("%d-->", p->data);
         }
      }
   }
}

NodeT *makeNode(int v) {
   NodeT *new = malloc(sizeof(NodeT));
   assert(new != NULL);
   new -> data = v;
   new -> next = NULL;
   return new;
}

NodeT *joinLL(NodeT *list, int v) {
   NodeT *new = makeNode(v);
   list -> next = new;
   return new;
}

int main() {
   NodeT *all = NULL;
   NodeT *head = NULL;

   int flag, num;
   printf("Enter a number: ");
   flag = scanf("%d", &num);
   while(flag == 1){
      if(all == NULL){
         all = makeNode(num);
         head = all;
         printf("Enter a number: ");
         flag = scanf("%d", &num);
      } else {
         all = joinLL(all, num);
         printf("Enter a number: ");
         flag = scanf("%d", &num);
      }
   }

   showLL(head);
   freeLL(head);

   return 0;
}