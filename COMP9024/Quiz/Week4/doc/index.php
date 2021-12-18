<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>COMP9024 21T3 - Week 4 Problem Set</title>
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
  <span class='heading'>Week 4 Problem Set</span><br/>
  <span class='subheading'>Graph Data Structures and Graph Search</span>
</td>
<td align='right' width='25%'>
  <span class='heading'><img src="unsw.png"></span>
</td>
</table>
</div><p style='text-align:center;font-size:75%'><a href='/~cs9024/21T3/probs/prob4/index.php?view=qo'>[Show with no answers]</a> &nbsp; <a href='/~cs9024/21T3/probs/prob4/index.php?view=all'>[Show with all answers]</a></div>

<ol>

<br/>
<li>(Graph fundamentals)
<p>
For the graph
</p>
<center><img src="graph1.png"></center>
<p>
give examples of the smallest (but not of size/length 0) and largest of each of the following:
</p>
<ol type="a">
<li> simple path
<li> cycle
<li> spanning tree
<li> vertex degree
<li> clique
</ol>

<p><small>[<a id="q1a" href="##" onclick="toggleVisible('q1')">show answer</a>]</small></p>
<div id="q1" style="color:#000099;display:none">
<ol type="a">
<li> path
 <ul>
 <li> smallest: any path with one edge (e.g. 1-2 or 6-13)
 <li> largest: some path including all but two nodes (e.g. 3-8-9-2-1-6-5-4-11-12-7)
 </ul>
<li> cycle
 <ul>
 <li> smallest: any cycle with 4 nodes (e.g. 10-2-3-8-10)
 <li> largest: any cycle with 10 nodes (e.g. 1-2-3-8-7-12-11-4-5-6-1)
 </ul>
<li> spanning tree
 <ul>
 <li> smallest: any spanning tree must include all nodes (an example is the largest path above plus the edges 6-13 and 2-10)
 <li> largest: same
 </ul>
<li> vertex degree
 <ul>
 <li> smallest: there are several nodes of degree 2 (e.g., nodes 1 and 10)
 <li> largest: in this graph, 4 (nodes 2 and 8)
 </ul>
<li> clique
 <ul>
 <li> smallest: any vertex by itself is a clique of size 1
 <li> largest: any two nodes that are connected, e.g. 1 and 2 (this graph has no cliques of size 3 or higher)
 </ul>
</ol>
</div>

<br/>
<li>(Graph properties)
<ol type="a">
<li><p>Write pseudocode for computing</p>
<ul>
<li> the minimum and maximum vertex degree
<li> all 3-cliques (i.e. cliques of 3 nodes, "triangles")
</ul>
<p>of a graph <i>g</i> with <i>n</i> vertices.</p>

<p>
Your methods should be representation-independent; the only function you should use is to check if two vertices <i>v,w&isin;{0,&hellip;n-1}</i> are adjacent in <i>g</i>.
</p>

<li><p>Determine the asymptotic complexity of your two algorithms. Assume that the adjacency check is performed in constant time, <i>O(1)</i>.</p>

