<?php
$CONFIGURATION['configargs'] = array ("private_key_bits" => 2048);

// ler do ficheiro a chave
$fp = fopen("./chave.pem", "r");
$chave = fread($fp, 10000);
fclose($fp);

$parchaves = openssl_pkey_get_private($chave, null);
var_dump($parchaves);

// vou criar o DN para o meu certificado 
$dn = array(
	"countryName" => "PT",
	"stateOrProvinceName" => "Lisboa",
	"localityName" => "Lisboa", 
	"organizationName" => "ISCTE",
	"organizationalUnitName" => "DCTI",
	"commonName" => "Carlos Serrao",
	"emailAddress" => "carlos.serrao@iscte.pt"
);

// vou criar o CSR para o meu certificado digital
$csr = openssl_csr_new($dn, $parchaves, $CONFIGURATION['configargs']);
var_dump($csr);

// poderia exportar o CSR para um ficheiro
openssl_csr_export_to_file($csr, "./mycsr.pem");

$x509 = openssl_csr_sign($csr, null, $parchaves, 180, $CONFIGURATION['configargs']);


// processar e imprimir certificado X.509 para ecran
print_r(openssl_x509_parse($x509));

// exportar x.509 para ficheiro
openssl_x509_export_to_file($x509, "./mycert.pem");

?>