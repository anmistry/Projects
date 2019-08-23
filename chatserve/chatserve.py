###############################################################################
# Name: Ankita Mistry
# Project: Project 1 "Client-Server application"
###############################################################################

from socket import *
import sys
import argparse

###############################################################################
# Function:     recv_message
# Description:  Receive client message
#
###############################################################################
def recv_message(connectionSocket):
	try:
		sentence = connectionSocket.recv(1024)
	except:
		# handle situation when server is disconnected
		print 'Server connection is lost'
		connectionSocket.close()
		return ''

	if not sentence:
		# handle situation when client is disconnected
		print 'Client connection is lost'
		connectionSocket.close()
		return ''

	return sentence

def send_message(connectionSocket):
	serverHandle = 'chatserve> '
	quitsentence = '\quit'

	# get input from supervisor
	sentence = raw_input(serverHandle)

	# close connection if supervisor provided '\quit'
	# command
	if sentence == quitsentence:
		connectionSocket.close()
	else:
		# otherwise send the message
		connectionSocket.send(serverHandle + sentence)

###############################################################################
# Function:     process_connection
# Description:  Receive client message, send client message
#
###############################################################################
def process_connection(connectionSocket):
	while 1:
		# wait for client message to arrive
		sentence = recv_message(connectionSocket)
		if not sentence:
			# exit if failed to receive message
			return

		# if message is not null than print message
		print sentence

		# get input and send the message
		send_message(connectionSocket)

###############################################################################
# Function:     main
# Description:  Parse user arguments, establish TCP socket connection with
#               client
#
###############################################################################
def main():
	# Create a command line parser to ensure that port number is supplied by
	#the user
	parser = argparse.ArgumentParser(prog='chatserve.py')
	parser.add_argument('port', type=int, help = 'numeric port number')
	args = parser.parse_args()

	# define server IP & port
	serverName = ''
	serverPort = args.port
	serverSocket = socket(AF_INET, SOCK_STREAM)
	serverSocket.bind((serverName,serverPort))
	serverSocket.listen(1)

	# listen for client connection
	print 'Start Server on port:', serverPort
	print("The Server is ready to receive")
	while 1:
		connectionSocket, addr = serverSocket.accept()
		# process client connection
		print 'Connection address:', addr
		process_connection(connectionSocket)
	serverSocket.close

###############################################################################
# main function call
###############################################################################
main()
