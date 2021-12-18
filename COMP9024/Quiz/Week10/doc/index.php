<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>COMP9024 21T3 - Week 10 Problem Set</title>
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
  <span class='heading'>Week 10 Problem Set</span><br/>
  <span class='subheading'>Randomised Algorithms</span>
</td>
<td align='right' width='25%'>
  <span class='heading'><img src="unsw.png"></span>
</td>
</table>
</div><p style='text-align:center;font-size:75%'><a href='/~cs9024/21T3/probs/prob10/index.php?view=qo'>[Show with no answers]</a> &nbsp; <a href='/~cs9024/21T3/probs/prob10/index.php?view=all'>[Show with all answers]</a></div>

<p>
Congratulations on reaching the end of this course!
</p>
<p>
<i>Please note:</i>
</p>
<ul>
<li> Just 1 program to submit.
<li> <font color="red">Note the early submission deadline: Friday,
19 November, at 5:00:00pm.</font>
</ul>
<br/>

<ol>

<br/>
<li> (Random numbers)

<ol type="a">
 <li> <p>A program that simulates the tosses of a coin is as follows:
 <pre>
#define NTOSSES 20
srand(time(NULL));
int i, count = 0;
for (i=0; i&lt;NTOSSES; i++) {
   int toss = rand() % 2;     // toss = 0 or 1
   if (toss == 0) {
      putchar('H');
      count++;
   } else {
      putchar('T');
   }
}
printf(&quot;\n%d heads, %d tails\n&quot;, count, NTOSSES-count);
</pre>
</p>
Sample output is:
 <pre>
HHTTTTHHTTTHHTHHHHHH
12 heads, 8 tails
</pre>

<ol>
  <li> <p>What would an analogous program to simulate the repeated rolling of a die look like?</p> </li>
  <li> <p>What could be a sample output of this program?</p> </li>
</ol>

 <li> <p>If you were given a string, say &quot;hippopotamus&quot;, and you had to select a random letter, how would you do this?</p> </li>

 <li> <p>If you have to pick a random number between 2 numbers, say <i>i</i> and <i>j</i> (inclusive), how would you do this? (Assume <i>i&lt;j</i>.)</p> </li>

 <li><p>Write a C program that generates a random password consisting of any letter, number or symbol between <a href="http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week9/slide011.html">Ascii</a> 33 (= <tt>'!'</tt>) and 126 (= <tt>'~'</tt>). When executed, the first command-line argument is the seed used by the random number generator, i.e. by <tt>rand()</tt>, and the second argument is the length of the password.</p>
<p>
An example of the program executing could be
<pre class="command_line">
<kbd class="shell">./mypassword 1 8</kbd>
v%b82j1S
</pre>
which seeds the random-number generator with 1 and generates a password of length 8.
</p>
<p>
<p><i>We have created a script that can automatically test your program. To run this test you can execute the </i><tt>dryrun</tt><i> program that corresponds to this exercise. It expects to find a file named </i><tt>mypassword.c</tt><i> in the current directory.
</p>
<p>You can use dryrun as follows:</i></p>
<pre class="command_line">
<kbd class="shell">9024 dryrun mypassword</kbd>
</pre>
</p>
<p>
<i>Note: It is important in this exercise that you use the random number generator as specified in the lecture (and generalised in Exercise 1.c above), otherwise the outputs will not match. If you use a different method to generate random numbers, the testcases will 'fail', but your program could still be perfectly correct. The output may also be different on your own computer.</i>
</p>
<p><i>Hint</i>: You may assume that the maximum password length is 32.</p>
</li>
</ol>

