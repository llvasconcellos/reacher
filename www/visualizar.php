<?
require("funcoes.php");
require("conectar_mysql.php");

$email_pessoa = $_GET["id"];
$id_mala = $_GET["id_mala"];

$query = "SELECT id_pessoa, nome_pessoa FROM pessoas WHERE email_pessoa = '" . $email_pessoa . "'";
$result = mysql_query($query);
$registro = mysql_fetch_assoc($result);
if(mysql_num_rows($result)== 0) $nome_pessoa = "Sr(a).";
else {
	$nome_pessoa = $registro["nome_pessoa"];
	$id_pessoa = $registro["id_pessoa"];
}


$query = "SELECT css_mala, html_mala FROM malas WHERE id_mala = " . $id_mala;
$result = mysql_query($query);
$registro = mysql_fetch_assoc($result);
$css_mala = stripslashes($registro["css_mala"]);
$html_mala = str_replace("(*nome*)", $nome_pessoa, stripslashes($registro["html_mala"]));

$query = "INSERT INTO malas_visualizacoes (id_mala, id_pessoa) VALUES (" . $id_mala . "," . $id_pessoa . ")";
$result = mysql_query($query);

?>
<html>
	<head>
		<title>Reacher WebMailer</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	</head>
	<style type="text/css">
	<!--
		<?=$css_mala?>
	-->
	</style>
	<body>
		<?=$html_mala?>
		<br><center><a href="<?=retorna_config('url_site')?>/reacher/remove_lista.php?id=<?=$email_pessoa?>"><img border="0" src="<?=retorna_config('url_site')?>/reacher/imagens/remover.gif"></a></center><BR><BR>
		<img border="0" src="<?=retorna_config('url_site')?>/reacher/registra_visualizacao.php?id=<?=$email_pessoa?>&id_mala=<?=$id_mala?>" width="1" height="1">
		<BR><BR>
	</body>
</html>
<? require("desconectar_mysql.php"); ?>