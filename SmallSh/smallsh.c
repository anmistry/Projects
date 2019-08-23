/******************************************************************************
* Name:       Ankita Mistry
* Program     custom shell
******************************************************************************/

// header includes
#include <sys/types.h>   // needed for muti-threading
#include <unistd.h>      // needed for muti-threading
#include <stdio.h>       // needed for standard I/O operations
#include <stdlib.h>      // needed for std libs functions
#include <string.h>      // needed for string operations
#include <signal.h>      // needed for signals
#include <sys/wait.h>    // needed for wait functions
#include <fcntl.h>       // needed for file descriptor operations

#define MAX_CMD_BUFFER_SIZE 2048  // as per spec
#define MAX_ARGS            513   // 513 includes command + args
#define TRUE                1
#define FALSE               0

// define command line block
struct COMMAND_LINE
{
    char *args[MAX_ARGS];        // holds command + args strings
    char *input_file;            // holds input file name string
    char *output_file;           // holds output file name string
    int background_cmd;          // holds background command flag
    int argc;                    // holds num arguments minus command
};


//
// Name:        print_command_line()
// Description: Displays the parsed command line structure.
//
void print_command_line(const struct COMMAND_LINE *cmdln)
{
    int i;

    // print all cmd line
    printf("command: %s\n", cmdln->args[0]);
    for(i = 1; i < cmdln->argc; i++)
    {
        printf("args[%d]: %s\n", i, cmdln->args[i]);
    }
    
    if(cmdln->input_file != NULL){
        printf("input file: %s\n", cmdln->input_file);
    }

    if(cmdln->output_file != NULL){
        printf("output file: %s\n", cmdln->output_file);
    }

    if(cmdln->background_cmd){
        printf("background cmd: %d\n", cmdln->background_cmd);
    }
}

//
// Name:        parse_command_line()
// Description: Parse input command line and store into local structure
//
int parse_command_line(struct COMMAND_LINE *cmdln)
{
    char buffer[MAX_CMD_BUFFER_SIZE];
    char backupbuff[MAX_CMD_BUFFER_SIZE];
    char *tmp = NULL;
    char *input_ptr = NULL;
    char *output_ptr = NULL;

    // zero out the buffers
    memset(cmdln, 0, sizeof(struct COMMAND_LINE));
    memset(buffer, 0, sizeof(buffer));
    memset(backupbuff, 0, sizeof(backupbuff));

    // display command prompt
    printf(": ");

    // wait for user input command
    fgets(buffer, MAX_CMD_BUFFER_SIZE, stdin);

    // skip if comment or blank line
    if((buffer[0] == '#') || (buffer[0] == '\n'))
    {
        return EXIT_FAILURE;
    }

    // get rid of new line
    tmp = strchr(buffer, '\n' );
    if(tmp != NULL)
    {
      *tmp = 0;
    }

    // backup orignal input buffer
    strcpy(backupbuff, buffer);

    // extract command with arguments
    tmp = strtok(buffer, "<>&");

    // extract command word into arg0
    cmdln->args[0] = strtok(tmp, " ");
    cmdln->argc = 0;

    // extract all the arguments
    while(cmdln->args[cmdln->argc] != NULL)
    {
        cmdln->argc++;
        cmdln->args[cmdln->argc] = strtok(NULL, " ");
    }

    // search for 1st occurance of redirection "&" character 
    cmdln->background_cmd = 0;
    tmp = strchr(backupbuff, '&');
    if(tmp != NULL)
    {
        // flag this as background command
        cmdln->background_cmd = 1;
    }

    // get the pointers to the "<" & ">" occurrances
    output_ptr = strrchr(backupbuff, '>');
    input_ptr = strrchr(backupbuff, '<');

    // We gotta start chopping from tail end of the string because
    // strtok only returns leading part of the string.
    // Check if the tail end contains ">" or "<" character
    if((output_ptr > input_ptr) || (input_ptr == NULL)) {
        // search for last occurance of redirection ">" character  
        tmp = strrchr(backupbuff, '>');
        if(tmp != NULL)
        {
            // chop off the "> " characters
            // only save the filename
            cmdln->output_file = strtok(tmp, "> ");

            // search for last occurance of redirection "<" character
            tmp = strrchr(backupbuff, '<');
            if(tmp != NULL)
            {
                // chop off the "< " characters
                // only save the filename
                cmdln->input_file = strtok(tmp, "< ");
            }
        }
    } else if((input_ptr > output_ptr) || (output_ptr == NULL)) {
        // search for last occurance of redirection "<" character  
        tmp = strrchr(backupbuff, '<');
        if(tmp != NULL)
        {
            // chop off the "< " characters
            // only save the filename
            cmdln->input_file = strtok(tmp, "< ");

            // search for last occurance of redirection ">" character
            tmp = strrchr(backupbuff, '>');
            if(tmp != NULL)
            {
                // chop off the "< " characters
                // only save the filename
                cmdln->output_file = strtok(tmp, "> ");
            }
        }
    }

    return EXIT_SUCCESS;
}

