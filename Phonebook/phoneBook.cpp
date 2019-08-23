/*
Author: Ankita Mistry
Program: This is phonebook program. It allows user to add and delete entry from the phonebook.
*/

#include <iostream>
#include <string>
#include <array>
using namespace std;

#define MAX_SIZE 10;

struct Phone {
	string name;
	long long contact_number;
};

//Declare Functions.
void DisplayPhonebook(Phone entry[]);
void Delete(Phone entry[]);
void Add(Phone entry[]);

int main()
{
	// Declare variables.
	Phone person[10];
	int option;
 
    // Initialize phonebook elements null.
	for (int a = 0; a < 10; a++) {
		person[a].name = "";
		person[a].contact_number = 0;
	}
    // Add entry to Phonebook.
	for (int i = 0; i < 2; i++) {
		cout << "Enter person's first and last name: " << endl;
		getline(cin, person[i].name); // To store name with space.
		cout << "Enter person's contact number: " << endl;
		cin >> person[i].contact_number;
		cin.ignore();// To terminate (/n) charecter and able enter name each time loops.
	}
	
	cout << "Select:" << endl;
	cout << "1 to add entry in phonebook" << endl;
	cout << "2 to delete an entry from phonebook" << endl;
	cin >> option;
	cin.ignore();
	
	if (option == 1) {
		Add(person);
	}else if (option == 2){
		Delete(person);
	}else {
	cout << "invalid input." << endl; 
	}
	
	return 0;
}

//Function: DisplayPhonebook()
//inputs:
//	None
// output:
//	Prints out array elements.
void DisplayPhonebook(Phone entry[]) {
	//Prints phonebook entries.
	cout << "Person's name:  " << "Person's contact number: " << endl;
	for (int j = 0; j < 10; j++) {
		cout << "Element" << j << " " << entry[j].name << " " << entry[j].contact_number << endl;
	}
}

// Function: Delete()
//inputs:
//	integer number stores in position variable to delete particular emlement in phonebook.
// output:
//	Delete Phonebbok entry stored in position varibale. Prints out array elements.

void Delete(Phone entry[]) {
	int position;
	cout << "Enter the number between 0 to 9 to delete a phone entry: " << endl;
	cin >> position;

	entry[position].name = "";
	entry[position].contact_number = 0;
	DisplayPhonebook(entry);
}

// Function: Add()
//inputs:
//	x = integer value to run for loop to search and empty phoneboon entry.
// output:
//	Add new entry in phonebook. Prints out phonebook entries.


void Add(Phone entry[]) {
	// Check for empty phonebook entry.
	int x = 0; 
	while ((entry[x].name != "") && (entry[x].contact_number != 0) && (x < 10)) {
		x++;
		if ((entry[x].name == "") && (entry[x].contact_number == 0)) {
			break;
		}
		
	}
	// Add new entry in phonebook.
	cout << x << " Enter Name:" << endl;
	getline(cin,entry[x].name);
	cout << "Enter Contact Number: " << endl;
	cin >> entry[x].contact_number;
	cin.ignore();
	DisplayPhonebook(entry);
}