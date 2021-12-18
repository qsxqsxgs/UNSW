<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>COMP9024 21T3 - Week 2 Problem Set</title>
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
  <span class='heading'>Week 2 Problem Set</span><br/>
  <span class='subheading'>Analysis of Algorithms</span>
</td>
<td align='right' width='25%'>
  <span class='heading'><img src="unsw.png"></span>
</td>
</table>
</div><p style='text-align:center;font-size:75%'><a href='/~cs9024/21T3/probs/prob2/index.php?view=qo'>[Show with no answers]</a> &nbsp; <a href='/~cs9024/21T3/probs/prob2/index.php?view=all'>[Show with all answers]</a></div>

<ol>

<br/>
<li>(Counting primitive operations)

<p>The following algorithm
<ul>
<li> takes a sorted array A[1..<i>n</i>] of characters
   <li> and outputs, in reverse order, all 2-letter words &nu;&omega; such that &nu;&le;&omega;.
</ul>
</p>
<p>
  &nbsp;&nbsp;<b>for all</b> i=<i>n</i> down to 1 <b>do</b>
<br/>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>for all</b> j=<i>n</i> down to <i>i</i> <b>do</b>
<br/>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;print "A[i]A[j]"
<br/>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>end for</b>
<br/>
  &nbsp;&nbsp;<b>end for</b>
</p>
<p>Count the number of primitive operations (evaluating an expression, indexing into an array). What is the time complexity of this algorithm in big-Oh notation?</p>

<p><small>[<a id="q1a" href="##" onclick="toggleVisible('q1')">show answer</a>]</small></p>
<div id="q1" style="color:#000099;display:none">
<table style="border-top:1px solid #000099;border-bottom:1px solid #000099;color:#000099">
<tr><td colspan="4">Statement</td><td>&nbsp;&nbsp;<td># primitive operations</td></tr>
<tr></tr>
<tr></tr>
<tr><td colspan="4"><b>for all</b> i=<i>n</i> down to 1 <b>do</b></td><td>&nbsp;&nbsp;<td>n+(n+1)</td></tr>
<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td colspan="3"><b>for all</b> j=<i>n</i> down to <i>i</i> <b>do</b></td><td></td><td>3+5+&hellip;+(2n+1) = n(n+2)</td></tr>
<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td colspan="2">print "A[<i>i</i>]A[<i>j</i>]"</td><td></td><td>(1+2+&hellip;+n)&middot;2 = n(n+1)</td></tr>
<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td colspan="3"><b>end for</b></td><td></td></tr>
<tr><td colspan="4"><b>end for</b></td><td></td></tr>
</table>
 <p>Total: 2n<sup>2</sup>+5n+1, which is O(n<sup>2</sup>)</p>
</div>

<br/>
<li>(Big-Oh Notation)
<ol type="a">
<li>
<p>
Prove mathematically that `sum_(i=1)^n i^2` &nbsp;&isin; O(<i>n</i><sup>3</sup>)
</p>
<li>
<p>
Prove mathematically that `sum_(i=1)^n log i` &nbsp;&isin; O(<i>n log n</i>)
</p>
<li>
<p>
Prove mathematically that `sum_(i=1)^n (i)/(2^i)` &nbsp;&isin; O(1)
</p>
</ol>
<p><small>[<a id="q2a" href="##" onclick="toggleVisible('q2')">show answer</a>]</small></p>
<div id="q2" style="color:#000099;display:none">
<ol type="a">
<li> `1^2+2^2+...+n^2 = (n(n+1)(2n+1))/6`, which is in O(<i>n</i><sup>3</sup>).
<li>`sum_(i=1)^(n)log i <= sum_(i=1)^(n)log n = n*log n`, which is in O(<i>n log n</i>)
<li>Let `S = sum_(i=1)^n(i)/(2^i)`. Then `S = sum_(i=1)^n(1)/(2^i)+sum_(i=1)^n(i-1)/(2^i) = sum_(i=1)^n (1)/(2^i)+sum_(i=1)^(n-1)(i)/(2^(i+1)) < 1+1/2S`. Therefore, `S<2`. Consequently, `sum_(i=1)^n(i)/(2^i)` is in O(1).
<br/>Note: it is easy to see that `sum_(i=1)^n1/(2^i)<1` from the fact that `sum_(i=1)^(oo)1/2^i=1`.
</ol>
</div>

<br/>
<li>(Algorithms and complexity)

