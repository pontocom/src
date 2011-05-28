<?php
	// operacoes crypto
	
	//php basicCrypto.php md5 texto 

	if($argc != 3)
	{
		echo "Usage: php basicCrypto.php md5|md5file|sha1|sha1file|hmac|all texto\n";
		exit;
	}

	$oper = $argv[1];
	$texto = $argv[2];
	$resumo = null;
	
	switch($oper)
	{
		case 'md5': $resumo = md5($texto, true);	
					echo "MD5 = ".$resumo."\n";
					break;
		case 'md5file': $resumo = md5_file($texto);
					echo "MD5FILE = ".$resumo."\n";
					break;
		case 'sha1': $resumo = sha1($texto);	
					echo "SHA1 = ".$resumo."\n";
					break;
		case 'sha1file': $resumo = sha1_file($texto);
					echo "SHA1FILE = ".$resumo."\n";
					break;
		case 'hmac':
			$hmacode = hash_hmac('sha1', $texto, sha1("mykey"));
			echo "HMAC = ".$hmacode."\n";
			break;
		case 'all':
			foreach(hash_algos() as $algo)
			{
					echo $algo." = ".hash($algo, $texto)."\n";
			} 
			break;
					
	}
?>