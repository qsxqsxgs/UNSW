<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>COMP9024 21T3 - Week 8 Problem Set</title>
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
  <span class='heading'>Week 8 Problem Set</span><br/>
  <span class='subheading'>Balanced Search Trees</span>
</td>
<td align='right' width='25%'>
  <span class='heading'><img src="unsw.png"></span>
</td>
</table>
</div><p style='text-align:center;font-size:75%'><a href='/~cs9024/21T3/probs/prob8/index.php?view=qo'>[Show with no answers]</a> &nbsp; <a href='/~cs9024/21T3/probs/prob8/index.php?view=all'>[Show with all answers]</a></div>

<ol>

<br>
<li> (Rebalancing)

<p>
Trace the execution of <tt>rebalance(t)</tt> on the following tree. Show the tree after each rotate operation.
<center><img src="bst.png"></center>
</p>

<p><small>[<a id="q1a" href="##" onclick="toggleVisible('q1')">show answer</a>]</small></p>
<div id="q1" style="color:#000099;display:none">
<p>
In the answer below, any (sub-)tree <tt>t<sub>n</sub></tt> is identified by its root node <tt>n</tt>, e.g. <tt>t<sub>2</sub></tt> for the original tree.
</p>
<p>
Rebalancing begins by calling <tt>partition(t<sub>2</sub>,3)</tt> since the original tree has 6 nodes. The call to <tt>partition(t<sub>2</sub>,3)</tt> leads to a series of recursive calls: <tt>partition(t<sub>4</sub>,2)</tt>, which calls <tt>partition(t<sub>6</sub>,1)</tt>, which in turn calls <tt>partition(t<sub>8</sub>,0)</tt>. The last call simply returns <tt>t<sub>8</sub></tt>, and then the following rotations are performed to complete each recursive call:
<center><img src="bst-balance1.png"></center>
Next, the new left subtree <tt>t<sub>2</sub></tt> gets balanced via <tt>partition(t<sub>2</sub>,1)</tt>, since this subtree has 3 nodes. Calling <tt>partition(t<sub>2</sub>,1)</tt> leads to the recursive call <tt>partition(t<sub>4</sub>,0)</tt>. The latter returns <tt>t<sub>4</sub></tt>, and then the following rotation is performed to complete the rebalancing of subtree <tt>t<sub>2</sub></tt>:
<center><img src="bst-balance2.png"></center>
The left and right subtrees of <tt>t<sub>4</sub></tt> have fewer than 3 nodes, hence will not be rebalanced further. Rebalancing continues with the right subtree <tt>t<sub>10</sub></tt>. Since this tree also has fewer than 3 nodes, rebalancing is finished.
</p>
</li>

</div>
</li>

<br>
<li> (Splay trees)

<ol type="a">
<li>
<p> Show how a Splay tree would be constructed if the following values were inserted
into an initially empty tree in the order given:
</p>
<pre>
3 8 5 7 2 4
</pre>
</li>

<li>
<p> Let <tt>t</tt> be your answer to question a., and consider the following sequence of operations:
<pre>
SearchSplay(t,3)
SearchSplay(t,5)
SearchSplay(t,6)
</pre>
<p>
Show the tree after each operation.
</p>
</li>
</ol>
<p><small>[<a id="q2a" href="##" onclick="toggleVisible('q2')">show answer</a>]</small></p>
<div id="q2" style="color:#000099;display:none">
<ol type="a">
<li>
<p>
The following diagram shows how the tree grows:
</p>
<center><img src="splay-tree1.png"></center>
<p>
</li>
<li>
<p>
The following diagram shows how the tree changes with each search operation:
</p>
<center><img src="splay-tree2.png"></center>
</ul>
</div>
</li>

<br><li> (Lazy deletion)

