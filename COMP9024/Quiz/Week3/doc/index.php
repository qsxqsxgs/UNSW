<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>COMP9024 21T3 - Week 3 Problem Set</title>
<link rel='stylesheet' type='text/css' href='./course.css'><script language="JavaScript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.1/MathJax.js?config=AM_HTMLorMML">
function changeText(el, newText) {
  // Safari work around
  if (el.innerText)
    el.innerText = newText;
  else if (el.firstChild && el.firstChild.nodeValue)
    el.firstChild.nodeValue = newText;
}
function toggleVisible(elid) {
  el1 = document.getElementById(elid);
  el2 = document.getElementById(elid+"a");
  if (el1.style.display == "") {
     el1.style.display = "none";
     changeText(el2,"show answer");
  }
  else {
     el1.style.display = "";
     changeText(el2,"hide answer");
  }
}
</script></head>
<body>
<div align='center'>
<table width='100%' border='0'>
<tr valign='top'>
<td align='left' width='25%'>
  <table><tr valign='top'><td><span class='tiny'><a href="http://www.cse.unsw.edu.au/~cs9024/21T3/index.html">COMP9024 21T3</a></span></td></tr>
  <tr><td><span class='tiny'><a href="http://www.cse.unsw.edu.au/~mit/">Prof Michael Thielscher</a></span></td></tr></table>
</td>
<td align='center' width='50%'>
  <span class='heading'>Week 3 Problem Set</span><br/>
  <span class='subheading'>Dynamic Data Structures</span>
</td>
<td align='right' width='25%'>
  <span class='heading'><img src="unsw.png"></span>
</td>
</table>
</div><p style='text-align:center;font-size:75%'><a href='/~cs9024/21T3/probs/prob3/index.php?view=qo'>[Show with no answers]</a> &nbsp; <a href='/~cs9024/21T3/probs/prob3/index.php?view=all'>[Show with all answers]</a></div>

<ol>

<br/>
<li>(Memory)
<p>
Given the following definition:
 <pre>
int data[12] = {5, 3, 6, 2, 7, 4, 9, 1, 8};
</pre>
 and assuming that <i>&amp;data[0] == 0x10000</i>, what are the values of the following expressions?
<p><table border="1" cellpadding="8">
 <tr><td> data + 4 </td></tr>
 <tr><td> *data + 4 </td></tr>
 <tr><td> *(data + 4) </td></tr>
 <tr><td> data[4] </td></tr>
 <tr><td> *(data + *(data + 3)) </td></tr>
 <tr><td> data[data[2]] </td></tr>
</table></p>
<p><small>[<a id="q1a" href="##" onclick="toggleVisible('q1')">show answer</a>]</small></p>
<div id="q1" style="color:#000099;display:none">
<p><table border="1" cellpadding="8" style="color:#000099">
 <tr><td> data + 4              </td><td> == 0x10000 + 4 * 4 bytes == 0x10010 </td></tr>
 <tr><td> *data + 4             </td><td> == data[0] + 4 == 5 + 4 == 9 </td></tr>
 <tr><td> *(data + 4)           </td><td> == data[4] == 7 </td></tr>
 <tr><td> data[4]               </td><td> == 7 </td></tr>
 <tr><td> *(data + *(data + 3)) </td><td> == *(data + data[3]) == *(data + 2) == data[2] == 6 </td></tr>
 <trd><td> data[data[2]]         </td><td> == data[6] == 9 </td></tr>
</table></p>
</div>

<br/>
<li>(Pointers)
<p>
Consider the following piece of code:
<pre>
typedef struct {
   int   studentID;
   int   age;
   char  gender;
   float WAM;
} PersonT;

PersonT per1;
PersonT per2;
PersonT *ptr;

ptr = &amp;per1;
per1.studentID = 3141592;
ptr-&gt;gender = 'M';
ptr = &amp;per2;
ptr-&gt;studentID = 2718281;
ptr-&gt;gender = 'F';
per1.age = 25;
per2.age = 24;
ptr = &amp;per1;
per2.WAM = 86.0;
ptr-&gt;WAM = 72.625;
</pre>
</p>
<p>What are the values of the fields in the <i>per1</i> and <i>per2</i> record after execution of the above statements?</p>

