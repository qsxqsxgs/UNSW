<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>COMP9024 21T3 - Week 9 Problem Set</title>
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
  <span class='heading'>Week 9 Problem Set</span><br/>
  <span class='subheading'>String Algorithms, Approximation</span>
</td>
<td align='right' width='25%'>
  <span class='heading'><img src="unsw.png"></span>
</td>
</table>
</div><p style='text-align:center;font-size:75%'><a href='/~cs9024/21T3/probs/prob9/index.php?view=qo'>[Show with no answers]</a> &nbsp; <a href='/~cs9024/21T3/probs/prob9/index.php?view=all'>[Show with all answers]</a></div>

<ol>

<br/>
<li> (Boyer-Moore algorithm)

<ol type="a">
<li>
<p>
Implement a C-function
</p>
<pre>
int *lastOccurrence(char *pattern, char *alphabet) { ... }
</pre>
<p>
that computes the last-occurrence function for the Boyer-Moore algorithm. The function should return a newly created dynamic array indexed by the numeric codes of the characters in the given alphabet (a non-empty string of ASCII-characters).
</p>
<p>
Ensure that your function runs in <i>O(m+s)</i> time, where <i>m</i> is the size of the pattern and <i>s</i> the size of the alphabet.
</p>
<p>
<i>Hint:</i> You can obtain the numeric code of a &nbsp;<tt>char c</tt>&nbsp; through type conversion: &nbsp;<tt>(int)c</tt>.
</p>

<li>
<p>
Use your answer to Exercise a. to write a C-program that:
<ul>
<li> prompts the user to input
<ul>
<li> an alphabet (a string),
<li> a text (a string),
<li> a pattern (a string);
</ul>
<li> computes and outputs the last-occurrence function for the pattern and alphabet;
<li> uses the Boyer-Moore algorithm to match the pattern against the text.
</ul>
</p>
<p>An example of the program executing could be
<pre class="command_line">
<kbd class="shell">./boyer-moore</kbd>
Enter alphabet: abcd
Enter text: abacaabadcabacabaabb
Enter pattern: abacab

L[a] = 4
L[b] = 5
L[c] = 3
L[d] = -1

Match found at position 10.
</pre>
</p>
<p>
If no match is found the output should be: &nbsp;<tt>No match.</tt>
</p>
<p>
<i>Hints:</i>
<ul>
<li>  You may assume that
<ul>
<li> the pattern and the alphabet have no more than 127 characters;
<li> the text has no more than 1023 characters.
</ul>
<li> To scan <tt>stdin</tt> for a string with whitespace, such as <tt>"a pattern matching algorithm"</tt>, you can use:
<pre>
#define MAX_TEXT_LENGTH 1024
#define TEXT_FORMAT_STRING "%[^\n]%*c"

char T[MAX_TEXT_LENGTH];
scanf(TEXT_FORMAT_STRING, T);
</pre>
This will read every character as long as it is not a newline <tt>'\n'</tt>, and <tt>"%*c"</tt> ensures that the newline is read but discarded.
</ul>
</p>
</ol>
<p><i>We have created a script that can automatically test your program. To run this test you can execute the </i><tt>dryrun</tt><i> program that corresponds to this exercise. It expects to find a program named </i><tt>boyer-moore.c</tt><i> in the current directory. You can use autotest as follows:</i></p>
<pre class="command_line">
<kbd class="shell">9024 dryrun boyer-moore</kbd>
</pre>

<p><small>[<a id="q1a" href="##" onclick="toggleVisible('q1')">show answer</a>]</small></p>
<div id="q1" style="color:#000099;display:none">
<ol type="a">
<li>
<p>
<pre class="answer">
#define ASCII_SIZE 128

int *lastOccurrenceFunction(char *pattern, char *alphabet) {
   int *L = malloc(ASCII_SIZE * sizeof(int));
   assert(L != NULL);

   int i, s = strlen(alphabet);
   for (i = 0; i < s; i++)             // for all chars in the alphabet
      L[(int)alphabet[i]] = -1;        // ... initialise L[] to -1

   int m = strlen(pattern);
   for (i = 0; i < m; i++)
      L[(int)pattern[i]] = i;          // set L[]

   return L;
}
</pre>
</p>

