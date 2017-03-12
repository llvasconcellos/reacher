<?

if(ereg("form_instituicao.php",$_SERVER['HTTP_REFERER'])) $url = $_SERVER['HTTP_REFERER'];
else $url = "browser_pessoas.php";

require("funcoes.php");
require("permissao_documento.php");
require("conectar_mysql.php");

$modo = $_REQUEST["modo"];
$pagina = $_REQUEST["pagina"];
$id_pessoa = $_REQUEST["id_pessoa"];
$id_instituicao = $_REQUEST["id_instituicao"];
$nome_pessoa = $_REQUEST["nome_pessoa"];
$telefone_pessoa = $_REQUEST["telefone_pessoa"];
$ramal_pessoa = $_REQUEST["ramal_pessoa"];
$celular_pessoa = $_REQUEST["celular_pessoa"];
$email_pessoa = $_REQUEST["email_pessoa"];
$departamento_pessoa = $_REQUEST["departamento_pessoa"];
$dt_nascimento_pessoa = $_REQUEST["dt_nascimento_pessoa"];
$recebe_email_pessoa = $_REQUEST["recebe_email_pessoa"];

if(empty($dt_nascimento_pessoa)) $dt_nascimento_pessoa = "NULL";
else{
	$dt_nascimento_pessoa = split("/", $dt_nascimento_pessoa);
	$dt_nascimento_pessoa = "'" . $dt_nascimento_pessoa[2] . "-" . $dt_nascimento_pessoa[1] . "-" . $dt_nascimento_pessoa[0] . "'";
}

if($modo == "apagar"){
	$query = "DELETE FROM pessoas WHERE id_pessoa='" . $id_pessoa . "'";
	$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error());
	
	$query = "DELETE FROM segmentos_pessoas WHERE id_pessoa=" . $id_pessoa;
	$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
		
	$mensagem = "Pessoa removida com sucesso!";
	if($result) tela_ok($mensagem, $url);
	die();
}

/////VERIFICA ANTES DE ADICIONAR A PESSOA SE ELA SERÁ ADICIONADA EM ALGUM SEGEMENTO
$num_segmento = 0;
foreach ($_POST as $chave => $valor){
	if(substr($chave, 0, 9) == "segmento_"){
		$numsegmento++;
	}
}
if($numsegmento == 0) tela_erro("Selecione pelo menos um segmento de mercado.", false);



if($modo == "add"){
	$query = "SELECT email_pessoa FROM pessoas WHERE email_pessoa='" . $email_pessoa . "'";
	$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error(), false);
	if(mysql_num_rows($result)>0) tela_erro("Já existe uma pessoa cadastrada com este email.", false);
	else{
		$query = "INSERT INTO pessoas (id_instituicao, nome_pessoa, telefone_pessoa, ramal_pessoa, celular_pessoa, email_pessoa, departamento_pessoa, recebe_email_pessoa, dt_nascimento_pessoa) VALUES ";
		$query .= "('" . $id_instituicao ."',";
		$query .= "'" . $nome_pessoa ."',";
		$query .= "'" . $telefone_pessoa ."',";
		$query .= "'" . $ramal_pessoa ."',";
		$query .= "'" . $celular_pessoa ."',";
		$query .= "'" . $email_pessoa ."',";
		$query .= "'" . $departamento_pessoa ."', ";
		$query .= "'" . $recebe_email_pessoa ."', ";
		$query .= $dt_nascimento_pessoa .")";
		$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
		$result = mysql_query("SELECT LAST_INSERT_ID();") or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
		$registro = mysql_fetch_row($result);
		$id_pessoa = $registro[0];
		

		foreach ($_POST as $chave => $valor){
			if(substr($chave, 0, 9) == "segmento_"){
				$id_segmento = str_replace("segmento_", "", $chave);
				$query = "INSERT INTO segmentos_pessoas (id_segmento, id_pessoa) VALUES (" . $id_segmento . "," . $id_pessoa . ")";
				$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
			}
		}
		
		$url = "form_pessoa.php?modo=update&id_pessoa=" . $id_pessoa;
		$mensagem = "Pessoa cadastrada com sucesso!";
	}
}
if($modo == "update"){
	$query = "UPDATE pessoas SET ";
	$query .= "id_instituicao='" . $id_instituicao . "', ";
	$query .= "nome_pessoa='" . $nome_pessoa . "', ";
	$query .= "telefone_pessoa='" . $telefone_pessoa . "', ";
	$query .= "ramal_pessoa='" . $ramal_pessoa . "', ";
	$query .= "celular_pessoa='" . $celular_pessoa . "', ";
	$query .= "email_pessoa='" . $email_pessoa . "', ";
	$query .= "departamento_pessoa='" . $departamento_pessoa . "', ";
	$query .= "recebe_email_pessoa='" . $recebe_email_pessoa . "', ";
	if($recebe_email_pessoa == "n"){
		$query .= "dt_nao_recebe_email=NOW(), ";
		$query .= "motivo=1, ";
	}
	$query .= "dt_nascimento_pessoa=" . $dt_nascimento_pessoa;
	$query .= " WHERE id_pessoa='" . $id_pessoa . "'";
	$mensagem = "Informações alteradas com sucesso!";
	$url = "form_pessoa.php?modo=update&id_pessoa=" . $id_pessoa;
	$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
	
	if($id_instituicao == 0){
		$query = "DELETE FROM segmentos_pessoas WHERE id_pessoa=" . $id_pessoa;
		$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
		foreach ($_POST as $chave => $valor){
			if(substr($chave, 0, 9) == "segmento_"){
				$id_segmento = str_replace("segmento_", "", $chave);
				$query = "INSERT INTO segmentos_pessoas (id_segmento, id_pessoa) VALUES (" . $id_segmento . "," . $id_pessoa . ")";
				$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
			}
		}
	}
}
if($result) tela_ok($mensagem, $url);

require("desconectar_mysql.php");
?>