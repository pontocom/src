<?php
	/*
	 * fazer aqui alguns testes com cifra de CŽsar e com fun›es de Hash e MAC
	 */

    if($argc != 3)
    {
        echo "Parametros incorrectos...";
        exit;
    }

    $stringCifrar = $argv[1];
    $key = $argv[2];

    $output = null;

    for($n=0; $n<strlen($stringCifrar); $n++)
    {
        $output .= chr( ord($stringCifrar[$n]) + $key );
    }

    echo "original = $stringCifrar\n";
    echo "cifrado = $output\n";


    // vamos decifrar
    $decifrado = null;

    for($n=0; $n<strlen($output); $n++)
    {
        $decifrado .= chr( ord($output[$n]) - $key);
    }

    echo "decifrado = $decifrado\n";


    // teste de forÃ§a bruta para determinar a chave

    $tkey = 0;
    do
    {
            $decifrado = null;
            for($n=0; $n<strlen($output); $n++)
            {
                $decifrado .= chr( ord($output[$n]) - $tkey);
            }

            echo "testing with key = $tkey value = $decifrado\n";

            if(strcmp($decifrado, $stringCifrar)==0)
            {
                $found = 1;
                break;
            }

            $tkey++;
    } while ($found != 1);

    echo "found key = $tkey\n";

    echo "MD5 = ".md5($stringCifrar)."\n";
    echo "SHA1 = ".sha1($stringCifrar)."\n";

    foreach(hash_algos() as $algo)
    {
        echo $algo." = ".hash($algo, $stringCifrar)."\n";
    }

    echo "HMAC = ".hash_hmac("SHA1", $stringCifrar, "uma coisa qq")."\n";


?>
