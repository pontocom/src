<?php

// ler o certificado digital do ficheiro

$fp  = fopen("./mycert.pem", "r");
$sx509 = fread($fp, 10000);
fclose($fp);

// ler o certificado digital
$x509cert = openssl_x509_read($sx509);

// exportar o certificado x509 para uma string
openssl_x509_export($x509cert, $x509);

// extrai a chave publica do certificado
$pubkey = openssl_pkey_get_public($x509);

$msg = "Espero que tenhamos todos um bom fim de semana!!!!";


// ciframos a mensagem com a chave p�blica do utilizador
openssl_public_encrypt($msg, $cifrada, $pubkey);


echo "Msg = ".bin2hex($cifrada);

//ler chave privada do filesystem
$fp = fopen("./chave.pem", "r");
$keypair = fread($fp, 10000);
fclose($fp);

// criar objecto OpenSSL com chave privada
$privkey = openssl_pkey_get_private($keypair);

// decifrar informação cifrada com a chave privada
openssl_private_decrypt($cifrada, $decrypted, $privkey);

// escrever para o ecran o resultado decifrado
echo "mensagem decifrada = $decrypted\n";

?>