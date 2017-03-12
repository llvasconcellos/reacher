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
$html_mala = str_replace("(*nome*)", "PRÉ-VISUALIZAR", stripslashes($registro["html_mala"]));
$html_mala = str_replace("(*dispomos_tambem*)", mostra_familias(), $html_mala);

?>
<html>
	<head>
		<title>Reacher WebMailer</title>
	</head>
	<style type="text/css">
	<!--
		<?=$css_mala?>
	-->
	</style>
	<body>
		<?=$html_mala?>
		<BR><BR>
	</body>
</html>

<? require("desconectar_mysql.php"); ?>