<p><small>[<a id="q2a" href="##" onclick="toggleVisible('q2')">show answer</a>]</small></p>
<div id="q2" style="color:#000099;display:none">
<p>
<table border="1" cellpadding="8" style="color:#000099">
 <tr><td> per1.studentID     </td><td> == 3141592 </td></tr>
 <trd><td> per1.age      </td><td> == 25 </td></tr>
 <tr><td> per1.gender   </td><td> == 'M' </td></tr>
 <tr><td> per1.WAM </td><td> == 72.625</td></tr>
 <tr><td> per2.studentID     </td><td> == 2718281 </td></tr>
 <tr><td> per2.age      </td><td> == 24 </td></tr>
 <tr><td> per2.gender   </td><td> == 'F' </td></tr>
 <tr><td> per2.WAM </td><td> == 86.0 </td></tr>
</table>
</p>
</div>

<br/>
<li>(Memory management)

<p>
Consider the following function:
<pre>
/* Makes an array of 10 integers and returns a pointer to it */

int *makeArrayOfInts() {
   int arr[10];
   int i;
   for (i=0; i&lt;10; i++) {
      arr[i] = i;
   }
   return arr;
}
</pre>
<p>Explain what is wrong with this function. Rewrite the function so that it correctly achieves the intended result using &nbsp;<tt>malloc()</tt>.</p>
<p><small>[<a id="q3a" href="##" onclick="toggleVisible('q3')">show answer</a>]</small></p>
<div id="q3" style="color:#000099;display:none">
<p>The function is erroneous because the array <tt>arr</tt> will cease to exist after the line <tt>return arr</tt>, since <tt>arr</tt> is local to this function and gets destroyed once the function returns.
So the caller will get a pointer to something that doesn't exist anymore, and you will start to see garbage, segmentation faults, and other errors.</p>
<p>
Arrays created with <tt>malloc()</tt> are stored in a separate place in memory, the heap, which ensures they live on indefinitely until you free them yourself.
</p>
The correctly implemented function is as follows:
<pre class="answer">
int *makeArrayOfInts() {
   int *arr = malloc(sizeof(int) * 10);
   assert(arr != NULL);  // always check that memory allocation was successful
   int i;
   for (i=0; i&lt;10; i++) {
      arr[i] = i;
   }
   return arr;           // this is fine because the array itself will live on
}
</pre></p>
</div>

<br/>
<li>(Memory management)
<p>
Consider the following program:
<pre>
#include &lt;stdio.h&gt;
#include &lt;stdlib.h&gt;
#include &lt;assert.h&gt;

void func(int *a) {
   a = malloc(sizeof(int));
   assert(a != NULL);
}

int main(void) {
   int *p;
   func(p);
   *p = 6;
   printf(&quot;%d\n&quot;,*p);
   free(p);
   return 0;
}
</pre>
<p>Explain what is wrong with this program.
</p>
<p><small>[<a id="q4a" href="##" onclick="toggleVisible('q4')">show answer</a>]</small></p>
<div id="q4" style="color:#000099;display:none">
<p>The program is not valid because <tt>func()</tt> makes a <i>copy</i> of the pointer <tt>p</tt>. So when <tt>malloc()</tt> is called, the result is assigned to the copied pointer rather than to <tt>p</tt>. Pointer <tt>p</tt> itself is pointing to random memory (e.g., <tt>0x0000</tt>) before and after the function call. Hence, when you dereference it, the program will (likely) crash.</p>
If you want to use a function to add memory to a pointer, then you need to pass the <i>address</i> of the pointer (i.e. a pointer to a pointer, or "double pointer"):
<pre class="answer">
#include &lt;stdio.h&gt;
#include &lt;stdlib.h&gt;
#include &lt;assert.h&gt;

void func(int **a) {
   *a = malloc(sizeof(int));
   assert(*a != NULL);
}

int main(void) {
   int *p;

   func(&p);
   *p = 6;
   printf("%d\n",*p);
   free(p);
   return 0;
}
</pre>
Note also that you should always ensure that <tt>malloc()</tt> did not return <tt>NULL</tt> before you proceed.
</div>

<br/>
<li>(Dynamic arrays)

