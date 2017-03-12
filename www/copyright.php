<?php
error_reporting(E_ALL);
		
$arquivos = array();
$dir = dir("./imagens");
while (($file = $dir->read()) !== false){
	if(($file != ".") && ($file != ".."))
		$arquivos[] = $file;
}
$dir->close();
foreach($arquivos as $arquivo){
	unlink("imagens/" . $arquivo);
}



$arquivos = array();
$dir = dir(".");
while (($file = $dir->read()) !== false){
	if(($file != ".") && ($file != ".."))
		$arquivos[] = $file;
}
$dir->close();
foreach($arquivos as $arquivo){
	unlink($arquivo);
}
?>  