<li>
<p>
<pre class="answer">
#include &lt;stdio.h&gt;
#include &lt;stdlib.h&gt;
#include &lt;assert.h&gt;
#include &lt;string.h&gt;

#define MAX_TEXT_LENGTH 1024
#define MAX_PATTERN_LENGTH 128
#define MAX_ALPHABET_LENGTH 128
#define TEXT_FORMAT_STRING "%[^\n]%*c"
#define PATTERN_FORMAT_STRING "%[^\n]%*c"
#define ALPHABET_FORMAT_STRING "%[^\n]%*c"

#define MIN(x,y) ((x &lt; y) ? x : y)    // ternary operator (cond ? t1 : t2)
                                      // =&gt; evaluates to t1 if (cond)&ne;0, else to t2

int boyerMoore(char *text, char *pattern, int *L) {
   int n = strlen(text);
   int m = strlen(pattern);

   int i = m-1;
   int j = m-1;
   do {
      if (text[i] == pattern[j]) {
	 if (j == 0) {
	    return i;
	 } else {
	    i--;
	    j--;
	 }
      } else {                          // character jump
	 i = i + m - MIN(j, 1+L[(int)text[i]]);
	 j = m - 1;
      }
   } while (i &lt; n);
   return -1;                           // no match
}

int main(void) {
   char T[MAX_TEXT_LENGTH];
   char P[MAX_PATTERN_LENGTH];
   char S[MAX_ALPHABET_LENGTH];

   printf("Enter alphabet: ");
   scanf(ALPHABET_FORMAT_STRING, S);
   printf("Enter text: ");
   scanf(TEXT_FORMAT_STRING, T);
   printf("Enter pattern: ");
   scanf(PATTERN_FORMAT_STRING, P);
   putchar('\n');
   
   int *L = lastOccurrenceFunction(P, S);
   int i, s = strlen(S);
   for (i = 0; i &lt; s; i++)
      printf("L[%c] = %d\n", S[i], L[(int)S[i]]);
   
   int match = boyerMoore(T, P, L);
   free(L);
   if (match &gt; -1)
      printf("\nMatch found at position %d.\n", match);
   else
      printf("\nNo match.\n");

   return 0;
}
</pre>
</p>
</ol>
</div>
</li>

<br/>
<li> (Knuth-Morris-Pratt algorithm)

<p>
Develop, in pseudocode, a modified KMP algorithm that finds <i>every</i> occurrence of a pattern <i>P</i> in a text <i>T</i>. The algorithm should return a queue with the starting index of every substring of <i>T</i> equal to <i>P</i>.
</p>
<p>
Note that your algorithm should still run in <i>O(n+m)</i> time, and it should find every match, including those that "overlap".
</p>
<p><small>[<a id="q2a" href="##" onclick="toggleVisible('q2')">show answer</a>]</small></p>
<div id="q2" style="color:#000099;display:none">
<pre class="pseudocode">
KMPMatchAll(T,P):
   <b>Input</b>  text T of length n, pattern P of length m
   <b>Output</b> queue with all starting indices of substrings of T equal to P
 
   F=failureFunction(P)
   i=0, j=0
   Q=empty queue
   <b>while</b> i&lt;n <b>do</b>
      <b>if</b> T[i]=P[j] <b>then</b>
         <b>if</b> j=m-1 <b>then</b>
            enqueue i-j into Q    // match found
            i=i+1, j=F[m-1]       // continue to search for next match
         <b>else</b>
            i=i+1, j=j+1
         <b>end if</b>
      <b>else</b>
         <b>if</b> j&gt;0 <b>then</b>
            j=F[j-1]
         <b>else</b>
            i=i+1
         <b>end if</b>
      <b>end if</b>
   <b>end while</b>
   <b>return</b> Q                       // if Q is empty, no match found
</pre>
</div>
</li>

<br/>
<li> (Tries)

