<?php

// php scifra.php pass dados_a_cifrar
$pass = $argv[1];

// AES
$skey = md5($pass);
$iv = "0011223344556677"; // 128 bits

$data = $argv[2];

$cipher = mcrypt_cbc(MCRYPT_RIJNDAEL_128, $skey, $data, MCRYPT_ENCRYPT, $iv);

echo "Valor cifrado = $cipher\n";

// decifrar a informação
$decipher = mcrypt_cbc(MCRYPT_RIJNDAEL_128, $skey, $cipher, MCRYPT_DECRYPT, $iv);

echo "Valor decifrado = $decipher\n";

?>
