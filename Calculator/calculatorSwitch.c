/*
Author: Ankita Mistry
Program: Simple calculator program using switch statements.
*/

#include <stdio.h>

// Declare  global defines.
#define ADDDITON 1
#define SUBSTRACTION 2
#define MULTIPLICATION 3
#define DIVISION 4
#define MODULUS 5

int main(){

	//Declare variables.	
	int a;
	int b;
	int x;
	float result;
	
	printf("Welcome to calculator program in C language.\n");
	printf("Please enter input value of a: ");
	scanf("%d", &a);
	printf("Please enter input value of b: ");
	scanf("%d", &b);
	printf("Please select task you want to perform on the calculator.\n");
	printf("Please select\n 1 for addition\n 2 for substraction\n 3 for multiplication\n 4 for division\n 5 for mode.\n");
	printf("Please enter value for the task to be performed: ");
	scanf("%d", &x);

	
	//Use switch statements.
	switch(x)
	{
		case 1 : 
			// Addition of two values.
			result = (a + b);
			break;
		case 2 : 
			// substraction of two values.
			result = (a - b);
			break;
		case 3 : 
			// Multiplication of two values.
			result = (a * b);
			break;
		case 4 : 
			// Division of two values.
			result = (a / b);
			break;
		case 5 :
			// Modulus of two values. 
			result = (a % b);
			break;
		default : 
			// If enetred inout is other than 1 to 5 number, this statement will print.
			printf("Invalid input.\n"); 
	}

	printf("The result of operation is %f\n", result);

	return 0;
}
