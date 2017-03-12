<?php
	function verifica_nome_arquivo($teste){
		$CARACTERES_SEM_PERMISSAO = "ÔÂÊÀàêâôãõñÃÕÑáéíóúÁÉÍÓÚüÜçÇ@#$%&*ªº°?§' +`´(),!?/"; //caracteres que deverão ser substituidos
		$TRADUZIDOS_PARA = "oaeaaeaoaonaonaeiouaeiouuucc______________________"; //por estes caracteres.
		
		return strtolower(strtr($teste,$CARACTERES_SEM_PERMISSAO, $TRADUZIDOS_PARA));
	}
	function sizeformater($tam){
		if($tam >= 0 && $tam <= 1023){
			return $tam . " Bytes";
		}
		if($tam >= 1024 && $tam <= 1048575){
			return number_format($tam/1024,2) . " KB";
		}
		if($tam >= 1048576 && $tam <= 1073741824){
			return number_format($tam/1024/1024,2) . " MB";
		}
	}
?>