<p>
There are (at least) two approaches to dealing with deletions from binary search trees.
The first, as used in lectures, is to remove the tree node containing
the deleted value and re-arrange the pointers within the tree.
The second is to not remove nodes, but simply to mark them as being
&quot;deleted&quot;.
</p>
<p>
For this question, assume that we are going to re-implement
Binary Search Trees so that they use mark-as-deleted rather than
deleting any nodes.
Under this scheme, no nodes are ever removed from the tree; instead,
when a value is deleted, its node remains (and continues to retain the
same value) but is marked so that it can be recognised as deleted.
</p>
<p>
To implement this idea of &quot;lazy&quot; deletion, consider the following modification to the BST data structure:
<pre class="answer">
typedef struct Node {
   <font color=blue>bool deleted;</font>
   int  data;
   Tree left, right;
   ...
} Node;
</pre>
</p>

<ol type="a">
<li>
<p>
Modify the <a href="https://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week7/slide025.html">search algorithm</a> (week 7 lecture)
for a &quot;conventional&quot; binary search tree to take into account deleted nodes.
</p>
</li>

<li>
<p>
One significant advantage of deletion-by-marking
is that it makes the deletion operation simpler.
All that deletion needs to do is search for a node containing the value
to be deleted. If it finds such a node, it simply &quot;marks&quot; it as deleted.
If it does not find such a node, the tree is unchanged.
</p>
<p>
Write a deletion algorithm that takes a BST <tt>t</tt> and a
value <tt>v</tt> and returns a new tree with the node with value <tt>v</tt> marked as deleted.
</p>                                                                       
</li>

<li>
<p>
Modify this week's Binary Search Tree ADT (<a href="http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week8/progs/BST.h"><tt>BST.h</tt></a>, <a href="http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week8/progs/BST.c"><tt>BST.c</tt></a>) from the lecture by an implementation of lazy deletion. Specifically, you should implement your answers to a. and b. by modifying
<ul>
<li> the data structure &nbsp;<tt>struct Node</tt>;
<li> the functions &nbsp;<tt>newNode(it)</tt>, <tt>TreeSearch(t,it)</tt>, <tt>TreeDelete(t,it)</tt>;
<li> the function &nbsp;<tt>TreeInsert(t,it)</tt>&nbsp; so that if &nbsp;<tt>it</tt>&nbsp; is already in the tree but marked as deleted, then it gets &quot;un-deleted.&quot;
</ul>
<p>Do <i>not</i> change <tt>BST.h</tt>.</p>
</li>
</ul>

<p>
You can test your program with the <a href="http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week8/progs/treeLab.c"><tt>treeLab.c</tt></a> client from the lecture. An example of the program executing is shown below.
<pre class="command_line">
<kbd class="shell">./treeLab</kbd>

> i 20
New Tree:  #nodes = 1,    height = 0
20

> i 10
New Tree:  #nodes = 2,    height = 1
  20
  / 
 /  
10  

> s 10
Found!

> d 10
New Tree:  #nodes = 2,    height = 1
  20
  / 
 /  
10  

> s 10
Not found

> q
Bye.
</pre>
</p>
<p>As you can see, node <tt>10</tt> is still in the tree after deleting it, but <tt>TreeSearch()</tt> returns <tt>false</tt> when searching for this value after it has been marked as deleted.</p>

<p><i>We have created a script that can automatically test your program. To run this test you can execute the </i><tt>dryrun</tt><i> program that corresponds to this exercise. It expects to find the file named </i><tt>BST.c</tt><i> in the current directory with your implementation of lazy deletion.
</p>
<p>You can use dryrun as follows:</i></p>
<pre class="command_line">
<kbd class="shell">9024 dryrun BST</kbd>
</pre>
</p>
</li>
</ol>

<p><small>[<a id="q3a" href="##" onclick="toggleVisible('q3')">show answer</a>]</small></p>
<div id="q3" style="color:#000099;display:none">
<ol type="a">