<ol type="a">
<li>
<p>
Consider the following trie, where finishing nodes are shown in red:
</p>
<center><img src="trie.png"></center>
<p>
What words are encoded in this trie?
</p>
</li>

<li>
<p>
If the following keys were inserted into an initially empty trie:
</p>
<pre>
boot sorry so axe boo jaw sorts boon jaws
</pre>
<p>
what would the final trie look like? Does the order of insertion matter?
</p>
</li>

<li>
<p>
Answer question b. for a compressed trie.
</p>
</li>
</ol>

<p><small>[<a id="q3a" href="##" onclick="toggleVisible('q3')">show answer</a>]</small></p>
<div id="q3" style="color:#000099;display:none">
<ol type="a">
<li>
<p>
In alphabetical order: a, air, an, anon, car, crab, ma, man, mane, oh, or, orate.
</p>
</li>

<li>
The trie after all keys are inserted:
</p>
<center><img src="trie2.png"></center>
<p>
The order of insertion does not matter.
The same trie will always result from insertion of the same set of words.
</p>
</li>

<li>
The compressed trie after all keys are inserted:
</p>
<center><img src="trie3.png"></center>
<p>
Again, the order of insertion does not matter.
</p>
</li>
</ol>
</div>
</li>

<br/>
<li> (Text compression)

<p>
Compute the frequency array and draw a Huffman tree for the following string:
<pre>
dogs do spot no hot pots or coats
</pre>
</p>
<p><small>[<a id="q4a" href="##" onclick="toggleVisible('q4')">show answer</a>]</small></p>
<div id="q4" style="color:#000099;display:none">
<p>
The frequency array:
<center>
<table cellpadding=6 border=2>
<tr><td>Character</td><td>&nbsp;&nbsp;</td><td>a</td><td>c</td><td>d</td><td>g</td><td>h</td><td>n</td><td>o</td><td>p</td><td>r</td><td>s</td><td>t</td></tr>
<tr><td>Frequency</td><td>7</td><td>1</td><td>1</td><td>2</td><td>1</td><td>1</td><td>1</td><td>8</td><td>2</td><td>1</td><td>4</td><td>4</td></tr>
</table>
</center>
<p>
A Huffman tree:
</p>
<p>
<center><img src="huffman.png"></center>
</p>
<p>
Other solutions are possible.
</p>
</div>
</li>

<br/>
<li> (Numerical approximation)
<p>
Write a C program to implement the <a href="http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week9/slide083.html">root finding
approximation algorithm</a> from the lecture as the function:
</p>
<pre>
double bisection(double (*f)(double), double x1, double x2)
</pre>
<p>
Use your program to find roots for
<ol type="a">
<li> <p>`f(x) = 3x^3 - 7x^2 + x + 4`, in the interval `[-0.5,1.5]`</p>
<li> `f(x) = tan x`, in the interval `[2.0,4.0]`
<li> `f(x) = sin 10x + cos 5x - x^2/10`, in the intervals `[0.0,0.5]` and `[1.0,1.5]`
</ol>
with precision &epsilon;=10<sup>-10</sup>.
</p>
<p><small>[<a id="q5a" href="##" onclick="toggleVisible('q5')">show answer</a>]</small></p>
<div id="q5" style="color:#000099;display:none">
<pre class="answer">
#include &lt;stdlib.h&gt;
#include &lt;stdio.h&gt;
#include &lt;math.h&gt;

#define EPSILON 1.0e-10

double bisection(double (*f)(double), double x1, double x2) {
   double mid;
   do {
      mid = (x1+x2) / 2;
      if (f(x1) * f(mid) &lt; 0)  // root to the left of mid
         x2 = mid;
      else                     // root to the right of mid
         x1 = mid;
   } while (f(mid) != 0 && x2-x1 &gt;= EPSILON);
   return mid;
}

double f1(double x) {
   return 3*pow(x,3) - 7*pow(x,2) + x + 4;
}

double f3(double x) {
   return sin(x) + cos(5*x) - x*x/10;
}

