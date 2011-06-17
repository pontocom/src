<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

    /**
     * criar uma CA
     * php ca.php setup|issue keyfile certfile
     */
     $oper = $argv[1];
    $CONFIGURATION['configargs']= array(
        "private_key_bits" => 2048
    );
     
     if ($oper == "setup")
     {
         echo "Inicializar uma nova CA \n";
         
         // gerar um par de chaves

        $par = openssl_pkey_new($CONFIGURATION['configargs']);

        var_dump($par);

        openssl_pkey_export($par, $chaves, null, $CONFIGURATION['configargs']);
        echo $chaves;

         // gravar chaves para ficheiro
        openssl_pkey_export_to_file($par, "./CAkeys.pem", null, $CONFIGURATION['configargs']);
         
         // gerar CSR
        $dndata = array (
            "countryName" => "PT",
            "stateOrProvinceName" => "Lisboa",
            "localityName" => "Lisboa",
            "organizationName" => "ISCTE-IUL",
            "organizationalUnitName" => "MOSS",
            "commonName" => "SRC_CA",
            "emailAddress" => "src_ca@iscte.pt"
        );
        
        $privateKey = openssl_pkey_get_private($chaves);
        
        $csr = openssl_csr_new($dndata, $privateKey, $CONFIGURATION['configargs']);
         
         // gerar certificado (self-signed)
        
         $x509ca = openssl_csr_sign($csr, null, $privateKey, 365, $CONFIGURATION['configargs']);
         openssl_x509_export($x509ca, $cert);
         
         echo $cert;
         
         // gravar certificado para ficheiro
         
         openssl_x509_export_to_file($x509ca, "./CAcert.pem");
         
         echo "Done!!!\n";
         
     }
     else
     {
         echo "Criar um novo certificado \n";
     }
?>
