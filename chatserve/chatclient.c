/********************************************************/
/* Name: Ankita Mistry                                  */
/* Class: CS372                                         */
/* Project: Project 1 "Client-Server application"        */
/********************************************************/

#include <stdio.h>
#include <string.h>
#include <sys/socket.h>
#include <arpa/inet.h>
#include <netdb.h>     // need it for getaddrinfo()

#define MESSAGE_SIZE      1024
char quitmessage[17] = "chatclient> \\quit";

/***********************************************************/
/* Function: commands_valid                                */
/* Description: parses the command arguments for validity  */
/***********************************************************/
int commands_valid(int argc, char * argv[])
{
    // check for valid arguments
    // - there must be 2 arguments (not counting program name argv[0])
    // - hostname in argv[1] must be not be all numeric
    // - port number in argv[2] must be all numeric
    if((argc != 3) || (atoi(argv[1]) != 0) || (atoi(argv[2]) == 0))
    {
        // display usage when there are invalid arguments
        printf("usage: chatclient [hostname] [port]\n");
        return -1;
    } else {
        return 0;
    }
}

/***********************************************************/
/* Function: initiate_contact                              */
/* Description: sets up connection with the server using   */
/*              the socket APIs over TCP                   */
/***********************************************************/
int initiate_contact(int *clientSocket, char* argv[])
{
    int status;
    struct addrinfo hints, *result, *rp;

    // reference code from http://man7.org/linux/man-pages/man3/getaddrinfo.3.html
    memset(&hints, 0, sizeof(struct addrinfo));
    hints.ai_family = AF_INET;
    hints.ai_socktype = SOCK_STREAM;
    hints.ai_flags = 0;
    hints.ai_protocol = 0;

    status = getaddrinfo(argv[1], argv[2], &hints, &result);
    if (status != 0)
    {
        printf("Error: hostname parsing error\n");
        return -1;
    }

    // getaddrinfo() returns a list of address structures.
    // Try each address until we successfully connect.
    for (rp = result; rp != NULL; rp = rp->ai_next)
    {
        // create a socket
        *clientSocket = socket(result->ai_family , result->ai_socktype, result->ai_protocol);
        if (*clientSocket == -1)
        {
            // try another socket from address structure
            printf("Error: could not create a socket\n");
            continue;
        }

        // connect to server using socket
        if (connect(*clientSocket , result->ai_addr, result->ai_addrlen) == -1)
        {
            printf("Error: server connect error\n");
            close(*clientSocket);
        } else {
            printf("Connected to server\n");
            break;
        }
    }

    // free addressinfo since it's no longer needed
    freeaddrinfo(result);

    // check if we exhausted the address structure without connection
    if(rp == NULL)
    {
        // report failure
        return -1;
    }

    // report success connection to server
    return 0;
}

/***********************************************************/
/* Function: send_message                                  */
/* Description: sends message to server                    */
/***********************************************************/
int send_message(int *clientSocket)
{
    int status;
    char message[MESSAGE_SIZE];

    // get user input
    memset(message, 0, MESSAGE_SIZE);
    strcat(message, "chatclient> ");
    printf("chatclient> ");
    fgets(&message[12], MESSAGE_SIZE-1, stdin);

    // strip the trailing new line because enter key
    // does not count as a message
    if (message[strlen(message)-1] == '\n')
    {
        message[strlen(message) - 1] = '\0';
    }

    // check if client wants to quit
    if(strncmp(message, quitmessage, sizeof(quitmessage)) == 0)
    {
        printf("User issued quit command.  Exiting client application.\n");
        return -1;
    }

    // send the message to server
    status = send(*clientSocket , message , strlen(message) , 0);
    if(status == -1)
    {
        printf("Send failed\n");
        return -1;
    }

    // send successful
    return 0;
}

/***********************************************************/
/* Function: recv_message                                  */
/* Description: receives message from server               */
/***********************************************************/
int recv_message(int *clientSocket)
{
    int status;
    char message[MESSAGE_SIZE];

    // read message from server
    memset(message, 0, MESSAGE_SIZE);
    status = read(*clientSocket, message, MESSAGE_SIZE-1);
    if(status <= 0)
    {
         printf("Error: reading from server\n");
         return -1;
    }

    // quit once server sends a "\quit" command
    if(strncmp(message, quitmessage, sizeof(quitmessage)) == 0)
    {
        printf("Server send quit command\n");
        return -1;
    }

    printf("%s\n", message );
    return 0;
}

/***********************************************************/
/* Function: main                                          */
/* Description: main routine of the server-client program  */
/***********************************************************/
int main(int argc , char *argv[])
{
    int clientSocket, n;

    // check for valid arguments
    if(commands_valid(argc, argv) == -1)
    {
        // exit program when no valid commands
        return 0;
    }

    // establish connection with server
    if(initiate_contact(&clientSocket, argv) == -1)
    {
        // exit program when no connection to server
        return 0;
    }

    // perform client <> server communication
    do
    {
        // send message to server
        if(send_message(&clientSocket) == -1)
        {
            // exit program when there is send failure
            break;
        }

        // receive message from server
        if(recv_message(&clientSocket) == -1)
        {
            // exit program when there is receive failure
            break;
        }
    } while(1);  

    // free the socket connection
    close(clientSocket);
    return 0;
}