<p>Develop an algorithm to determine if a character array of length <i>n</i> encodes a <i>heterogram</i>, that is, a word in which no letter occurs more than once. For example, "algorithm" is such a word but "program" is not.</p>
<ol type="a">
<li><p>Write the algorithm in pseudocode.</p>
<li><p>Analyse the time complexity of your algorithm.</p>
<li><p>Implement your algorithm in C as a function</p>
<pre>
bool isHeterogram(char A[], int len)
</pre>
<p>that returns <tt>true</tt> if string <tt>A</tt> of length <tt>len</tt> is a heterogram, and <tt>false</tt> otherwise.
</p>
<p>
<i>Hint:</i>
The standard library <tt>&lt;stdbool.h&gt;</tt> defines the basic data type <tt>bool</tt> with the two values <tt>true</tt> (internally encoded as <tt>1</tt>) and <tt>false</tt> (= <tt>0</tt>).
</p>
<li> Use your solution to Exercise c. to write a program that prompts the user to input a string and checks whether it is a heterogram.
Examples of the program executing are</p>
<p>
<pre class="command_line">
<kbd class="shell">./heterogram</kbd>
Enter a word: <b>algorithm</b>
yes
<kbd class="shell">./heterogram</kbd>
Enter a word: <b>program</b>
no
</pre>
</p>
<i>Hints:</i>
<ul>
<li> You may assume that the input consists of lower case letters only.
<li> You may assume that the input consists of no more than 31 characters (excluding the terminating <tt>'\0'</tt>).
<li> You may use the standard library function <tt>strlen(char[])</tt>, defined in <tt>&lt;string.h&gt;</tt>, which computes the length of a string (without counting its terminating <tt>'\0'</tt>-character).
</ul>
</p>
</ol>
<p><i>We have created a script that can automatically test your program. To run this test you can execute the </i><tt>dryrun</tt><i> program that corresponds to this exercise. It expects to find a program named </i><tt>heterogram.c</tt><i> in the current directory. You can use dryrun as follows:</i></p>
<p>
<pre class="command_line">
<kbd class="shell">9024 dryrun heterogram</kbd>
</pre>
</p>

<p><small>[<a id="q3a" href="##" onclick="toggleVisible('q3')">show answer</a>]</small></p>
<div id="q3" style="color:#000099;display:none">
<pre class="pseudocode">
isHeterogram(A):
|  <b>Input</b>  array A[0..n-1] of chars
|  <b>Output</b> true if no letter occurs more than once in A, false otherwise
|
|  <b>for</b> i=0 to n-2 <b>do</b>
|  |  <b>for</b> j=i+1 to n-1 <b>do</b>
|  |  |  <b>if</b> A[i]=A[j] <b>then</b>
|  |  |     <b>return</b> false
|  |  |  <b>end if</b>
|  |  <b>end for</b>
|  <b>end for</b>
|  <b>return</b> true
</pre>
<p>Time complexity analysis: In the worst case, the inner loop is executed (n-1)+(n-2)+&hellip;+1 times, and the operations inside the loop are O(1). Hence, this algorithm takes O(<i>n</i><sup>2</sup>) time.</p>
<pre class="answer">
#include &lt;stdio.h&gt;
#include &lt;string.h&gt;
#include &lt;stdbool.h&gt;

#define INPUT_STRLEN 32

bool isHeterogram(char A[], int len) {
   int i = 0;
   int j = len-1;

   for (i = 0; i &lt; len-1; i++) {
      for (j = i+1; j &lt; len; j++) {
	 if (A[i] == A[j]) {
	    return false;
	 }
      }
   }
   return true;
}

int main(void) {
   char str[INPUT_STRLEN];

   printf("Enter a word: ");
   scanf("%31s", str);
   if (isHeterogram(str, strlen(str))) {
      printf("yes\n");
   } else {
      printf("no\n");
   }
   return 0;
}
</pre>
</div>

<br/>
<li>(Algorithms and complexity)

<p>
Let <i>p(x)</i> = a<sub>n</sub>x<sup>n</sup>+a<sub>n-1</sub>x<sup>n-1</sup>+&hellip;+a<sub>1</sub>x+a<sub>0</sub> be a polynomial of degree n. Design an O(<i>n</i>)-time algorithm for computing the function <i>p(x)</i>.
</p>
<p>
<i>Hint:</i> Assume that the coefficients a<sub>i</sub> are stored in an array A[0..n].
</p>

