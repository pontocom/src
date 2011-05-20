<?php
// estou a definir os par‰metros de gera‹o das chaves
$CONFIGURATION['configargs'] = array ("private_key_bits" => 2048);

$parchaves = openssl_pkey_new($CONFIGURATION['configargs']);

var_dump($parchaves);

openssl_pkey_export($parchaves, $chave, null, $CONFIGURATION['configargs']);

// guardar a minha chave num ficheiro
openssl_pkey_export_to_file($parchaves, "./chave.pem", null, $CONFIGURATION['configargs']);

echo $chave;
?>