<?php
	/**
	 * criar cifra de CŽsar - simplificada
	 */

    echo "Valor a cifrar = $argv[1] \n";
    echo "com a seguinte chave = $argv[2]\n";

    $string2cipher = $argv[1];
    $key = $argv[2];

    $output = null;
    
    // do cipher
    for($n=0; $n<strlen($string2cipher); $n++)
    {
        $output .= chr( ord($string2cipher[$n]) + $key );
    }

    echo 'Ciphered result = '.$output."\n";
    
    $string2uncipher = $output;
    $output = null;

    // do uncipher
    for($n=0; $n<strlen($string2uncipher); $n++)
    {
        $output .= chr( ord($string2uncipher[$n]) - $key );
    }
    
    echo 'Unciphered result = '.$output."\n";
?>
