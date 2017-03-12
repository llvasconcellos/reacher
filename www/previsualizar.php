<?
require("funcoes.php");
require("conectar_mysql.php");

$id = $_GET["id"];
$tipo = $_GET["tipo"];

if($tipo == "mala") $query = "SELECT css_mala, html_mala FROM malas WHERE id_mala = " . $id;
if($tipo == "modelo") $query = "SELECT css_modelo as css_mala, html_modelo as html_mala FROM modelos WHERE id_modelo = " . $id;
$result = mysql_query($query);
$registro = mysql_fetch_assoc($result);
$css_mala = stripslashes($registro["css_mala"]);
$html_mala = str_replace("(*nome*)", "Leonardo", stripslashes($registro["html_mala"]));
//$html_mala = str_replace("(*dispomos_tambem*)", mostra_familias(), $html_mala);

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
		<br><center><a href="' . <?=retorna_config('url_site') . '/reacher/remove_lista.php?id=teste&p=teste"><img border="0" src="' . retorna_config('url_site')?>/reacher/imagens/remover.gif"></a></center><BR><BR>
		<BR><BR>
	</body>
</html>

<? require("desconectar_mysql.php"); ?>