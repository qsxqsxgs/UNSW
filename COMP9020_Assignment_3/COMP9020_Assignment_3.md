# Assignment 3

<center>Sixiang Qiu</center>

<center>November 2021</center>

## Problem 1

![img/Problem_1.png](img/Problem_1.png)

### (a)

Given that two matrices are both $n \times n$, and adding elements take $O(1)$ time,

In the inner loop of  $sum(A,B)$, each loop takes $O(1)$ time.

Then, the inner loop can be carried out in $O(n)$ time.

For the whole function which is the inner loop nested with an outer one, it can be carried out in $O(n^2)$ time.

Therefore, the asymptotic upper bound for the running time of sum is $O(n^2)$.

### (b)

Given that two matrices are both $n \times n$, and multiplying elements take $O(1)$ time,

$A[i,k]*B[k,j]$ for $k \in [0,n)$ can be carried out in $O(1)$ time.

'Add' instruction adds all elements in the set above which is of size $n$.

The time complexity for 'add' instruction in function $product(A,B)$ is $O(n)$.

Same as question(a), 'add' instruction is also nested with two for loops.

Each of them runs for $n$ times.

Therefore, the asymptotic upper bound for the running time of product is $O(n^3)$.

### (c)

![](img/Figure_1.png)

In the above figure, it is easy to count that, in each recursion,

8 multiplications are done for matrices which are of size $\frac{n}{2} \times \frac{n}{2}$ and 4 additions as well.

The time complexity analysis for multiplication is passed to the next recursion.

While, addition of two takes $O(n^2)$ time, given in question(a).

Therefore, the recurrence equation for $T(n)$​ is defined below:
$$
T(n)=8\cdot T(\frac{n}{2})\ +\ O(n^2)
$$

### (d)

![](img/Definition_1.png)

From the definition of Master Theorem, for recurrence equation in question(c):
$$
a=8\\
b=2\\
c=2\\
k=0
$$
Which is Case 1, $T(n)=\Theta(n^3)$,

Therefore, the asymptotic upper bound for $T(n)$ is $O(n^3)$.

## Problem 2

![](img/Problem_2.png)

### (a)

#### (i)

Mark the 8 houses by 8 characters as below:

![](img/Figure_2.png)

Each character represent 'House X uses channel 1'.

True means it is using channel 1 while false means it is using channel 2.

#### (ii)

Then the constraints, in this problem interference, are:
$$
p\equiv A\rightarrow (\urcorner B\ \wedge \urcorner E)
$$

$$
q\equiv B\rightarrow (\urcorner A\ \wedge \urcorner C\ \wedge \urcorner F)
$$

$$
r\equiv C\rightarrow (\urcorner B\ \wedge \urcorner D\ \wedge \urcorner G)
$$

$$
s\equiv D\rightarrow (\urcorner C\ \wedge \urcorner H)
$$

$$
t\equiv E\rightarrow (\urcorner A\ \wedge \urcorner F)
$$

$$
u\equiv F\rightarrow (\urcorner B\ \wedge \urcorner E\ \wedge \urcorner G)
$$

$$
v\equiv G\rightarrow (\urcorner C\ \wedge \urcorner F\ \wedge \urcorner H)
$$

$$
w\equiv H\rightarrow (\urcorner D\ \wedge \urcorner G)
$$

Truth values of them represent that there is no interference occurs.

#### (iii)

To solve the problem, define $\phi$​ as below:
$$
\phi \equiv p\ \wedge q\ \wedge r\ \wedge s\ \wedge t\ \wedge u\ \wedge v
\ \wedge w
$$
If $\phi$ is satisfiable, then the problem is solved. Otherwise, it cannot be done.

To list a truth table of $A,B,C,D,E,F,G,H$ and their constraints,

Omit those which turn their constraints to be all false.

That would also brings a satisfying result of $\phi$, but it is not the problem asking for.

#### (iv)

Since problem changed from solving with 3 channels rather than 2,

It becomes insufficient if only declaring $A,B,C,D,E,F,G,H$.

Each of them can be expanded to the form of $A{_1},A{_2},A{_3}$,

Which represents that 'House A is using channel 1 (2, 3)'.

Constraints should also time 3:
$$
A_1\rightarrow (\urcorner B_1\ \wedge \urcorner E_1)
$$

$$
A_2\rightarrow (\urcorner B_2\ \wedge \urcorner E_2)
$$

$$
A_3\rightarrow (\urcorner B_3\ \wedge \urcorner E_3)
$$

Similarly,
$$
\phi_1 \equiv p_1\ \wedge q_1\ \wedge r_1\ \wedge s_1\ \wedge t_1\ \wedge u_1\ \wedge v_1
\ \wedge w_1
$$

$$
\phi_2 \equiv p_2\ \wedge q_2\ \wedge r_2\ \wedge s_2\ \wedge t_2\ \wedge u_2\ \wedge v_2
\ \wedge w_2
$$

