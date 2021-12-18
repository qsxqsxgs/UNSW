<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>COMP9024 21T3 - Week 7 Problem Set</title>
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
  <span class='heading'>Week 7 Problem Set</span><br/>
  <span class='subheading'>Binary Search Trees</span>
</td>
<td align='right' width='25%'>
  <span class='heading'><img src="unsw.png"></span>
</td>
</table>
</div><p style='text-align:center;font-size:75%'><a href='/~cs9024/21T3/probs/prob7/index.php?view=qo'>[Show with no answers]</a> &nbsp; <a href='/~cs9024/21T3/probs/prob7/index.php?view=all'>[Show with all answers]</a></div>

<ol>

<br/>
<li> (Tree properties)

<ol type="a">
<li>
<p>
Devise a formula for the minimum height of a binary search tree (BST) containing <i>n</i> nodes.
Recall that the height is defined as the number of edges on a longest path from the root to a leaf.
You might find it useful to start by considering the characteristics of a tree which has minimum height.
The following diagram may help:
</p>
<center><img src="tree-heights.png"></center>
</li>

<li>
<p>
In the Binary Search Tree ADT (<a href="http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week7/progs/BSTree.h"><tt>BSTree.h</tt></a>, <a href="http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week7/progs/BSTree.c"><tt>BSTree.c</tt></a>) from the lecture, implement the function:
</p>
<pre>
int TreeHeight(Tree t) { ... }
</pre>
<p>to compute the height of a tree.</p>
</li>

<li> <p>
Computing the height/depth of trees is useful for estimating their search
efficiency.
For <i>drawing</i> trees, we're more interested in their <i>width</i>.
For some simple trees the following diagrams show a useful definition of tree width if you want to keep reasonable spacing:
</p>
<center><img src="tree-widths.png"></center>
<p>Derive a formula for the width of a tree that generalises from the examples and add a new function to the <tt>BSTree</tt> ADT which computes the width of a tree. Use the following function interface:
</p>
<pre>
int TreeWidth(Tree t) { ... }
</pre>
</li>

</ol>

<br/>
<p><i>We have created a script that can automatically test your program. To run this test you can execute the </i><tt>dryrun</tt><i> program that corresponds to this exercise. It expects to find the program named </i><tt>BSTree.c</tt><i> with your implementation for <tt>TreeHeight()</tt> and <tt>TreeWidth()</tt> in the current directory. You can use dryrun as follows:</i>
<pre class="command_line">
<kbd class="shell">9024 dryrun BSTree</kbd>
</pre>
</p>

<p><small>[<a id="q1a" href="##" onclick="toggleVisible('q1')">show answer</a>]</small></p>
<div id="q1" style="color:#000099;display:none">
<ol type="a">
<li>
<p>
A minimum height tree must be balanced.
In a balanced tree, the height of the two subtrees
differs by at most one.
In a <em>perfectly</em> balanced tree, all leaves are at the same
level.
The single-node tree, and the two trees on the right in the
diagram above are perfectly balanced trees.
A perfectly balanced tree of height `h` has `n = 2^0 + 2^1 + ... + 2^h = 2^(h+1)-1` nodes. A perfectly balanced tree, therefore, satisfies `h = log_2 (n+1)-1`.
</p>
By inspection of the trees that are not perfectly balanced above,
it is clear that as soon as an extra node is added to a perfectly
balanced tree, the height will increase by 1. To maintain this
height, all subsequent nodes must be added at the same level.
The height will thus remain constant until we reach a new
perfectly balanced state.
It follows that for a tree with <i>n</i> nodes, the minimum height is `h = |~log_2 (n+1)~|-1`.
</p>
</li>

<li>
<p>
The following code uses the obvious recursive strategy:
an empty tree is defined to be of height -1;
a tree with a root node has height one plus the height
of the highest subtree.
<pre class="answer">
int TreeHeight(Tree t) {
   if (t == NULL) {
      return -1;
   } else {
      int lheight = 1 + TreeHeight(left(t));
      int rheight = 1 + TreeHeight(right(t));
      if (lheight &gt; rheight)
	 return lheight;
      else
	 return rheight;
   }
}
</pre>
</li>

