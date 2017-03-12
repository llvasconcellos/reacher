<?php
require("funcoes.php");

$oque = $_REQUEST["oque"];
$id = $_REQUEST["id"];
require("conectar_mysql.php");
if($oque == "modelo"){
	$query = "SELECT * FROM modelos WHERE id_modelo=" . $id;
	$css = "css_modelo";
}
elseif ($oque == "mala"){
	$query = "SELECT * FROM malas WHERE id_mala=" . $id;
	$css = "css_mala";
}
$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error(), false);
$registro = mysql_fetch_assoc($result);
echo(stripslashes($registro[$css]));
require("desconectar_mysql.php");
?>