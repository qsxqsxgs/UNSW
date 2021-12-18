<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>COMP9024 21T3 - Week 5 Problem Set</title>
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
  <span class='heading'>Week 5 Problem Set</span><br/>
  <span class='subheading'>Minimum Spanning Trees, Shortest Paths, Maximum Flows</span>
</td>
<td align='right' width='25%'>
  <span class='heading'><img src="unsw.png"></span>
</td>
</table>
</div><p style='text-align:center;font-size:75%'><a href='/~cs9024/21T3/probs/prob5/index.php?view=qo'>[Show with no answers]</a> &nbsp; <a href='/~cs9024/21T3/probs/prob5/index.php?view=all'>[Show with all answers]</a></div>

<ol>

<li>(Graph representations)

<ol type="a">
<li><p>Consider the following graphs, where bi-directional edges are depicted as two-way arrows rather than having two separate edges going in opposite directions:
</p>
<center><img src="graph1.png"></center>
<p>
For each of the graphs show the concrete data structures if the graph was implemented via:
</p>
<p>
<ol>
<li> adjacency matrix representation (assume full V&times;V matrix)
<li> adjacency list representation (if non-directional, include both (v,w) and (w,v))
</ol>

<li>
<p>
Consider the following map of streets in the Sydney CBD:
</p><br/>
<center><img src="SydneyCBD.png"></center>
<p>
Represent this as a directed graph, where intersections are
vertices and the connecting streets are edges. Ensure that
the directions on the edges correctly reflect any one-way streets
(this is a driving map, not a walking map).
You only need to make a graph which includes the intersections
marked with red letters.
Some things that don't show on the map: Castlereagh St is one-way
heading south, Curtin Pl is a little laneway that you can't drive down and, thanks to the shiny new light rail, George St is now closed for cars between "F" and "K".
</p>
<p>
For each of the following pairs of intersections, indicate
whether there is a path from the first to the second. Show a simple path if there is one. If there is more
than one simple path, show two different paths.
<ol>
<li><p>
from intersection "D" on Margaret St
to insersection "L" on Pitt St
</p></li>
<li><p>
from intersection "J" to the corner of Margaret St and York St
(intersection "A")
</p></li>
<li><p>
from intersection "P" on Castlereagh St to the corner of Margaret St and Wynyard Ln ("C")
</p>
<li><p>
from the intersection of Castlereagh St and Hunter St ("M")
to intersection "H" at Wynyard Park
</p></li>
</ol>
</ol>

<p><small>[<a id="q1a" href="##" onclick="toggleVisible('q1')">show answer</a>]</small></p>
<div id="q1" style="color:#000099;display:none">
<ol type="a">
<li>
<p><img src="graph1_a.png" style="background-color:#E8F8F5;"></p>
<p><img src="graph1_b.png" style="background-color:#E8F8F5;"></p>

<li>
<p>
The graph is as follows.
</p>
<center><img src="SydneyGraph.png" style="background-color:#E8F8F5";></center>
<p>
For the paths:
</p>
<ol>
<li><p>
<nobr>D &rightarrow; F &rightarrow; G &rightarrow; L</nobr>
and there are no other choices that don't involve loops through F or G.
</p></li>
<li><p>
<nobr>J &rightarrow; I &rightarrow; B &rightarrow; A.</nobr>
<li><p>
You can't reach C from P on this graph. Real-life is different, of course.
</p></li>
<li><p>
<nobr>M &rightarrow; G &rightarrow; F &rightarrow; D &rightarrow; C &rightarrow; B  &rightarrow; A &rightarrow; H<nobr>
&nbsp; or &nbsp;
<nobr>M &rightarrow; G &rightarrow; F &rightarrow; D &rightarrow; C &rightarrow; J &rightarrow; I &rightarrow; H.</nobr>
</p></li>
</ol>
</ol>
</div>

<li> (Digraphs)
<br/>
<p>Write a program <tt>FollowerBase.c</tt> that</p>
<ol>
<li> <p>builds a <i>directed</i> graph from user input, where each node represents a user of a social networking platform:</p>
  <ul>
  <li> first, the program prompts for the number of users
  <li> then, the program repeatedly asks to input information about who <i>follows</i> who on the networking platform
  <li> until any non-numeric character(s) are entered
  </ul>
<li> <p>ranks all the nodes according to their <i>follower base</i>, that is, by the number of their followers</p>
  <ul>
  <li> nodes with the same number of followers are ranked by how many users <i>they</i> follow
  </ul>
<li> <p>outputs the nodes and the size of their follower base, from most popular to least popular (and from following the most to following the least when users have the same number of followers). Nodes that rank equally on both accounts should be displayed in their natural (increasing) order.</p>
</ol> 

<p>Your program should use the Weighted Graph ADT (<a href="http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week5/progs/WGraph.h"><tt>WGraph.h</tt></a>, <a href="http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week5/progs/WGraph.c"><tt>WGraph.c</tt></a>) from the lecture. Do not change the header file or the ADT implementation.<br/>
<p><i>Hints</i>:
<ul>
<li> You cannot use the standard Graph ADT since this assumes undirected edges.
<li> You can use a modified version of the sorting algorithm (<a href="https://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week1/progs/inssort.c"><tt>inssort.c</tt></a>) from Week 1 if you wish.
</ul>
</p>

An example of the program executing is shown below. The input is the directed graph in Exercise 1a.
<pre class="command_line">
<kbd class="shell">./FollowerBase</kbd>
Enter the number of users:<b> 6</b>
Enter a user (follower):<b> 0</b>
Enter a user (followed by 0):<b> 1</b>
Enter a user (follower):<b> 1</b>
Enter a user (followed by 1):<b> 5</b>
Enter a user (follower):<b> 3</b>
Enter a user (followed by 3):<b> 5</b>
Enter a user (follower):<b> 5</b>
Enter a user (followed by 5):<b> 0</b>
Enter a user (follower):<b> 5</b>
Enter a user (followed by 5):<b> 2</b>
Enter a user (follower):<b> 5</b>
Enter a user (followed by 5):<b> 3</b>
Enter a user (follower):<b> 5</b>
Enter a user (followed by 5):<b> 4</b>
Enter a user (follower):<b> #</b>
Done.

Ranking by follower base:
5 has 2 follower(s) and follows 4 user(s).
0 has 1 follower(s) and follows 1 user(s).
1 has 1 follower(s) and follows 1 user(s).
3 has 1 follower(s) and follows 1 user(s).
2 has 1 follower(s) and follows 0 user(s).
4 has 1 follower(s) and follows 0 user(s).
</pre>

<p><i>We have created a script that can automatically test your program. To run this test you can execute the </i><tt>dryrun</tt><i> program that corresponds to this exercise. It expects to find a file named </i><tt>FollowerBase.c</tt><i> in the current directory. You can use dryrun as follows:</i></p>
<pre class="command_line">
<kbd class="shell">9024 dryrun FollowerBase</kbd>
</pre>
<p><small>[<a id="q2a" href="##" onclick="toggleVisible('q2')">show answer</a>]</small></p>
<div id="q2" style="color:#000099;display:none">
<pre class="answer">
#include &lt;stdio.h&gt;
#include &lt;stdlib.h&gt;
#include &lt;assert.h&gt;
#include "WGraph.h"

typedef struct Ranking {
   Vertex v;
   int    in, out;        // #edges into node, #edges out of a node
   float  rank;           // integer component = #followers, fraction = #following / #users
} Ranking;

void insertionSort(Ranking array[], int n) {            // sorting algorithm from week 1, adapted
   int i;
   for (i = 1; i &lt; n; i++) {
      Ranking element = array[i];                       // for this element ...
      int j = i-1;
      while (j &gt;= 0 && array[j].rank &lt; element.rank) {  // ... work down the ordered list
         array[j+1] = array[j];                         // ... moving elements up
         j--;
      }
      array[j+1] = element;                             // and insert in correct position
   }
}

void followerBase(Graph g) {
   Vertex v, w;
   int nV = numOfVertices(g);

   Ranking *table = calloc(nV, sizeof(Ranking));        // initialise in = out = 0
   for (v = 0; v &lt; nV; v++) {                           // compute in and out degrees
      table[v].v = v;
      for (w = 0; w &lt; nV; w++) {
         if (adjacent(g, v, w)) {
	       table[v].out++;
	       table[w].in++;
         }
      }
   }

   for (v = 0; v &lt; nV; v++)                             // determine ranking of all users
      table[v].rank = (float) table[v].in
	                      + (float) table[v].out / (float) nV;

   insertionSort(table, nV);                            // sort nodes by decreasing ranking
   printf("\nRanking by follower base:\n");
   for (v = 0; v &lt; nV; v++)
      printf("%d has %d follower(s) and follows %d user(s).\n", table[v].v, table[v].in, table[v].out);

   free(table);
}

int main(void) {
   Edge e = {0, 0, 1};                                  // use constant edge weight = 1
   int n;

   printf("Enter the number of users: ");
   scanf("%d", &n);
   Graph g = newGraph(n);

   printf("Enter a user (follower): ");
   while (scanf("%d", &e.v) == 1) {
      printf("Enter a user (followed by %d): ", e.v);
      scanf("%d", &e.w);
      insertEdge(g, e);
      printf("Enter a user (follower): ");
   }
   printf("Done.\n");

   followerBase(g);
   freeGraph(g);

   return 0;
}
</pre>
</div>

