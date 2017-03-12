<?
class editorHTML{
	function editorHTML($conteudo, $largura, $altura, $css){
		if(strpos($_SERVER["HTTP_USER_AGENT"],"MSIE")) echo "<script language=JavaScript src='/scripts/editor.js'></script>";
		else echo "<script language=JavaScript src='scripts/moz/editor.js'></script>";
		
		echo('<pre id="temp_conteudo" name="temp_conteudo" style="display:none">');
		$sContent = stripslashes($conteudo);
		echo htmlentities($sContent);
		echo('</pre>');
		
		echo('<script>' . chr(10));
		echo('var oEdit1 = new InnovaEditor("oEdit1");' . chr(10));
		echo('oEdit1.css="' . $css . '";' . chr(10));
		echo('oEdit1.width="' . $largura . '";' . chr(10));
		echo('oEdit1.height="' . $altura . '";' . chr(10));
		echo('oEdit1.btnFlash=true;' . chr(10));
		echo('oEdit1.btnMedia=true;' . chr(10));
		echo("oEdit1.cmdAssetManager='/assetmanager/assetmanager.php';" . chr(10));
		echo('oEdit1.RENDER(document.getElementById("temp_conteudo").innerHTML);' . chr(10));
		echo('</script>');
	}
	//
}
?>