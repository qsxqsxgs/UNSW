// Approximation Algorithm implementation ... COMP9024 21T3

#include <stdio.h>
#include <math.h>

double bisection(double (*f)(double), double x, double y) {
  double mid = (x + y) / 2;
  while (f(mid) != 0 && (y - x) > pow(10,-10)) {
    if (f(x) * f(mid) < 0)
      y = mid;
    else
      x = mid;
    mid = (x + y) / 2;
  }
  return mid;
}

int main() {
  double result = bisection(tan, 2.0, 4.0);
  printf("%.10f", result);
  return 0;
}