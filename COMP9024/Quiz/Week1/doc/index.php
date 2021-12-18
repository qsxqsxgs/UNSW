<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>COMP9024 21T3 - Week 1 Problem Set</title>
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
  <span class='heading'>Week 1 Problem Set</span><br/>
  <span class='subheading'>Elementary Data and Control Structures in C</span>
</td>
<td align='right' width='25%'>
  <span class='heading'><img src="unsw.png"></span>
</td>
</table>
</div><p style='text-align:center;font-size:75%'><a href='/~cs9024/21T3/probs/prob1/index.php?view=qo'>[Show with no answers]</a> &nbsp; <a href='/~cs9024/21T3/probs/prob1/index.php?view=all'>[Show with all answers]</a></div>

<br/>
<hr>
<p>The purpose of the first problem set is mainly to familiarise yourself with programming in C.</p>
<p>For the remainder of the course it is vital that you understand and are able to solve all of the Exercises 1 &ndash; 5 below. In addition, you could gain further, self-guided programming practice by solving small puzzles from this website:</p>
<blockquote>
   <a href=http://programmedlessons.org/CPuzzlesNew/CpuzzlesMain.html>C Puzzles</a>
</blockquote>
<p>(<i>Hint:</i> Recommended are L11&ndash;L20, L31&ndash;L40, D11&ndash;D20, DD11&ndash;DD17. Pointers and random numbers will be introduced later in COMP9024.)</p>
<hr>

<ol>

<br/>
<li>(Numbers)
<p>There is a 5-digit number that satisfies 4&middot;<i>abcde</i> = <i>edcba</i>, that is, when multiplied by 4 yields the same number read backwards. Write a C-program to find this number.</p>
<p>
<i>Hint:</i> Only use arithmetic operations; do not use any string operations.
</p>

<p><small>[<a id="q1a" href="##" onclick="toggleVisible('q1')">show answer</a>]</small></p>
<div id="q1" style="color:#000099;display:none">
<pre class="answer">
#include &lt;stdio.h&gt;

#define MIN 10000
#define MAX 24999    // solution has to be &lt;25000

int main(void) {
   int a, b, c, d, e, n;
   
   for (n = MIN; n <= MAX; n++) {
      a = (n / 10000) % 10;
      b = (n / 1000) % 10;
      c = (n / 100) % 10;
      d = (n / 10) % 10;
      e = n % 10;
      if (4*n == 10000*e + 1000*d + 100*c + 10*b + a) {
         printf("%d\n", n);
      }
   }
   return 0;
}
</pre>
Solution: 21978
</div>

<br/>
<li>(Characters)
<p>
Write a C-program that outputs, in alphabetical order, all strings that use each of the characters 'c', 'a', 't', 'd', 'o', 'g' exactly once.</p>
<p>How many strings does your program generate?</p>
<p>
<i>Hint:</i> Find a simple algorithm to solve this specific problem only. Do not use any functions from the string library.
</p>

<p><small>[<a id="q2a" href="##" onclick="toggleVisible('q2')">show answer</a>]</small></p>
<div id="q2" style="color:#000099;display:none">
<p>There are 6! = 720 permutations of "catdog".</p>
<p>A straightforward solution is to use six nested loops and a conditional statement to filter out all strings with duplicate characters. The following program includes a counter to check how many strings have been generated.
<pre class="answer">
#include &lt;stdio.h&gt;

int main(void) {
   char catdog[] = { 'a','c','d','g','o','t' };

   int count = 0;
   int i, j, k, l, m, n;
   for (i=0; i<6; i++)
      for (j=0; j<6; j++)
	 for (k=0; k<6; k++)
	    for (l=0; l<6; l++)
	       for (m=0; m<6; m++)
		  for (n=0; n<6; n++)
		     if (i!=j && i!=k && i!=l && i!=m && i!=n &&
			 j!=k && j!=l && j!=m && j!=n &&
			 k!=l && k!=m && k!=n &&
			 l!=m && l!=n && m!=n) {
			   printf("%c%c%c%c%c%c\n", catdog[i], catdog[j],
						    catdog[k], catdog[l],
						    catdog[m], catdog[n]);
			   count++;
		     }
   printf("%d\n", count);
   return 0;
}
</pre>
</div>