<p> Write a C-program that
</p>
<ul>
<li> takes 1 command line argument, a positive integer <i>n</i>
<li> creates a dynamic array of <i>n</i> &nbsp; <tt>unsigned long long int </tt> numbers (8 bytes, only positive numbers)
<li> uses the array to compute the <i>n</i>'th Fibonacci number.
</ul>
<p>
For example, <tt><b>./fib 60</b></tt> should result in 1548008755920.
</p>
<p>
<i>Hint</i>: The placeholder &nbsp;<tt>%llu</tt>&nbsp; (instead of <tt>%d</tt>) can be used to print an &nbsp;<tt>unsigned long long int</tt>. Recall that the Fibonacci numbers are defined as Fib(1) = 1, Fib(2) = 1 and Fib(<i>n</i>) = Fib(<i>n</i>-1)+Fib(<i>n</i>-2) for <i>n</i>&geq;3.
</p>

<p>An example of the program executing could be
<pre class="command_line">
<kbd class="shell">./fib 60</kbd>
1548008755920
</pre>
<p>If the commad line argument is missing, then the output to <tt>stderr</tt> should be
<pre class="command_line">
<kbd class="shell">./fib</kbd>
Usage: ./fib number
</pre>
</p>

<p><i>We have created a script that can automatically test your program. To run this test you can execute the </i><tt>dryrun</tt><i> program that corresponds to this exercise. It expects to find a program named </i><tt>fib.c</tt><i> in the current directory. You can use dryrun as follows:</i></p>
<pre class="command_line">
<kbd class="shell">9024 dryrun fib</kbd>
</pre>

<p><small>[<a id="q5a" href="##" onclick="toggleVisible('q5')">show answer</a>]</small></p>
<div id="q5" style="color:#000099;display:none">
<pre class="answer">
#include &lt;stdio.h&gt;
#include &lt;stdlib.h&gt;
#include &lt;assert.h&gt;

int main(int argc, char *argv[]) {
   if (argc != 2) {
      fprintf(stderr, "Usage: %s number\n", argv[0]);
      return 1;
   }

   int n = atoi(argv[1]);
   if (n > 0) {
      unsigned long long int *arr = malloc(n * sizeof(unsigned long long int));
      assert(arr != NULL);
      arr[0] = 1;
      if (n > 1) {
         arr[1] = 1;
         int i;
         for (i = 2; i < n; i++) {
            arr[i] = arr[i-1] + arr[i-2];
         }
      }
      printf("%llu\n", arr[n-1]);
      free(arr);                   // don't forget to free the array
   }
   return 0;
}
</pre>
</div>

<br/>
<li>(Dynamic linked lists)
<p>
Write a C-program called <b>llbuild.c</b> that builds a linked list of integers from user input. Your program should use the following functions:</p>
<ul>
<li><i>void freeLL(NodeT *list)</i>: taken from the lecture.</li>
<li><i>void showLL(NodeT *list)</i>: taken from the lecture <b>but needs modification.</b></li>
<li><i>NodeT *joinLL(NodeT *list, int v)</i>: returns a pointer to the linked list obtained by appending a new element with data <i>v</i> at the end of <i>list</i>. <b>Needs to be implemented.</b></li>
</ul>

<p>The program:
<ul>
  <li> starts with an empty linked list called &nbsp;<tt>all</tt>&nbsp; (say), initialised to <tt>NULL</tt>
  <li> prompts the user with the message &quot;Enter a number: &quot;
  <li> appends at the end of &nbsp;<tt>all</tt>&nbsp; a new linked list node created from user's response
  <li> asks for more user input and repeats the cycle
  <li> the cycle is terminated when the user enters any imput that cannot be interpreted as a number
  <li> on termination, the program generates the message &quot;Done. List is &quot; followed by the contents of the linked list in the format shown below.
</ul>

<p>A sample interaction is:
<pre class="command_line">
<kbd class="shell">./llbuild</kbd>
Enter a number:<b> 12</b>
Enter a number:<b> 34</b>
Enter a number:<b> 56</b>
Enter a number:<b> #</b>
Done. List is 12--&gt;34--&gt;56
</pre>
</p>
<p>If the user provides no data, then no list should be output:
<pre class="command_line">
<kbd class="shell">./llbuild</kbd>
Enter a number:<b> quit</b>
Done.
</pre>