<li><p>Implement your algorithms in a program <tt>graphAnalyser.c</tt> that
<ol>
<li>builds a graph from user input:
<ul>
<li>first, the user is prompted for the number of vertices
<li>then, the user is repeatedly asked to input an egde by entering
a "from" vertex followed by a "to" vertex
<li>until any non-numeric character(s) are entered
</ul>
<li>computes and outputs the degree of each vertext in the graph
<li>displays all 3-cliques of the graph in ascending order.
</ol>
<p>
Your program should use the Graph ADT from the lecture (<a href=http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week4/progs/Graph.h><tt>Graph.h</tt></a> and <a href=http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week4/progs/Graph.c><tt>Graph.c</tt></a>). These files should not be changed.
</p>
<p>
<i>Hint:</i> You may assume that the graph has a maximum of 1000 nodes.
</p>
An example of the program executing is shown below for the graph
<center><img src="graph2.png"></center>
<br/>
<pre class="command_line">
<kbd class="shell">./graphAnalyser</kbd>
Enter the number of vertices:<b> 6</b>
Enter an edge (from):<b> 0</b>
Enter an edge (to):<b> 1</b>
Enter an edge (from):<b> 1</b>
Enter an edge (to):<b> 2</b>
Enter an edge (from):<b> 4</b>
Enter an edge (to):<b> 2</b>
Enter an edge (from):<b> 1</b>
Enter an edge (to):<b> 3</b>
Enter an edge (from):<b> 3</b>
Enter an edge (to):<b> 4</b>
Enter an edge (from):<b> 1</b>
Enter an edge (to):<b> 5</b>
Enter an edge (from):<b> 5</b>
Enter an edge (to):<b> 3</b>
Enter an edge (from):<b> 2</b>
Enter an edge (to):<b> 3</b>
Enter an edge (from):<b> done</b>
Done.
Degree of node 0: 1
Degree of node 1: 4
Degree of node 2: 3
Degree of node 3: 4
Degree of node 4: 2
Degree of node 5: 2
Triangles:
1-2-3
1-3-5
2-3-4
</pre>
</p>
<p>
Note that any non-numeric data can be used to 'finish' the interaction.
</p>
</ol>

<p><i>We have created a script that can automatically test your program. To run this test you can execute the </i><tt>dryrun</tt><i> program that corresponds to this exercise. It expects to find a program named </i><tt>graphAnalyser.c</tt><i> in the current directory. You can use dryrun as follows:</i></p>
<pre class="command_line">
<kbd class="shell">9024 dryrun graphAnalyser</kbd>
</pre>
<p><i>Please ensure that your program output follows exactly the format shown in the sample interaction above. In particular, the vertices (with their degree) and the 3-cliques should be printed in ascending order.</i></p>

<p><small>[<a id="q2a" href="##" onclick="toggleVisible('q2')">show answer</a>]</small></p>
<div id="q2" style="color:#000099;display:none">
The following algorithm uses two nested loops to compute the degree of each vertex. Hence its asymptotic running time is <i>O(n<sup>2</sup>)</i>.
<pre class="pseudocode">
Degrees(g):
   <b>Input</b>  graph g
   <b>Output</b> minimum and maximum vertex degree

   min = &infin;, max = 0
   <b>for all</b> vertices v&isin;g <b>do</b>
      deg=0
      <b>for all</b> vertices w&isin;g, v&ne;w <b>do</b>
         <b>if</b> v,w adjacent in g <b>then</b>
            deg=deg+1
         <b>end if</b>
      <b>end for</b>
      <b>if</b> deg &lt; min <b>then</b>
         min = deg
      <b>end if</b>
      <b>if</b> deg &gt; max <b>then</b>
         max = deg
      <b>end if</b>
   <b>end for</b>
<b>return</b> min, max
</pre>
</p>
The following algorithm uses three nested loops to print all 3-cliques in order. Hence its asymptotic running time is <i>O(n<sup>3</sup>)</i>.
<pre class="pseudocode">
show3Cliques(g):
   <b>Input</b> graph g of n vertices numbered 0..n-1

   <b>for all</b> i=0..n-3 <b>do</b>
      <b>for all</b> j=i+1..n-2 <b>do</b>
	 <b>if</b> i,j adjacent in g <b>then</b>
            <b>for all</b> k=j+1..n-1 <b>do</b>
               <b>if</b> i,k adjacent in g and j,k adjacent in g <b>then</b>
	          print i"-"j"-"k
	       <b>end if</b>
	    <b>end for</b>
	  <b>end if</b>
      <b>end for</b>
   <b>end for</b>
</pre>
</p>
Sample <tt>graphAnalyser.c</tt>:
<pre class="answer">
#include &lt;stdio.h&gt;
#include &lt;stdlib.h&gt;
#include &lt;assert.h&gt;
#include "Graph.h"

#define MAX_NODES 1000

// determine and output the degree of each node in graph g
void Degrees(Graph g) {
   int nV = numOfVertices(g);
   int v, w, degree;
   for (v = 0; v < nV; v++) {
      degree = 0;
      for (w = 0; w < nV; w++) {
	 if (adjacent(g,v,w))
	    degree++;
      }
      printf("Degree of node %d: %d\n", v, degree);
   }
}   