<br/>
<li>(Elementary control structures)
<ol type="a">
<li>
<p>
Write a C-function that takes a positive integer <i>n</i> as argument and outputs a series of numbers according to the following process, until 1 is reached:</p>
<ul>
<li> if <i>n</i> is even, then <i>n</i> &larr; <i>n</i>/2
<li> if <i>n</i> is odd, then <i>n</i> &larr; 3*<i>n</i>+1
</ul>

<li>
<p>
The Fibonacci numbers are defined as follows:
<ul>
<li> Fib(1) = 1
<li> Fib(2) = 1
<li> Fib(<i>n</i>) = Fib(<i>n</i>-1)+Fib(<i>n</i>-2) for <i>n</i>&geq;3
</ul>
<p>Write a C program <tt>fibonacci.c</tt> that applies the process described in Part a. to the first 10 Fibonacci numbers.</p>
The output of the program should begin with
<pre class="command_line">
Fib[1] = 1
1
Fib[2] = 1
1
Fib[3] = 2
2
1
Fib[4] = 3
3
10
5
16
8
4
2
1
</pre>
</ol>
<p><i>We have created a script that can automatically test your program. To run this test you can execute the </i><tt>dryrun</tt><i> program that corresponds to this exercise. It expects to find a program named </i><tt>fibonacci.c</tt><i> in the current directory. You can use dryrun as follows:</i></p>
<pre class="command_line">
<kbd class="shell">9024 dryrun fibonacci</kbd>
</pre>
<p><i>Note: Please ensure that your output follows exactly the format shown above.</i></p>

<p><small>[<a id="q3a" href="##" onclick="toggleVisible('q3')">show answer</a>]</small></p>
<div id="q3" style="color:#000099;display:none">
<p>
<pre class="answer">
#include &lt;stdio.h&gt;

#define MAX 10

void collatz(int n) {  // named after the German mathematician who invented this problem
   printf("%d\n", n);
   while (n != 1) {
      if (n % 2 == 0) {
	 n = n / 2;
      } else {
	 n = 3*n + 1;
      }
      printf("%d\n", n);
   }
}

int main(void) {
   int fib[MAX] = { 1, 1 };     // initialise the first two numbers
   int i;
   for (i = 2; i < MAX; i++) {  // compute the first 10 Fibonacci numbers
      fib[i] = fib[i-1] + fib[i-2];
   }

   for (i = 0; i < MAX; i++) {  // apply Collatz's process to each number
      printf("Fib[%d] = %d\n", i+1, fib[i]);
      collatz(fib[i]);
   }

   return 0;
}
</pre>
</p>
</div>

<br/>
<li>(Elementary data structures)
<p>
Define a data structure to store all information of a single ride with the Opal card. Here are three sample records:
</p>
<img src="opal.png">
<p>
You may assume that individual stops (such as "UNSW Anzac Parade LR") require no more than 31 characters.
</p>
<p>
Determine the memory requirements of your data structure, assuming that each integer and floating point number takes 4 bytes.
</p>
<p>
If you want to store millions of records, how would you improve your data structure?
</p>

<p><small>[<a id="q4a" href="##" onclick="toggleVisible('q4')">show answer</a>]</small></p>
<div id="q4" style="color:#000099;display:none">
  There are of course many possible ways in which this data can be structured; the following is just one example:
<pre class="answer">
typedef struct {
   int day, month, year;
} DateT;

typedef struct {
   int hour, minute;
} TimeT;

typedef struct {
   int   transaction;
   char  weekday[4];        // 3 chars + terminating '\0'
   DateT date;
   TimeT time;
   char  mode;              // 'B', 'F' or 'T'
   char  from[32], to[32];
   int   journey;
   char  faretext[12];
   float fare, discount, amount;
} JourneyT;
</pre>
<p>Memory requirement for one element of type <tt>JourneyT</tt>: 4 + 4 + 12 + 8 + 1 (+ 3 padding) + 2&middot;32 + 4 + 12 + 3&middot;4 = 124 bytes.</p>
<p>The data structure can be improved in various ways:
<itemize>
<item> encode both origin and destination (<tt>from</tt> and <tt>to</tt>) using Sydney Transport's unique stop IDs along with a lookup table that links e.g. 203311 to "UNSW";
<item> use a single integer to encode the possible "Fare Applied" entries;
<item> avoid storing redundant information like the weekday, which can be derived from the date itself.
</itemize>
</div>

