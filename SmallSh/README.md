# SmallSh Program Description:
This is a custom shell program.  The shell will run command line instructions and return the results similar to other shells but without many of their fancier features.

The shell features:
1. Uses colon ```:``` symbol as a prompt for each command line.
2. The general syntax of a command line is: ```command [arg1 arg2 ...] [< input_file] [> output_file] [&]``` 
    - Square brackets are optional.  
    - Special symbols <, >, and & are recognized, but they must be surrounded by spaces like other words. 
    - If the command is to be executed in the background, the last word must be &. 
    - If standard input or output is to be redirected, the > or < words followed by a filename word must appear after all the arguments. 
3. Supported built-in commands:
   - ```exit``` - to exit the shell
   - ```cd``` - to change directory
   - ```status``` - prints out either the exit status or the terminating signal of the last foreground process

# Demo Link:
Click [here](https://onlinegdb.com/SyBx3q6NB) for demo.

# How to Build:
1. Open Linux command prompt.
2. Git clone Bit Magic folder.
3. Go to Bit Magic folder.
4. Run command ```gcc -o smallsh smallsh.c``` on command line.
5. Run ```./smallsh``` on command prompt.
6. Program will execute.

# Sample Run:
```$ smallsh
: ls
junk   smallsh    smallsh.c
: ls > junk
 : status
 exit value 0
: cat junk
junk
smallsh
smallsh.c
: wc < junk
       3       3      23
: test -f badfile
: status
exit value 1
: wc < badfile
cannot open badfile for input
: status
exit value 1
: badfile
badfile: no such file or directory
: sleep 5
^Cterminated by signal 2
: status
terminated by signal 2
: sleep 15 &
background pid is 4923
: ps
   PID TTY      TIME CMD
  4923 pts/4    0:00 sleep
  4564 pts/4    0:03 tcsh-6.0
  4867 pts/4    1:32 smallsh
: 
: 
: # that was a blank command line, this is a comment line
background pid 4923 is done: exit value 0
: # the background sleep finally finished
: sleep 30 &
background pid is 4941
: kill -15 4941
background pid 4941 is done: terminated by signal 15
: pwd
/nfs/stak/faculty/b/brewsteb/CS344/prog3
: cd
: pwd
/nfs/stak/faculty/b/brewsteb
: cd CS344
: pwd
/nfs/stak/faculty/b/brewsteb/CS344
: exit
$```
