<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>COMP9024 21T3 - Large Assignment</title>
<link rel='stylesheet' type='text/css' href='./course.css'></head>
<body>
<div align='center'>
<table width='100%' border='0'>
<tr valign='top'>
<td align='left' width='25%'>
  <table><tr valign='top'><td><span class='tiny'><a href="http://www.cse.unsw.edu.au/~cs9024/21T3/index.html">COMP9024 21T3</a></span></td></tr>
  <tr><td><span class='tiny'><a href="http://www.cse.unsw.edu.au/~mit/">Prof Michael Thielscher</a></span></td></tr></table>
</td>
<td align='center' width='50%'>
  <span class='heading'>Large Assignment</span><br/>
  <span class='subheading'>Word Sequences</span>
</td>
<td align='right' width='25%'>
  <span class='heading'><img src="unsw.png"></span>
</td>
</table>
</div>
<h2>Change Log</h2>

We may make minor changes to the spec to address/clarify some outstanding issues. These may require minimal changes in your design/code, if at all. Students are strongly encouraged to check the change log regularly.
<br/><br/>
<b>27 October</b>
<ul>
   <li>Example for stage 3 corrected.
</ul>
<br/>
    <b>Version 1: Released on 22 October 2021</b>

<br/><br/><h2>Objectives</h2>

<p>The assignment aims to give you more independent, self-directed practice with</p>
<ul>
<li> advanced data structures, especially graphs
<li> graph algorithms
<li> asymptotic runtime analysis
</ul>

<h2>Admin</h2>

<table cellpadding="6">
<tr><td valign="top"><b>Marks</b></td><td></td>
  <td>2 marks for stage 1 (correctness)
  <br/>3 marks for stage 2 (correctness)
  <br/>2 marks for stage 3 (correctness)
  <br/>3 marks for stage 4 (correctness)
  <br/>1 mark for complexity analysis
  <br/>1 mark for style
  <br/>&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;
  <br/>Total: 12 marks</td></tr>
<tr><td><b>Due</b><td></td><td>11:00:00am on <b>Monday</b> 15 November (week 10)</td></tr>
<tr><td valign="top"><b>Late</b><td></td><td>2 marks (= &frac16; of the maximum mark) off the ceiling per day late
  <br/><small>(e.g. if you are 25 hours late, your maximum possible mark is 8)</small></td></tr>
</table>

<br/><h2>Aim</h2>

<p>A <b>word sequence</b> is a sequence of <i>k</i> &ge; 1 words:
<center>
&omega;<sub>1</sub> &rarr; &omega;<sub>2</sub> &rarr; &omega;<sub>3</sub> &rarr; &hellip; &rarr; &omega;<sub><i>k</i>-1</sub> &rarr; &omega;<sub><i>k</i></sub>
</center>
in which
<ul>
<li> words are ordered alphabetically, and
<li> two consecutive words &omega;<sub><i>i</i></sub> and &omega;<sub><i>i</i>+1</sub> differ by only one letter:
<ol>
<li> either they are of the same length with one letter different, e.g. &nbsp;<tt>tail</tt> &rarr; <tt>tall</tt>
<li> <i>or</i> one letter is missing or added, e.g. &nbsp;<tt>grater</tt> &rarr; <tt>greater</tt>&nbsp; or &nbsp;<tt>scent</tt> &rarr; <tt>sent</tt>.
</ol>
</ul>
</p>
<p>An example is the following word sequence of length <i>k</i> = 8:
<center>
  <tt>cold</tt> &rarr; <tt>cord</tt> &rarr; <tt>core</tt> &rarr; <tt>corse</tt> &rarr; <tt>horse</tt> &rarr; <tt>hose</tt> &rarr; <tt>host</tt> &rarr; <tt>hot</tt>
</center>

<p>Your task is to develop a program to compute the <i>longest</i> word sequences that can be created given a collection of words.
</p>

<br/><h2>Input</h2>

<p>Your program should start by prompting the user to input a positive number <i>n</i>, then prompt the user to input <i>n</i> words.
</p>

<p><i>Hint:</i></p>

You may assume that
<ul>
<li> the input is syntactically correct (a number <i>n</i> &ge;1 followed by <i>n</i> words);
<li> all words are input in alphabetical order;
<li> each single word has a maximum of 31 letters;
<li> only the 26 lowercase letters &nbsp;<tt>a</tt> &ndash; <tt>z</tt>&nbsp; will be used;
<li> the maximum number of words will be 100.
</ul>

<br/><h2>Output</h2>

