/*
Author: Ankita Mistry
Program: Simple calculator program using if-else statements.
*/

#include <stdio.h>

int main(){

	//Declare variables.	
	int a;         // Stores the value of a.
	int b;         // Stores the value of b.
	int x;         // Stores the value of x.
	float result;  // Stores the value of result for selected operation.

	printf("Welcome to calculator program in C language.\n");
	printf("Please enter input value of a: ");
	scanf("%d", &a);
	printf("Please enter input value of b: ");
	scanf("%d", &b);
	printf("Please select task you want to perform on the calculator.\n");
	printf("Please select\n 1 for addition\n 2 for substraction\n 3 for multiplication\n 4 for division\n 5 for mode.\n");
	printf("Please enter value for the task to be performed: ");
	scanf("%d", &x);
	
	
	//Loop to perform tasks.
	if(x == 1){
		//If number entered is 1, perform addition for given values.
		result = (a + b);
	}else if(x == 2){
		//If number entered is 2, perform substraction for given values.
		result = (a - b);
	}else if(x == 3){
		//If number entered is 3, perform multiplication for given values.
		result = (a * b);
	}else if(x == 4){
		//If number entered is 4, perform division for given values.
		result = (a / b);
	}else if(x == 5){
		//If number entered is 5, perform mode for given values.
		result = (a % b);

	}else{
		//For invalid input for value of x, print following message.
		printf("Invalid input. Please select number between 1 to 5.\n");
	}


	printf("The result of operation is %f\n", result);

	return 0;
}
