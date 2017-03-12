<?
require("funcoes.php");
require("permissao_documento.php");
require("conectar_mysql.php");

$modo = $_REQUEST["modo"];
$id_lembrete = $_REQUEST["id_lembrete"];
$texto = addslashes($_REQUEST["texto"]);
$dia = $_REQUEST["dia"];
$mes = $_REQUEST["mes"];
$ano = $_REQUEST["ano"];
$semana = $_REQUEST["semana"];
$titulo = $_REQUEST["titulo"];
$destinatario = $_REQUEST["destinatario"];
$status = $_REQUEST["status"];

if(strlen($semana) == 0){
	$data = "D;" . $dia . "," . $mes . "," . $ano;
}
else $data = "W;" . $semana;

if($modo == "apagar"){
	$query = "DELETE FROM lembretes WHERE id_lembrete='" . $id_lembrete . "'";
	$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error());
	
	$mensagem = "Lembrete removido com sucesso!";
	$url = "browser_lembretes.php";
	if($result) tela_ok($mensagem, $url);
	die();
}

if($modo == "alterar_status"){
	$query = "UPDATE lembretes SET status = '" . $status . "' WHERE id_lembrete='" . $id_lembrete . "'";
	$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error());
	
	$mensagem = "Status do lembrete modificado com sucesso!";
	$url = "browser_lembretes.php?pagina=" . $pagina;
	if($result) tela_ok($mensagem, $url);
	die();
}

if($modo == "add"){
	$query = "INSERT INTO lembretes (titulo, destinatario, texto, status, data) VALUES ";
	$query .= "('" . $titulo . "', ";
	$query .= "'" . $destinatario . "', ";
	$query .= "'" . $texto . "', ";
	$query .= "1, ";
	$query .= "'" . $data . "')";
	$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
	$result = mysql_query("SELECT LAST_INSERT_ID();") or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
	$registro = mysql_fetch_row($result);
	$id_lembrete = $registro[0];

	$mensagem = "Lembrete cadastrado com sucesso!";
	$url = "form_lembrete.php?modo=update&id_lembrete=" . $id_lembrete;
}
if($modo == "update"){
	$query = "UPDATE lembretes SET ";
	$query .= "titulo='" . $titulo . "', ";
	$query .= "destinatario='" . $destinatario . "', ";
	$query .= "texto='" . $texto . "', ";
	$query .= "status=" . $status . ", ";
	$query .= "data='" . $data . "'";
	$query .= " WHERE id_lembrete=" . $id_lembrete;
	$mensagem = "Informações alteradas com sucesso!";
	$url = "form_lembrete.php?modo=update&id_lembrete=" . $id_lembrete;
	$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
}

if($result) tela_ok($mensagem, $url);

require("desconectar_mysql.php");
?>