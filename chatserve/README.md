# ChatServe Program Description:
This is a readme to compile and execute server-client project.

# The contents of the Program contains:
1. Makefile - used to compile the chatclient.c file.
2. chatserver.py - used to run chat server
3. chatclient.c - used to compile and run chat client

# How to compile the chatclient.c file:
1. ```make all``` - compiles the chatclient.c file and generates a "chatclient" executable
2. ```make clean``` - deletes the "chatclient" executable

# How to run server - client programs:
1. Open two separate dialog box instances of linux terminal.
2. In instance 1 window type ```python chatserve.py 12000``` to start server on port 12000.  
   Note: If port 12000 does not work than try a different port (i.e. 12001)
3. In instance 2 window type ```./chatclient localhost 12000``` to start client using localhost and port 12000.
   Note: the port number must match the server port in step #2.
