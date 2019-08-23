/*
Author: Ankita Mistry
Program: This program performs bitshifting for entered integer and 
convert shifted integer value to binary format.
*/

#include <stdio.h>

int main(){
	// Declare variables.
	char pos;    // Store char value for bit shifing position.
	int a;       // Stores the value of a for bitshifting operation.
	int b;       // Stores the b value for bit shifing position.
	int c[32];   // Stores the value for array for 32-bit binary number.
	int i;       // Stores value loop counter.
	int j;       // Stores value loop counter.
	int result;  // Stores final result.

	printf("Enter 'L' for shifting Left or 'R' for shifting Right: ");
	scanf("%c", &pos);
	printf("Enter an interger value for bitshifting operation: ");
	scanf("%d", &a);
	printf("Enter the value by how many places you want to shift the integer: ");
	scanf("%d", &b);

	// Loop to perfrom task.
	if(pos == 'L'){
	//If selected position is left, than shift bits to left.
		result = a << b;
	}else if(pos == 'R'){
	//If selected position is right, than shift bits to right.	
		result = a >> b;
	}else{
	//For invalid input, print following message.
		printf("Invalid input. Please enter L or R.\n");
	}

	printf("The shifted value is: %d\n", result);

	// Convert decimal result value to binary number.
	i = 0;
	while (result > 0){
		// Store modulus value of result in c[i] array (Store reaminder value.)
		c[i] = (result % 2);
		// Divide result in half, so modulus is 0 here.
		result  = (result / 2);
		i++;
	}

	printf("The decimal to binary conversation for shifted value is: ");
	for(j = i - 1; j >= 0; j--){
		printf("%d", c[j]);
	}
	
	printf("\n");
	
	return 0;
}
