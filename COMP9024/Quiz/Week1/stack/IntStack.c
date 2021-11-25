// Stack ADO implementation ... COMP9024 21T3

#include "IntStack.h"
#include <assert.h>

typedef struct {
   int num[MAXITEMS];
   int top;
} stackRep;                   // defines the Data Structure

static stackRep stackObject;  // defines the Data Object

void StackInit() {            // set up empty stack
   stackObject.top = -1;
}

int StackIsEmpty() {          // check whether stack is empty
   return (stackObject.top < 0);
}

void StackPush(int n) {     // insert char on top of stack
   assert(stackObject.top < MAXITEMS-1);
   stackObject.top++;
   int i = stackObject.top;
   stackObject.num[i] = n;
}

int StackPop() {             // remove char from top of stack
   assert(stackObject.top > -1);
   int i = stackObject.top;
   int n = stackObject.num[i];
   stackObject.top--;
   return n;
}