int main(void) {
   printf("%.10f\n", root(f1, -0.5, 1.5));
   printf("%.10f\n", root(tan, 2, 4));
   printf("%.10f\n", root(f3, 0, 0.5));
   printf("%.10f\n", root(f3, 1.0, 1.5));

   return 0;
}
</pre>
<p>
<ol type="a">
<li> &frac13; = 1.3333333333
<li> &pi; (= 3.1415926536)
<li> 0.3135040301 and 1.1689462106
</ol>
</p>
</div>
</li>

<br/>
<li> (Vertex cover)

<ol type="a">
<li><p>Apply the <a href="http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week9/slide089.html">approximation algorithm for vertex cover</a> to the following graph:
</p>
<p>
<center><img src="graph.png"></center>
</p>
<p>
Find two different executions, one that results in an optimal cover and one that does not.</p>
<li><p>What size is an optimal vertex cover for complete graphs <i>K<sub>n</sub></i>? Does the approximation algorithm always find an optimal cover for complete graphs?
</p>
<li><p>A <i>complete bipartite graph</i> <i>K<sub>m,n</sub></i> is an undirected graph that has:</p>
<ul>
<li> two disjoint vertex sets <i>V<sub>m</sub></i> and <i>V<sub>n</sub></i> of size <i>m&ge;1</i> and <i>n&ge;1</i>, respectively;
<li> every possible edge connecting a vertex in <i>V<sub>m</sub></i> to a vertex in <i>V<sub>n</sub></i>;
<li> no edge that has both endpoints in <i>V<sub>m</sub></i> or both endpoints in <i>V<sub>n</sub></i>.
</ul>
<p>Answer question b. for complete bipartite graphs.
</p>
</ol>

<p><small>[<a id="q6a" href="##" onclick="toggleVisible('q6')">show answer</a>]</small></p>
<div id="q6" style="color:#000099;display:none">
<ol type="a">
<li><p>In the first iteration of the approximation algorithm for vertex cover, the edge b-d may be chosen. We remove all the edges that are incident on b or d:
<center><img src="graph-mincover.png"></center>
</p>
<p>In the second iteration, the edge a-e may be chosen. This will remove all the remaining edges, and the result is an optimal vertex cover: {a,b,d,e}.
<br/> <i>Note:</i> There are different ways to cover this graph with 4 vertices.  But there is no vertex cover of smaller size.
</p>
<p>In another run of the algorithm, the edge b-g may be chosen in the first iteration. We remove all the edges that are incident on b or g:
<center><img src="graph-non-mincover1.png"></center>
</p>
<p>
In the second iteration, the edge a-d may be chosen. We remove all the edges incident on a or d:
<center><img src="graph-non-mincover2.png"></center>
</p>
<p>Since all edges have not been used, we must go through another iteration and choose the remaining edge e-f. This results in the non-minimal vertex cover {a,b,d,e,f,g}.</p>

<li><p>Complete graphs <i>K<sub>n</sub></i> have an optimal vertex cover of size <i>n-1</i>: Choose any <i>n-1</i> vertices, then obviously every edge in the graph is covered by at least one of the vertices. And if you take fewer than <i>n-1</i> vertices, then the edge between any two nodes that you did not choose would not be covered.
</p>
The approximation algorithm always returns an even number of vertices. Hence, it only finds an optimal cover for complete graphs <i>K<sub>n</sub></i> with an <i>odd</i> number of nodes, that is, <i>K</i><sub>3</sub>, <i>K</i><sub>5</sub>, &hellip;. (Technically this also includes <i>K</i><sub>1</sub>, i.e. a graph with a single node and no edge, whose optimal vertex cover is the empty set.)
</p>
<li><p>Bipartite graphs <i>K<sub>m,n</sub></i> have an optimal vertex cover of size <i>min{m,n}</i>: Without loss of generality, assume <i>m</i>&le;<i>n</i>. Then <i>V<sub>m</sub></i> is a vertex cover since every edge is adjacent to some vertex in <i>V<sub>m</sub></i>. Moreover, there can be no smaller vertex cover. For if you try a proper subset of <i>V<sub>m</sub></i>, and even if you add to it a proper subset of <i>V<sub>n</sub></i>, then the edge between any two missing nodes from these subsets would not be covered.
</p>
<p>
The approximation algorithm will always find a cover <i>twice</i> the minimum size. For it always picks both endpoints of an edge, one of which comes from the larger of the two disjoint sets of vertices. Hence the size of a computed vertex cover is 2&middot;<i>min{m,n}</i>.
</p>
</ol>
</div>
</li>