<li>
<p>
The following algorithm ignores nodes that have been deleted:
</p>
<pre>
TreeSearch(tree,item):
|  <b>Input</b>  tree, item
|  <b>Output</b> true if item found in tree, false otherwise
|
|  <b>if</b> tree is empty <b>then</b>
|     <b>return</b> false
|  <b>else if</b> item&lt;data(tree) <b>then</b>
|     <b>return</b> TreeSearch(left(tree),item)
|  <b>else if</b> item&gt;data(tree) <b>then</b>
|     <b>return</b> TreeSearch(right(tree),item)
|  <b>else</b>      // found =&gt; check if node has been deleted
|     <b>if</b> tree.deleted <b>return</b> false
|                <b>else return</b> true
|  <b>end if</b>
</pre>

<li>
<p>
The following simple function implements deletion-by-marking:
</p>
<pre>
TreeDelete(t,v):
|  <b>Input</b></b>  tree t, value v
|  <b>Output</b> t with v deleted
|
|  <b>if</b> t is not empty <b>then</b>      // nothing to do if tree is empty
|  |  <b>if</b> v&lt;data(t) <b>then</b>        // delete v in left subtree
|  |     left(t)=TreeDelete(left(t),item)
|  |  <b>else</b> <b>if</b> v&gt;data(t) <b>then</b>   // delete v in right subtree
|  |     right(t)=TreeDelete(right(t),item)
|  |  <b>else</b>                     // mark 't' as deleted
|  |     t.deleted=true
|  |  <b>end</b> <b>if</b>
|  <b>end</b> <b>if</b>
|  <b>return</b> t
</pre>

<li>
<p>
<pre class="answer">
typedef struct Node {
   bool deleted;

   int  data;
   Tree left, right;
   ...
} Node;

#define deleted(t) ((t)->deleted)

// make a new node containing data
Tree newNode(Item it) {
   Tree new = malloc(sizeof(Node));
   assert(new != NULL);
   data(new) = it;
   deleted(new) = false;                // mark new nodes as undeleted
   left(new) = right(new) = NULL;
   return new;
}

// check whether a key is in a Tree
bool TreeSearch(Tree t, Item it) {
   if (t == NULL)
      return false;
   else if (it < data(t))
      return TreeSearch(left(t), it);
   else if (it > data(t))
      return TreeSearch(right(t), it);
   else                                 // it == data(t)
      return (!deleted(t));             // return true only if t undeleted
}

// delete an item from a Tree
Tree TreeDelete(Tree t, Item it) {
   if (t != NULL) {
      if (it < data(t))
         left(t) = TreeDelete(left(t), it);
      else if (it > data(t))
         right(t) = TreeDelete(right(t), it);
      else
         deleted(t) = true;             // mark node as deleted
   }
   return t;
}

// insert a new item into a Tree
Tree TreeInsert(Tree t, Item it) {
   if (t == NULL)
      t = newNode(it);
   else if (it < data(t))
      left(t) = TreeInsert(left(t), it);
   else if (it > data(t))
      right(t) = TreeInsert(right(t), it);
   else
      deleted(t) = false;               // un-delete node
   return t;
}
</pre>
</p>
</li>

</ol>
</div>
</li>

<br><li> (AVL trees)

<p>
<i>Note: You should answer the following question without the help of the </i><tt>treeLab</tt><i> program from the lecture.</i>
</p>

<p> Show how an AVL tree would be constructed if the following values were inserted
into an initially empty tree in the order given:
</p>
<p>
<pre>
58 26 12 37 43 40
</pre>
</p>

<p><small>[<a id="q4a" href="##" onclick="toggleVisible('q4')">show answer</a>]</small></p>
<div id="q4" style="color:#000099;display:none">
<p>
The following diagram shows how the tree grows:
<center><img src="avl-tree.png"></center>
</p>
Imbalances happen:
<ul>
<li> when 12 is inserted, which triggers a right rotation at the root;
<li> when 43 is inserted, which triggers a left rotation at 37 followed by a right rotation at 58;
<li> when 40 is inserted, which triggers a right rotation at 43 followed by a left rotation at the root.
</ul>
<p/>
</div>
</li>

<br><li> (Lazy deletion in AVL trees)