<li>
<p>The following recursive definition of <i>tree width</i> generalises from the examples:</p>
<ul>
<li> An empty tree has width zero.
<li> A tree with just one node has width two.
<li> All other trees have width which is two more than the combined width of the subtrees.
</ul>
<p>
The following function computes the width:
</p>
<pre class="answer">
#define TREEWIDTH_BASE 2

int TreeWidth(Tree t) {
   if (t == NULL)
      return 0;
   else if (left(t) == NULL && right(t) == NULL)
      return TREEWIDTH_BASE;
   else
      return TREEWIDTH_BASE + TreeWidth(left(t)) + TreeWidth(right(t));
}
</pre>
</li>
</ol>
</div>

<br/>
<li> (Tree traversal)

<p>
Consider the following tree and its nodes displayed in
different output orderings:
</p>
<center><img src="tree-orders.png"></center>
<ol type="a">
<li> <p>What kind of trees have the property that their infix output
is the same as their prefix output?
Are there any kinds of trees for which all four output orders will
be the same?
</p>
<li>
<p>
  Design a recursive algorithm for prefix-, infix-, and postfix-order traversal of a binary search tree. Use pseudocode, and define a single function &nbsp;<tt>TreeTraversal(tree,style)</tt>, where <tt>style</tt> can be any of <tt>"NLR"</tt>, <tt>"LNR"</tt> or <tt>"LRN"</tt>.
</pre>
</p>
</ol>

<p><small>[<a id="q2a" href="##" onclick="toggleVisible('q2')">show answer</a>]</small></p>
<div id="q2" style="color:#000099;display:none">
<ol type="a">
<li>
<p>
One obvious class of trees with this property is "right-deep" trees.
Such trees have no left sub-trees on any node, e.g. ones that are built by
inserting keys in ascending order.
Essentially, they are linked-lists.
</p>
<p>
Empty trees and trees with just one node have all output orders the same.
</p>
<li> <p>A generic traversal algorithm:
<pre style="pseudocode">
TreeTraversal(tree,style):
|  <b>Input</b> tree, style of traversal
|
|  <b>if</b> tree is not empty <b>then</b>
|  |  <b>if</b> style="NLR" <b>then</b>
|  |     <i>visit</i>(data(tree))
|  |  <b>end if</b>
|  |  TreeTraversal(left(tree),style)
|  |  <b>if</b> style="LNR" <b>then</b>
|  |     <i>visit</i>(data(tree))
|  |  <b>end if</b>
|  |  TreeTraversal(right(tree),style)
|  |  <b>if</b> style="LRN" <b>then</b>
|  |     <i>visit</i>(data(tree))
|  |  <b>end if</b>
|  <b>end if</b>
</pre>
</p>
</ol>
</div>
</li>

<br/>
<li> (Standard insertion)

<p>Show the BST that results from inserting (at leaf) the following values into an empty tree in the order given:
</p>
<pre>
15 4 7 30 42 23 1
</pre>
</li>

<p><small>[<a id="q3a" href="##" onclick="toggleVisible('q3')">show answer</a>]</small></p>
<div id="q3" style="color:#000099;display:none">
<p>
<center><img src="tree-ops.png"></center>
</p>
</div>
</li>

<br/>
<li> (Insertion at root)

<p>
Consider an initially empty BST and the sequence of values
<pre>
1 2 3 4 5 6
</pre>
</p>
<ol type="a">
<li> <p>Show the tree resulting from inserting these values "at leaf". What is its height?</p>
<li> <p>Show the tree resulting from inserting these values "at root". What is its height?</p>
<li> <p>Show the tree resulting from alternating between at-leaf-insertion and at-root-insertion. What is its height?</p>
</ol>

