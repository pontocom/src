<?php

$host = "127.0.0.1";
$port = 1234;

$timeout = 10;

$key = "aabbccddeeff0099";
$iv = "0011223344556677";

//$message = "secret message to be passed!!!";
$message = $argv[1];

$socket = fsockopen($host, $port, $errnum, $errstr, $timeout);

/*if (!is_resource($socket)) {
    exit("connection fail: " . $errnum . " " . $errstr);
} else {
    fputs($socket, "hello world");
    $dati = fgets($socket, 1024);
    fputs($socket, "EOT");
}*/

if (!is_resource($socket)) {
    exit("connection fail: " . $errnum . " " . $errstr);
} else {
    
    $cipher = mcrypt_cbc(MCRYPT_RIJNDAEL_128, $key, $message, MCRYPT_ENCRYPT, $iv);
    
    fputs($socket, $key, strlen($key));
    fputs($socket, $iv, strlen($iv));
    fputs($socket, $cipher, strlen(bin2hex($cipher))/2);
    
    echo "Sending cipher text: ".$cipher."\n";
    echo "Sending cipher text: ".bin2hex($cipher)."\n";
}


fclose($socket);

?>