// show all 3-cliques of graph g
void Show3Cliques(Graph g) {
   int i, j, k;
   int nV = numOfVertices(g);

   printf("Triangles:\n");
   for (i = 0; i < nV-2; i++)
      for (j = i+1; j < nV-1; j++)
	 if (adjacent(g,i,j))
	    for (k = j+1; k < nV; k++)
	       if (adjacent(g,i,k) && adjacent(g,j,k))
		  printf("%d-%d-%d\n", i, j, k);
}

int main(void) {
   Edge e;
   int n;

   printf("Enter the number of vertices: ");
   scanf("%d", &n);
   Graph g = newGraph(n);

   printf("Enter an edge (from): ");
   while (scanf("%d", &e.v) == 1) {
      printf("Enter an edge (to): ");
      scanf("%d", &e.w);
      insertEdge(g, e);
      printf("Enter an edge (from): ");
   }
   printf("Done.\n");

   Degrees(g);
   Show3Cliques(g);
   freeGraph(g);

   return 0;
}
</pre>
</div>

<br/>
<li> (Graph representations)
<ol type="a">
<li><p>
Show how the following graph would be represented by
</p>
<ol type="i">
<li> an adjacency matrix representation (V&timesV matrix with each edge represented twice)
<li> an adjacency list representation (where each edge appears in two lists, one for <i>v</i> and one for <i>w</i>)
</ol>
<center><img src="graph3.png"></center>
<li>
<p>
Consider the adjacency matrix and adjacency list representations for graphs.
Analyse the storage costs for the two representations in more detail in terms of the number
of vertices <i>V</i> and the number of edges <i>E</i>. Determine roughly
the V:E ratio at which it is more storage efficient to use an adjacency matrix
representation vs the adjacency list representation.
</p>
<p>
For the purposes of the analysis, ignore the cost of storing the
<tt>GraphRep</tt> structure. Assume that: each pointer is 8 bytes
long, a <tt>Vertex</tt> value is 4 bytes, a linked-list <i>node</i> is
16 bytes long and that the adjacency matrix is a complete <i>V</i>&times;<i>V</i>
matrix. Assume also that each adjacency matrix element is <b>1 byte</b> long.
(<i>Hint:</i> Defining the matrix elements as 1-byte boolean values rather than 4-byte integers is a simple way to improve the space usage for the adjacency matrix representation.)
</p>

<li>
<p>
The standard adjacency matrix representation for a graph uses a
full <i>V&times;V</i> matrix and stores each edge twice (at [v,w]
and [w,v]). This consumes a lot of space, and wastes a lot of
space when the graph is sparse. One way to use less space is to
store just the upper (or lower) triangular part of the matrix,
as shown in the diagram below:
</p>
<center><img src="adj-matrix.png"></center>
<p>
The <i>V&times;V</i> matrix has been replaced by a single 1-dimensional
array <tt>g.edges[]</tt> containing just the "useful" parts of the matrix.
</p>
<p>
Accessing the elements is no longer as simple as <tt>g.edges[v][w]</tt>.
Write pseudocode for a method to check whether two
vertices <tt>v</tt> and <tt>w</tt> are adjacent under the upper-triangle matrix representation of a graph <tt>g</tt>.
</p>

</ol>
<p><small>[<a id="q3a" href="##" onclick="toggleVisible('q3')">show answer</a>]</small></p>
<div id="q3" style="color:#000099;display:none">
<ol type="a">
<li>
<p>
<center><img src="graph-reps.png" style="background-color:#E8F8F5";></center>
</p>