<p><small>[<a id="q4a" href="##" onclick="toggleVisible('q4')">show answer</a>]</small></p>
<div id="q4" style="color:#000099;display:none">
<ol type="a">
<li> <p>At-leaf-insertion results in a fully degenerate, "right-deep" of height 5.</p>
<li> <p>At-root insertion results in a fully degenerate, "left-deep" tree of height 5.</p>
<li> <p>Alternating between the two styles of insertion results in a tree of height 3. Generally, if <i>n</i> ordered values are inserted into a BST in this way, then the resulting tree will be of height `|__n/2__|`.</p>
</ol>
<center><img src="root-insert.png"></center>
</div>
</li>

<br/>
<li> (Deletion)

<p>Consider the BST that results from inserting the following values into an empty tree in the order given:
</p>
<pre>
6 10 8 2 12 4 1
</pre>
</p>
<p>
Then consider executing the following sequence of operations:
</p>
<pre>
TreeDelete(t,12);
TreeDelete(t,6);
TreeDelete(t,2);
TreeDelete(t,4);
</pre>
<p>
Assume that deletion is handled by joining the two subtrees of the deleted
node in the same way as in the lecture (slides <a href="http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week7/slide048.html">Deletion from BSTs</a> and <a href="http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week7/slide036.html">Joining Two Trees</a>)
if the node has two children. What is the tree after each delete operation?
</p>
<p><small>[<a id="q5a" href="##" onclick="toggleVisible('q5')">show answer</a>]</small></p>
<div id="q5" style="color:#000099;display:none">
<center><img src="tree-deletions.png"></center>
</div>
</li>

<br/>
<li> (Rotation)
<p>
Consider the following tree:
</p>
<center><img src="tree.png"></center>
<p>
Suppose that &nbsp;<tt>t</tt>&nbsp; is a pointer to the root node, then consider executing the following sequence of operations:
</p>
<pre>
left(t) = rotateRight(left(t));  t = rotateLeft(t);  right(t) = rotateRight(right(t));
</pre>
<p>
Show the tree after each rotation.
</p>
<p><small>[<a id="q6a" href="##" onclick="toggleVisible('q6')">show answer</a>]</small></p>
<div id="q6" style="color:#000099;display:none">
<center><img src="tree-rotations.png"></center>
<p>The last operation &ndash; right rotation of the right subtree of the root &ndash; leaves the tree unchanged.</p>
</div>
</li>

<br/>
<li> (Balancing trees)
<ol type="a">
<li>
<p>Consider again the tree from the previous exercise (before any rotations). Is this tree height-balanced? If not, what is the minimum number of rotations needed to obtain a height-balanced tree?
</p>
<li>
<p>Consider the second, non-balanced tree from the lecture on the slide &quot;<a href="http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week7/slide049.html">Balanced Binary Search Trees</a>.&quot; What is the minimum number of rotations needed to height-balance the tree? What is the minimum number of rotations needed to balance the tree?
</p>
</ol>
<p><i>Hint:</i>
<ul>
<li>A BST is called <i>height-balanced</i> if all its nodes satisfy the following: The height of left and right subtree differ by at most 1 (cf. slide &quot;<a href="http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week7/slide018.html">Binary Search Trees</a>&quot;).
<li>A BST is called <i>balanced</i> if all its nodes satisfy the following: The number of nodes in the left and right subtree differ by at most 1 (cf. slide &quot;<a href="http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week7/slide049.html">Balanced Binary Search Trees</a>&quot;).
</ul>
</p>
<p><small>[<a id="q7a" href="##" onclick="toggleVisible('q7')">show answer</a>]</small></p>
<div id="q7" style="color:#000099;display:none">
<ol type="a">
<li>
<p>The tree is not height-balanced because the left subtree of node '7' is of height 1 while the right subtree of '7' is empty, i.e. of height -1. A height-balanced tree can be obtained by 2 rotations: First, a left rotation of the subtree rooted in '4', then a right rotation at node '7'.
</p>
</li>
<li>
<p>A single right rotation at the root suffices to obtain a height-balanced tree: The height of the left subtree will be 3 and the height of the right subtree will be 2.
</p>
<p>
This height-balanced tree is not balanced, however: The left subtree contains the four nodes 1, 2, 3, 4 while the right subtree contains only two nodes: 6 and 7.
The tree can only be balanced if node 4 becomes its root <b>and</b> the left and right subtree of the root are balanced, too. The minimum number of rotations required to this end is four:
<ol type="1">
<li> Left rotation at 3.
<li> Left rotation at 2.
<li> Right rotation at 5.
<li> Right rotation at 6.
</ol>
</p>
<p>
This results in the (perfectly) balanced tree depicted on the slide &quot;<a href="http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week7/slide018.html">Binary Search Trees</a>.&quot;
</p>
</li>
</ul>
</div>

