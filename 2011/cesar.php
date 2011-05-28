<?php 

	// cifra de cesar
	
	//php cesar.php c|d textoACifrar Chave 

	if($argc != 4)
	{
		echo "Usage: php cesar.php c|d textoACifrar Chave\n";
		exit;
	}

	$oper = $argv[1];
	$textoCifrar = $argv[2];
	$chave = $argv[3];
	$textoCifrado = null;

	if($oper == "c")
	{
		for($n=0; $n<strlen($textoCifrar); $n++)
		{
			if ($textoCifrar[$n] == ' ')
				$textoCifrado .= ' ';
			else
				$textoCifrado .= chr(ord($textoCifrar[$n]) + $chave);
		}
	}
	elseif ($oper == "d")
	{
		for($n=0; $n<strlen($textoCifrar); $n++)
		{
			if ($textoCifrar[$n] == ' ')
				$textoCifrado .= ' ';
			else
				$textoCifrado .= chr(ord($textoCifrar[$n]) - $chave);
		}
			}
	
	echo "Texto a cifrar = ".$textoCifrar."\n";
	echo "Texto cifrado  = ".$textoCifrado."\n";
?>