<li>
<p>
The adjacency matrix representation always requires a <i>V</i>&times;<i>V</i>
matrix, regardless of the number of edges, where each element is 1 byte long.
It also requires an array of <i>V</i> pointers. This gives a fixed
size of <i>V&middot;8</i>+<i>V<sup>2</sup></i> bytes.
</p>
<p>
The adjacency list representation requires an array of <i>V</i> pointers
(the start of each list), with each being 8 bytes long,
and then one list node for each edge in each list. The total
number of edge nodes is 2<i>E</i> (each edge <i>(v,w)</i> is stored twice,
once in the list for <i>v</i> and once in the list for <i>w</i>). Since
each node requires 16 bytes (vertex+padding+pointer), this gives a size
of <i>V&middot;8</i>+16&middot;2&middot;<i>E</i>. The total storage is thus <i>V&middot;8</i>+<i>32&middot;E</i>.
</p>
<p>
Since both representations involve <i>V</i> pointers, the difference is
based on <i>V<sup>2</sup></i> vs <i>32E</i>. So, if
<i>32E &lt; V<sup>2</sup></i> (or, equivalently, <i>E &lt; V<sup>2</sup>/32</i>),
then the adjacency list representation will be more storage-efficient.
Conversely, if <i>E &gt; V<sup>2</sup>/32</i>, then the adjacency matrix
representation will be more storage-efficient.
</p>
<p>
To pick a concrete example, if <i>V=25</i> and if we have 19 or fewer edges
(25&middot;25/32 = 19.53), then the adjacency list will be more storage-efficient, otherwise
the adjacency matrix will be more storage-efficient.
</p>

<li>
The following solution uses a loop to compute the correct index in the 1-dimensional <tt>edges[]</tt> array:
<pre class="pseudocode">
adjacent(g,v,w):
   <b>Input</b>  graph g in upper-triangle matrix representation
          v, w vertices such that v&ne;w
   <b>Output</b> true if v and w adjacent in g, false otherwise

   <b>if</b> v&gt;w <b>then</b>
      swap v and w        // to ensure v&lt;w
   <b>end if</b>
   chunksize=g.nV-1, offset=0
   <b>for all</b> i=0..v-1 <b>do</b>
      offset=offset+chunksize
      chunksize=chunksize-1
   <b>end if</b>
   offset=offset+w-v-1
   <b>if</b> g.edges[offset]=0 <b>then</b> <b>return</b> false
                        <b>else</b> <b>return</b> true
   <b>end if</b>
</pre>
<p>
Alternatively, you can compute the overall offset directly via the formula `(nV-1)+(nV-2)+...+(nV-v)+(w-v-1)=v/2(2*nV-v-1)+(w-v-1)` (assuming that <i>v &lt; w</i>).</p>

</ol>
</div>

<br/>
<li>(Graph traversal: DFS and BFS)

<p>
Both DFS and BFS can be used for a <i>complete</i> search without a specific destination, which means traversing a graph until all reachable nodes have been visited. Show the order in which the nodes of the graph depicted below are visited by
</p>
<ol type="a">
<li> DFS starting at node 7
<li> DFS starting at node 4
<li> BFS starting at node 7
<li> BFS starting at node 4
</ol>
<center><img src="graph4.png"></center>
<p>
Assume the use of a stack for depth-first search (DFS) and a queue for breadth-first search (BFS), respectively, and use the pseudocode from the lecture: <a href=http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week4/slide081.html>DFS</a>,
<a href=http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week4/slide085.html>BFS</a>.
Show the state of the stack or queue explicitly in each step. When choosing which neighbour to visit next, always choose
the smallest unvisited neighbour.</p>

<p><small>[<a id="q4a" href="##" onclick="toggleVisible('q4')">show answer</a>]</small></p>
<div id="q4" style="color:#000099;display:none">
<ol type="a">
<li> DFS starting at 7:
<pre class="pseudocode">
Current    Stack (top at left)
-          7
7          5
5          2 3 4 6
2          1 3 3 4 6
1          0 3 4 3 3 4 6
0          3 4 3 3 4 6
3          4 4 3 3 4 6
4          4 3 3 4 6
...
6          -
</pre>
<li> DFS starting at 4:
<pre class="pseudocode">
Current    Stack (top at left)
-          4
4          1 3 5
1          0 2 3 3 5
0          2 3 3 5
2          3 5 3 3 5
3          5 5 3 3 5
5          6 7 5 3 3 5
6          7 5 3 3 5
7          5 3 3 5
...
-          -
</pre>
<li>BFS starting at 7:
<pre class="pseudocode">
Current    Queue (front at left)
-          7
7          5
5          2 3 4 6
2          3 4 6 1
3          4 6 1
4          6 1
6          1
1          0
0          -
</pre>
<li>BFS starting at 4:
<pre class="pseudocode">
Current    Queue (front at left)
-          4
4          1 3 5
1          3 5 0 2
3          5 0 2
5          0 2 6 7
0          2 6 7
2          6 7
6          7
7          -
</pre>
</ol>
</div>