<p><i>We have created a script that can automatically test your program. To run this test you can execute the </i><tt>dryrun</tt><i> program that corresponds to this exercise. It expects to find a program named </i><tt>llbuild.c</tt><i> in the current directory. You can use dryrun as follows:</i></p>
<pre class="command_line">
<kbd class="shell">9024 dryrun llbuild</kbd>
</pre>
<p><i>Note: Please ensure that your output follows exactly the format shown above.</i></p>

<p><small>[<a id="q6a" href="##" onclick="toggleVisible('q6')">show answer</a>]</small></p>
<div id="q6" style="color:#000099;display:none">
<pre class="answer">
// llbuild.c: create a linked list from user input, and print
#include &lt;stdio.h&gt;
#include &lt;stdlib.h&gt;
#include &lt;assert.h&gt;

typedef struct node {
   int data;
   struct node *next;
} NodeT;

NodeT *joinLL(NodeT *list1, NodeT *list2) {
// either or both list1 and list2 may be NULL
   if (list1 == NULL) {
      list1 = list2;
   } else {
      NodeT *p = list1;
      while (p->next != NULL) {
         p = p->next;
      }
      p->next = list2; // this does nothing if list2 == NULL
   }
   return list1;
}

NodeT *makeNode(int v) {
   NodeT *new = malloc(sizeof(NodeT));
   assert(new != NULL);
   new->data = v;
   new->next = NULL;
   return new;
}

void showLL(NodeT *list) {
   NodeT *p;
   for (p = list; p != NULL; p = p->next) {
      printf("%d", p->data);
      if (p->next != NULL)
         printf("->");
   }
   putchar('\n');
}

void freeLL(NodeT *list) {
   NodeT *p = list;
   while (p != NULL) {
      NodeT *temp = p->next;
      free(p);
      p = temp;
   }
}

int main(void) {
   NodeT *all = NULL;
   int data;

   printf("Enter a number: ");
   while (scanf("%d", &data) == 1) {
      NodeT *new = makeNode(data);
      all = joinLL(all, new);
      printf("Enter a number: ");
   }
   if (all != NULL) {
      printf("Done. List is ");
      showLL(all);
      freeLL(all);
   } else {
      printf("Done.\n");
   }
   return 0;
}
</pre>
</div>

<br/>
<li>(Dynamic linked lists)
<p>Extend the C-program from the previous exercise to split the linked list in two separate lists: The first list should contain every other number starting with the 1<sup>st</sup> element in the original list, the second list should contain all the other numbers (i.e., the 2<sup>nd</sup>, 4<supo>th</sup>, &hellip;). If the original list has an odd number of elements, then the first list should contain one more element than the second.</p>
Note that:
<ul>
<li> your algorithm should be 'in-place' (so you are not permitted to create a second linked list or use some other data structure such as an array);
<li> to split the list, you should not traverse the list more than once.
</ul>
<p>An example of the program executing could be
<pre class="command_line">
<kbd class="shell">./llsplit</kbd>
Enter a number: 421
Enter a number: 456732
Enter a number: 321
Enter a number: 4
Enter a number: 86
Enter a number: 89342
Enter a number: 9
Enter a number: #
Done. List is 421--&gt;456732--&gt;321--&gt;4--&gt;86--&gt;89342--&gt;9
Odd-numbered elements are 421--&gt;321--&gt;86--&gt;9
Even-numbered elements are 456732--&gt;4--&gt;89342
</pre>
<p><i>To test your program you can execute the </i><tt>dryrun</tt><i> program that corresponds to this exercise. It expects to find a program named </i><tt>llsplit.c</tt><i> in the current directory. You can use dryrun as follows:</i></p>
<pre class="command_line">
<kbd class="shell">9024 dryrun llsplit</kbd>
</pre>
<p><i>Note: Please ensure that your output follows exactly the format shown above.</i></p>

<p><small>[<a id="q7a" href="##" onclick="toggleVisible('q7')">show answer</a>]</small></p>
<div id="q7" style="color:#000099;display:none">
<pre class="answer">
void splitList(NodeT *head) {
   assert(head != NULL);

   NodeT *prev, *curr;

   prev = head;
   curr = head->next;            // starting with the second element ...
   while (curr != NULL) {
      prev->next = curr->next;   // ... link current element's predecessor to current element's successor
      prev = curr;
      curr = curr->next;         // ... and move to the next element
   }
}
</pre>
</div>

