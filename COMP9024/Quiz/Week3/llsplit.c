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

void showLL(NodeT *list, int length) {
   NodeT *p;
   if (list == NULL){
      printf("Done.");
   } else {
      int i = 0;
      while (i < 3*length){
         if (i == 0){
            p = list;
            printf("Done. List is ");
         }
         if (i == length){
            p = list;
            i ++;
            printf("Odd-numbered elements are ");
         }
         if (i == 2*length){
            printf("%d\n", p->data);
            p = list->next;
            printf("Even-numbered elements are ");
            i ++;
         }
         
         if (i < length){
            if (p->next == NULL){
              printf("%d\n", p->data);
            } else {
              printf("%d-->", p->data);
            }
         p = p->next;
         i ++;
         } else if(i < 2*length) {
            printf("%d-->", p->data);
            p = (p->next)->next;
            i += 2;
         } else if(i > 2*length && i <= 3*length){
            if ((p->next)->next == NULL){
              printf("%d\n", p->data);
            } else {
              printf("%d-->", p->data);
            }
         p = (p->next)->next;
         i += 2;
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

   int flag, num, len;
   printf("Enter a number: ");
   flag = scanf("%d", &num);
   while(flag == 1){
      if(all == NULL){
         all = makeNode(num);
         head = all;
         len = 1;
         printf("Enter a number: ");
         flag = scanf("%d", &num);
      } else {
         all = joinLL(all, num);
         len ++;
         printf("Enter a number: ");
         flag = scanf("%d", &num);
      }
   }

   //printf("%d", len);
   showLL(head, len);
   freeLL(head);

   return 0;
}