<p><small>[<a id="q4a" href="##" onclick="toggleVisible('q4')">show answer</a>]</small></p>
<div id="q4" style="color:#000099;display:none">
Rewriting <i>p(x)</i> as <i>(&hellip;((a<sub>n</sub>x+a<sub>n-1</sub>)&middot;x+a<sub>n-2</sub>)&middot;x+&hellip;+a<sub>1</sub>)&middot;x+a<sub>0</sub></i> leads to the following algorithm:
<pre class="pseudocode">
p(A,x):
   <b>Input</b>  coefficients A[0..n], value x
   <b>Output</b> A[n]&middot;x<sup>n</sup>+A[n-1]&middot;x<sup>n-1</sup>+...+A[1]&middot;x+A[0]

   p=A[n]
   <b>for all</b> i=n-1 down to 0 <b>do</b>
      p=p&middot;x+A[i]
   <b>end for</b>
</pre>
<p>This is obviously O(n).</p>
</div>

<br/>
<li>(Algorithms and complexity)

<p>
A vector V is called <i>sparse</i> if most of its elements are 0. In order to store sparse vectors efficiently, we can use an array L to store only its non-zero elements. Specifically, for each non-zero element <i>V[i]</i>, we store an index-value pair <i>(i,V[i])</i> in L.
</p>
<p>For example, the 8-dimensional vector <i>V</i>=(2.3,0,0,0,-5.61,0,0,1.8) can be stored in an array L of size 3, namely L[0]=(0,2.3), L[1]=(4,-5.61) and L[2]=(7,1.8). We call L the <i>compact form</i> of V.</p>
<p>
Describe an efficient algorithm for adding two sparse vectors <i>V<sub>1</sub></i> and <i>V<sub>2</sub></i> of equal dimension but given in compact form. The result should be in compact form too, of course. What is the time complexity of your algorithm depending on the sizes <i>m</i> and <i>n</i> of the compact forms of <i>V<sub>1</sub></i> and <i>V<sub>2</sub></i>, respectively?
<p>
<i>Hint:</i> The sum of two vectors <i>V<sub>1</sub></i> and <i>V<sub>2</sub></i> is defined as usual, e.g. (2.3,-0.1,0,0,1.7,0,0,0) + (0,3.14,0,0,-1.7,0,0,-1.8) = (2.3,3.04,0,0,0,0,0,-1.8).
</p>
<p><small>[<a id="q5a" href="##" onclick="toggleVisible('q5')">show answer</a>]</small></p>
<div id="q5" style="color:#000099;display:none">
In the algorithm below, <tt>L[i].x</tt> denotes the first component (the index) of a pair L[i], and <tt>L[i].v</tt> denotes its second component (the value).
<pre class="pseudocode">
VectorSum(L<sub>1</sub>,L<sub>2</sub>):
   <b>Input</b>  compact forms L<sub>1</sub> of length m and L<sub>2</sub> of length n
   <b>Output</b> compact form of L<sub>1</sub>+L<sub>2</sub>

   i=0, j=0, k=0
   <b>while</b> i&leq;m-1 and j&leq;n-1 <b>do</b>
      <b>if</b> L<sub>1</sub>[i].x=L<sub>2</sub>[j].x <b>then</b>       // found index with entries in both vectors
         <b>if</b> L<sub>1</sub>[i].v&ne;-L<sub>2</sub>[j].v <b>then</b>   // only add if the values don't add up to 0
            L<sub>3</sub>[k]=(L<sub>1</sub>[i].x, L<sub>1</sub>[i].v+L<sub>2</sub>[j].v)
            i=i+1, j=j+1, k=k+1
         <b>end if</b>
      <b>else if</b> L<sub>1</sub>[i].x&lt;L<sub>2</sub>[j].x <b>then</b>  // copy an entry from L<sub>1</sub>
         L<sub>3</sub>[k]=(L<sub>1</sub>[i].x,L<sub>1</sub>[i].v)
         i=i+1, k=k+1
      <b>else</b>
         L<sub>3</sub>[k]=(L<sub>2</sub>[j].x,L<sub>2</sub>[j].v)    // copy an entry from L<sub>2</sub>
         j=j+1, k=k+1
      <b>end if</b>
   <b>end while</b>
   <b>while</b> i&lt;m-1 <b>do</b>                  // copy the remaining pairs of L<sub>1</sub>, if any
      L<sub>3</sub>[k]=(L<sub>1</sub>[i].x,L<sub>1</sub>[i].v)
      i=i+1, k=k+1
   <b>end while</b>
   <b>while</b> j&lt;n-1 <b>do</b>                  // copy the remaining pairs of L<sub>2</sub>, if any
      L<sub>3</sub>[k]=(L<sub>2</sub>[j].x,L<sub>2</sub>[j].v)
      j=j+1, k=k+1
   <b>end while</b>