//
// Name:        process_child()
// Description: processes the child thread
//
void process_child(struct COMMAND_LINE *cmdln)
{
    struct sigaction myaction;
    int filedsc;

    // initialize signal handler
    myaction.sa_handler = SIG_IGN; //set to ignore
    sigaction(SIGINT, &myaction, NULL);

    if(cmdln->background_cmd)
    {
        // set command to be interrupted
        myaction.sa_handler = SIG_DFL;
	myaction.sa_flags = 0;
	sigaction(SIGINT, &myaction, NULL);
    }


    // check if input redirection is absent &
    // this is background process
    if((cmdln->input_file == NULL) && (cmdln->background_cmd))
    {
        // redirect to /dev/null by default
        cmdln->input_file = "/dev/null";
    } 

    if(cmdln->input_file != NULL) {
        // open existing input file in current directory with readonly
        // permission
        filedsc = open(cmdln->input_file, O_RDONLY);

        // check for file open failure
        if(filedsc == -1) {
            printf("cannot open %s for input\n", cmdln->input_file);
            fflush(stdout);
            exit(1);
        }

        // create a copy of the file descriptor
        if(dup2(filedsc, 0) == -1) {
            printf("cannot duplicate input file descriptor\n");
            fflush(stdout);
            exit(1);
        }

        // close input file
        close(filedsc);
    }


    // check if output redirection is present
    if(cmdln->output_file != NULL)
    {
        // create new or open existing ouput file in current directory.
        // we'll just give read/write/execute permission to avoid head-aches
        filedsc = open(cmdln->output_file, O_WRONLY|O_CREAT|O_TRUNC, S_IRWXU);

        // check for file open failure
        if(filedsc == -1) {
            printf("cannot open %s output file.\n", cmdln->output_file);
            fflush(stdout);
            exit(1);
        }

        // create a copy of the file descriptor
        if(dup2(filedsc, 1) == -1) {
            printf("cannot duplicate output file descriptor\n");
            fflush(stdout);
            exit(1);
        }

        // close output file
        close(filedsc);
    }

    // debug: display child pid & command
    //printf("%d: %s\n", getpid(), cmdln->args[0]);
    //fflush(stdout);

    if(execvp(cmdln->args[0], cmdln->args))
    {
        perror("exec failed");
        fflush(stdout);
        exit(1);
    }
}

//
// Name:        main()
// Description: Program main entry point
//
int main()
{
    pid_t spawnpid;
    int status;
    int pidstatus;
    int ext;
    int pid;
    struct COMMAND_LINE cmdln = {0};

    do {
        // parse the command line
        status = parse_command_line(&cmdln);

        // debug: display command line
        //  print_command_line(&cmdln);

        if(status == EXIT_SUCCESS){
            // check for built-in commands
            ext = FALSE;
            if(strcmp(cmdln.args[0], "exit") == 0)
            {
                ext = TRUE;
            } else if(strcmp(cmdln.args[0], "cd") == 0) {

              // default to HOME directory if no relative path
              // provided in the command line args[1]
              if(cmdln.args[1] == NULL)
              {
                  // change to default HOME directory
                  cmdln.args[1] = getenv("HOME");
              }

              status = chdir(cmdln.args[1]);
              if(status == -1)
              {
                  printf("command could not be executed.\n");
                  fflush(stdout);
              }

              // debug: display current working directory
              //char cwd[2048];
              //if (getcwd(cwd, sizeof(cwd)) != NULL) {
              //  printf("Current working dir: %s\n", cwd);
              //  fflush(stdout);
              //}
            } else if(strcmp(cmdln.args[0], "status") == 0) {
                // print the statu of the last command
                printf("exit value %d\n", WEXITSTATUS(pidstatus));
                fflush(stdout);
            } else {
                // non built-in command so fork a child process
                spawnpid = fork();
                switch (spawnpid)
                {
                    case -1:
                        perror("Hull Breach!");
                        status = 1;
                        break;
                    case 0:
                        // debug: display child thread
                        //printf("I am the child!\n");
                        //fflush(stdout);

                        process_child(&cmdln);
                        break;
                    default:
                        // debug: display parent thread
                        //printf("I am the parent!\n");
                        //fflush(stdout);

                        // check if foreground command
                        if(cmdln.background_cmd == 0)
                        {
                            do {
                                // wait for child to terminate automatically or
                                // by a signal
                                waitpid(spawnpid, &pidstatus, 0);
                            } while ((!WIFEXITED(pidstatus)) && (!WIFSIGNALED(pidstatus)));
                        } else {
                            // display background PID value
                            printf("background pid is %d\n", spawnpid);
                            fflush(stdout);
                        }
                        break;
                } // end of switch {}
            } // end of if{}else{}

            // wait for any child process to finish          
            do
            {                
                pid = waitpid(-1, &pidstatus, WNOHANG);
                if(pid > 0)
                {
                    printf("background pid %d is done: ", pid);
                    fflush(stdout);

                    // display appropriate exit value
                    if (WIFEXITED(pidstatus)) {
                        // display status value if exited automatically
	                printf("exit value %d\n", WEXITSTATUS(pidstatus));
                        fflush(stdout);
                    } else if (WIFSIGNALED(pidstatus)) {
                       // display signal value if existed by signal
                       printf("terminated by signal: %d\n", pidstatus);
                       fflush(stdout);
                    }
                }
            } while(pid > 0);
        } // end of if{}
    }while(!ext);  // end of do{}while()

    return 0;
}
