<?php
// assinar e verificar assinaturas digitais

// mensagem que eu quero assinar

$msg = "esta e' a mensagem que eu vou querer assinar digitalmente";

// vou ler a chave privada do ficheiro
$fp = fopen("./chave.pem", "r");
$keypair = fread($fp, 10000);
fclose($fp);

// criar objecto openssl com a chave privada
$privkey = openssl_pkey_get_private($keypair);

// assinar digitalmente a mensagem usando a chave privada
openssl_sign($msg, $signature, $privkey);

// mostrar assinatura digital
echo "assinatura = ".base64_encode($signature)."\n";

$msg_recebida = "esta e a mensagem que eu vou querer assinar digitalmente";

// ler o certificado digital do assinante
$fp = fopen("./mycert.pem", "r");
$cert = fread($fp, 10000);
fclose($fp);

// criar uma instancia openssl do certificado x.509
$certx509 = openssl_x509_read($cert);

// extrair do certificado x.509 a chave pública do assinante

openssl_x509_export($certx509, $scert);

$pubkey = openssl_pkey_get_public($scert); // tenho a chave pública

// verificar a assinatura digital da mensagem enviada
$status = openssl_verify($msg_recebida, $signature, $pubkey);

if($status == true)
    echo "Assinatura válida\n";
else
    echo "Assinatura inválida\n";

?>
