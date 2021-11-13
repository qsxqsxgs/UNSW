// Stack ADT implementation ... COMP9024 21T3

#include <stdio.h>
#include <stdlib.h>
#include <assert.h>

#include "stack.h"

typedef struct node {
    int data;
    struct node *next;
} NodeT;

typedef struct StackRep {
    int    height;   // #elements on stack
    NodeT *top;      // ptr to first element
} StackRep;

// set up empty stack
stack newStack() {
    stack S = malloc(sizeof(StackRep));
    assert(S != NULL);
    S->height = 0;
    S->top = NULL;
    return S;
}

stack reverseStack(stack S) {
    int   i;
    int   n;
    int   temp;
    stack new = newStack();

    n = S->height;

    for (i = 0; i < n; i++) {
        temp = S->top->data;
        StackPop(S);
        StackPush(new, temp);
    }
    return new;
}

// remove unwanted stack
void dropStack(stack S) {
    NodeT *curr = S->top;
    while (curr != NULL) {
        NodeT *temp = curr->next;
        free(curr);
        curr = temp;
    }
    free(S);
}

// check whether stack is empty
bool StackIsEmpty(stack S) {
    return (S->height == 0);
}

// insert an int on top of stack
void StackPush(stack S, int v) {
    NodeT *new = malloc(sizeof(NodeT));
    assert(new != NULL);
    new->data = v;
    new->next = S->top;
    S->top = new;
    S->height++;
}

// remove int from top of stack
int StackPop(stack S) {
    assert(S->height > 0);
    NodeT *head = S->top;
    S->top = S->top->next;
    S->height--;
    int d = head->data;
    free(head);
    return d;
}