<p>
The most problematic aspect of deletion-by-marking is insertion of new values.
If handled naively, the tree grows as if it contains <i>n+d</i>
values, where <i>n</i> is the number of nodes containing
undeleted values and <i>d</i> is the number of nodes containing
deleted values. If many values are deleted, then the tree
becomes significantly larger than necessary.
</p>
<p>
A more careful approach to insertion can help to limit the growth
of the tree by re-using nodes containing deleted values, <i>even when using them with a different value</i>.
Modify the algorithm for <a href="https://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week8/slide041.html">AVL tree insertion</a>
from the lecture to re-use deleted nodes wherever possible.
</p>
<p><i>Hint:</i> Solve in pseudocode only. You do <i>not</i> need to implement your solution in C.</p>

<p><small>[<a id="q5a" href="##" onclick="toggleVisible('q5')">show answer</a>]</small></p>
<div id="q5" style="color:#000099;display:none">
<p>
The algorithm below implements the following strategy:
<ul>
<li> if the value is already in the AVL tree, the tree is unchanged
<li> if there are no deleted nodes on the insertion path, insert as a leaf as normal and rebalance if necessary
<li> if a deleted node is found containing the value to be inserted, un-mark it
<li> if a deleted node is on the insertion path
   and if the value to be inserted is between the inorder predecessor and the
   inorder successor of the deleted node, then replace the value in that node
   by the new value, and un-mark it
</ul>
</p>
<p>
<pre>
min(t):
|  <b>Input</b>  tree t
|  <b>Output</b> minimum value in t
|
|  <b>while</b> left(t) not empty <b>do</b>
|     t=left(t)
|  <b>return</b> data(t)

max(t):
|  <b>Input</b>  tree t
|  <b>Output</b> maximum value in t
|
|  <b>while</b> right(t) not empty <b>do</b>
|     t=right(t)
|  <b>return</b> data(t)

insertAVL(t,v):
|  <b>Input</b>  tree t, value v
|  <b>Output</b> t with item AVL-inserted
|
|  <b>if</b> t is empty <b>then</b>
|     <b>return</b> new node containing v
|  <b>else</b> <b>if</b> v=data(t) <b>then</b>
|     <b>return</b> t
|  <b>else</b> <b>if</b> t.deleted and max(left(t))&lt;v&lt;min(right(t)) <b>then</b>
|     data(t)=v
|     t.deleted=false
|  <b>else</b>
|  |  <b>if</b> v&lt;data(t) <b>then</b>
|  |     left(t)=insertAVL(left(t),v)
|  |  <b>else</b> <b>if</b> v&gt;data(t) <b>then</b>
|  |     right(t)=insertAVL(right(t),v)
|  |  <b>end</b> <b>if</b>
|  |  <b>if</b> height(left(t))-height(right(t)) &gt; 1 <b>then</b>
|  |     <b>if</b> v&gt;data(left(t)) <b>then</b>
|  |        left(t)=rotateLeft(left(t))
|  |     <b>end</b> <b>if</b>
|  |     t=rotateRight(t)
|  |  <b>else</b> <b>if</b> height(right(t))-height(left(t)) &gt; 1 <b>then</b>
|  |     <b>if</b> v&lt;data(right(t)) <b>then</b>
|  |        right(t)=rotateRight(right(t))
|  |     <b>end</b> <b>if</b>
|  |     t=rotateLeft(t)
|  |  <b>end</b> <b>if</b>
|  |  <b>return</b> t
|  <b>end</b> <b>if</b>
</pre>
</p>
</div>
</li>

<br><li> (2-3-4 trees)

<p>
Show how a 2-3-4 tree would be constructed if the following values were inserted
into an initially empty tree in the order given:
</p>
<pre>
1 2 3 4 5 8 6 7 9 10
</pre>
<p>
Once you have built the tree, count the number of comparisons needed to search for each of the following values in the tree:
</p>
<p>
<pre>
1  7  9  13
</pre>
</p>

