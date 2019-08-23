/*
Author: Ankita Mistry
Program: Simple calculator program using functions.
*/

#include <stdio.h>

// Declare functions.
int add(int a, int b);
int substract(int a, int b);
int multiply(int a, int b);
float divide(int a, int b);
int mode(int a, int b);

int main(){
	// Declare variables.
	int a;
	int b;
	float result;

	printf("Welcome to calculator program in C language.\n");
	printf("Please enter input value of a: ");
	scanf("%d", &a);
	printf("Please enter input value of b: ");
	scanf("%d", &b);
	
	// Function calls in statements.	

	printf("The addition of two intergers is: %d\n",  add(a,b));
	printf("The substraction of two intergers is: %d\n",  substract(a,b));
	printf("The multiplication of two intergers is: %d\n",  multiply(a,b));
	printf("The division of two intergers is: %f\n",  divide(a,b));
	printf("The mode of two intergers is: %d\n",  mode(a,b));

	return 0;
	
 
}

// Funtion: add()
// inputs:
//	a - first value
//	b - second value
// output:
//	return - sum of two values

int add(int a, int b){
	return  (a + b);
}

// Funtion: substarct()
// inputs:
//	a - first value
//	b - second value
// output:
//	return - substraction of two values

int substract(int a, int b){
	return  (a - b);
}

// Funtion: multiply()
// inputs:
//	a - first value
//	b - second value
// output:
//	return - multiplication of two values

int multiply(int a, int b){
	return  (a * b);
}

// Funtion: divide()
// inputs:
//	a - first value
//	b - second value
// output:
//	return - division of two values

float divide(int a, int b){
	return  (a / b);
}

// Funtion: mode()
// inputs:
//	a - first value
//	b - second value
// output:
//	return - modulus of two values

int mode(int a, int b){
	return  (a % b);
}