$$
\phi_3 \equiv p_3\ \wedge q_3\ \wedge r_3\ \wedge s_3\ \wedge t_3\ \wedge u_3\ \wedge v_3
\ \wedge w_3
$$

The problem becomes to find truth values to make these three true.

### (b)

All possible situation is $2^8=256$.

The situation with no interference is $2$.

Therefore, the probability is $\frac{1}{128}$.

## Problem 3

![](img/Problem_3.png)

### (a)

$$\begin{array}{rclr}
    (x \wedge  1 ' ) \vee  (x'  \wedge  1 )&=& ((x \wedge  1 ' ) \vee  x' ) \wedge  ((x \wedge  1 ' ) \vee  1 ) &\quad\text{(Distributivity of $\vee$ over $\wedge$)}\\
    &=& (x'  \vee  (x \wedge  1 ' )) \wedge  ((x \wedge  1 ' ) \vee  1 ) &\quad\text{(Commutatitivity of $\vee$)}\\
    &=& (x'  \vee  (x \wedge  1 ' )) \wedge  (1  \vee  (x \wedge  1 ' )) &\quad\text{(Commutatitivity of $\vee$)}\\
    &=& ((x'  \vee  x) \wedge  (x'  \vee  1 ' )) \wedge  (1  \vee  (x \wedge  1 ' )) &\quad\text{(Distributivity of $\vee$ over $\wedge$)}\\
    &=& ((x'  \vee  x) \wedge  (x'  \vee  1 ' )) \wedge  ((1  \vee  x) \wedge  (1  \vee  1 ' )) &\quad\text{(Distributivity of $\vee$ over $\wedge$)}\\
    &=& ((x \vee  x' ) \wedge  (x'  \vee  1 ' )) \wedge  ((1  \vee  x) \wedge  (1  \vee  1 ' )) &\quad\text{(Commutatitivity of $\vee$)}\\
    &=& (1  \wedge  (x'  \vee  1 ' )) \wedge  ((1  \vee  x) \wedge  (1  \vee  1 ' )) &\quad\text{(Complement with $\vee$)}\\
    &=& (1  \wedge  (x'  \vee  1 ' )) \wedge  ((1  \vee  x) \wedge  1 ) &\quad\text{(Complement with $\vee$)}\\
    &=& ((x'  \vee  1 ' ) \wedge  1 ) \wedge  ((1  \vee  x) \wedge  1 ) &\quad\text{(Commutatitivity of $\wedge$)}\\
    &=& (x'  \vee  1 ' ) \wedge  ((1  \vee  x) \wedge  1 ) &\quad\text{(Identity of $\wedge$)}\\
    &=& (x'  \vee  1 ' ) \wedge  (1  \vee  x) &\quad\text{(Identity of $\wedge$)}\\
    &=& (x \wedge  1 )'  \wedge  (1  \vee  x) &\quad\text{(De Morgan$'$s, $'$ over $\wedge$)}\\
    &=& x'  \wedge  (1  \vee  x) &\quad\text{(Identity of $\wedge$)}\\
    &=& x'  \wedge  (x \vee  1 ) &\quad\text{(Commutatitivity of $\vee$)}\\
    &=& x'  \wedge  1  &\quad\text{(Annihilation of $\vee$)}\\
    &=& x'  &\quad\text{(Identity of $\wedge$)}
\end{array}$$

### (b)

$$
\begin{array}{rclr}
    (x \wedge  y) \vee  x&=& (x \wedge  y) \vee  (x \wedge  1 ) &\quad\text{(Identity of $\wedge$)}\\
    &=& (x \wedge  1 ) \vee  (x \wedge  y) &\quad\text{(Commutatitivity of $\vee$)}\\
    &=& x \wedge  (1  \vee  y) &\quad\text{(Distributivity of $\wedge$ over $\vee$)}\\
    &=& x \wedge  (y \vee  1 ) &\quad\text{(Commutatitivity of $\vee$)}\\
    &=& x \wedge  1  &\quad\text{(Annihilation of $\vee$)}\\
    &=& x &\quad\text{(Identity of $\wedge$)}
\end{array}
$$

### (c)

$$
\begin{array}{rclr}
    y'  \wedge  ((x \vee  y) \wedge  x' )&=& ((x \vee  y) \wedge  x' ) \wedge  y'  &\quad\text{(Commutatitivity of $\wedge$)}\\
    &=& (x \vee  y) \wedge  (x'  \wedge  y' ) &\quad\text{(Associativity of $\wedge$)}\\
    &=& (x \vee  y) \wedge  (x \vee  y)'  &\quad\text{(De Morgan$'$s, $'$ over $\vee$)}\\
    &=& 0  &\quad\text{(Complement with $\wedge$)}
\end{array}
$$