<ul>
<li> <p><b>Task 1:</b> For each word &omega;, compute and output all the words that could be used as the next word after &omega; in a word sequence.</p>
<li> <p><b>Task 2:</b> Compute and output</p>
<ol type="a">
<li> <p>the maximum length of a word sequence that can be built from the words in the input,</p>
<li> <p>all word sequences of maximum length that can be built from the set of words in the input.</p>
</ul>
</ol>



<br/><h2>Stage 1 (2 marks)</h2>

<p>For stage 1, you need to demonstrate that you can build the underlying graph <i>under the assumption that all words have the same length.</i>
</p>
<p>Any test for this stage will have only words of equal length and such that all the words together form a word sequence. Hence, this stage focuses on Task 1, and for Task 2 you can just output the total number of words (= maximum length of a sequence) and a sequence containing all the words (= the only maximal sequence).</p>

Here is an example to show the desired behaviour of your program for a stage 1 test:
<pre class="command_line">
<kbd class="shell">./words</kbd>
Enter a number: <b>6</b>
Enter a word: <b>lad</b>
Enter a word: <b>lag</b>
Enter a word: <b>lap</b>
Enter a word: <b>tap</b>
Enter a word: <b>tip</b>
Enter a word: <b>top</b>

lad: lag lap
lag: lap
lap: tap
tap: tip top
tip: top
top:

Maximum sequence length: 6
Maximal sequence(s):
lad -> lag -> lap -> tap -> tip -> top
</pre>

<br/><h2>Stage 2 (3 marks)</h2>

<p>For stage 2, you should demonstrate that you can find <i>one</i> maximal sequence under the assumption that all words have the same length.
</p>

<p>Any test for this stage will be such that all words are of equal length and such that there is only one  maximal word sequence.</p>

Here is an example to show the desired behaviour of your program for a stage 2 test:
<pre class="command_line">
<kbd class="shell">./words</kbd>
Enter a number: <b>8</b>
Enter a word: <b>bad</b>
Enter a word: <b>ban</b>
Enter a word: <b>dad</b>
Enter a word: <b>dan</b>
Enter a word: <b>lad</b>
Enter a word: <b>lap</b>
Enter a word: <b>mad</b>
Enter a word: <b>tap</b>

bad: ban dad lad mad
ban: dan
dad: dan lad mad
dan:
lad: lap mad
lap: tap
mad:
tap:

Maximum sequence length: 5
Maximal sequence(s):
bad -> dad -> lad -> lap -> tap
</pre>

<br/><h2>Stage 3 (2 marks)</h2>

<p>For stage 3, you should extend your program for stage 2 such that words can be of different length.
</p>

<p>Tests for this stage are also guaranteed to have just one word sequence of maximum length.</p>

Here is an example to show the desired behaviour of your program for a stage 3 test:
<pre class="command_line">
<kbd class="shell">./words</kbd>
Enter a number: <b>6</b>
Enter a word: <b>east</b>
Enter a word: <b>eat</b>
Enter a word: <b>eats</b>
Enter a word: <b>fast</b>
Enter a word: <b>fist</b>
Enter a word: <b>foist</b>

east: eat fast
eat: eats
eats:
fast: fist
fist: foist
foist:

Maximum sequence length: 4
Maximal sequence(s):
east -> fast -> fist -> foist
</pre>


<br/><h2>Stage 4 (3 marks)</h2>

<p>For stage 4, you should extend your stage 3 program such that it outputs
<ul>
<li> all word sequences of maximal length
<li> in alphabetical order.
</ul>
</p>

Here is an example to show the desired behaviour of your program for a stage 4 test:
<pre class="command_line">
<kbd class="shell">./words</kbd>
Enter a number: <b>5</b>
Enter a word: <b>east</b>
Enter a word: <b>eat</b>
Enter a word: <b>eats</b>
Enter a word: <b>fast</b>
Enter a word: <b>fist</b>

east: eat fast
eat: eats
eats:
fast: fist
fist:

Maximum sequence length: 3
Maximal sequence(s):
east -> eat -> eats
east -> fast -> fist
</pre>

<p><i>Note:</i>
<ul>
<li> It is a requirement that the sequences are output in alphabetical order.
</ul>

<br/><h2>Complexity Analysis (1 mark)</h2>

<p> Your program should include a time complexity analysis for the worst-case asymptotic running time of your program, in Big-Oh notation, depending on the size of the input:
<ol>
<li> your implementation for Task 1, depending on the number <i>n</i> of words and the maximum length <i>m</i> of a word;
<li> your implementation for Task 2, depending on the number <i>n</i> of words.
</ol>

<p>
Your main program file <tt>words.c</tt> should start with a comment: <tt>/* &hellip; */</tt> that contains the time complexity of your program in Big-Oh notation, together with a short explanation.
</p>

