/*
Author: Ankita Mistry
Program: This program converts celsius temperature to fahreheit and fahrenheit temperature to celcius using if-else statements.
*/

#include <iostream>
using namespace std;

int main()
{
	// Declare variables.
	float t;
	float temp;
	char option;

	cout << "This program converts celsius temperator to fahreheit and fahrenheut temperator to celcius." << endl;
	cout << "Select C for temperature to convert in celsius or F to convert into fahrenheit:";
	cin >> option;
	cout << "Enter the temperature you want to convert:";
	cin >> t;

	//Perform Loops.
	if(option == 'C') {
		// Convert fahrenheit temperature equivalent to celsius.
		temp = (((t - 32) * 5) / 9);
	}
	else if(option == 'F') {
		// Convert celsius temperature equivalent to fahrenheit.
		temp = ((1.8 * t) + 32);
	}
	else {
		cout << "Invalid option input." << endl;
	}

	cout << "The equivalent temperature is: " << temp << endl;

	return 0;
}
