<?
require("funcoes.php");
require("permissao_documento.php");
require("conectar_mysql.php");

$modo = $_REQUEST["modo"];
$id_modelo = $_REQUEST["id_modelo"];
$pagina = $_REQUEST["pagina"];
$nome_modelo = $_REQUEST["nome_modelo"];
$css_modelo = addslashes($_REQUEST["css_modelo"]);
$html_modelo = addslashes($_REQUEST["html_modelo"]);

if($modo == "apagar"){
	$query = "DELETE FROM modelos WHERE id_modelo='" . $id_modelo . "'";
	$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error());
	$mensagem = "Modelos removido com sucesso!";
	$url = "browser_modelos.php?pagina=" . $pagina;
	if($result) tela_ok($mensagem, $url);
	die();
}

if($modo == "add"){
	$query = "INSERT INTO modelos (nome_modelo, css_modelo, html_modelo) VALUES ";
	$query .= "('" . $nome_modelo ."',";
	$query .= "'" . $css_modelo ."',";
	$query .= "'" . $html_modelo ."')";
	$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
	$result = mysql_query("SELECT LAST_INSERT_ID();") or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
	$registro = mysql_fetch_row($result);
	$id_modelo = $registro[0];
	$mensagem = "Modelo cadastrado com sucesso!";
	$url = "form_modelo.php?modo=update&id_modelo=" . $id_modelo;
}
if($modo == "update"){
	$query = "UPDATE modelos SET ";
	$query .= "nome_modelo='" . $nome_modelo . "', ";
	$query .= "css_modelo='" . $css_modelo . "', ";
	$query .= "html_modelo='" . $html_modelo . "'";
	$query .= " WHERE id_modelo='" . $id_modelo . "'";
	$mensagem = "Informações alteradas com sucesso!";
	$url = "form_modelo.php?modo=update&id_modelo=" . $id_modelo;
	$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
}

if($result) tela_ok($mensagem, $url);

require("desconectar_mysql.php")
?>