<br/>
<li>(Cycle check)

<ol type="a">
<li>
<p>Take the <a href=http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week4/slide090.html>"buggy" cycle check</a> from the lecture and design a correct algorithm, in pseudocode, to use depth-first search to determine if a graph has a cycle.
</p>

<li>
<p>
Write a C program <tt>cycleCheck.c</tt> that implements your solution to check whether a graph has a cycle. The graph should be built from user input in the same way as in exercise 2. Your program should use the Graph ADT from the lecture (<a href=http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week4/progs/Graph.h><tt>Graph.h</tt></a> and <a href=http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week4/progs/Graph.c><tt>Graph.c</tt></a>). These files should not be changed.
</p>
<p>An example of the program executing is shown below for the following graph:</p>
<center><img src="components.png"></center>
<br/>
<pre class="command_line">
<kbd class="shell">./cycleCheck</kbd>
Enter the number of vertices:<b> 9</b>
Enter an edge (from):<b> 0</b>
Enter an edge (to):<b> 1</b>
Enter an edge (from):<b> 1</b>
Enter an edge (to):<b> 2</b>
Enter an edge (from):<b> 4</b>
Enter an edge (to):<b> 3</b>
Enter an edge (from):<b> 6</b>
Enter an edge (to):<b> 5</b>
Enter an edge (from):<b> 6</b>
Enter an edge (to):<b> 7</b>
Enter an edge (from):<b> 5</b>
Enter an edge (to):<b> 7</b>
Enter an edge (from):<b> 5</b>
Enter an edge (to):<b> 8</b>
Enter an edge (from):<b> 7</b>
Enter an edge (to):<b> 8</b>
Enter an edge (from):<b> done</b>
Done.
The graph has a cycle.
</pre>
</p>
<p>If the graph has no cycle, then the output should be:
<pre class="command_line">
<kbd class="shell">./cycleCheck</kbd>
Enter the number of vertices:<b> 3</b>
Enter an edge (from):<b> 0</b>
Enter an edge (to):<b> 1</b>
Enter an edge (from):<b> #</b>
Done.
The graph is acyclic.
</pre>
<p>
You may assume that a graph has a maximum of 1000 nodes.
</p>
<p><i>To test your program you can execute the </i><tt>dryrun</tt><i> program that corresponds to this exercise. It expects to find a program named </i><tt>cycleCheck.c</tt><i> in the current directory. You can use dryrun as follows:</i></p>
<pre class="command_line">
<kbd class="shell">9024 dryrun cycleCheck</kbd>
</pre>
<p><i>Note: Please ensure that your output follows exactly the format shown above.</i></p>
</li>
</ol>

<p><small>[<a id="q5a" href="##" onclick="toggleVisible('q5')">show answer</a>]</small></p>
<div id="q5" style="color:#000099;display:none">
<ol type="a">
<li>
<pre class="pseudocode">
hasCycle(G):
|  <b>Input</b>  graph G
|  <b>Output</b> true if G has a cycle, false otherwise
|
|  mark all vertices as unvisited
|  <b>for</b> each vertex v&isin;G <b>do</b>           // make sure to check all connected components
|  |  <b>if</b> v has not been visited <b>then</b>
|  |     <b>if</b> dfsCycleCheck(G,v,v) <b>then</b>
|  |        <b>return</b> true
|  |     <b>end if</b>
|  |  <b>end if</b>
|  <b>end for</b>
|  <b>return</b> false