</pre>
<p>
Time complexity analysis: Adding a pair to L<sub>3</sub> takes O(1) time. At most <i>m</i>+<i>n</i> pairs from L<sub>1</sub> and L<sub>2</sub> are added. Therefore, the time complexity is O(<i>m</i>+<i>n</i>).
</p>
</div>

<br/>
<li>(Ordered linked lists)

<p>A particularly useful kind of linked list is one that is sorted. Give an algorithm for inserting an element at the right place into a linked list whose elements are sorted in ascending order.
</p>
<p>Example: Given the linked list
<pre class="command_line">
L = 17 26 54 77 93
</pre>
the function <tt>insertOrderedLL(L,31)</tt> should return the list
<pre class="command_line">
L = 17 26 31 54 77 93
</pre>
</p>
<i>Hint:</i> Develop the algorithm with the help of a diagram that illustrates how to use pointers in order to
<ul>
<li> find the right place for the new element and
<li> link the new element to its predecessor and its successor.
</ul>
<p/>

<p><small>[<a id="q6a" href="##" onclick="toggleVisible('q6')">show answer</a>]</small></p>
<div id="q6" style="color:#000099;display:none">
<p>
The following diagram illustrates the use of pointers to the previous, the current and the new list element, and how to link them:
<p>
<img src="LL-insert.png">
</p>
<p>
<pre class="pseudocode">
insertOrderedLL(L,d):
   <b>Input</b>  ordered linked list L, value d
   <b>Output</b> L with d added in the right place
 
   current=L, previous=NULL
   <b>while</b> current&ne;NULL and current.value&lt;d <b>do</b>
      previous=current
      current=current.next
   <b>end while</b>
   temp=makeNode(d)
   <b>if</b> previous&ne;NULL <b>then</b>
      temp.next=current      // Step 1
      previous.next=temp     // Step 2
   <b>else</b>
      temp.next=L            // add new element at the beginning
      L=temp
   <b>end if</b>
   <b>return</b> L
</pre></p>
</div>

<br/>
<li>(Advanced linked list processing)

<p>Describe an algorithm to split a linked list in two halves and output the result. If the list has an odd number of elements, then the first list should contain one more element than the second.</p>
Note that:
<ul>
<li> your algorithm should be 'in-place' (so you are not permitted to create a second linked list or use some other data structure such as an array);
<li> you should not traverse the list more than once (e.g. to count the number of elements and then restart from the beginning).
</ul>
<p>An example of the result of the algorihtm could be
<pre class="command_line">
Linked list: 17 26 31 54 77 93 98
First half:  17 26 31 54
Second half: 77 93 98
</pre>
<p/>

<p><small>[<a id="q7a" href="##" onclick="toggleVisible('q7')">show answer</a>]</small></p>
<div id="q7" style="color:#000099;display:none">
<p>The following solution uses a "slow" and a "fast" pointer to traverse the list. The fast pointer always jumps 2 elements ahead. At any time, if <tt>slow</tt> points to the <i>i</i><sup>&nbsp;th</sup> element, then <tt>fast</tt> points to the <i>2&middot;i</i><sup>&nbsp;th</sup> element. Hence, when the fast pointer reaches the end of the list, the slow pointer points to the last element of the first half.</p>
<p><pre class="pseudocode">
SplitList(L):
   <b>Input</b> linked list L
 
   slow=L, fast=L.next
   <b>while</b> fast&ne;NULL and fast.next&ne;NULL <b>do</b>
      slow=slow.next
      fast=fast.next.next
   <b>end while</b>
   List2=slow.next           // this becomes head of second half
   slow.next=NULL            // cut off at end of first half
   print "First half:", showLL(L)
   print "Second half:", showLL(List2)
</pre></p>
</div>