<p><small>[<a id="q1a" href="##" onclick="toggleVisible('q1')">show answer</a>]</small></p>
<div id="q1" style="color:#000099;display:none">
<ol type="a">
<li> There are 6 outcomes of dice rolling: the numbers 1 to 6.
<ul>
<li>So we'll need a fixed array <i>count[0..5]</i> of length 6 to count how many of each.</li>
<li>This needs to be initialised to all zeros.</li>
</ul>
</p>
We roll the die <i>NROLLS</i> times, just like we tossed the coin.</li>
<ul>
<li>The outcome each time will be <i>roll = 1 + rand()%6</i> .</li>
<li>This is a number between 1 and 6. (<i>Easy to see?</i>)</li>
</ul>
</p>
We increment the count for this <i>roll</i>:
<ul>
<li><i>count[roll-1]++</i></li>
</ul>
</p>
We conclude by printing the contents of the <i>count</i> array.</p>

Output such as the following would be possible (for 20 rolls of the die):
  <pre>
25426251423232651155
Counts = {3,6,2,2,5,2}
</pre>
<ul>
<li>The list of digits shows the sequence of numbers that are rolled.</li>
<li>The count shows how often each number 1, 2, &hellip;, 6 appeared.</li>
</ul>

<li>
<p>
We pick a random number between 0 and 11 (as there are 12 letters in the given string, and they will be stored at indices 0 .. 11), and then print that element in the character array.</p>
   <pre class="answer">
srand(time(NULL));             // an arbitrary seed
char *string = &quot;hippopotamus&quot;;
int size = strlen(string);
int ran = rand() % size;       // 0 &le; ran &le; size-1
printf(&quot;%c\n&quot;, string[ran]);
</pre>

 <li> <p>We pick a random number between 0 and <i>j-i</i>, and add that number to <i>i</i>. Note that we must compute <i>rand()</i> modulo (<i>j-i+1</i>) because the number <i>j-i</i> should be included.</p>
    <pre class="answer">
srand(time(NULL));             // an arbitrary seed
int ran = rand()%(j-i+1);      // 0 &le; ran &le; j-i
int num = i + ran;             // i &le; num &le; j
printf(&quot;%d\n&quot;, num);
</pre>
</li>

<li>
<p>
<pre class="answer">
#include &lt;stdio.h&gt;
#include &lt;stdlib.h&gt;

#define ASCII_MIN 33
#define ASCII_MAX 126

int main(int argc, char *argv[]) {
   int length;
   unsigned int seed;
   if (argc == 3) {
      seed = atoi(argv[1]);
      length = atoi(argv[2]);
      srand(seed);               // seed comes from the command line
      int i;
      for (i=0; i&lt;length; i++) {
         int ran = rand() % (ASCII_MAX - ASCII_MIN + 1) + ASCII_MIN;
         putchar(ran);
      }
      putchar('\n');
   }
   return 0;
}
</pre>
</p>
</li>
</ol>
</div>
</li>