dfsCycleCheck(G,v,u):      // look for a cycle that does not go back directly to u
|  mark v as visited
|  <b>for each</b> (v,w)&isin;edges(G) <b>do</b>
|  |  <b>if</b> w has not been visited <b>then</b>
|  |  |  <b>if</b> dfsCycleCheck(G,w,v) <b>then</b>
|  |  |     <b>return</b> true
|  |  |  <b>end if</b>
|  |  <b>else if</b> w&ne;u <b>then</b>
|  |  |  <b>return</b> true
|  |  <b>end if</b>
|  <b>end for</b>
|  <b>return</b> false
</pre>

<li>
<p>
The following two C functions implement this algorithm:
</p>
<p>
<pre class="answer">
#define MAX_NODES 1000
int visited[MAX_NODES];

bool dfsCycleCheck(Graph g, Vertex v, Vertex u) {
   visited[v] = true;
   Vertex w;
   for (w = 0; w &lt; numOfVertices(g); w++) {
      if (adjacent(g, v, w)) {
         if (!visited[w]) {
	    if (dfsCycleCheck(g, w, v))
	       return true;
	 } else if (w != u) {
            return true;
	 }
      }
   }
   return false;
}

bool hasCycle(Graph g) {
   int v, nV = numOfVertices(g);
   for (v = 0; v &lt; nV; v++)
      visited[v] = false;
   for (v = 0; v &lt; nV; v++)
      if (!visited[v])
	 if (dfsCycleCheck(g, v, v))
	    return true;
   return false;
}
</pre>
</ol>
</div>

<br/>
<li>(Connected components)

<ol type="a">
<li>
<p>
Computing connected components can be avoided by maintaining a vertex-indexed connected components array as part of the <tt>Graph</tt> representation structure:
<pre>
typedef struct GraphRep *Graph;

struct GraphRep {
   ...
   int nC;  // # connected components
   int *cc; /* which component each vertex is contained in
               i.e. array [0..nV-1] of 0..nC-1 */
   ...
}
</pre>
</p>
<p>
Consider the following graph with multiple components:
</p>
<center><img src="ccGraph.png"></center>
<p>
Assume a vertex-indexed connected components array cc[0..nV-1] as introduced above:
<pre>
nC   = 2
cc[] = {0,0,0,1,1,1,0,0,0,1}
</pre>
</p>
<p>
Show how the <tt>cc[]</tt> array would change if
<ol>
<li>edge <i>d</i> was removed
<li>edge <i>b</i> was removed
</ol>
</p>

<li>
<p>
Consider an adjacency matrix graph representation augmented by the two fields
<ul>
<li> <tt>nC</tt> &nbsp; (number of connected components)
<li> <tt>cc[]</tt> &nbsp; (connected components array)
</ul>
</p>
These fields are initialised as follows:
<pre>
newGraph(V):
|  <b>Input</b>  number of nodes V
|  <b>Output</b> new empty graph
|
|  g.nV=V, g.nE=0, <font color="blue">g.nC=V</font>
|  allocate memory for g.edges[][]
|  <b>for all</b> i=0..V-1 <b>do</b>
|     <font color="blue">g.cc[i]=i</font>
|     <b>for all</b> j=0..V-1 <b>do</b>
|        g.edges[i][j]=0
|     <b>end for</b>
|  <b>end for</b>
|  <b>return</b> g
</pre>
<p>
Modify the pseudocode for edge insertion and edge removal from the lecture to maintain the two new fields.
</p>
</ol>

<p><small>[<a id="q6a" href="##" onclick="toggleVisible('q6')">show answer</a>]</small></p>
<div id="q6" style="color:#000099;display:none">
<ol type="a">