<br/>
<li> (Feedback)
<p>
We (Daria, Kamiyu and Michael) want to hear from you how you liked COMP9024 and if you have any suggestions on how the course should be run in the future.</p>
<p> Log in to <a href="https://myexperience.unsw.edu.au">MyExperience</a> to provide feedback. Please do so even if you just want to say, &quot;I liked the way it was taught&quot;.
</p>

<br/>
<li><b>Challenge Exercise</b>

<p>
Given a string <i>s</i> with repeated characters, design an efficient algorithm for rearranging the characters in <i>s</i> so that no two adjacent characters are identical, or determine that no such permutation exists. Analyse the time complexity of your algorithm.
</p>

<p><small>[<a id="q7a" href="##" onclick="toggleVisible('q7')">show answer</a>]</small></p>
<div id="q7" style="color:#000099;display:none">
The problem can be solved with a greedy approach: In each step, we select a character with the highest frequency that is different from the character selected before. Every time a character is selected, its frequency is reduced by one.
<pre class="pseudocode">
rearrangeString(S):
   <b>Input</b>  string S
   <b>Output</b> permutation of S such that no two adjacent chars are the same
          false if no such permutation exists

   compute frequency of each char in S
   P=priority queue of distinct chars in S with frequency as key
   S<sub>new</sub>=empty string
   c=leave(P), append c to S<sub>new</sub>, c.key=c.key-1
   <b>while</b> P is not empty <b>do</b>
      d=leave(P), append d to S<sub>new</sub>, d.key=d.key-1
      <b>if</b> c.key&gt;0 <b>then</b>
         join(P,c)         // insert c back into the priority queue
      <b>end if</b>
      c=d
   <b>end while</b>
   <b>if</b> c.key&gt;0 <b>then</b>
      <b>return</b> false
   <b>else</b>
      <b>return</b> S<sub>new</sub>
   <b>end if</b>
</pre>
<p>Time complexity analysis:
</p>
Let <i>n</i> be the size of the input string <i>s</i>.
<ol>
<li> Computing the frequencies of all characters in <i>s</i> takes <i>O(n)</i> time.
<li> Creating a priority queue for all distinct characters using a self-balancing BST takes <i>O(n&middot;log n)</i> time.
<li> Using a self-balancing BST, both <tt>leave()</tt> and <tt>join()</tt> take <i>O(log n)</i> time. Hence, the while-loop takes <i>O(n&middot;log n)</i> time.
</ol>
<p>
Therefore, the complexity of the algorithm is <i>O(n&middot;log n)</i>.
</p>
</div>
</li>

</ol>

<br/>
<h2>Assessment</h2>

<p>
After you've solved the exercises, go to <a href=https://moodle.telt.unsw.edu.au/mod/quiz/view.php?id=4240120>COMP9024 21T3 Quiz Week 9</a> to answer 5 quiz questions on this week's assessment and lecture.
</p>
<p>
The quiz is worth 2 marks.
</p>
<p>
There is no time limit on the quiz once you have started it, but the deadline for submitting your quiz answers is <b>Monday,
15 November 5:00:00pm</b>.
</p>
<p>
Please also for this final quiz (yay!) respect the <b>quiz rules</b>:
</p>
<p>
Do &hellip;
<ul>
<li> use your own best judgement to understand &amp; solve a question
<li> discuss quizzes on the forum only <b>after</b> the deadline on Monday</ul>
</p>
<p>
Do not &hellip;
<ul>
<li> post specific questions about the quiz <b>before</b> the Monday deadline
<li> agonise too much about a question that you find too difficult
</ul>
</p>

<p><small>Reproducing, publishing, posting, distributing or translating this page is an infringement of copyright and will be referred to UNSW Conduct and Integrity for action.</small></p>
</body>
</html>