<br/>
<li>(Stack ADO)
<ol type="a">
<li>
<p>
Modify the Stack ADO from the lecture (<a href=http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week1/progs/Stack.h><tt>Stack.h</tt></a> and <a href=http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week1/progs/Stack.c><tt>Stack.c</tt></a>) to develop an implementation. Below is the header file (<a href=IntStack.h><tt>IntStack.h</tt></a>) that your ADO should use:
</p>
<tt>IntStack.h</tt>
<pre class="answer">
// Integer Stack ADO header file ... COMP9024 21T3

#define MAXITEMS 10

void StackInit();     // set up empty stack
int  StackIsEmpty();  // check whether stack is empty
void StackPush(int);  // insert int on top of stack
int  StackPop();      // remove int from top of stack
</pre>
</p>
<p>Your task is to implement these functions in a program called <tt>IntStack.c</tt>.</p>
<li>
<p>Complete the test program below (<a href=StackTester.c><tt>StackTester.c</tt></a>) and run it to test your integer stack ADO. The tester
<ul>
<li> initialises the stack
<li> prompts the user to input a number <i>n</i>
<li> checks that <i>n</i> is a positive number
<li> prompts the user to input <i>n</i> numbers and push each number onto the stack
<li> <i>uses the stack to output the <i>n</i> numbers in reverse order</i> (needs to be implemented)
</ul>
</p>
<tt>StackTester.c</tt>
<pre>
// Integer Stack ADO tester ... COMP9024 21T3

#include &lt;stdio.h&gt;
#include &lt;stdlib.h&gt;
#include "IntStack.h"

#define INPUT_STRLEN 20

int main(void) {
   int i, n;
   char str[INPUT_STRLEN];

   StackInit();

   printf("Enter a positive number: ");
   scanf("%19s", str);
   if ((n = atoi(str)) > 0) {    // convert to int and test if positive
      for (i = 0; i < n; i++) {
	 printf("Enter a number: ");
	 scanf("%19s", str);
	 StackPush(atoi(str));
      }
   }

   /* NEEDS TO BE COMPLETED */

   return 0;
}
</pre>

<p>
An example of the program executing could be
<pre class="command_line">
Enter a positive number: 3
Enter a number: 2019
Enter a number: 12
Enter a number: 25
25
12
2019
</pre>
</p>
</ol>

<p><small>[<a id="q5a" href="##" onclick="toggleVisible('q5')">show answer</a>]</small></p>
<div id="q5" style="color:#000099;display:none">
<ol type="a">
<li> <tt>IntStack.h</tt>
<tt>IntStack.c</tt>
<pre class="answer">
// Integer Stack ADO implementation
#include "IntStack.h"
#include &lt;assert.h&gt;

typedef struct {
   int item[MAXITEMS];
   int top;
} stackRep;                // defines the Data Structure

static stackRep stackObject;  // defines the Data Object

void StackInit() {         // set up empty stack
   stackObject.top = -1;
}

int StackIsEmpty() {      // check whether stack is empty
   return (stackObject.top < 0);
}

void StackPush(int n) {   // insert int on top of stack
   assert(stackObject.top < MAXITEMS-1);
   stackObject.top++;
   int i = stackObject.top;
   stackObject.item[i] = n;
}

int StackPop() {          // remove int from top of stack
   assert(stackObject.top > -1);
   int i = stackObject.top;
   int n = stackObject.item[i];
   stackObject.top--;
   return n;
}
</pre>
<p/>

<li> <tt>StackTester.c</tt>
<pre class="answer">
// Integer Stack ADO tester ... COMP9024 21T3
#include &lt;stdio.h&gt;
#include &lt;stdlib.h&gt;
#include "IntStack.h"

#define INPUT_STRLEN 20