<li><p> After removing <i>d</i>, <tt>cc[] = {0,0,0,1,1,1,0,0,0,1}</tt> &nbsp; (i.e. unchanged)
<br/>
After removing <i>b</i>, <tt>cc[] = {0,0,2,1,1,1,2,0,2,1}</tt> with <tt>nC=3</tt>
</p>
<li>
Inserting an edge may reduce the number of connected components:
<pre class="pseudocode">
insertEdge(g,(v,w)):
|  <b>Input</b> graph g, edge (v,w)
|
|  <b>if</b> g.edges[v][w]=0 <b>then</b>               // (v,w) not in graph
|  |  g.edges[v][w]=1, g.edges[w][v]=1   // set to true
|  |  g.nE=g.nE+1
|  |  <b>if</b> g.cc[v]&ne;g.cc[w] <b>then</b>            // v,w in different components?
|  |  |  c=min{g.cc[v],g.cc[w]}          // &rArr; merge components c and d
|  |  |  d=max{g.cc[v],g.cc[w]}
|  |  |  <b>for all</b> vertices v&isin;g <b>do</b>
|  |  |     <b>if</b> g.cc[v]=d <b>then</b>
|  |  |        g.cc[v]=c                 // move node from component d to c
|  |  |     <b>else if</b> g.cc[v]=g.nC-1 <b>then</b>
|  |  |        g.cc[v]=d                 // replace largest component ID by d
|  |  |     <b>end if</b>
|  |  |  <b>end for</b>
|  |  |  g.nC=g.nC-1
|  |  <b>end if</b>
|  <b>end if</b>
</pre>
</p>
Removing an edge may increase the number of connected components:
<pre class="pseudocode">
removeEdge(g,(v,w)):
|  <b>Input</b> graph g, edge (v,w)
|
|  <b>if</b> g.edges[v][w]&ne;0 <b>then</b>               // (v,w) in graph
|  |  g.edges[v][w]=0, g.edges[w][v]=0   // set to false
|  |  <b>if</b> not hasPath(g,v,w) <b>then</b>         // v,w no longer connected?
|  |     dfsNewComponent(g,v,g.nC)       // &rArr; put v + connected vertices into new component
|  |     g.nC=g.nC+1
|  |  <b>end if</b>
|  <b>end if</b>

dfsNewComponent(g,v,componentID):
|  <b>Input</b> graph g, vertex v, new componentID for v and connected vertices
|
|  g.cc[v]=componentID
|  <b>for all</b> vertices w adjacent to v <b>do</b>
|     <b>if</b> g.cc[w]&ne;componentID <b>then</b>
|        dfsNewComponent(g,w,componentID)
|     <b>end if</b>
|  <b>end if</b>
</pre>
</ol>
</div>

<br/>
<li>(Hamiltonian/Euler paths and circuits)

<ol type="a">
<li> <p>
Identify any Hamiltonian/Euler paths/circuits in the following graphs:
<center><img src="euler-hamilton.png"></center>

<li> <p>
Find an Euler path and an Euler circuit (if they exist) in the following graph:
</p>
<center><img src="graph5.png"></center>
</ol>

<p><small>[<a id="q7a" href="##" onclick="toggleVisible('q7')">show answer</a>]</small></p>
<div id="q7" style="color:#000099;display:none">
<ol type="a">
<li>
<p>
   Graph 1: has both Euler and Hamiltonian paths (e.g. 0-1-2), but cannot have circuits
as there are no cycles.
</p>
<p>
   Graph 2: has both Euler paths (e.g. 0-1-2-0) and Hamiltonian paths (e.g. 0-1-2); also has both
Euler and Hamiltonian circuits (e.g. 0-1-2-0).
</p>
<p>
Graph 3: has neither Euler nor Hamiltonian paths, nor Euler nor Hamiltonian circuits.
</p>
<p>
Graph 4: has Hamiltonian paths (e.g. 0-1-2-3) and Hamiltonian circuits (e.g. 0-1-2-3-0);
it has neither an Euler path nor an Euler circuit.
</p>

<li>
<p>
An Euler path: &nbsp; 2-6-5-2-3-0-1-5-0-4-5
</p>
<p>
No Euler circuit since two vertices (2 and 5) have odd degree.
</p>
</div>