<br/>
<li>(Warshall's algorithm)

<p>
Apply Warshall's algorithm to compute the transitive closure of your graph from exercise 1b. Choose vertices in alphabetical order. Show the reachability matrix:
<ul>
<li> after the initialisation
<li> after the 1<sup>st</sup> iteration (vertex 'A') of the outermost loop
<li> after the 6<sup>th</sup> iteration (vertex 'F') of the outermost loop
<li> at the end.
</ul>
</p>
<p>Interpret the values in each of these matrices: Which connections between vertices do the different matrices encode?
</p>

<p><small>[<a id="q3a" href="##" onclick="toggleVisible('q3')">show answer</a>]</small></p>
<div id="q3" style="color:#000099;display:none">
<p>The initial matrix encodes all directed paths of length 1:</p>
<table border=1 cellpadding=4>
<tr>
<td align="center"><tt><small>tc</small></tt></td>
<td align="center"><small>[A]</td><td align="center"><small>[B]</td><td align="center"><small>[C]</td><td align="center"><small>[D]</td><td align="center"><small>[E]</td><td align="center"><small>[F]</td><td align="center"><small>[G]</td><td align="center"><small>[H]</td><td align="center"><small>[I]</td><td align="center"><small>[J]</td><td align="center"><small>[K]</td><td align="center"><small>[L]</td><td align="center"><small>[M]</td><td align="center"><small>[N]</td><td align="center"><small>[P]</td>
</tr>
<tr>
<td align="center"><small>[A]</td>
<td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[B]</td>
<td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[C]</td>
<td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[D]</td>
<td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[E]</td>
<td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[F]</td>
<td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[G]</td>
<td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[H]</td>
<td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[I]</td>
<td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[J]</td>
<td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[K]</td>
<td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[L]</td>
<td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[M]</td>
<td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td></tr>
<tr>
<td align="center"><small>[N]</td>
<td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[P]</td>
<td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
</table>
</p>

<p>
After the first iteration:
</p>
<table border=1 cellpadding=4>
<tr>
<td align="center"><tt><small>tc</small></tt></td>
<td align="center"><small>[A]</td><td align="center"><small>[B]</td><td align="center"><small>[C]</td><td align="center"><small>[D]</td><td align="center"><small>[E]</td><td align="center"><small>[F]</td><td align="center"><small>[G]</td><td align="center"><small>[H]</td><td align="center"><small>[I]</td><td align="center"><small>[J]</td><td align="center"><small>[K]</td><td align="center"><small>[L]</td><td align="center"><small>[M]</td><td align="center"><small>[N]</td><td align="center"><small>[P]</td>
</tr>
<tr>
<td align="center"><small>[A]</td>
<td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[B]</td>
<td align="center"><font color=#000099><small>1</td><td align="center"><font color="red"><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color="red"><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[C]</td>
<td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[D]</td>
<td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[E]</td>
<td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[F]</td>
<td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[G]</td>
<td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[H]</td>
<td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[I]</td>
<td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[J]</td>
<td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[K]</td>
<td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[L]</td>
<td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[M]</td>
<td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td></tr>
<tr>
<td align="center"><small>[N]</td>
<td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[P]</td>
<td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
</table>
</p>
<p>This matrix represents the existence of all directed paths:
<ul>
<li> of length 1,
<li> of length &gt;1 that go through vertex A as the only non-endpoint (B&rarr;A&rarr;B and B&rarr;A&rarr;H).
</ul>
</p>
<p>
After the sixth iteration:
</p>
<table border=1 cellpadding=4>
<tr>
<td align="center"><tt><small>tc</small></tt></td>
<td align="center"><small>[A]</td><td align="center"><small>[B]</td><td align="center"><small>[C]</td><td align="center"><small>[D]</td><td align="center"><small>[E]</td><td align="center"><small>[F]</td><td align="center"><small>[G]</td><td align="center"><small>[H]</td><td align="center"><small>[I]</td><td align="center"><small>[J]</td><td align="center"><small>[K]</td><td align="center"><small>[L]</td><td align="center"><small>[M]</td><td align="center"><small>[N]</td><td align="center"><small>[P]</td>
</tr>
<tr>
<td align="center"><small>[A]</td>
<td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[B]</td>
<td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[C]</td>
<td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[D]</td>
<td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[E]</td>
<td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[F]</td>
<td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[G]</td>
<td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[H]</td>
<td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[I]</td>
<td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[J]</td>
<td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[K]</td>
<td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[L]</td>
<td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[M]</td>
<td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td></tr>
<tr>
<td align="center"><small>[N]</td>
<td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[P]</td>
<td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
</table>
</p>
<p>This matrix represents the existence of all directed paths
<ul>
<li> of length 1,
<li> of length &gt;1 that go through one or more of the vertices A,B,C,D,E,F as non-endpoints.
</ul>
</p>
<p>
After the last iteration:
</p>
<table border=1 cellpadding=4>
<tr>
<td align="center"><tt><small>tc</small></tt></td>
<td align="center"><small>[A]</td><td align="center"><small>[B]</td><td align="center"><small>[C]</td><td align="center"><small>[D]</td><td align="center"><small>[E]</td><td align="center"><small>[F]</td><td align="center"><small>[G]</td><td align="center"><small>[H]</td><td align="center"><small>[I]</td><td align="center"><small>[J]</td><td align="center"><small>[K]</td><td align="center"><small>[L]</td><td align="center"><small>[M]</td><td align="center"><small>[N]</td><td align="center"><small>[P]</td>
</tr>
<tr>
<td align="center"><small>[A]</td>
<td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td></tr>
<tr>
<td align="center"><small>[B]</td>
<td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td></tr>
<tr>
<td align="center"><small>[C]</td>
<td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td></tr>
<tr>
<td align="center"><small>[D]</td>
<td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td></tr>
<tr>
<td align="center"><small>[E]</td>
<td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td></tr>
<tr>
<td align="center"><small>[F]</td>
<td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td></tr>
<tr>
<td align="center"><small>[G]</td>
<td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td></tr>
<tr>
<td align="center"><small>[H]</td>
<td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[I]</td>
<td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td></tr>
<tr>
<td align="center"><small>[J]</td>
<td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td></tr>
<tr>
<td align="center"><small>[K]</td>
<td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[L]</td>
<td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
<tr>
<td align="center"><small>[M]</td>
<td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td></tr>
<tr>
<td align="center"><small>[N]</td>
<td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td><td align="center"><font color=#000099><small>1</td></tr>
<tr>
<td align="center"><small>[P]</td>
<td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td><td align="center"><font color=#000099><small>0</td></tr>
</table>
</p>
<p>The final matrix represents the existence of all directed paths through any of the vertices as non-endpoints, i.e. the transitive closure.
</p>
</div>


<br/>
<li> (Minimum spanning trees)
<p/>
<ol type="a">
<li> <p>Show how Kruskal's algorithm would construct the MST for the following graph:
<center><img src="graph4.png"></center>
How many edges do you have to consider?</p>
<li> <p>For a graph <i>G=(V,E)</i>, what is the least number of edges that might need to be considered by Kruskal's algorithm, and what is the most number of edges? Add one vertex and edge to the above graph to force Kruskal's algorithm to the worst case.</p>
<li> <p>Trace the execution of Prim's algorithm to compute a minimum spanning tree on the following graph:</p>
<center><img src="graph2.png"></center>
<p>Choose a random vertex to start with. Draw the resulting minimum spanning tree.</p>
</ol>
<p><small>[<a id="q4a" href="##" onclick="toggleVisible('q4')">show answer</a>]</small></p>
<div id="q4" style="color:#000099;display:none">
<ol type="a">
<li>
<p>
In the first iteration of Kruskal's algorithm, we could choose either 1-4 or 6-7,
since both edges have weight 1. Assume we choose 1-4.
Since its inclusion produces no cycles, we add it to the MST
(non-existent edges are indicated by dotted lines):
</p>
<center><img src="graph5a.png" style="background-color:#E8F8F5;"></center>
<p>
In the next iteration, we choose 6-7. Its inclusion produces
no cycles, so we add it to the MST:
</p>
<center><img src="graph5b.png" style="background-color:#E8F8F5;"></center>
<p>
In the next iteration, we could choose either 1-2 or 3-4,
since both edges have weight 2. Assume we choose 1-2.
Since its inclusion produces no cycles, we add it to the MST:
</p>
<center><img src="graph5c.png" style="background-color:#E8F8F5;"></center>
<p>
In the next iteration, we choose 3-4. Its inclusion produces
no cycles, so we add it to the MST:
</p>
<center><img src="graph5d.png" style="background-color:#E8F8F5;"></center>
<p>
In the next iteration, we would first consider the lowest-cost
unused edge. This is 2-4, but its inclusion would produce a
cycle, so we ignore it. We then consider 1-3 and 4-7 which
both have weight 4. If we choose 1-3, that produces a cycle
so we ignore that edge. If we add 4-7 to the MST, there is no
cycle and so we include it:
</p>
<center><img src="graph5e.png" style="background-color:#E8F8F5;"></center>
<p>
Now the lowest-cost unused edge is 3-6, but its inclusion would produce a
cycle, so we ignore it. We then consider 5-7. If we add 5-7
to the MST, there is no cycle and so we include it:
</p>
<center><img src="graph5f.png" style="background-color:#E8F8F5;"></center>
<p>
At this stage, all vertices are connected and we have a MST.
</p>
<p>
For this graph, we considered 9 of the 12 possible edges in
determining the MST.</p>
<li> <p>For a graph with <i>V</i> vertices and <i>E</i> edges,
the best case would be when the
first <i>V-1</i> edges we consider are the lowest cost edges
and none of these edges leads to a cycle.
The worst case would be when we had to consider all <i>E</i>
edges.
If we added a vertex 8 to the above graph, and connected
it to vertex 5 with edge cost 11 (or any cost larger than
all the other edge costs in the graph), we would need to
consider all edges to construct the MST.</p>
<li><p>If we start at node 5, for example, edges would be found in the following order:
<ul>
<li> 5-3
<li> 3-4
<li> 4-7
<li> 1-7
<li> 6-7
<li> 0-7
<li> 0-2
</ul>
</p>
<p>
The minimum spanning tree:
</p>
<center><img src="graph2-mst.png" style="background-color:#E8F8F5;"></center>

</ol>
</div>

<br/>
<li> (Dijkstra's algorithm)

<ol type="a">
<li>
<p>Consider the following graph:
<center><img src="sssp-graph.png"></center>
</p>
<ol type="i">
<li> <p>What is the shortest path from vertex 0 to vertex 3? From vertex 0 to vertex 7? How did you determine these?</p>
<li><p>Trace the execution of Dijkstra's algorithm on the graph to compute the minimum distances from source node 0 to all other vertices.
</p>
<p>Show the values of <tt>vSet</tt>, <tt>dist[]</tt> and <tt>pred[]</tt> after each iteration.</p>
</ol>

<li><p>Download the implementation of a Priority Queue ADO (<a href=http://www.cse.unsw.edu.au/~cs9024/21T3/probs/prob5/PQueue.h><tt>PQueue.h</tt></a>,
<a href=http://www.cse.unsw.edu.au/~cs9024/21T3/probs/prob5/PQueue.c><tt>PQueue.c</tt></a>). The ADO implements a single priority queue for up to 1000 elements for Dijkstra's algorithm. The queue is represented by a global variable <font color=blue><tt>PQueue</tt></font> of the following structure:
<pre>
#define MAX_NODES 1000
typedef struct {
   int item[MAX_NODES];  // array of vertices currently in queue
   int length;           // #values currently stored in item[] array
} PQueueT;

static PQueueT <font color=blue>PQueue</font>;   // defines the Priority Queue Object
</pre>
It is assumed that vertices are stored in the <tt>item[]</tt>
array in the priority queue in <i>no</i> particular order.
Rather, the <tt>item[]</tt> array acts like a set, and the priority
is determined by reference to a <tt>priority[0..nV-1]</tt> array.

<br/><br/>
The Priority Queue ADO provides implementations of the following functions:
<pre>
void   PQueueInit();                 // set up empty priority queue
void   joinPQueue(Vertex v);         // insert vertex v into priority queue
                                     // no effect if v is already in the queue
Vertex leavePQueue(int priority[]);  // remove the highest priority vertex from the priority queue
                                     // remember: highest priority = lowest value priority[v]
                                     // returns the removed vertex
bool   PQueueIsEmpty();              // check if the priority queue is empty
</pre>

<p>
Next, download and complete the incomplete implementation <a href=http://www.cse.unsw.edu.au/~cs9024/21T3/probs/prob5/dijkstra.c><tt>dijkstra.c</tt></a> of Dijkstra's algorithm that uses the priority queue ADO and the Weighted Graph ADT (<a href="http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week5/progs/WGraph.h"><tt>WGraph.h</tt></a>, <a href="http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week5/progs/WGraph.c"><tt>WGraph.c</tt></a>) from the lecture. The program:
<ul>
<li> prompts the user for the number of nodes in a graph,
<li> prompts the user for a source node,
<li> builds a weighted <i>undirected</i> graph from user input (adds every input edge in both directions),
<li> uses the priority queue to compute and output the distance and a shortest path from the source to every vertex of the graph (<b>needs to be implemented</b>).
</ul>
<p>
An example of the program executing is shown below. The input graph consists of a simple triangle along with a fourth, disconnected node.
<pre class="command_line">
<kbd class="shell">./dijkstra</kbd>
Enter the number of vertices:<b> 4</b>
Enter the source node: <b>0</b>
Enter an edge (from):<b> 0</b>
Enter an edge (to):<b> 1</b>
Enter the weight:<b> 42</b>
Enter an edge (from):<b> 0</b>
Enter an edge (to):<b> 2</b>
Enter the weight:<b> 25</b>
Enter an edge (from):<b> 1</b>
Enter an edge (to):<b> 2</b>
Enter the weight:<b> 14</b>
Enter an edge (from):<b> done</b>
Finished.
0: distance = 0, shortest path: 0
1: distance = 39, shortest path: 0-2-1
2: distance = 25, shortest path: 0-2
3: no path
</pre>
</p>
<p>
Note that any non-numeric data can be used to 'finish' the interaction.
</p>
<p><i>To test your program you can execute the </i><tt>dryrun</tt><i> program that corresponds to this exercise. It expects to find a file named </i><tt>dijkstra.c</tt><i> in the current directory.
You can use dryrun as follows:</i></p>
<pre class="command_line">
<kbd class="shell">9024 dryrun dijkstra</kbd>
</pre>
<p><i>Note: Please ensure that your output follows exactly the format shown above.</i></p>

</ol>

<p><small>[<a id="q5a" href="##" onclick="toggleVisible('q5')">show answer</a>]</small></p>
<div id="q5" style="color:#000099;display:none">
<ol type="a">
<li>
<ol type="i">
<li> <p>Shortest path from vertex 0 to vertex 3 has total weight 5. There are really only two plausible choices: either the direct edge from vertex 0 to vertex 3, or two edges via vertex 2. It is easy to see that the total weight on the two-edge path (5) is less than the weight on the single edge (6).
</p>
<p>Shortest path from vertex 0 to vertex 7 has total weight 13. Probably (although not necessarily) the best paths are also the most direct ones, which suggests 0-1-6-7, 0-1-5-7 and 0-2-4-7. If we sum the lengths on each of these paths, they are, respectively: 17, 13, 15. So we choose the shortest: 0-1-5-7.
</p>
<li>Initialisation:
<pre class="answer">
vSet = { 0, 1, 2, 3, 4, 5, 6, 7 }
dist = [ 0, &infin;, &infin;, &infin;, &infin;, &infin;, &infin;, &infin; ]
pred = [ -1, -1, -1, -1, -1, -1, -1, -1 ]
</pre>
</p>

The vertex in vSet with minimum dist[] is 0. Relaxation along the edges (0,1,5), (0,2,4) and (0,3,6) results in:
<pre class="answer">
vSet = { 1, 2, 3, 4, 5, 6, 7 }
dist = [ 0, 5, 4, 6, &infin;, &infin;, &infin;, &infin; ]
pred = [ -1, 0, 0, 0, -1, -1, -1, -1 ]
</pre>
</p>

Now the vertex in vSet with minimum dist[] is 2. Considering all edges from 2 to nodes still in vSet:
<ul>
<li> relaxation along (2,1,8) does not give us a shorter distance to node 1
<li> relaxation along (2,3,1) yields a smaller value (4+1 = 5) for dist[3], and pred[3] is updated to 2
<li> relaxation along (2,4,3) yields a smaller value (4+3 = 7) for dist[4], and pred[4] is updated to 2
<li> relaxation along (2,5,7)  yields a smaller value (4+7 = 11) for dist[5], and pred[5] is updated to 2
</ul>
<pre class="answer">
vSet = { 1, 3, 4, 5, 6, 7 }
dist = [ 0, 5, 4, 5, 7, 11, &infin;, &infin; ]
pred = [ -1, 0, 0, 2, 2, 2, -1, -1 ]
</pre>
</p>

Next, we could choose either 1 or 3, since both vertices have minimum distance 5. Suppose we choose 1. Relaxation along (1,5,2) and (1,6,7)  results in new values for nodes 5 and 6:
<pre class="answer">
vSet = { 3, 4, 5, 6, 7 }
dist = [ 0, 5, 4, 5, 7, 7, 12, &infin; ]
pred = [ -1, 0, 0, 2, 2, 1, 1, -1 ]
</pre>
</p>

Now we consider vertex 3. The only adjacent node still in vSet is 4, but there is no shorter path to 4 through 3. Hence no update to dist[] or pred[]:
<pre class="answer">
vSet = { 4, 5, 6, 7 }
dist = [ 0, 5, 4, 5, 7, 7, 12, &infin; ]
pred = [ -1, 0, 0, 2, 2, 1, 1, -1 ]
</pre>
</p>

Next we could choose either vertex 4 or 5. Suppose we choose 4. Edge (4,7,8) is the only one that leads to an update:
<pre class="answer">
vSet = { 5, 6, 7 }
dist = [ 0, 5, 4, 5, 7, 7, 12, 15 ]
pred = [ -1, 0, 0, 2, 2, 1, 1, 4 ]
</pre>
</p>

Vertex 5 is next. Relaxation along edges (5,6,3) and (5,7,6) results in:
<pre class="answer">
vSet = { 6, 7 }
dist = [ 0, 5, 4, 5, 7, 7, 10, 13 ]
pred = [ -1, 0, 0, 2, 2, 1, 5, 5 ]
</pre>
</p>

Of the two vertices left in vSet, 6 has the shorter distance. Edge (6,7,5) does not update the values for node 7 since dist[7]=13&lt;dist[6]+5=15. Hence:
<pre class="answer">
vSet = { 7 }
dist = [ 0, 5, 4, 5, 7, 7, 10, 13 ]
pred = [ -1, 0, 0, 2, 2, 1, 5, 5 ]
</pre>
</p>

Processing the last remaining vertex in vSet will obviously not change anything. The values in pred[] determine shortest paths to all nodes as follows:
<pre class="answer">
0: distance = 0, shortest path: 0
1: distance = 5, shortest path: 0-1
2: distance = 4, shortest path: 0-2
3: distance = 5, shortest path: 0-2-3
4: distance = 7, shortest path: 0-2-4
5: distance = 7, shortest path: 0-1-5
6: distance = 10, shortest path: 0-1-5-6
7: distance = 13, shortest path: 0-1-5-7
</pre>
</p>
</ol>
<li> Sample implementation of Dijkstra's algorithm, including a recursive function to display a path via <tt>pred[]</tt>:
<pre class="answer">
#define VERY_HIGH_VALUE 999999

void showPath(int v, int pred[]) {
   if (pred[v] == -1) {
      printf("%d", v);
   } else {
      showPath(pred[v], pred);
      printf("-%d", v);
   }
}

void dijkstraSSSP(Graph g, Vertex source) {
   int  dist[MAX_NODES];
   int  pred[MAX_NODES];
   bool vSet[MAX_NODES];  // vSet[v] = true <=> v has not been processed
   int s, t;

   PQueueInit();
   int nV = numOfVertices(g);
   for (s = 0; s < nV; s++) {
      joinPQueue(s);
      dist[s] = VERY_HIGH_VALUE;
      pred[s] = -1;
      vSet[s] = true;
   }
   dist[source] = 0;
   while (!PQueueIsEmpty()) {
      s = leavePQueue(dist);
      vSet[s] = false;
      for (t = 0; t < nV; t++) {
         if (vSet[t]) {
            int weight = adjacent(g,s,t);
            if (weight > 0 && dist[s]+weight < dist[t]) {  // relax along (s,t,weight)
               dist[t] = dist[s] + weight;
               pred[t] = s;
            }
         }
      }
   }
   for (s = 0; s < nV; s++) {
      printf("%d: ", s);
      if (dist[s] < VERY_HIGH_VALUE) {
         printf("distance = %d, shortest path: ", dist[s]);
         showPath(s, pred);
         putchar('\n');
      } else {
         printf("no path\n");
      }
   }
}
</pre>
</ol>
</div>

<br/>
<li> (All-pair shortest paths)
<ol type="a">
<li> <p>In the graph from exercise 5a, what is the shortest path from vertex 3 to vertex 6? From vertex 6 to vertex 3? How did you determine these?</p>
<li>
<p>
Trace the execution of Floyd's algorithm on the graph from exercise 5a to compute the shortests paths between <i>all</i> pairs of vertices.
</p>
</ol>
<p><small>[<a id="q6a" href="##" onclick="toggleVisible('q6')">show answer</a>]</small></p>
<div id="q6" style="color:#000099;display:none">
<ol type="a">
<li> <p>Shortest path from vertex 3 to vertex 6 has total weight 10. The most direct paths use three edges, e.g. 3-0-1-6, 3-2-1-6 or 3-2-5-6. If we sum the lengths on each of these paths, the shortest one is 3-2-5-6 with total weight 11. However, there is a path from vertex 2 to vertex 5 that is shorter than the direct edge, via vertex 4. This reduces the total weight of the path from 3 to 6 (now via 2, 4 and 5) to 1+3+3+3=10.
</p>
<p>Since all weighted edges in the graph are bidirectional, the shortest path from vertex 6 to vertex 3 is the reverse of the shortest path we found from 3 to 6: 6-5-4-2-3. Its total weight is the same (10).
</p>
<li>
<p>
Initialisation:
</p>
<table border=1 cellpadding=4 style="float: left;">
<tr>
<td align="center"><tt>dist</tt></td>
<td align="center">[0]</td><td align="center">[1]</td><td align="center">[2]</td><td align="center">[3]</td><td align="center">[4]</td><td align="center">[5]</td><td align="center">[6]</td><td align="center">[7]</td>
</tr>
<tr>
<td align="center">[0]</td>
<td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>5</td><td align="center"><font color=#000099>4</td><td align="center"><font color=#000099>6</td>
<td align="center"><font color=red><font color=#000099>&infin;</td><td align="center"><font color=#000099>&infin;</td>
<td align="center"><font color=#000099>&infin;</td><td align="center"><font color=#000099>&infin;</td>
</tr>
<tr>
<td align="center">[1]</td>
<td align="center"><font color=#000099>5</td><td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>8</td><td align="center"><font color=#000099>&infin;</td>
<td align="center"><font color=#000099>&infin;</td>
<td align="center"><font color=red><font color=#000099>2</td><td align="center"><font color=#000099>7</td>
<td align="center"><font color=#000099>&infin;</td>
</tr>
<tr>
<td align="center">[2]</td>
<td align="center"><font color=#000099>4</td><td align="center"><font color=#000099>8</td><td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>1</td>
<td align="center"><font color=red><font color=#000099>3</td><td align="center"><font color=#000099>7</td>
<td align="center"><font color=red><font color=#000099>&infin;</td><td align="center"><font color=#000099>&infin;</td>
</tr>
<tr>
<td align="center">[3]</td>
<td align="center"><font color=#000099>6</td><td align="center"><font color=#000099>&infin;</td><td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>0</td>
<td align="center"><font color=#000099>6</td><td align="center"><font color=#000099>&infin;</td>
<td align="center"><font color=red><font color=#000099>&infin;</td><td align="center"><font color=#000099>&infin;</td>
</tr>
<tr>
<td align="center">[4]</td>
<td align="center"><font color=#000099>&infin;</td><td align="center"><font color=#000099>&infin;</td><td align="center"><font color=#000099>3</td><td align="center"><font color=#000099>6</td>
<td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>3</td>
<td align="center"><font color=red><font color=#000099>&infin;</td><td align="center"><font color=#000099>8</td>
</tr>
<tr>
<td align="center">[5]</td>
<td align="center"><font color=#000099>&infin;</td><td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>7</td><td align="center"><font color=#000099>&infin;</td>
<td align="center"><font color=#000099>3</td><td align="center"><font color=#000099>0</td>
<td align="center"><font color=red><font color=#000099>3</td><td align="center"><font color=#000099>6</td>
</tr>
<tr>
<td align="center">[6]</td>
<td align="center"><font color=#000099>&infin;</td><td align="center"><font color=#000099>7</td><td align="center"><font color=#000099>&infin;</td><td align="center"><font color=#000099>&infin;</td>
<td align="center"><font color=#000099>&infin;</td><td align="center"><font color=#000099>3</td>
<td align="center"><font color=red><font color=#000099>0</td><td align="center"><font color=#000099>5</td>
</tr>
<tr>
<td align="center">[7]</td>
<td align="center"><font color=#000099>&infin;</td><td align="center"><font color=#000099>&infin;</td><td align="center"><font color=#000099>&infin;</td><td align="center"><font color=#000099>&infin;</td>
<td align="center"><font color=#000099>8</td><td align="center"><font color=#000099>6</td>
<td align="center"><font color=red><font color=#000099>5</td><td align="center"><font color=#000099>0</td>
</tr>
</table>

<table border=1 cellpadding=4>
<tr>
<td align="center"><tt>path</tt></td>
<td align="center">[0]</td><td align="center">[1]</td><td align="center">[2]</td><td align="center">[3]</td><td align="center">[4]</td><td align="center">[5]</td><td align="center">[6]</td><td align="center">[7]</td>
</tr>
<tr>
<td align="center">[0]</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>3</td>
<td align="center"><font color=red><font color=#000099>&ndash;</td><td align="center"><font color=#000099>&ndash;</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>&ndash;</td>
</tr>
<tr>
<td align="center">[1]</td>
<td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>&ndash;</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>5</td>
<td align="center"><font color=#000099>6</td><td align="center"><font color=#000099>&ndash;</td>
</tr>
<tr>
<td align="center">[2]</td>
<td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>3</td>
<td align="center"><font color=red><font color=#000099>4</td><td align="center"><font color=#000099>5</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>&ndash;</td>
</tr>
<tr>
<td align="center">[3]</td>
<td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>&ndash;</td>
<td align="center"><font color=#000099>4</td><td align="center"><font color=#000099>&ndash;</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>&ndash;</td>
</tr>
<tr>
<td align="center">[4]</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>3</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>5</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>7</td>
</tr>
<tr>
<td align="center">[5]</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>&ndash;</td>
<td align="center"><font color=#000099>4</td><td align="center"><font color=#000099>&ndash;</td>
<td align="center"><font color=#000099>6</td><td align="center"><font color=#000099>7</td>
</tr>
<tr>
<td align="center">[6]</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>&ndash;</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>5</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>7</td>
</tr>
<tr>
<td align="center">[7]</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>&ndash;</td>
<td align="center"><font color=#000099>4</td><td align="center"><font color=#000099>5</td>
<td align="center"><font color=#000099>6</td><td align="center"><font color=#000099>&ndash;</td>
</tr>
</table>

<p>
After 1<sup>st</sup> iteration <tt>i=0</tt>:
</p>
<table border=1 cellpadding=4 style="float: left;">
<tr>
<td align="center"><tt>dist</tt></td>
<td align="center">[0]</td><td align="center">[1]</td><td align="center">[2]</td><td align="center">[3]</td><td align="center">[4]</td><td align="center">[5]</td><td align="center">[6]</td><td align="center">[7]</td>
</tr>
<tr>
<td align="center">[0]</td>
<td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>5</td><td align="center"><font color=#000099>4</td><td align="center"><font color=#000099>6</td>
<td align="center"><font color=red><font color=#000099>&infin;</td><td align="center"><font color=#000099>&infin;</td>
<td align="center"><font color=#000099>&infin;</td><td align="center"><font color=#000099>&infin;</td>
</tr>
<tr>
<td align="center">[1]</td>
<td align="center"><font color=#000099>5</td><td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>8</td><td align="center"><font color=#000099>11</td>
<td align="center"><font color=#000099>&infin;</td>
<td align="center"><font color=red><font color=#000099>2</td><td align="center"><font color=#000099>7</td>
<td align="center"><font color=#000099>&infin;</td>
</tr>
<tr>
<td align="center">[2]</td>
<td align="center"><font color=#000099>4</td><td align="center"><font color=#000099>8</td><td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>1</td>
<td align="center"><font color=red><font color=#000099>3</td><td align="center"><font color=#000099>7</td>
<td align="center"><font color=red><font color=#000099>&infin;</td><td align="center"><font color=#000099>&infin;</td>
</tr>
<tr>
<td align="center">[3]</td>
<td align="center"><font color=#000099>6</td><td align="center"><font color=#000099>11</td><td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>0</td>
<td align="center"><font color=#000099>6</td><td align="center"><font color=#000099>&infin;</td>
<td align="center"><font color=red><font color=#000099>&infin;</td><td align="center"><font color=#000099>&infin;</td>
</tr>
<tr>
<td align="center">[4]</td>
<td align="center"><font color=#000099>&infin;</td><td align="center"><font color=#000099>&infin;</td><td align="center"><font color=#000099>3</td><td align="center"><font color=#000099>6</td>
<td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>3</td>
<td align="center"><font color=red><font color=#000099>&infin;</td><td align="center"><font color=#000099>8</td>
</tr>
<tr>
<td align="center">[5]</td>
<td align="center"><font color=#000099>&infin;</td><td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>7</td><td align="center"><font color=#000099>&infin;</td>
<td align="center"><font color=#000099>3</td><td align="center"><font color=#000099>0</td>
<td align="center"><font color=red><font color=#000099>3</td><td align="center"><font color=#000099>6</td>
</tr>
<tr>
<td align="center">[6]</td>
<td align="center"><font color=#000099>&infin;</td><td align="center"><font color=#000099>7</td><td align="center"><font color=#000099>&infin;</td><td align="center"><font color=#000099>&infin;</td>
<td align="center"><font color=#000099>&infin;</td><td align="center"><font color=#000099>3</td>
<td align="center"><font color=red><font color=#000099>0</td><td align="center"><font color=#000099>5</td>
</tr>
<tr>
<td align="center">[7]</td>
<td align="center"><font color=#000099>&infin;</td><td align="center"><font color=#000099>&infin;</td><td align="center"><font color=#000099>&infin;</td><td align="center"><font color=#000099>&infin;</td>
<td align="center"><font color=#000099>8</td><td align="center"><font color=#000099>6</td>
<td align="center"><font color=red><font color=#000099>5</td><td align="center"><font color=#000099>0</td>
</tr>
</table>

<table border=1 cellpadding=4>
<tr>
<td align="center"><tt>path</tt></td>
<td align="center">[0]</td><td align="center">[1]</td><td align="center">[2]</td><td align="center">[3]</td><td align="center">[4]</td><td align="center">[5]</td><td align="center">[6]</td><td align="center">[7]</td>
</tr>
<tr>
<td align="center">[0]</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>3</td>
<td align="center"><font color=red><font color=#000099>&ndash;</td><td align="center"><font color=#000099>&ndash;</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>&ndash;</td>
</tr>
<tr>
<td align="center">[1]</td>
<td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>0</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>5</td>
<td align="center"><font color=#000099>6</td><td align="center"><font color=#000099>&ndash;</td>
</tr>
<tr>
<td align="center">[2]</td>
<td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>3</td>
<td align="center"><font color=red><font color=#000099>4</td><td align="center"><font color=#000099>5</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>&ndash;</td>
</tr>
<tr>
<td align="center">[3]</td>
<td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>&ndash;</td>
<td align="center"><font color=#000099>4</td><td align="center"><font color=#000099>&ndash;</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>&ndash;</td>
</tr>
<tr>
<td align="center">[4]</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>3</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>5</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>7</td>
</tr>
<tr>
<td align="center">[5]</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>&ndash;</td>
<td align="center"><font color=#000099>4</td><td align="center"><font color=#000099>&ndash;</td>
<td align="center"><font color=#000099>6</td><td align="center"><font color=#000099>7</td>
</tr>
<tr>
<td align="center">[6]</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>&ndash;</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>5</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>7</td>
</tr>
<tr>
<td align="center">[7]</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>&ndash;</td>
<td align="center"><font color=#000099>4</td><td align="center"><font color=#000099>5</td>
<td align="center"><font color=#000099>6</td><td align="center"><font color=#000099>&ndash;</td>
</tr>
</table>

<p>
After 2<sup>nd</sup> iteration <tt>i=1</tt>:
</p>
<table border=1 cellpadding=4 style="float: left;">
<tr>
<td align="center"><tt>dist</tt></td>
<td align="center">[0]</td><td align="center">[1]</td><td align="center">[2]</td><td align="center">[3]</td><td align="center">[4]</td><td align="center">[5]</td><td align="center">[6]</td><td align="center">[7]</td>
</tr>
<tr>
<td align="center">[0]</td>
<td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>5</td><td align="center"><font color=#000099>4</td><td align="center"><font color=#000099>6</td>
<td align="center"><font color=red><font color=#000099>&infin;</td><td align="center"><font color=#000099>7</td>
<td align="center"><font color=#000099>12</td><td align="center"><font color=#000099>&infin;</td>
</tr>
<tr>
<td align="center">[1]</td>
<td align="center"><font color=#000099>5</td><td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>8</td><td align="center"><font color=#000099>11</td>
<td align="center"><font color=#000099>&infin;</td>
<td align="center"><font color=red><font color=#000099>2</td><td align="center"><font color=#000099>7</td>
<td align="center"><font color=#000099>&infin;</td>
</tr>
<tr>
<td align="center">[2]</td>
<td align="center"><font color=#000099>4</td><td align="center"><font color=#000099>8</td><td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>1</td>
<td align="center"><font color=red><font color=#000099>3</td><td align="center"><font color=#000099>7</td>
<td align="center"><font color=red><font color=#000099>15</td><td align="center"><font color=#000099>&infin;</td>
</tr>
<tr>
<td align="center">[3]</td>
<td align="center"><font color=#000099>6</td><td align="center"><font color=#000099>11</td><td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>0</td>
<td align="center"><font color=#000099>6</td><td align="center"><font color=#000099>13</td>
<td align="center"><font color=red><font color=#000099>18</td><td align="center"><font color=#000099>&infin;</td>
</tr>
<tr>
<td align="center">[4]</td>
<td align="center"><font color=#000099>&infin;</td><td align="center"><font color=#000099>&infin;</td><td align="center"><font color=#000099>3</td><td align="center"><font color=#000099>6</td>
<td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>3</td>
<td align="center"><font color=red><font color=#000099>&infin;</td><td align="center"><font color=#000099>8</td>
</tr>
<tr>
<td align="center">[5]</td>
<td align="center"><font color=#000099>7</td><td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>7</td><td align="center"><font color=#000099>13</td>
<td align="center"><font color=#000099>3</td><td align="center"><font color=#000099>0</td>
<td align="center"><font color=red><font color=#000099>3</td><td align="center"><font color=#000099>6</td>
</tr>
<tr>
<td align="center">[6]</td>
<td align="center"><font color=#000099>12</td><td align="center"><font color=#000099>7</td><td align="center"><font color=#000099>15</td><td align="center"><font color=#000099>18</td>
<td align="center"><font color=#000099>&infin;</td><td align="center"><font color=#000099>3</td>
<td align="center"><font color=red><font color=#000099>0</td><td align="center"><font color=#000099>5</td>
</tr>
<tr>
<td align="center">[7]</td>
<td align="center"><font color=#000099>&infin;</td><td align="center"><font color=#000099>&infin;</td><td align="center"><font color=#000099>&infin;</td><td align="center"><font color=#000099>&infin;</td>
<td align="center"><font color=#000099>8</td><td align="center"><font color=#000099>6</td>
<td align="center"><font color=red><font color=#000099>5</td><td align="center"><font color=#000099>0</td>
</tr>
</table>

<table border=1 cellpadding=4>
<tr>
<td align="center"><tt>path</tt></td>
<td align="center">[0]</td><td align="center">[1]</td><td align="center">[2]</td><td align="center">[3]</td><td align="center">[4]</td><td align="center">[5]</td><td align="center">[6]</td><td align="center">[7]</td>
</tr>
<tr>
<td align="center">[0]</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>3</td>
<td align="center"><font color=red><font color=#000099>&ndash;</td><td align="center"><font color=#000099>1</td>
<td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>&ndash;</td>
</tr>
<tr>
<td align="center">[1]</td>
<td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>0</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>5</td>
<td align="center"><font color=#000099>6</td><td align="center"><font color=#000099>&ndash;</td>
</tr>
<tr>
<td align="center">[2]</td>
<td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>3</td>
<td align="center"><font color=red><font color=#000099>4</td><td align="center"><font color=#000099>5</td>
<td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>&ndash;</td>
</tr>
<tr>
<td align="center">[3]</td>
<td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>&ndash;</td>
<td align="center"><font color=#000099>4</td><td align="center"><font color=#000099>0</td>
<td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>&ndash;</td>
</tr>
<tr>
<td align="center">[4]</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>3</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>5</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>7</td>
</tr>
<tr>
<td align="center">[5]</td>
<td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>1</td>
<td align="center"><font color=#000099>4</td><td align="center"><font color=#000099>&ndash;</td>
<td align="center"><font color=#000099>6</td><td align="center"><font color=#000099>7</td>
</tr>
<tr>
<td align="center">[6]</td>
<td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>1</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>5</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>7</td>
</tr>
<tr>
<td align="center">[7]</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>&ndash;</td>
<td align="center"><font color=#000099>4</td><td align="center"><font color=#000099>5</td>
<td align="center"><font color=#000099>6</td><td align="center"><font color=#000099>&ndash;</td>
</tr>
</table>

<p>
After 3<sup>rd</sup> iteration <tt>i=2</tt>:
</p>
<table border=1 cellpadding=4 style="float: left;">
<tr>
<td align="center"><tt>dist</tt></td>
<td align="center">[0]</td><td align="center">[1]</td><td align="center">[2]</td><td align="center">[3]</td><td align="center">[4]</td><td align="center">[5]</td><td align="center">[6]</td><td align="center">[7]</td>
</tr>
<tr>
<td align="center">[0]</td>
<td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>5</td><td align="center"><font color=#000099>4</td><td align="center"><font color=#000099>5</td>
<td align="center"><font color=red><font color=#000099>7</td><td align="center"><font color=#000099>7</td>
<td align="center"><font color=#000099>12</td><td align="center"><font color=#000099>&infin;</td>
</tr>
<tr>
<td align="center">[1]</td>
<td align="center"><font color=#000099>5</td><td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>8</td><td align="center"><font color=#000099>9</td>
<td align="center"><font color=#000099>11</td>
<td align="center"><font color=red><font color=#000099>2</td><td align="center"><font color=#000099>7</td>
<td align="center"><font color=#000099>&infin;</td>
</tr>
<tr>
<td align="center">[2]</td>
<td align="center"><font color=#000099>4</td><td align="center"><font color=#000099>8</td><td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>1</td>
<td align="center"><font color=red><font color=#000099>3</td><td align="center"><font color=#000099>7</td>
<td align="center"><font color=red><font color=#000099>15</td><td align="center"><font color=#000099>&infin;</td>
</tr>
<tr>
<td align="center">[3]</td>
<td align="center"><font color=#000099>5</td><td align="center"><font color=#000099>9</td><td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>0</td>
<td align="center"><font color=#000099>4</td><td align="center"><font color=#000099>8</td>
<td align="center"><font color=red><font color=#000099>16</td><td align="center"><font color=#000099>&infin;</td>
</tr>
<tr>
<td align="center">[4]</td>
<td align="center"><font color=#000099>7</td><td align="center"><font color=#000099>11</td><td align="center"><font color=#000099>3</td><td align="center"><font color=#000099>4</td>
<td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>3</td>
<td align="center"><font color=red><font color=#000099>18</td><td align="center"><font color=#000099>8</td>
</tr>
<tr>
<td align="center">[5]</td>
<td align="center"><font color=#000099>7</td><td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>7</td><td align="center"><font color=#000099>8</td>
<td align="center"><font color=#000099>3</td><td align="center"><font color=#000099>0</td>
<td align="center"><font color=red><font color=#000099>3</td><td align="center"><font color=#000099>6</td>
</tr>
<tr>
<td align="center">[6]</td>
<td align="center"><font color=#000099>12</td><td align="center"><font color=#000099>7</td><td align="center"><font color=#000099>15</td><td align="center"><font color=#000099>16</td>
<td align="center"><font color=#000099>18</td><td align="center"><font color=#000099>3</td>
<td align="center"><font color=red><font color=#000099>0</td><td align="center"><font color=#000099>5</td>
</tr>
<tr>
<td align="center">[7]</td>
<td align="center"><font color=#000099>&infin;</td><td align="center"><font color=#000099>&infin;</td><td align="center"><font color=#000099>&infin;</td><td align="center"><font color=#000099>&infin;</td>
<td align="center"><font color=#000099>8</td><td align="center"><font color=#000099>6</td>
<td align="center"><font color=red><font color=#000099>5</td><td align="center"><font color=#000099>0</td>
</tr>
</table>

<table border=1 cellpadding=4>
<tr>
<td align="center"><tt>path</tt></td>
<td align="center">[0]</td><td align="center">[1]</td><td align="center">[2]</td><td align="center">[3]</td><td align="center">[4]</td><td align="center">[5]</td><td align="center">[6]</td><td align="center">[7]</td>
</tr>
<tr>
<td align="center">[0]</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>2</td>
<td align="center"><font color=red><font color=#000099>2</td><td align="center"><font color=#000099>1</td>
<td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>&ndash;</td>
</tr>
<tr>
<td align="center">[1]</td>
<td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>2</td>
<td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>5</td>
<td align="center"><font color=#000099>6</td><td align="center"><font color=#000099>&ndash;</td>
</tr>
<tr>
<td align="center">[2]</td>
<td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>3</td>
<td align="center"><font color=red><font color=#000099>4</td><td align="center"><font color=#000099>5</td>
<td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>&ndash;</td>
</tr>
<tr>
<td align="center">[3]</td>
<td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>&ndash;</td>
<td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>2</td>
<td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>&ndash;</td>
</tr>
<tr>
<td align="center">[4]</td>
<td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>2</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>5</td>
<td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>7</td>
</tr>
<tr>
<td align="center">[5]</td>
<td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>2</td>
<td align="center"><font color=#000099>4</td><td align="center"><font color=#000099>&ndash;</td>
<td align="center"><font color=#000099>6</td><td align="center"><font color=#000099>7</td>
</tr>
<tr>
<td align="center">[6]</td>
<td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>1</td>
<td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>5</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>7</td>
</tr>
<tr>
<td align="center">[7]</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>&ndash;</td>
<td align="center"><font color=#000099>4</td><td align="center"><font color=#000099>5</td>
<td align="center"><font color=#000099>6</td><td align="center"><font color=#000099>&ndash;</td>
</tr>
</table>

<p>
After 4<sup>th</sup> iteration <tt>i=3</tt>: unchanged
</p>
<p>
After 5<sup>th</sup> iteration <tt>i=4</tt>:
</p>
<table border=1 cellpadding=4 style="float: left;">
<tr>
<td align="center"><tt>dist</tt></td>
<td align="center">[0]</td><td align="center">[1]</td><td align="center">[2]</td><td align="center">[3]</td><td align="center">[4]</td><td align="center">[5]</td><td align="center">[6]</td><td align="center">[7]</td>
</tr>
<tr>
<td align="center">[0]</td>
<td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>5</td><td align="center"><font color=#000099>4</td><td align="center"><font color=#000099>5</td>
<td align="center"><font color=red><font color=#000099>7</td><td align="center"><font color=#000099>7</td>
<td align="center"><font color=#000099>12</td><td align="center"><font color=#000099>15</td>
</tr>
<tr>
<td align="center">[1]</td>
<td align="center"><font color=#000099>5</td><td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>8</td><td align="center"><font color=#000099>9</td>
<td align="center"><font color=#000099>11</td>
<td align="center"><font color=red><font color=#000099>2</td><td align="center"><font color=#000099>7</td>
<td align="center"><font color=#000099>19</td>
</tr>
<tr>
<td align="center">[2]</td>
<td align="center"><font color=#000099>4</td><td align="center"><font color=#000099>8</td><td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>1</td>
<td align="center"><font color=red><font color=#000099>3</td><td align="center"><font color=#000099>6</td>
<td align="center"><font color=red><font color=#000099>15</td><td align="center"><font color=#000099>11</td>
</tr>
<tr>
<td align="center">[3]</td>
<td align="center"><font color=#000099>5</td><td align="center"><font color=#000099>9</td><td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>0</td>
<td align="center"><font color=#000099>4</td><td align="center"><font color=#000099>7</td>
<td align="center"><font color=red><font color=#000099>16</td><td align="center"><font color=#000099>12</td>
</tr>
<tr>
<td align="center">[4]</td>
<td align="center"><font color=#000099>7</td><td align="center"><font color=#000099>11</td><td align="center"><font color=#000099>3</td><td align="center"><font color=#000099>4</td>
<td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>3</td>
<td align="center"><font color=red><font color=#000099>18</td><td align="center"><font color=#000099>8</td>
</tr>
<tr>
<td align="center">[5]</td>
<td align="center"><font color=#000099>7</td><td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>6</td><td align="center"><font color=#000099>7</td>
<td align="center"><font color=#000099>3</td><td align="center"><font color=#000099>0</td>
<td align="center"><font color=red><font color=#000099>3</td><td align="center"><font color=#000099>6</td>
</tr>
<tr>
<td align="center">[6]</td>
<td align="center"><font color=#000099>12</td><td align="center"><font color=#000099>7</td><td align="center"><font color=#000099>15</td><td align="center"><font color=#000099>16</td>
<td align="center"><font color=#000099>18</td><td align="center"><font color=#000099>3</td>
<td align="center"><font color=red><font color=#000099>0</td><td align="center"><font color=#000099>5</td>
</tr>
<tr>
<td align="center">[7]</td>
<td align="center"><font color=#000099>15</td><td align="center"><font color=#000099>19</td><td align="center"><font color=#000099>11</td><td align="center"><font color=#000099>12</td>
<td align="center"><font color=#000099>8</td><td align="center"><font color=#000099>6</td>
<td align="center"><font color=red><font color=#000099>5</td><td align="center"><font color=#000099>0</td>
</tr>
</table>

<table border=1 cellpadding=4>
<tr>
<td align="center"><tt>path</tt></td>
<td align="center">[0]</td><td align="center">[1]</td><td align="center">[2]</td><td align="center">[3]</td><td align="center">[4]</td><td align="center">[5]</td><td align="center">[6]</td><td align="center">[7]</td>
</tr>
<tr>
<td align="center">[0]</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>2</td>
<td align="center"><font color=red><font color=#000099>2</td><td align="center"><font color=#000099>1</td>
<td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>2</td>
</tr>
<tr>
<td align="center">[1]</td>
<td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>2</td>
<td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>5</td>
<td align="center"><font color=#000099>6</td><td align="center"><font color=#000099>2</td>
</tr>
<tr>
<td align="center">[2]</td>
<td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>3</td>
<td align="center"><font color=red><font color=#000099>4</td><td align="center"><font color=#000099>4</td>
<td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>4</td>
</tr>
<tr>
<td align="center">[3]</td>
<td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>&ndash;</td>
<td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>2</td>
<td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>2</td>
</tr>
<tr>
<td align="center">[4]</td>
<td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>2</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>5</td>
<td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>7</td>
</tr>
<tr>
<td align="center">[5]</td>
<td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>4</td><td align="center"><font color=#000099>4</td>
<td align="center"><font color=#000099>4</td><td align="center"><font color=#000099>&ndash;</td>
<td align="center"><font color=#000099>6</td><td align="center"><font color=#000099>7</td>
</tr>
<tr>
<td align="center">[6]</td>
<td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>1</td>
<td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>5</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>7</td>
</tr>
<tr>
<td align="center">[7]</td>
<td align="center"><font color=#000099>4</td><td align="center"><font color=#000099>4</td><td align="center"><font color=#000099>4</td><td align="center"><font color=#000099>4</td>
<td align="center"><font color=#000099>4</td><td align="center"><font color=#000099>5</td>
<td align="center"><font color=#000099>6</td><td align="center"><font color=#000099>&ndash;</td>
</tr>
</table>

<p>
After 6<sup>th</sup> iteration <tt>i=5</tt>:
</p>
<table border=1 cellpadding=4 style="float: left;">
<tr>
<td align="center"><tt>dist</tt></td>
<td align="center">[0]</td><td align="center">[1]</td><td align="center">[2]</td><td align="center">[3]</td><td align="center">[4]</td><td align="center">[5]</td><td align="center">[6]</td><td align="center">[7]</td>
</tr>
<tr>
<td align="center">[0]</td>
<td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>5</td><td align="center"><font color=#000099>4</td><td align="center"><font color=#000099>5</td>
<td align="center"><font color=red><font color=#000099>7</td><td align="center"><font color=#000099>7</td>
<td align="center"><font color=#000099>10</td><td align="center"><font color=#000099>13</td>
</tr>
<tr>
<td align="center">[1]</td>
<td align="center"><font color=#000099>5</td><td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>8</td><td align="center"><font color=#000099>9</td>
<td align="center"><font color=#000099>5</td>
<td align="center"><font color=red><font color=#000099>2</td><td align="center"><font color=#000099>5</td>
<td align="center"><font color=#000099>8</td>
</tr>
<tr>
<td align="center">[2]</td>
<td align="center"><font color=#000099>4</td><td align="center"><font color=#000099>8</td><td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>1</td>
<td align="center"><font color=red><font color=#000099>3</td><td align="center"><font color=#000099>6</td>
<td align="center"><font color=red><font color=#000099>9</td><td align="center"><font color=#000099>11</td>
</tr>
<tr>
<td align="center">[3]</td>
<td align="center"><font color=#000099>5</td><td align="center"><font color=#000099>9</td><td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>0</td>
<td align="center"><font color=#000099>4</td><td align="center"><font color=#000099>7</td>
<td align="center"><font color=red><font color=#000099>10</td><td align="center"><font color=#000099>12</td>
</tr>
<tr>
<td align="center">[4]</td>
<td align="center"><font color=#000099>7</td><td align="center"><font color=#000099>5</td><td align="center"><font color=#000099>3</td><td align="center"><font color=#000099>4</td>
<td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>3</td>
<td align="center"><font color=red><font color=#000099>6</td><td align="center"><font color=#000099>8</td>
</tr>
<tr>
<td align="center">[5]</td>
<td align="center"><font color=#000099>7</td><td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>6</td><td align="center"><font color=#000099>7</td>
<td align="center"><font color=#000099>3</td><td align="center"><font color=#000099>0</td>
<td align="center"><font color=red><font color=#000099>3</td><td align="center"><font color=#000099>6</td>
</tr>
<tr>
<td align="center">[6]</td>
<td align="center"><font color=#000099>10</td><td align="center"><font color=#000099>5</td><td align="center"><font color=#000099>9</td><td align="center"><font color=#000099>10</td>
<td align="center"><font color=#000099>6</td><td align="center"><font color=#000099>3</td>
<td align="center"><font color=red><font color=#000099>0</td><td align="center"><font color=#000099>5</td>
</tr>
<tr>
<td align="center">[7]</td>
<td align="center"><font color=#000099>13</td><td align="center"><font color=#000099>8</td><td align="center"><font color=#000099>11</td><td align="center"><font color=#000099>12</td>
<td align="center"><font color=#000099>8</td><td align="center"><font color=#000099>6</td>
<td align="center"><font color=red><font color=#000099>5</td><td align="center"><font color=#000099>0</td>
</tr>
</table>

<table border=1 cellpadding=4>
<tr>
<td align="center"><tt>path</tt></td>
<td align="center">[0]</td><td align="center">[1]</td><td align="center">[2]</td><td align="center">[3]</td><td align="center">[4]</td><td align="center">[5]</td><td align="center">[6]</td><td align="center">[7]</td>
</tr>
<tr>
<td align="center">[0]</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>2</td>
<td align="center"><font color=red><font color=#000099>2</td><td align="center"><font color=#000099>1</td>
<td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>1</td>
</tr>
<tr>
<td align="center">[1]</td>
<td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>2</td>
<td align="center"><font color=#000099>5</td><td align="center"><font color=#000099>5</td>
<td align="center"><font color=#000099>5</td><td align="center"><font color=#000099>5</td>
</tr>
<tr>
<td align="center">[2]</td>
<td align="center"><font color=#000099>0</td><td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>3</td>
<td align="center"><font color=red><font color=#000099>4</td><td align="center"><font color=#000099>4</td>
<td align="center"><font color=#000099>4</td><td align="center"><font color=#000099>4</td>
</tr>
<tr>
<td align="center">[3]</td>
<td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>&ndash;</td>
<td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>2</td>
<td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>2</td>
</tr>
<tr>
<td align="center">[4]</td>
<td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>5</td><td align="center"><font color=#000099>2</td><td align="center"><font color=#000099>2</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>5</td>
<td align="center"><font color=#000099>5</td><td align="center"><font color=#000099>7</td>
</tr>
<tr>
<td align="center">[5]</td>
<td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>1</td><td align="center"><font color=#000099>4</td><td align="center"><font color=#000099>4</td>
<td align="center"><font color=#000099>4</td><td align="center"><font color=#000099>&ndash;</td>
<td align="center"><font color=#000099>6</td><td align="center"><font color=#000099>7</td>
</tr>
<tr>
<td align="center">[6]</td>
<td align="center"><font color=#000099>5</td><td align="center"><font color=#000099>5</td><td align="center"><font color=#000099>5</td><td align="center"><font color=#000099>5</td>
<td align="center"><font color=#000099>5</td><td align="center"><font color=#000099>5</td>
<td align="center"><font color=#000099>&ndash;</td><td align="center"><font color=#000099>7</td>
</tr>
<tr>
<td align="center">[7]</td>
<td align="center"><font color=#000099>5</td><td align="center"><font color=#000099>5</td><td align="center"><font color=#000099>4</td><td align="center"><font color=#000099>4</td>
<td align="center"><font color=#000099>4</td><td align="center"><font color=#000099>5</td>
<td align="center"><font color=#000099>6</td><td align="center"><font color=#000099>&ndash;</td>
</tr>
</table>

<p>
The last two iterations (<tt>i=6,7</tt>) do not effect any more changes.
</p>
<p>
Observe that the final distances and shortest paths between 0 and all other vertices are the same as in the solution to exercise 5a, as it should be.
</p>
</ol>
</div>

<br/>
<li> (Maximum flow)
<p>
<ol type="a">
<li>Identify a maximum flow from source=0 to sink=5 in the following network (without applying the algorithm from the lecture):
</p>
<center><img src="graph3.png"></center>
What approach did you use in finding the maxflow?
<li> <p>Show how Edmonds and Karp's algorithm would construct a maximum flow from 0 to 5 for the network above. How many augmenting paths do you have to consider?</p>
</ol>
<p><small>[<a id="q7a" href="##" onclick="toggleVisible('q7')">show answer</a>]</small></p>
<div id="q7" style="color:#000099;display:none">
<p>
<ol type="a">
<li>
<p>
I suspect (no proof) that most people would use a strategy like:
</p>
<ol>
<li> Choose an edge from a vertex into the sink and attempt to see if and how the maximum flow through this edge can be achieved, for example edge (3,5) with capacity 9.
<li> Attempt to maximise the flow into this vertex 3 to check if the required capacity 9 can be reached.
<li> Realise that the maximum flow into 3 is actually 8, which would get you to a partial solution like:
</p>
<center><img src="graph3-flow-partial.png"></center>
<p>
<li> Inspect the other edge into the sink &ndash; (2,5) with capacity 4 &ndash; and attempt to max out its capacity.
<li> Realise that the maximum flow that can be sent into node 2 is indeed 4, which results in the maximum flow shown below.
</p>
<center><img src="graph3-maxflow.png"></center>
</ol>
<li> <p>The shortest augmenting path found by BFS is 0-3-5, along which we can send <tt>df</tt>=5. The resulting <tt>flow[][]</tt> matrix is:
<center>
<table border="2" cellpadding="4"><tr><td align="center"></td><td align="center">[0]</td><td align="center">[1]</td><td align="center">[2]</td><td align="center">[3]</td><td align="center">[4]</td><td align="center">[5]</td></tr>
<tr><td align="center">[0]</td><td align="center">0</td><td align="center">0</td><td align="center">0</td><td align="center">5</td><td align="center">0</td><td align="center">0</td></tr>
<tr><td align="center">[1]</td><td align="center">0</td><td align="center">0</td><td align="center">0</td><td align="center">0</td><td align="center">0</td><td align="center">0</td></tr>
<tr><td align="center">[2]</td><td align="center">0</td><td align="center">0</td><td align="center">0</td><td align="center">0</td><td align="center">0</td><td align="center">0</td></tr>
<tr><td align="center">[3]</td><td align="center">-5</td><td align="center">0</td><td align="center">0</td><td align="center">0</td><td align="center">0</td><td align="center">5</td></tr>
<tr><td align="center">[4]</td><td align="center">0</td><td align="center">0</td><td align="center">0</td><td align="center">0</td><td align="center">0</td><td align="center">0</td></tr>
<tr><td align="center">[5]</td><td align="center">0</td><td align="center">0</td><td align="center">0</td><td align="center">-5</td><td align="center">0</td><td align="center">0</td></tr>
</table>
</center>
</p>
<p>
The negative values encode the "reversed" edges in the residual graph.
</p>
<p>
If we choose neighbours in ascending order, then the next augmenting path found by BFS is 0-1-2-5 with <tt>df</tt>=4. We update the <tt>flow[][]</tt> matrix to:
<center>
<table border="2" cellpadding="4"><tr><td align="center"></td><td align="center">[0]</td><td align="center">[1]</td><td align="center">[2]</td><td align="center">[3]</td><td align="center">[4]</td><td align="center">[5]</td></tr>
<tr><td align="center">[0]</td><td align="center">0</td><td align="center">4</td><td align="center">0</td><td align="center">5</td><td align="center">0</td><td align="center">0</td></tr>
<tr><td align="center">[1]</td><td align="center">-4</td><td align="center">0</td><td align="center">4</td><td align="center">0</td><td align="center">0</td><td align="center">0</td></tr>
<tr><td align="center">[2]</td><td align="center">0</td><td align="center">-4</td><td align="center">0</td><td align="center">0</td><td align="center">0</td><td align="center">4</td></tr>
<tr><td align="center">[3]</td><td align="center">-5</td><td align="center">0</td><td align="center">0</td><td align="center">0</td><td align="center">0</td><td align="center">5</td></tr>
<tr><td align="center">[4]</td><td align="center">0</td><td align="center">0</td><td align="center">0</td><td align="center">0</td><td align="center">0</td><td align="center">0</td></tr>
<tr><td align="center">[5]</td><td align="center">0</td><td align="center">0</td><td align="center">-4</td><td align="center">-5</td><td align="center">0</td><td align="center">0</td></tr>
</table>
</center>
</p>
<p>
Now the shortest augmenting path is 0-1-3-5 with <tt>df</tt>=1, so we update the <tt>flow[][]</tt> matrix as follows:
<center>
<table border="2" cellpadding="4"><tr><td align="center"></td><td align="center">[0]</td><td align="center">[1]</td><td align="center">[2]</td><td align="center">[3]</td><td align="center">[4]</td><td align="center">[5]</td></tr>
<tr><td align="center">[0]</td><td align="center">0</td><td align="center">5</td><td align="center">0</td><td align="center">5</td><td align="center">0</td><td align="center">0</td></tr>
<tr><td align="center">[1]</td><td align="center">-5</td><td align="center">0</td><td align="center">4</td><td align="center">1</td><td align="center">0</td><td align="center">0</td></tr>
<tr><td align="center">[2]</td><td align="center">0</td><td align="center">-4</td><td align="center">0</td><td align="center">0</td><td align="center">0</td><td align="center">4</td></tr>
<tr><td align="center">[3]</td><td align="center">-5</td><td align="center">-1</td><td align="center">0</td><td align="center">0</td><td align="center">0</td><td align="center">6</td></tr>
<tr><td align="center">[4]</td><td align="center">0</td><td align="center">0</td><td align="center">0</td><td align="center">0</td><td align="center">0</td><td align="center">0</td></tr>
<tr><td align="center">[5]</td><td align="center">0</td><td align="center">0</td><td align="center">-4</td><td align="center">-6</td><td align="center">0</td><td align="center">0</td></tr>
</table>
</center>
</p>
<p>
The residual graph now admits one more augmenting path: 0-4-2-1-3-5 with <tt>df</tt>=2, by which some of the current flow from 1 to 2 is "redirected" to 3 and replaced by the same amount from 4 to 2. This results in the <tt>flow[][]</tt> matrix:
<center>
<table border="2" cellpadding="4"><tr><td align="center"></td><td align="center">[0]</td><td align="center">[1]</td><td align="center">[2]</td><td align="center">[3]</td><td align="center">[4]</td><td align="center">[5]</td></tr>
<tr><td align="center">[0]</td><td align="center">0</td><td align="center">5</td><td align="center">0</td><td align="center">5</td><td align="center">2</td><td align="center">0</td></tr>
<tr><td align="center">[1]</td><td align="center">-5</td><td align="center">0</td><td align="center">2</td><td align="center">3</td><td align="center">0</td><td align="center">0</td></tr>
<tr><td align="center">[2]</td><td align="center">0</td><td align="center">-2</td><td align="center">0</td><td align="center">0</td><td align="center">-2</td><td align="center">4</td></tr>
<tr><td align="center">[3]</td><td align="center">-5</td><td align="center">-3</td><td align="center">0</td><td align="center">0</td><td align="center">0</td><td align="center">8</td></tr>
<tr><td align="center">[4]</td><td align="center">-2</td><td align="center">0</td><td align="center">2</td><td align="center">0</td><td align="center">0</td><td align="center">0</td></tr>
<tr><td align="center">[5]</td><td align="center">0</td><td align="center">0</td><td align="center">-4</td><td align="center">-8</td><td align="center">0</td><td align="center">0</td></tr>
</table>
</center>
</p>
<p>
No more augmenting path exists. The maximum flow is 5+4+1+2 = 12, the sum of what we could maximally send along the 4 augmenting paths that we computed.
</p>
</ol>
</div>

<br/>
<li><b>Challenge Exercise</b>
<p>
Consider a machine with four wheels. Each wheel has the digits 0&hellip;9 printed clockwise on it. The current <i>state</i> of the machine is given by the four topmost digits <tt>abcd</tt>, e.g. 8056 in the picture below.
</p>
<center><img src="wheels.png"></center>
<p>
Each wheel can be controlled by two buttons: Pressing the button labelled with "&larr;" turns the corresponding wheel clockwise one digit ahead, whereas presssing "&rarr;" turns it anticlockwise one digit back.
</p>
Write a C-program to determine the <i>minimum</i> number of button presses required to transform
</p>
<ul>
<li> a given initial state, <tt>abcd</tt>
<li> to a given goal state, <tt>efgh</tt>
<li> without passing through any of <i>n&ge;0</i> given "forbidden" states, <tt>forbidden[]={w<sub>1</sub>x<sub>1</sub>y<sub>1</sub>z<sub>1</sub>,&hellip;,w<sub>n</sub>x<sub>n</sub>y<sub>n</sub>z<sub>n</sub>}</tt>.
</ul>
<p>For example, the state 8056 as depicted can be transformed into 0056 in 2 steps if <tt>forbidden[]={}</tt>, whereas a minimum of 4 steps is needed for the same task if <tt>forbidden[]={9056}</tt>. (Why?)
</p>
<p>Use your program to compute the least number of button presses required to transform 8056 to 7012 if
<ol type="a">
<li>there are no forbidden states;
<li>you are not permitted to pass through any state 7055&ndash;8055 (i.e., 7055, 7056, &hellip;, 8055 all are forbidden);
<li>you are not permitted to pass through any state 0000&ndash;0999 or 7055&ndash;8055
</ol>
</p>
<p><small>[<a id="q8a" href="##" onclick="toggleVisible('q8')">show answer</a>]</small></p>
<div id="q8" style="color:#000099;display:none">
<p>The problem can be solved by a breadth-first search on an undirected graph:
<ul>
<li> nodes 0&hellip;9999 correspond to the possible configurations 0000 &ndash; 9999 of the machine;
<li> edges connect nodes v and w if, and only if, one button press takes the machine from v to w and vice versa.
</ul>
</p>
<p>The following code implements BFS on this graph with the help of the integer queue ADT from the lecture (<a href="http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week4/progs/queue.h"><tt>queue.h</tt></a>, <a href="http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week4/progs/queue.c"><tt>queue.c</tt></a>). Note that the graph is built <i>implicitly</i> : nodes are generated as they are encountered during the search.</p>
<pre class="answer">
#include "queue.h"

int shortestPath(int source, int target, int forbidden[], int n) {
   int visited[10000];

   int i;
   for (i = 0; i <= 9999; i++)
      visited[i] = -1;             // mark all nodes as unvisited
   for (i = 0; i < n; i++)
      visited[forbidden[i]] = -2;  // mark forbidden nodes as visited => they won't be selected
   visited[source] = source;
   
   queue Q = newQueue();
   QueueEnqueue(Q, source);
   bool found = (target == source);
   while (!found && !QueueIsEmpty(Q)) {
      int v = QueueDequeue(Q);
      if (v == target) {
	 found = true;
      } else {
         int wheel, turn;
         for (wheel = 10; wheel <= 10000; wheel *= 10) { // fancy way of generating the
            for (turn = 1; turn <= 9; turn += 8) {       // eight neighbour configurations of v
	       int w = wheel * (v / wheel) + (v % wheel + (wheel/10) * turn) % wheel;
	       if (visited[w] == -1) {
	          visited[w] = v;
		  QueueEnqueue(Q, w);
	       }
	    }
	 }
      }
   }
   dropQueue(Q);
   if (found) {                     // unwind path to determine length
      int length = 0;
      while (target != source) {
         target = visited[target];  // move to predecessor on path
         length++;
      }
      return length;
   } else {
      return -1;                    // no solution
   }
}
</pre>
<p>
<ol type="a">
<li> 9
<li> 17
<li> &infin; (unreachable)
</ol>
</p>
</div>

</ol>

<br/>
<h2>Assessment</h2>

<p>
Submit your solutions to <b>Exercises 2 and 5</b> using the following <b>give</b> command:
</p>
<pre class="command_line">
<kbd class="shell">give cs9024 week5 FollowerBase.c dijkstra.c</kbd>
</pre>
<p>
Make sure you spell the filenames correctly. You can run <b>give</b> multiple times. Only your last submission will be marked.
</p>
<p>
The deadline for submission is <b>Monday,
18 October 5:00:00pm</b>.
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
