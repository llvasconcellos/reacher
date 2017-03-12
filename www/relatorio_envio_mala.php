<?
$modo = $_GET["modo"];
$id_mala = $_GET["id_mala"];

if($modo == "download")	$enter = chr(13) . chr(10);
elseif($modo == "display") $enter = "<br>" . chr(13) . chr(10);
else tela_erro("Falta informações para a visualização deste Relatório", false);

require("conectar_mysql.php");
$query = "SELECT * FROM malas_envios WHERE id_mala=" . $id_mala . " ORDER BY ordem";
$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error(), false);
if(mysql_num_rows($result) == 0) $relatorio = "Relatório Vazio";
while($registro = mysql_fetch_assoc($result)){
	$relatorio .= $registro['ordem'] . " - Email Enviado: " . $registro["email"] . $enter;
}


if($modo == "download"){
	header('Content-type: text/plain');
	header('Content-Disposition: attachment; filename="relatorio.txt"');
	header("Content-Length: " .(string)(strlen($relatorio)) );
}

echo($relatorio);
require("desconectar_mysql.php");
?>