<br/>
<li> (Karger's algorithm)
<p>
Consider the graph <i>G</i>:
<center><img src="graph.png"></center>
<ol type="a">
<li> <p>Find a minimum cut of <i>G</i>.</p>
<li> <p>Show two different ways in which randomised edge contraction may execute on <i>G</i>, one that results in a minimum cut and one that doesn't.</p>
<li> <p>Determine the total number of possible executions of the edge contraction algorithm on <i>G</i>. How many of these result in a minimum cut? What, therefore, is the probability for Karger's algorithm to find a minimum cut for <i>G</i>?
</ol>

<p><small>[<a id="q2a" href="##" onclick="toggleVisible('q2')">show answer</a>]</small></p>
<div id="q2" style="color:#000099;display:none">
<ol type="a">
<li> <p>The unique minimum cut is {a,b,c},{d}. The weight is 1.</p>
<li> <p>Two possible executions of the contraction algorithm:</p>
<center><img src="graph-contraction1.png"></center>
<p>The first execution results in a minimum cut of weight 1. The second execution results in a cut of weight 2.</p>
<li> <p>In the first step there are four edges to choose from.</p>
<ul>
   <li> <p>Selecting edge a-b, edge a-c or edge b-c all result in an intermediate graph like the one in the first execution from above. This therefore happens with probability &frac34;. If in the next step you choose any of the two edges between m and b, the result would be the same minimum cut. The likelihood for this to happen is &frac34;&middot;&frac23; = &frac12;. If instead edge b-d is selected, the result would be:</p>
<center><img src="graph-contraction2.png"></center>
<p>This happens with probability &frac34;&middot;&frac13; = &frac14;.</p>
<li> <p>If edge b-d is selected first as shown in the second execution for Exercise b, then in the next step you can contract any of the edges a-c, a-m or c-m to always obtain a graph with two nodes and two edges between them, hence a cut of weight 2. The likelihood for this to happen is therefore &frac14;&middot;1 = &frac14;.</p>
</ul>
<p>To summarise, there are 4&middot;3 possible executions, half of which result in the minimum cut. Hence, if randomised edge contraction is executed `|~ ((4),(2))*ln 4 ~|=9` times as required by Karger's algorithm, then the likelihood to find a minimum cut is 1 - (&frac12;)<sup>9</sup> = 99.8%.</p>
</ol>
</div>

<br/>
<li> (Analysis of randomised algorithms)
<p>
Random permutations can be a good way to test the average runtime behaviour of implementations, for example to test sorting algorithms, BST insertion strategies etc.</p>
<p>
The following algorithm can be used to compute a uniform random permutation of a given array:
<pre>
randomiseInPlace(A):
|  <b>Input</b>  array A[1..n]
|  <b>Output</b> random permutation of A
|
|  <b>for all</b> i=1&hellip;n <b>do</b>
|     swap A[i] with A[random number between i and n]
|  <b>end for</b>
|  <b>return</b> A
</pre>
</p>
<p>
Does the following variation also produce each possible permutation with equal probability?
<pre>
randomiseWithAll(A):
|  <b>Input</b>  array A[1..n]
|  <b>Output</b> random permutation of A
|
|  <b>for all</b> i=1&hellip;n <b>do</b>
|     swap A[i] with A[random number between 1 and n]
|  <b>end for</b>
|  <b>return</b> A
</pre>
</p>
<p><small>[<a id="q3a" href="##" onclick="toggleVisible('q3')">show answer</a>]</small></p>
<div id="q3" style="color:#000099;display:none">
<p>
Somewhat surprisingly, the answer is no. Take, for example, the array <tt>[1,2,3].</tt> There are 6 permutations, so each one of them should be produced with probability 1/6. But the permutation <tt>P = [3,2,1]</tt>, say, is returned with lower probability, as we can see when we consider all the ways in which <tt>P</tt> can be obtained:
</p>
<pre class="answer">
i=1: swap A[1],A[1]   i=2: swap A[2],A[2]   i=3: swap A[3],A[1]   probability 1/3*1/3*1/3 = 1/27
i=1: swap A[1],A[3]   i=2: swap A[2],A[2]   i=3: swap A[3],A[3]   probability 1/3*1/3*1/3 = 1/27
i=1: swap A[1],A[2]   i=2: swap A[2],A[1]   i=3: swap A[3],A[1]   probability 1/3*1/3*1/3 = 1/27
i=1: swap A[1],A[3]   i=2: swap A[2],A[3]   i=3: swap A[3],A[2]   probability 1/3*1/3*1/3 = 1/27
</pre>
<p>
Therefore the likelihood with which <tt>randomiseWithAll</tt> returns <tt>[1,2,3]</tt> is 4/27 &approx; 0.1481 &lt; 1/6 &approx; 0.1667.
</p>
<p>Contrast this with <tt>randomiseInPlace</tt>, where every possible permutation is the result of a unique sequence of swaps. For example:
</p>
<p>
<pre class="answer">
i=1: swap A[1],A[3]   i=2: swap A[2],A[2]   i=3: swap A[3],A[3]   probability 1/3*1/2*1 = 1/6
</pre>
</p>
</div>
<br/>
<li><b>Challenge Exercise</b>
<p>
In cryptography, a <i>substitution cipher</i> encrypts a plaintext by replacing each letter with another letter according to a fixed system. For example, if <tt>e&#x27F6;y</tt>, <tt>h&#x27F6;r</tt>, <tt>s&#x27F6;h</tt>, then the plaintext
<center>
  <tt>she sees, he sees.</tt>
</center>
would be encrypted by this ciphertext:
<center>
  <tt>hry hyyh, ry hyyh.</tt>
</center>
</p>
<p>
Even though there are 26! &approx; 4&middot;10<sup>26</sup> different encryption keys, substitution ciphers are not very strong and cryptoanalysts can break them by guessing the meaning of the most frequent letters in a ciphertext. With the help of a <a href="https://en.wikipedia.org/wiki/Letter_frequency#Relative_frequencies_of_letters_in_the_English_language">letter-frequency table for English</a>, try to decrypt the ciphertext below that's been encrypted using a randomly generated substitution cipher.</p>
<center>
  <tt>liam mtdru liu xdmluh theyhdxxuh: "sflieal liu sfbp, liu yhdmm peum bel xewu. sflieal meolsdhu, idhpsdhu fm amujumm."</tt>
</center>
<p>
<small>(The first student to email <a href="http://cgi.cse.unsw.edu.au/~mit/">me</a> the correct plaintext will receive accolades on this webpage.)</small>
</p>
<p><small>[<a id="q4a" href="##" onclick="toggleVisible('q4')">show answer</a>]</small></p>
<div id="q4" style="color:#000099;display:none">
<i>Congratulations to Jason Liu, who was the first to crack the code.
<br/>
</i>
</p>
<p>
Start by counting the frequencies in the ciphertext:
<pre class="answer">
a: 3
b: 2
c: 0
d: 5
e: 7
f: 3
g: 0
h: 6
i: 6
j: 0
k: 0
l: 11
m: 7
n: 0
o: 1
p: 2
q: 0
r: 1
s: 4
t: 2
u: 9
v: 0
w: 1
x: 4
y: 2
z: 0
</pre>
</p>
<p>If we replace the two most frequent letters (<tt>l,u</tt>) by the most frequent letters in English (<tt>e,t</tt>) we obtain the following partial text:</p>
<pre class="answer">
e___ ____t e_t ___et_ ________t_: "__e___e e_t ____, e_t _____ __t_ __e ___t. __e___e ___e___t, _______t __ __t_t__."
</pre>
<p>
There are three occurrences of <tt>e_t</tt>, which suggests that it's probably the other way round and they mean "the":
</p>
<pre class="answer">
th__ ____e the ___te_ ________e_: "__th__t the ____, the _____ __e_ __t ___e. __th__t ___t___e, h______e __ __e_e__."
</pre>
<p>You may then guess that the two occurrences of <tt>__th__t</tt> could be the word "without":
<pre class="answer">
thu_ ____e the ___te_ __o_____e_: "without the wi__, the _____ _oe_ _ot _o_e. without _o_tw__e, h___w__e i_ u_e_e__."
</pre>
<p>
Then the first word is most likely "thus", and "<tt>_ot</tt>" probably means "not", and so on. The actual plaintext is:</p>
<p>
<pre class="answer">
thus spake the master programmer: &quot;without the wind, the grass does not move. without software, hardware is useless.&quot;
</pre>
</p>
</div>
</li>

</ol>

<br/>
<h2>Assessment</h2>

<p>
Submit your solution to <b>Exercise 1d</b> using the following <b>give</b> command:
</p>
<pre class="command_line">
<kbd class="shell">give cs9024 week10 mypassword.c</kbd>
</pre>
<p>
Make sure you spell the filenames correctly. You can run <b>give</b> multiple times. Only your last submission will be marked.
</p>
<p>
<p>
The deadline for submission is <font color="red"><b>Friday,
19 November 5:00:00pm</b></font>.
</p>
<p>
The program is worth 2 marks. Auto-marking will be run by the lecturer several days after the submission deadline using different test cases than <tt>dryrun</tt> does.
</p>
<p>
<i>Hints</i>:
<ul>
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