<br/>
<li><b>Challenge Exercise</b>
<p>
Write pseudocode to compute the <i>largest</i> size of a clique in a graph. For example, if the input happens to be the complete graph <i>K<sub>5</sub></i> but with any one edge missing, then the output should be 4. Extend your program from Exercise 2 by an implementation of your algorithm to compute the largest size of a clique in a graph.
</p>
</p>
<i>Hint:</i> Computing the maximum size of a clique in a graph is known to be an <i>NP-hard problem</i>. Try a generate-and-test strategy.
</p>
<p><small>[<a id="q8a" href="##" onclick="toggleVisible('q8')">show answer</a>]</small></p>
<div id="q8" style="color:#000099;display:none">
As an NP-hard problem, no tractable algorithm for computing the maximum size of a clique in a graph is known. Here is a sample 'brute-force' algorithm that essentially generates-and-tests all possible subsets of vertices to determine the maximum size of a complete subgraph.
<pre class="pseudocode">
maxCliqueSize(g,v,clique,k):
|  <b>Input</b>  g       graph with n nodes 0..n-1
|         v       next vertex to consider
|         clique  some subset of nodes 0..v-1 that forms a clique
|         k       size of that clique
|  <b>Output</b> size of largest complete subgraph of g that extends clique with nodes from v..n-1
|
|  <b>if</b> v=n <b>then</b>                            // no more vertices to consider
|     <b>return</b> k
|  <b>else</b>
|  |  k1=maxCliqueSize(g,v+1,clique,k)    /* find largest complete subgraph that
|  |                                         extends clique without considering v */
|  |  <b>for all</b> w&isin;clique <b>do</b>                 // check if v can be added to clique:
|  |  |  <b>if</b> v is not adjacent to w <b>then</b>   // if v not adjacent to some node in clique
|  |  |     <b>return</b> k1                     // &rArr; return largest clique size without v
|  |  |  <b>end if</b>
|  |  <b>end for</b>
|  |  add v to clique
|  |  k2=maxCliqueSize(g,v+1,clique,k+1)  // find largest clique extending clique &cup; {v}
|  |  <b>if</b> k2&gt;k1 <b>then</b> <b>return</b> k2
|  |           <b>else</b> <b>return</b> k1
|  |  <b>end if</b>
|  <b>end if</b>
</pre>
</p>
<p>
Starting with an empty <tt>clique</tt>, the function call <tt>maxCliqueSize(g,0,clique,0)</tt> will return the maximum clique size of graph <tt>g</tt>.
</p>
The following C program implements this algorithm:
<pre class="answer">
int maxCliqueSize(Graph g, int v, int clique[], int k) {
//
// g         graph
// v         next vertex to consider
// clique[]  some subset of nodes 0..v-1 that forms a clique
// k         size of that clique
//
// returns size of largest complete subgraph of g that extends clique[] with nodes from v..nV-1
//
   if (v == numOfVertices(g)) {                    // no more vertices to consider
      return k;
   } else {
      int k1 = maxCliqueSize(g, v+1, clique, k);   /* find largest complete subgraph that
                                                      extends clique[] without considering v */
      int i;
      for (i = 0; i < k; i++)                      // check if v can be added to clique[]:
         if (!adjacent(g, v, clique[i]))           // if v not adjacent to some node in clique[]
            return k1;                             // => return largest clique size without v

      clique[k] = v;                               // add v to clique[]
      int k2 = maxCliqueSize(g, v+1, clique, k+1); // find largest clique extending clique[]+v
      if (k2 > k1)
         return k2;
      else
         return k1;
}
</pre>
<p/>
To call this recursive function on a graph <tt>g</tt> with <tt>nV</tt> vertices:
<pre class="answer">
int *clique = malloc(nV * sizeof(int));            // allocate memory for an array of vertices
int m = maxCliqueSize(g, 0, clique, 0);            // start at vertex 0 with clique of size 0
free(clique);
</pre>
<p>For the keen: <a href="http://en.wikipedia.org/wiki/Clique_problem">Here</a> you can read more about the computational aspects of computing cliques including some references to more sophisticated algorithms.
</p>
</div>

</ol>

<br/>
<h2>Assessment</h2>

<p>
After you've solved the exercises, go to <a href=https://moodle.telt.unsw.edu.au/mod/quiz/view.php?id=4160432>COMP9024 21T3 Quiz Week 4</a> to answer 5 quiz questions on this week's problem set and lecture.
</p>
<p>
The quiz is worth 2 marks.
</p>
<p>
There is no time limit on the quiz once you have started it, but the deadline for submitting your quiz answers is <b>Monday,
11 October 5:00:00pm</b>.
</p>
<p>
Please continue to respect the <b>quiz rules</b>:
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