<p><small>[<a id="q6a" href="##" onclick="toggleVisible('q6')">show answer</a>]</small></p>
<div id="q6" style="color:#000099;display:none">
<p>
The following diagram shows how the tree grows:
</p>
<center><img src="234-tree.png"></center>
<p>
Search costs (for tree after insertion of 10):
</p>
<p>
<ul>
<li> search(1): cmp(4),cmp(2),cmp(1) &nbsp;&rArr; cost = 3
<li> search(7): cmp(4),cmp(6),cmp(8),cmp(7) &nbsp;&rArr; cost = 4
<li> search(9): cmp(4),cmp(6),cmp(8),cmp(9) &nbsp;&rArr; cost = 4
<li> search(13): cmp(4),cmp(6),cmp(8),cmp(9),cmp(10) &nbsp;&rArr; cost = 5
</ul>
</p>
</div>
</li>

<br><li> (Red-black trees)
<ol type="a">
<li>
<p>
Show how a red-black tree would be constructed if the following values were inserted
into an initially empty tree in the order given:
</p>
<pre>
1 2 3 4 5 8 6 7 9 10
</pre>
<p>
Once you have built the tree, compute the cost (#comparisons) of searching for
each of the following values in the tree:
</p>
<pre>
1  7  9  13
</pre>
</li>

<li>
<p>
Implement the pseudocode for Red-Black Tree Insertion from the lecture (<a href="http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week8/slide070.html">slides 70&ndash;74</a>) in our Red-Black Tree ADT (<a href="http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week8/progs/RBTree.h"><tt>RBTree.h</tt></a>, <a href="http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week8/progs/RBTree.c"><tt>RBTree.c</tt></a>) as the function:
</p>
<pre>
Tree TreeInsert(Tree t, Item it) { ... }
</pre>
<p><b>Note:</b> Ensure that you implement the pseudocode from the lecture. Other algorithms will not score full marks for this exercise even if they also result in the correct insertion of the new element.</p>

<p>
<p><i>We have created a script that can automatically test your program. To run this test you can execute the </i><tt>dryrun</tt><i> program that corresponds to this exercise. It expects to find the file named </i><tt>RBTree.c</tt><i> in the current directory with your implementation of the function </i><tt>TreeInsert()</tt>.
</p>
<p>You can use dryrun as follows:</i></p>
<pre class="command_line">
<kbd class="shell">9024 dryrun RBTree</kbd>
</pre>
</p>
</li>
</ol>

<p><small>[<a id="q7a" href="##" onclick="toggleVisible('q7')">show answer</a>]</small></p>
<div id="q7" style="color:#000099;display:none">
<ol type="a">
<li>
<p>
The following diagrams shows how the tree grows:
</p>
<center><img src="rb-tree.png"></center>
<p>
Search costs: The number of comparisons needed to search for a node is 1 + the level of the node in the final red-black tree:
<center><img src="rb-tree-final.png"></center>
<ul>
<li> search(1): cost = 3
<li> search(7): cost = 4
<li> search(9): cost = 4
<li> search(13): cost = 5
</ul>
<p>
Note that the resulting red-black tree corresponds to the 2-3-4 tree from Exercise 5, with identical search costs.
</p>
</li>

<li>
<p>
<pre class="answer">
Tree insertRB(Tree t, Item it, bool inRight) {
   if (t == NULL)
      return newNode(it);
   if (it == data(t))
      return t;
   if ( NodeIsRed(left(t)) &amp;&amp; NodeIsRed(right(t)) ) {
      colour(left(t)) = BLACK;
      colour(right(t)) = BLACK;
      colour(t) = RED;
   }
   if (it &lt; data(t)) {
      left(t) = insertRB(left(t), it, false);
      if (NodeIsRed(t) &amp;&amp; NodeIsRed(left(t)) &amp;&amp; inRight) {
         t = rotateRight(t);
      }
      if ( NodeIsRed(left(t)) &amp;&amp; NodeIsRed(left(left(t))) ) {
         colour(t) = RED;
         colour(left(t)) = BLACK;
         t = rotateRight(t);
      }
   } else {
      right(t) = insertRB(right(t), it, true);
      if ( NodeIsRed(t) &amp;&amp; NodeIsRed(right(t)) &amp;&amp; !inRight ) {
         t = rotateLeft(t);
      }
      if ( NodeIsRed(right(t)) &amp;&amp; NodeIsRed(right(right(t))) ) { 
         colour(t) = RED;
         colour(right(t)) = BLACK;
         t = rotateLeft(t);
      }
   }
   return t;
}

Tree TreeInsert(Tree t, Item it) {
   t = insertRB(t, it, false);
   colour(t) = BLACK;
   return t;
}
</pre>
</p>
</li>
</ol>
</div>
</li>

<br>
<li><b>Challenge Exercise</b>
<p>
Extend the BST ADT from the lecture (<a href="http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week8/progs/BST.h"><tt>BST.h</tt></a>, <a href="http://www.cse.unsw.edu.au/~cs9024/21T3/lecs/week8/progs/BST.c"><tt>BST.c</tt></a>) by an implementation of the function
</p>
<pre>
deleteAVL(Tree t, Item it)
</pre>
<p>
to properly delete an element from an AVL tree (as opposed to lazy deletion, cf. Exercise 3) while maintaining balance.
</p>
<p><small>[<a id="q8a" href="##" onclick="toggleVisible('q8')">show answer</a>]</small></p>
<div id="q8" style="color:#000099;display:none">
<p>
The following algorithms implements standard BST deletion and then repairs any imbalanes in the same ways as AVL insertion does.
</p>
<pre class="answer">
Tree AVLrepair(Tree t) {
   int hL  = TreeHeight(left(t));
   int hLL = TreeHeight(left(left(t)));
   int hLR = TreeHeight(right(left(t)));
   int hR  = TreeHeight(right(t));
   int hRL = TreeHeight(left(right(t)));
   int hRR = TreeHeight(right(right(t)));
   if (hL-hR &gt; 1) {
      if (hLR-hLL &gt; 1)
         left(t)=rotateLeft(left(t));      // left-right case
      t = rotateRight(t);
   } else if (hR-hL &gt; 1) {
      if (hRL-hRR &gt; 1)
         right(t)=rotateRight(right(t));   // right-left case
      t = rotateLeft(t);
   }
   return t;
}

Tree deleteAVL(Tree t, Item it) {
   if (t != NULL) {
      if (it < data(t)) {
         left(t) = TreeDelete(left(t), it);
	 t = AVLrepair(t);
      } else if (it > data(t)) {
         right(t) = TreeDelete(right(t), it);
	 t = AVLrepair(t);
      } else {
         Tree new;
         if (left(t) == NULL &amp;&amp; right(t) == NULL)
            new = NULL;
         else if (left(t) == NULL)    // if only right subtree, make it the new root             
            new = right(t);
         else if (right(t) == NULL)   // if only left subtree, make it the new root              
            new = left(t);
         else {                       // left(t) != NULL and right(t) != NULL                    
            new = joinTrees(left(t), right(t));
	    new = AVLrepair(new);
	 }
         free(t);
         t = new;
      }
   }
   return t;
}
</pre>
</div>
</li>
</ol>

<br>
<h2>Assessment</h2>

<p>
Submit your solutions to <b>Exercises 3 and 7</b> using the following <b>give</b> command:
</p>
<pre class="command_line">
<kbd class="shell">give cs9024 week8 BST.c RBTree.c</kbd>
</pre>
<p>
Make sure you spell the filenames correctly. You can run <b>give</b> multiple times. Only your last submission will be marked.
</p>
<p>
The deadline for submission is <b>Monday,
8 November 5:00:00pm</b>.
</p>
<p>
Each program is worth 1 mark. Total marks = 2. Auto-marking will be run by the lecturer several days after the submission deadline using different test cases than <tt>dryrun</tt> does.
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
