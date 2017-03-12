<?
require("funcoes.php");
require("permissao_documento.php");
require("conectar_mysql.php");

$modo = $_REQUEST["modo"];
$id_instituicao = $_REQUEST["id_instituicao"];
$pagina = $_REQUEST["pagina"];
$nome_instituicao = $_POST["nome_instituicao"];
$razao_social_instituicao = $_POST["razao_social_instituicao"];
$telefone_instituicao = $_POST["telefone_instituicao"];
$fax_instituicao = $_POST["fax_instituicao"];
$endereco_instituicao = $_POST["endereco_instituicao"];
$bairro_instituicao = $_POST["bairro_instituicao"];
$cidade_instituicao = $_POST["cidade_instituicao"];
$estado_instituicao = $_POST["estado_instituicao"];
$cep_instituicao = $_POST["cep_instituicao"];

if($modo == "apagar"){
	$query = "DELETE FROM instituicoes WHERE id_instituicao='" . $id_instituicao . "'";
	$result = mysql_query($query) or tela_erro("Erro de conexуo ao banco de dados: " . mysql_error());
	
	$query = "DELETE FROM segmentos_instituicoes WHERE id_instituicao=" . $id_instituicao;
	$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
	
	$mensagem = "Instituiчуo removida com sucesso!";
	$url = "browser_instituicoes.php?pagina=" . $pagina;
	if($result) tela_ok($mensagem, $url);
	die();
}

if($modo == "add"){
	$query = "SELECT nome_instituicao FROM instituicoes WHERE nome_instituicao='" . $nome_instituicao . "'";
	$result = mysql_query($query) or tela_erro("Erro de conexуo ao banco de dados: " . mysql_error(), false);
	if(mysql_num_rows($result)>0) tela_erro("Jс existe uma empresa cadastrada com este nome.", false);
	else{
		$query = "INSERT INTO instituicoes (nome_instituicao, razao_social_instituicao, telefone_instituicao, fax_instituicao, endereco_instituicao, bairro_instituicao, cidade_instituicao, estado_instituicao, cep_instituicao) VALUES ";
		$query .= "('" . $nome_instituicao ."',";
		$query .= "'" . $razao_social_instituicao ."',";
		$query .= "'" . $telefone_instituicao ."',";
		$query .= "'" . $fax_instituicao ."',";
		$query .= "'" . $endereco_instituicao ."',";
		$query .= "'" . $bairro_instituicao."',";
		$query .= "'" . $cidade_instituicao ."',";
		$query .= "'" . $estado_instituicao ."',";
		$query .= "'" . $cep_instituicao ."')";
		$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
		$result = mysql_query("SELECT LAST_INSERT_ID();") or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
		$registro = mysql_fetch_row($result);
		$id_instituicao = $registro[0];
		
		foreach ($_POST as $chave => $valor){
			if(substr($chave, 0, 9) == "segmento_"){
				$id_segmento = str_replace("segmento_", "", $chave);
				$query = "INSERT INTO segmentos_instituicoes (id_segmento, id_instituicao) VALUES (" . $id_segmento . "," . $id_instituicao . ")";
				$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
			}
		}
		
		$mensagem = "Instituiчуo cadastrada com sucesso!";
		$url = "form_instituicao.php?modo=update&id_instituicao=" . $id_instituicao;
	}
}
if($modo == "update"){
	$query = "UPDATE instituicoes SET ";
	$query .= "nome_instituicao='" . $nome_instituicao . "', ";
	$query .= "razao_social_instituicao='" . $razao_social_instituicao . "', ";
	$query .= "telefone_instituicao='" . $telefone_instituicao . "', ";
	$query .= "fax_instituicao='" . $fax_instituicao . "', ";
	$query .= "endereco_instituicao='" . $endereco_instituicao . "', ";
	$query .= "bairro_instituicao='" . $bairro_instituicao . "', ";
	$query .= "cidade_instituicao='" . $cidade_instituicao . "', ";
	$query .= "estado_instituicao='" . $estado_instituicao . "', ";
	$query .= "cep_instituicao='" . $cep_instituicao . "'";
	$query .= " WHERE id_instituicao='" . $id_instituicao . "'";
	$mensagem = "Informaчѕes alteradas com sucesso!";
	$url = "form_instituicao.php?modo=update&id_instituicao=" . $id_instituicao;
	$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
	
	$query = "DELETE FROM segmentos_instituicoes WHERE id_instituicao=" . $id_instituicao;
	$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
	foreach ($_POST as $chave => $valor){
		if(substr($chave, 0, 9) == "segmento_"){
			$id_segmento = str_replace("segmento_", "", $chave);
			$query = "INSERT INTO segmentos_instituicoes (id_segmento, id_instituicao) VALUES (" . $id_segmento . "," . $id_instituicao . ")";
			$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
		}
	}
}

if($result) tela_ok($mensagem, $url);

require("desconectar_mysql.php")
?>