<br/>
<li><b>Challenge Exercise</b>
<p>
The function <tt>showTree()</tt> from the lecture displays a given BST sideways. A more attractive output would be to print a tree properly from the root down to the leaves. Design and implement a new function <tt>showTree(Tree t)</tt> for the Binary Search Tree ADT (<a href="http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week7/progs/BSTree.h"><tt>BSTree.h</tt></a>, <a href="http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week7/progs/BSTree.c"><tt>BSTree.c</tt></a>) to achieve this.
<p>
<em>
Please email <a href="http://cgi.cse.unsw.edu.au/~mit/">me</a> your solution. The best solution will be added to our BST ADT implementation and used in the next lecture (week 8). Both the attractiveness of the visualisation and the simplicity of the code will be judged.
</em>
</p>

<p><small>[<a id="q8a" href="##" onclick="toggleVisible('q8')">show answer</a>]</small></p>
<div id="q8" style="color:#000099;display:none">
Solution courtesy of: Jason Liu
<pre class="answer">
typedef struct Node {
   Item data;
   Tree left, right;

   // auxiliary fields for drawing
   unsigned int height;
   unsigned int width;
   unsigned int drawWidth; // width including margin and node data length
   unsigned int drawPos;   // node data position relative to the left side of the tree
} Node;

const unsigned int vMargin = 0; // extra number of lines between levels
const unsigned int hMargin = 0; // number of columns between nodes
const char leftEdge = '/';
const char rightEdge = '\\';
const char hEdge = '_';
const char vEdge = '|';

int numDigits(int number) {
    int digits = ceil(log10(abs(number) + 1));
    return number < 0 ? digits + 1 : digits;
}

void calculateProperties(Tree t) {
    if (t == NULL) {
        return;
    }

    int leftHeight = -1;
    int rightHeight = -1;
    int leftWidth = 0;
    int rightWidth = 0;
    int leftDrawWidth = 0;
    int rightDrawWidth = 0;

    if (left(t) != NULL) {
        calculateProperties(left(t));
        leftHeight = left(t)->height;
        leftWidth = left(t)->width;
        leftDrawWidth = left(t)->drawWidth + hMargin;
    }

    if (right(t) != NULL) {
        calculateProperties(right(t));
        rightHeight = right(t)->height;
        rightWidth = right(t)->width;
        rightDrawWidth = right(t)->drawWidth + hMargin;
    }
    
    t->height = fmax(leftHeight, rightHeight) + 1;
    t->width = leftWidth + rightWidth + 1;
    t->drawWidth = leftDrawWidth + numDigits(data(t)) + rightDrawWidth;
    t->drawPos = leftDrawWidth;
}

void drawData(Tree t, char* line, int hOffset) {
    int currNum = abs(data(t));
    int digits = numDigits(data(t));
    int pos = hOffset + t->drawPos + digits - 1;

    // converts int to char from least significant digit
    while (currNum > 0) {
        int d = currNum % 10;
        line[pos] = d + '0';
        currNum /= 10;
        pos--;
    }

    if (data(t) < 0) {
        line[pos] = '-';
    }
}

