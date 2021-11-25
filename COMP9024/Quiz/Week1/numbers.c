#include <stdio.h>

int main() {
  int a,b,c,d,e;
  int pre,aft;
  for (a = 0; a < 10; a++) 
    for (b = 0; b < 10; b++) 
      for (c = 0; c < 10; c++) 
        for (d = 0; d < 10; d++)
          for (e = 0; e < 10; e++) {
            pre = 10000*a + 1000*b + 100*c + 10*d + e;
            aft = 10000*e + 1000*d + 100*c + 10*b + a;
            if (4 * pre == aft && pre != 0)
              printf("%d\n", pre);
          }
}