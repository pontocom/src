<?php

$CONFIGURATION['configargs']= array(
    "private_key_bits" => 4096
);

$par = openssl_pkey_new($CONFIGURATION['configargs']);

var_dump($par);

openssl_pkey_export($par, $chaves, null, $CONFIGURATION['configargs']);
echo $chaves;

openssl_pkey_export_to_file($par, "./mykeys.pem", null, $CONFIGURATION['configargs']);

?>