void drawLeftEdge(Tree t, char** grid, int vOffset, int hOffset) {
    if (left(t) == NULL) {
        return;
    }

    int hPos = hOffset + t->drawPos;
    int vPos = vOffset + 1;
    grid[vPos][hPos] = grid[vPos][hPos] != rightEdge ? leftEdge : vEdge; // draw left pointing line below the root
    hPos--;
    int hGoal = hOffset + left(t)->drawPos + numDigits(data(left(t))) / 2;

    // draw horizontal and vertical lines connecting to left child
    while (hPos > hGoal) {
        grid[vPos][hPos] = hEdge;
        hPos--;
    }

    vPos++;
    int vGoal = vOffset + vMargin + 2;

    while (vPos < vGoal) {
        grid[vPos][hPos] = vEdge;
        vPos++;
    }

    grid[vPos][hPos] = leftEdge; // draw left pointing line above the left child
}

void drawRightEdge(Tree t, char** grid, int vOffset, int hOffset) {
    if (right(t) == NULL) {
        return;
    }

    int hPos = hOffset + t->drawPos + numDigits(data(t)) - 1;
    int vPos = vOffset + 1;
    grid[vPos][hPos] = grid[vPos][hPos] != leftEdge ? rightEdge : vEdge;
    hPos++;
    int hGoal = hPos + hMargin + right(t)->drawPos + fmax(numDigits(data(right(t))) / 2 - 1, 0);


    while (hPos < hGoal) {
        grid[vPos][hPos] = hEdge;
        hPos++;
    }

    vPos++;
    int vGoal = vOffset + vMargin + 2;

    while (vPos < vGoal) {
        grid[vPos][hPos] = vEdge;
        vPos++;
    }

    grid[vPos][hPos] = rightEdge;
}

void drawTree(Tree t, char** grid, int vOffset, int hOffset) {
    if (t == NULL) {
        return;
    }

    drawData(t, grid[vOffset], hOffset);
    drawLeftEdge(t, grid, vOffset, hOffset);
    drawRightEdge(t, grid, vOffset, hOffset);
    int newVOffset = vOffset + vMargin + 3;
    drawTree(left(t), grid, newVOffset, hOffset);
    drawTree(right(t), grid, newVOffset, hOffset + t->drawPos + numDigits(data(t)) + hMargin);
}

void showTreeD(Tree t) {
    if (t == NULL) {
        return;
    }

    int h = t->height * (vMargin + 3) + 1; // put a minimum of 2 lines between levels
    int w = t->drawWidth;
    char** grid = malloc(h * sizeof(char*));
    assert(grid != NULL);
    
    for (int i = 0; i < h; i++) {
        grid[i] = malloc(w * sizeof(char));
        assert(grid[i] != NULL);

        for (int j = 0; j < w; j++) {
            grid[i][j] = ' ';
        }
    }

    drawTree(t, grid, 0, 0);

    for (int i = 0; i < h; i++) {
        for (int j = 0; j < w; j++) {
            putchar(grid[i][j]);
        }

        putchar('\n');
        free(grid[i]);
    }

    free(grid);
}

void showTree(Tree t) {
   calculateProperties(t);
   showTreeD(t);
}
</pre>
</div>
</li>

</ol>

<br/>
<h2>Assessment</h2>

<p>
<p>
After you've solved the exercises, go to <a href=https://moodle.telt.unsw.edu.au/mod/quiz/view.php?id=4203325>COMP9024 21T3 Quiz Week 7</a> to answer 5 quiz questions on this week's problem set and lecture.
</p>
<p>
The quiz is worth 2 marks.
</p>
<p>
There is no time limit on the quiz once you have started it, but the deadline for submitting your quiz answers is <b>Monday,
1 November 5:00:00pm</b>.
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
