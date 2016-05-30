<?php

	//use model\RenameRegex as RenameRegex;
	require ('model/RenameRegex.php');
	
	$path 		= 'diretorio/';	 
	$pattern 	= '/(.[0-9][0-9][0-9][0-9].)(.-.)(.*)(\..*)$/';
    $replacement= '$3$2$1$4';

	$rr = new RenameRegex($path, $pattern, $replacement);

	// $rr->renameAllFiles(); 

	// para listar todos os arquivos do diretorio
	while( $a = $rr->getArchives() ){
		echo "<a href=\"$path$a\">$a</a><br>";
	}
	
	/*

	echo "<h1>Voltando</h1>";
	// "Minha Foto - [1894].jpeg"
	$path 		= "diretorio";	 
	$pattern 	= '/(.[0-9][0-9][0-9][0-9].)(.-.)(.*)/';
    $replacement= '$3$2$1';

	$rr = new RenameRegex($path, $pattern, $replacement);


	if( !$rr->renameAllDir() )
		$rr->getErro();

	*/


// desenvolver o regex
// https://regex101.com/	
?>