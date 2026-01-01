#include <stdio.h>

int main() {
    FILE *f = fopen("input.json","r");
    int n;
    fscanf(f, "{ \"number\": %d }", &n);
    fclose(f);

    FILE *o = fopen("c.json","w");
    fprintf(o, "{ \"c\": %d }", n * n);
    fclose(o);
}