<br/>
<li><b>Challenge Exercise</b>
<p>Suppose that you are given two stacks of non-negeative integers A and B and a target threshold <i>k</i> &geq; 0. Your task is to determine the maximum number of elements that you can pop from A and B so that the sum of these elements does not exceed <i>k</i>.</p>
<p>Example:
<br/>
<img src="stacks.png" style="width:100px;" align="middle"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <table style="display:inline"><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>Maximum number of elements that can</td></tr><tr><td>be popped without exceeding <i>k</i> = 10 is 4:</td></tr></table> &nbsp; &nbsp; <img src="stacks-solution.png" style="width:100px;" align="middle">
</p>
<p>If k = 7, then the answer would be 3 (the top element of A and the top two elements of B).</p>
<ol type="a">
<li> Write an algorithm (in pseudocode) to determine this maximum for any given stacks A and B and threshold <i>k</i>. As usual, the only operations you can perform on the stacks are pop() and push().
You <i>are</i> permitted to use a third "helper" stack but no other aggregate data structure.
<li><p>Determine the time complexity of your algorithm depending on the sizes <i>m</i> and <i>n</i> of input stacks A and B.</p>
</ol>

<i>Hints:</i>
<ul>
<li> A so-called greedy algorithm would simply take the smaller of the two elements currently on top of the stacks and continue to do so as long as you haven't exceeded the threshold. This won't work in general for this problem.
<li> Your algorithm only needs to determine the number of elements that can maximally be popped without exceeding the given <i>k</i>. You do not have to return the numbers themselves nor their sum. Also you do not need to restore the contents of the two stacks; they can be left in any state you wish.
</ul>

<p><small>[<a id="q8a" href="##" onclick="toggleVisible('q8')">show answer</a>]</small></p>
<div id="q8" style="color:#000099;display:none">
<pre class="pseudocode">
MaxElementsToPop(A,B,k):
   <b>Input</b>  stacks A and B, target threshold k&geq;0
   <b>Output</b> maximum number of elements that can be popped from A and B
          so that their sum does not exceed k

   sum=0, count=0, create empty stack C
   <b>while</b> sum&leq;k and stack A not empty <b>do</b>   // Phase 1: Determine how many elements can be popped just from A
      v=pop(A), push(v,C)                 //          and push those onto the helper stack C
      sum=sum+v, count=count+1
   <b>end while</b>
   <b>if</b> sum&gt;k <b>then</b>                          // exceeded k?
      sum=sum-pop(C), count=count-1       //   then subtract last element that's been popped off A
   <b>end if</b>
   best=count                             // best you can do with elements from A only

   <b>while</b> stack B not empty <b>do</b>
      sum=sum+pop(B), count=count+1       // Phase 2: add one element from B at a time
      <b>while</b> sum&gt;k and stack C not empty <b>do</b>   // and whenever threshold is exceeded:
         sum=sum-pop(C), count=count-1       //   subtract more elements originally from A (now in C)
      <b>end while</b>                              //   to get back below threshold
      <b>if</b> sum&leq;k and count&gt;best <b>then</b>
         best=count                       // update each time you got a better score
      <b>end if</b>
   <b>end while</b>
   <b>return</b> best
</pre>
<p>
Time complexity analysis: In phase 1, the worst case is when all <i>m</i> elements in stack A need to be visited, for a maximum of <i>m</i>+1 pop and <i>m</i> push operations. In phase 2, the worst case is when all elements have to be taken from both B and C, for a maximum of <i>m</i>+<i>n</i> pop operations. Assuming that push() and pop() take constant time, the overall complexity is O(m+n). This makes it a linear-time solution.
</p>
</div>

<br/>
<li>(Academic integrity)

<p>Complete the Academic Integrity Module linked on our <a href=https://moodle.telt.unsw.edu.au/course/view.php?id=62450>Moodle webpage</a>, whose aim is to help you
<ul>
<li> <p>better understand the factors involved in plagiarism with programming,</p>
<li> <p>avoid common pitfalls leading to academic integrity offences,</p>
<li> <p>better understand your rights and responsibilities under UNSW's plagiarism policies and procedures.</p>
</ul>

</ol>

<br/>
<h2>Assessment</h2>

<p>
After you have solved the exercises, go to <a href=https://moodle.telt.unsw.edu.au/mod/quiz/view.php?id=4095019>COMP9024 21T3 Quiz Week 2</a> to answer 5 quiz questions on this week's problem set and lecture.
</p>
<p>
The quiz is worth 2 marks.
</p>
<p>
There is no time limit on the quiz once you have started it, but the deadline for submitting your quiz answers is <b>Monday,
27 September 5:00:00pm</b>.
</p>
<p>
Please be mindful of the following <b>quiz rules</b>:
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