int main(void) {
   int i, n;
   char str[INPUT_STRLEN];

   StackInit();

   printf("Enter a positive number: ");
   scanf("%19s", str);
   if ((n = atoi(str)) > 0) {    // convert to int and test if positive
      for (i = 0; i < n; i++) {
	 printf("Enter a number: ");
	 scanf("%19s", str);
	 StackPush(atoi(str));
      }
   }
   while (!StackIsEmpty()) {
      printf("%d\n", StackPop());
   }
   return 0;
}
</pre>
</ol>
<p/>
</div>

<br/>
<li>(ADO client)
<p>
An integer stack can be used to convert a positive decimal number <i>n</i> to a different numeral system with base <i>k</i> according to the following algorithm:
</p>
&nbsp;&nbsp;<b>while</b> <i>n</i>&gt;0 <b>do</b>
<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;push <i>n</i><tt>%</tt><i>k</i> onto the stack
<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>n</i> = <i>n</i> <tt>/</tt> <i>k</i>
<br/>
&nbsp;&nbsp;<b>end while</b>
<p>
The result can be displayed by printing the numbers as they are popped off the stack. Example (<i>k</i>=2):
<pre>
n = 13          --> push 1 (= 13%2)
n = 6  (= 13/2) --> push 0 (= 6%2)
n = 3  (=  6/2) --> push 1 (= 3%2)
n = 1  (=  3/2) --> push 1 (= 1%2)
n = 0  (=  1/2)
Result: 1101
</pre>
</p>
<p>
Using your stack ADO from Exercise 5, write a C-program that implements this algorithm to convert to base <i>k</i>=2 a number given on the command line.
</p>
<p>
Examples of the program executing could be
</p>
<pre class="command_line">
<kbd class="shell">./binary</kbd>
Enter a number: <b>13</b>
1101
<kbd class="shell">./binary</kbd>
Enter a number: <b>128</b>
10000000
<kbd class="shell">./binary</kbd>
Enter a number: <b>127</b>
1111111
</pre>
<p><i>We have created a script that can automatically test your program. To run this test you can execute the </i><tt>dryrun</tt><i> program that corresponds to this exercise. It expects to find three programs in the current directory:
<ul>
<li> <tt>IntStack.h</tt> &ndash; your header file for the integer stack from Exercise 5
<li> <tt>IntStack.c</tt> &ndash; your implementation of the integer stack from Exercise 5
<li> <tt>binary.c</tt>
</ul>
</p>
<p>You can use dryrun as follows:</i></p>
<pre class="command_line">
<kbd class="shell">9024 dryrun binary</kbd>
</pre>

<p><small>[<a id="q6a" href="##" onclick="toggleVisible('q6')">show answer</a>]</small></p>
<div id="q6" style="color:#000099;display:none">
<pre class="answer">
#include &lt;stdlib.h&gt;
#include &lt;stdio.h&gt;
#include "IntStack.h"

#define INPUT_STRLEN 20

int main(void) {
   int n;
   char str[INPUT_STRLEN];

   printf("Enter a number: ");
   scanf("%19s", str);
   n = atoi(str);
   StackInit();
   while (n > 0) {
      StackPush(n % 2);
      n = n / 2;
   }
   while (!StackIsEmpty()) {
      printf("%d", StackPop());
   }
   putchar('\n');
   return 0;
}
</pre>
</div>

