/*
Author: Ankita Mistry
Program: Simple calculator program using struct.
*/

#include <stdio.h>

struct calc{
	int a;  // Stores the value of a.
	int b;	// Stores the value of b.
} value;

struct result{
 	int add;        // Stores the result for addition operation.
	int substract;  // Stores the result for substraction operation.
	int multiply;   // Stores the result for multiplication operation.
	float divide;   // Stores the result for division operation.
	int mode;       // Stores the result for modulus operation.
} final;

int main(){
	printf("Welcome to calculator program in C language.\n");
	printf("Please enter input value of a: ");
	scanf("%d", &value.a);
	printf("Please enter input value of b: ");
	scanf("%d", &value.b);
	
	// Addition operation
	final.add = (value.a + value.b);
	printf("The addition of two integer is: %d\n", final.add);

	// Substraction operation
	final.substract = (value.a - value.b);
	printf("The substraction of two integer is: %d\n", final.substract);

	// Multiply operation
	final.multiply = (value.a * value.b);
	printf("The multiplication of two integer is: %d\n", final.multiply);

	// Divide operation
	final.divide = (value.a / value.b);
	printf("The division of two integer is: %f\n", final.divide);

	// Modulus operation
	final.mode = (value.a % value.b);
	printf("The modulus of two integer is: %d\n", final.mode);


	return 0;


}