<br/>
<li><b>Challenge Exercise</b>
<p>Write a C-program that takes 1 command line argument and prints all its <i>prefixes</i> in decreasing order of length.
</p>
<ul>
  <li>You are not permitted to use any library functions other than <tt>printf()</tt>.
  <li>You are not permitted to use any array other than <tt>argv[]</tt>.
</ul>
<p>
An example of the program executing could be
<pre class="command_line">
<kbd class="shell">./prefixes Programming</kbd>
Programming
Programmin
Programmi
Programm
Program
Progra
Progr
Prog
Pro
Pr
P
</pre>
</p>

<p><small>[<a id="q8a" href="##" onclick="toggleVisible('q8')">show answer</a>]</small></p>
<div id="q8" style="color:#000099;display:none">
<pre class="answer">
#include &lt;stdio.h&gt;

int main(int argc, char *argv[]) {
   char *start, *end;

   if (argc == 2) {
      start = argv[1];
      end = argv[1];
      while (*end != '\0') {    // find address of terminating '\0'
         end++;
      }
      while (start != end) {
         printf("%s\n", start); // print string from start to '\0'
         end--;                 // move end pointer up
         *end = '\0';           // overwrite last char by '\0'
      }
   }
   return 0;
}
</pre>
</div>

</ol>

<br/>
<h2>Assessment</h2>

<p>
Submit your solutions to <b>Exercises 6 and 7</b> using the following <b>give</b> command:
</p>
<pre class="command_line">
<kbd class="shell">give cs9024 week3 llbuild.c llsplit.c</kbd>
</pre>
<p>
Make sure you spell the filenames correctly. You can run <b>give</b> multiple times. Only your last submission will be marked.
</p>
<p>
The deadline for submission is <b>Monday,
4 October 5:00:00pm</b>.
</p>
<p>
Each program is worth 1 mark. Total marks = 2. Auto-marking will be run by the lecturer several days after the submission deadline using different test cases than <tt>dryrun</tt> does.
</p>
<p>
<i>Hints</i>:
<ul>
<li> Ensure that you submit <b>all</b> files that you want to submit for this week when you run <b>give</b> again or when you re-upload your solutions on WebCMS.
<li> Programs will not be manually marked.
<li> It is important that the output of your program follows exactly the format shown above, otherwise auto-marking will result in 0 marks.
<li> <b>Ensure that your program compiles on a CSE machine with the standard options <tt>-Wall -Werror -std=c11</tt>. Programs that do not compile will receive 0 marks.</b>
<li> <tt>dryrun</tt> and auto-marking also check the correct usage of dynamic memory allocation and pointers as well as the absence of memory leaks.
<li>  Do your own testing in addition to running <tt>dryrun</tt>.
</ul>
</p>

<br/>
<h2>Plagiarism</h2>

<p>
Group submissions will not be allowed. Your programs must be entirely your own work. Plagiarism detection software will be used to compare all submissions pairwise (including submissions for similar assessments in previous years, if applicable) and serious penalties will be applied, including an entry on UNSW's plagiarism register.</p>

<ul>
<li> <b><i>Do not copy ideas or code from others</i></b>
<li> <b><i>Do not use a publicly accessible repository or allow anyone to see your code</i></b>
</ul>

<p>Please refer to the on-line sources to help you understand what plagiarism is and how it is dealt with at UNSW:</p>
<ul>
	<li><a href="https://student.unsw.edu.au/plagiarism">Plagiarism and Academic Integrity</a></li>
	<li><a href="https://www.gs.unsw.edu.au/policy/documents/plagiarismpolicy.pdf">UNSW Plagiarism Policy Statement</a></li>
	<li><a href="https://www.gs.unsw.edu.au/policy/documents/plagiarismprocedure.pdf">UNSW Plagiarism Procedure</a></li>
</ul>

<p><small>Reproducing, publishing, posting, distributing or translating this page is an infringement of copyright and will be referred to UNSW Conduct and Integrity for action.</small></p>
</body>
</html>