<br/>
<li>(Queue ADO)
<p>
Modify your integer stack ADO from Exercise 5 to an integer queue ADO.
</p>
<p>
Hint: A <i>queue</i> is a FIFO data structure (first in, first out). The principal operations are to <i>enqueue</i> and to <i>dequeue</i> elements. Elements are dequeued in the same order in which they have been enqueued. Below is the header file (<a href=http://www.cse.unsw.edu.au/~cs9024/21T3/probs/prob1/IntQueue.h><tt>IntQueue.h</tt></a>) with the functions that your ADO should provide.
</p>
<tt>IntQueue.h</tt>
<pre>
// Integer Queue ADO header file ... COMP9024 21T3
#define MAXITEMS 10

void QueueInit();        // set up empty queue
int  QueueIsEmpty();     // check whether queue is empty
void QueueEnqueue(int);  // insert int at end of queue
int  QueueDequeue();     // remove int from front of queue
</pre>
</p>
<p><i>We have created a script that can automatically test your program. To run this test you can execute the </i><tt>dryrun</tt><i> program that corresponds to this exercise. It expects to find two files named </i><tt>IntQueue.c</tt><i> and <tt>IntQueue.h</tt> in the current directory that provide an implementation of a queue ADO with the four queue functions shown above. You can use dryrun as follows:</i></p>
<pre class="command_line">
<kbd class="shell">9024 dryrun IntQueue</kbd>
</pre>

<p><small>[<a id="q7a" href="##" onclick="toggleVisible('q7')">show answer</a>]</small></p>
<div id="q7" style="color:#000099;display:none">
<tt>IntQueue.c</tt>
<pre class="answer">
// Integer Queue ADO implementation ... COMP9024 19T3
#include "IntQueue.h"
#include &lt;assert.h&gt;

static struct {
   int item[MAXITEMS];
   int top;
} queueObject;  // defines the Data Object

void QueueInit() {          // set up empty queue
   queueObject.top = -1;
}

int QueueIsEmpty() {        // check whether queue is empty
   return (queueObject.top < 0);
}

void QueueEnqueue(int n) {  // insert int at end of queue
   assert(queueObject.top < MAXITEMS-1);
   queueObject.top++;
   int i;
   for (i = queueObject.top; i > 0; i--) {
      queueObject.item[i] = queueObject.item[i-1]; // move all elements up
   }
   queueObject.item[0] = n; // add element at end of queue
}

int QueueDequeue() {        // remove int from front of queue
   assert(queueObject.top > -1);
   int i = queueObject.top;
   int n = queueObject.item[i];
   queueObject.top--;
   return n;
}
</pre>
</div>

<br/>
<li><b>Challenge Exercise</b>
<p>Write a C-function that takes 3 integers as arguments and returns the largest of them. The following restrictions apply:
<ul>
<li>You are not permitted to use <b>if</b> statements.
<li>You are not permitted to use loops (e.g. <b>while</b>).
<li>You are not permitted to call any function.
<li>You are only permitted to use data and control structures introduced in Week 1's lecture.
</ul>
</p>

<p><small>[<a id="q8a" href="##" onclick="toggleVisible('q8')">show answer</a>]</small></p>
<div id="q8" style="color:#000099;display:none">
<p>The following makes use of the fact that a true condition has value 1 and a false condition has value 0:
<pre class="answer">
int max(int a, int b, int c) {
   int d = a * (a >= b) + b * (a < b);   // d is max of a and b
   return  c * (c >= d) + d * (c < d);   // return max of c and d
}
</pre>
</p>
</div>

</ol>

<br/>
<h2>Assessment</h2>

<p>
<font color="red"><i>This first weekly assignment is meant to give you your first practice and will not count towards your mark for the weekly homework.</i></font>
</p>
<p>
However, in order to familiarise yourself with the submission and auto-marking process, you can submit your solutions.
</p>
<p>
You should submit your files using the following <b>give</b> command:
</p>
<pre class="command_line">
<kbd class="shell">give cs9024 week1 binary.c IntQueue.h IntQueue.c</kbd>
</pre>
<p>Alternatively, you can submit through <a href="https://webcms3.cse.unsw.edu.au/COMP9024/21T3/resources/67210">WebCMS3</a>.</p>
<p>
<b>Ensure that your program compiles on a CSE machine with the standard options <tt>-Wall -Werror -std=c11</tt>.</b>
</p>
<ul>
<li><p>
Make sure you spell the filenames correctly. You can submit multiple times. Only your last submission will be considered.</p>
<li><p> Ensure that you submit <b>all</b> files each time you resubmit.
</p>
<li><p>
The deadline for submission is <b>Monday,
20 September 5:00:00pm</b>.
</p>
<li><p>
Auto-marking will be run by the lecturer several days after the submission deadline using different test cases than <tt>dryrun</tt> does. <em>Hint</em>: Do your own testing in addition to running <tt>dryrun</tt>.
</p>
</ul>

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
