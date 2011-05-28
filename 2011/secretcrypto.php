<?php
	//php secretcrypto.php texto 

	$key = "0011223344556677";
	
	$iv = "0011223344556677";
	
	$texto = $argv[1];

	$cipher = mcrypt_cbc(MCRYPT_RIJNDAEL_128, $key, $texto, MCRYPT_ENCRYPT, $iv);
	
	echo "Resultado Cifrado = ".bin2hex($cipher)."\n";

	$decipher = mcrypt_cbc(MCRYPT_RIJNDAEL_128, $key, $cipher, MCRYPT_DECRYPT, $iv);
	
	echo "Resultado em claro = ".$decipher."\n";
        
        
?>