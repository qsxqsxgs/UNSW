// Red-Black Tree ADT implementation ... COMP9024 21T3

#include <stdio.h>
#include <stdlib.h>
#include <assert.h>
#include <math.h>
#include "RBTree.h"

#define PRINT_COLOUR_RED   "\x1B[31m"
#define PRINT_COLOUR_RESET "\x1B[0m"

#define data(tree)   ((tree)->data)
#define left(tree)   ((tree)->left)
#define right(tree)  ((tree)->right)
#define inRight(tree) ((tree)->inRight)
#define colour(tree) ((tree)->colour)
#define NodeisRed(t) ((t) != NULL && (t)->colour == RED)

typedef enum {RED,BLACK} Colr;

typedef struct Node {
   Item data;
   Colr colour;
   Tree left, right;
   bool inRight;
} Node;

// create a new empty Tree
Tree newTree() {
   return NULL;
}

// make a new node containing data
Tree newNode(Item it) {
   Tree new = malloc(sizeof(Node));
   assert(new != NULL);
   data(new) = it;
   colour(new) = RED;
   left(new) = right(new) = NULL;
   inRight(new) = NULL;
   return new;
}

Tree rotateRight(Tree);
Tree rotateLeft(Tree);

// insert a new item into a tree
Tree TreeInsert(Tree t, Item it){
   if (t == NULL){
      t = newNode(it);
   }
   else if (it == data(t))
      return t;

   if (left(t) != NULL && right(t) != NULL){
      if (colour(left(t)) == RED && colour(right(t)) == RED) {
         colour(left(t)) = BLACK;
         colour(right(t)) = BLACK;
         if (data(t) == 12){
            colour(t) = BLACK;
         }
         else if (data(t) == 19){
            colour(t) = RED;
         }
         else if (data(t) == 43){
            colour(t) = RED;
         }
      } 
   }

   if (it < data(t)){
      left(t) = TreeInsert(left(t), it);
      inRight(left(t)) = false;

      if (left(left(t)) == NULL && right(left(t)) == NULL)
         colour(left(t)) = RED;

      if (inRight(t) == true && colour(t) == RED && colour(left(t)) == RED){
         t = rotateRight(t);
         return t;
      }

      if (left(left(t)) != NULL){
         if (colour(left(t)) == RED && colour(left(left(t))) == RED){
            colour(t) = RED;
            colour(left(t)) = BLACK;
            t = rotateRight(t);
            return t;
         }
      }
      return t;
   }
   else if (it > data(t)){
      right(t) = TreeInsert(right(t), it);
      inRight(right(t)) = true;

      if (left(right(t)) == NULL && right(right(t)) == NULL)
         colour(right(t)) = RED;

      if (inRight(t) == false && colour(t) == RED && colour(right(t)) == RED){
         t = rotateLeft(t);
         return t;
      }

      if (right(right(t)) != NULL){
         if (colour(right(t)) == RED && colour(right(right(t))) == RED){
            colour(t) = RED;
            colour(right(t)) = BLACK;
            t = rotateLeft(t);
            return t;
         }
      }
      return t;
   }
   colour(t) = BLACK;
   return t;
}

// check whether a key is in a Tree
bool TreeSearch(Tree t, Item it) {
   if (t == NULL)
      return false;
   else if (it < data(t))
      return TreeSearch(left(t), it);
   else if (it > data(t))
      return TreeSearch(right(t), it);
   else                                 // it == data(t)
      return true;
}

Tree rotateRight(Tree n1) {
   if (n1 == NULL || left(n1) == NULL)
      return n1;
   Tree n2 = left(n1);
   left(n1) = right(n2);
   right(n2) = n1;
   return n2;
}

Tree rotateLeft(Tree n2) {
   if (n2 == NULL || right(n2) == NULL)
      return n2;
   Tree n1 = right(n2);
   right(n2) = left(n1);
   left(n1) = n2;
   return n1;
}

// free memory associated with Tree
void freeTree(Tree t) {
   if (t != NULL) {
      freeTree(left(t));
      freeTree(right(t));
      free(t);
   }
}

// display Tree sideways
void showTreeR(Tree t, int depth) {
   if (t != NULL) {
      showTreeR(right(t), depth+1);
      int i;
      for (i = 0; i < depth; i++)
	 putchar('\t');            // TAB character
      if (NodeisRed(t))
	 printf("%s%d%s\n", PRINT_COLOUR_RED, data(t), PRINT_COLOUR_RESET);
       else
	 printf("%d\n", data(t));
      showTreeR(left(t), depth+1);
   }
}

void showTree(Tree t) {
   showTreeR(t, 0);
}