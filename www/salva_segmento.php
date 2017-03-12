<?
require("funcoes.php");
require("permissao_documento.php");
require("conectar_mysql.php");

$modo = $_REQUEST["modo"];
$pagina = $_REQUEST["pagina"];
$id_segmento = $_REQUEST["id_segmento"];
$nome_segmento = $_REQUEST["nome_segmento"];

if($modo == "apagar"){
	$query = "DELETE FROM segmentos WHERE id_segmento='" . $id_segmento . "'";
	$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error());
	$mensagem = "Segmento removido com sucesso!";
	$url = "browser_segmentos.php?pagina=" . $pagina;
	if($result) tela_ok($mensagem, $url);
	die();
}


if($modo == "add"){
	$query = "SELECT nome_segmento FROM segmentos WHERE nome_segmento='" . $nome_segmento . "'";
	$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error(), false);
	if(mysql_num_rows($result)>0) tela_erro("Já existe um segmento cadastrado com este nome.", false);
	else{
		$query = "INSERT INTO segmentos (nome_segmento) VALUES ";
		$query .= "('" . $nome_segmento ."') ";
		$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
		$result = mysql_query("SELECT LAST_INSERT_ID();") or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
		$registro = mysql_fetch_row($result);
		$id_segmento = $registro[0];
		$url = "browser_segmentos.php";
		$mensagem = "Segmento cadastrado com sucesso!";
	}
}
if($modo == "update"){
	$query = "UPDATE segmentos SET ";
	$query .= "nome_segmento='" . $nome_segmento . "'";
	$query .= " WHERE id_segmento='" . $id_segmento . "'";
	$mensagem = "Informações alteradas com sucesso!";
	$url = "browser_segmentos.php";
	$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
}
if($result) tela_ok($mensagem, $url);

require("desconectar_mysql.php")
?>