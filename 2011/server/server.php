<?php

// servidor genérico para aceitar ligações
// set some variables
$host = "127.0.0.1";
$port = 1234;

// don't timeout!
set_time_limit(0);

// create socket
$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");

// bind socket to port
$result = socket_bind($socket, $host, $port) or die("Could not bind to socket\n");

// start listening for connections
$result = socket_listen($socket, 3) or die("Could not set up socket listener\n");

// accept incoming connections
echo "Waiting for connections...\n";

// spawn another socket to handle communication
$spawn = socket_accept($socket) or die("Could not accept incoming connection\n");

echo "Received connection request\n";

$key = socket_read($spawn, 16) or die("Could not read input\n");
echo 'key: '.$key."\n";
$iv = socket_read($spawn, 16) or die("Could not read input\n");
echo 'iv: '.$iv."\n";
$cipher = socket_read($spawn, 1024) or die("Could not read input\n");
echo 'cipher: '.$cipher."\n";

$decipher = mcrypt_cbc(MCRYPT_RIJNDAEL_128, $key, $cipher, MCRYPT_DECRYPT, $iv);

echo 'Deciphered message: '.$decipher."\n";

// close socket
socket_close($spawn);
socket_close($socket);
echo "Socket terminated\n";
?>