<br/><h2>Hints</h2>

<p>If you find any of the following ADTs from the course useful, then you can, and indeed are encouraged to, use them with your program:</p>
<ul>
<li> linked list ADT : &nbsp; <a href="http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week4/progs/list.h"><tt>list.h</tt></a>, <a href="http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week4/progs/list.c"><tt>list.c</tt></a>
<li> stack ADT : &nbsp; <a href="http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week3/progs/stack.h"><tt>stack.h</tt></a>, <a href="http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week3/progs/stack.c"><tt>stack.c</tt></a>
<li> queue ADT : &nbsp; <a href="http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week4/progs/queue.h"><tt>queue.h</tt></a>, <a href="http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week4/progs/queue.c"><tt>queue.c</tt></a>
<li> priority queue ADT : &nbsp; <a href="http://www.cse.unsw.edu.au/~cs9024/21T3/probs/prob5/PQueue.h"><tt>PQueue.h</tt></a>, <a href="http://www.cse.unsw.edu.au/~cs9024/21T3/probs/prob5/PQueue.c"><tt>PQueue.c</tt></a>
<li> graph ADT : &nbsp; <a href="http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week4/progs/Graph.h"><tt>Graph.h</tt></a>, <a href="http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week4/progs/Graph.c"><tt>Graph.c</tt></a>
<li> weighted graph ADT : &nbsp; <a href="http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week5/progs/WGraph.h"><tt>WGraph.h</tt></a>, <a href="http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week5/progs/WGraph.c"><tt>WGraph.c</tt></a>
</ul>
<p><b>You are free to modify any of the six ADTs for the purpose of the assignment (<i>but without changing the file names</i>).</b> If your program is using one or more of these ADTs, you should submit both the header and implementation file, even if you have not changed them.
</p>

<p>
Your main program file <tt>words.c</tt> should start with a comment: <tt>/* &hellip; */</tt> that contains the time complexity of your program in Big-Oh notation, together with a short explanation.
</p>

<br/><h2>Testing</h2>

<p><i>We have created a script that can automatically test your program. To run this test you can execute the </i><tt>dryrun</tt><i> program for the corresponding assignment, i.e. <tt>words</tt>. It expects to find, in the current directory, the program </i><tt>words.c</tt><i> and any of the admissible ADTs (<tt>Graph,WGraph,stack,queue,PQueue,list</tt>) that your program is using, even if you use them unchanged. You can use dryrun as follows:</i></p>
<pre class="command_line">
<kbd class="shell">9024 dryrun words</kbd>
</pre>

<p><i>Please note: Passing the dryrun tests does not guarantee that your program is correct. You should thoroughly test your program with your own test cases.</i></p>

<br/><h2>Submit</h2>

For this project you will need to submit a file named <tt>words.c</tt> and, optionally, any of the ADTs named <tt>Graph,WGraph,stack,queuePQueue,list</tt> that your program is using, even if you have not changed them. You can either submit through WebCMS3 or use a command line. For example, if your program uses the <tt>Graph</tt> ADT and the <tt>list</tt> ADT, then you should submit:
<pre class="command_line">
<kbd class="shell">give cs9024 assn words.c Graph.h Graph.c list.h list.c</kbd>
</pre>
</p>
<p>Do not forget to add the time complexity to your main source code file <tt>words.c</tt>.
</p>
You can submit as many times as you like &mdash; later submissions will overwrite earlier ones. You can check that your submission has been received on WebCMS3 or by using the following command:
<pre class="command_line">
<kbd class="shell">9024 classrun -check assn</kbd>
</pre>
</p>


<br/><h2>Marking</h2>

<p>This project will be marked on functionality in the first instance, so it is very important that the output of your program be <b><i>exactly</i></b> correct as shown in the examples above. Submissions which score very low on the automarking will be looked at by a human and may receive a few marks, provided the code is well-structured and commented.</p>

<p>Programs that generate compilation errors will receive a very low mark, no matter what other virtues they may have. In general, a program that attempts a substantial part of the job and does that part correctly will receive more marks than one attempting to do the entire job but with many errors.</p>

<p>Style considerations include:</p>
<ul>
<li> Readability
<li> Structured programming
<li> Good commenting
</ul>

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

<h2>Help</h2>

See <a href="https://www.cse.unsw.edu.au/~cs9024/21T3/assn/faq.php">FAQ</a> for some additional hints.

<br/><h2>Finally &hellip;</h2>

<i>Have fun! Michael</i>

<br/>
<p><small>Reproducing, publishing, posting, distributing or translating this page is an infringement of copyright and will be referred to UNSW Conduct and Integrity for action.</small></p>
</body>
</html>
