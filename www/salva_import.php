<?
set_time_limit(0);
require("funcoes.php");
require("conectar_mysql.php");
ini_set("memory_limit", "128M");
session_start();
inicia_pagina();
monta_titulo_secao("Importando Cadastros");
inicia_quadro_branco('width="100%"', "Aguarde...");
?>
<br />
<br />
<table width="100%">
	<tr>
		<td align="right" width="30%">Progresso:</td>
		<td>
			<div style="width:100%; height:20px; border: 1px solid #000099; background-color:#535353; text-align:left;">
				<div id="progresso" style=" width:0px; height:20px; background-color:#0000FF; background-image:url(imagens/pbar.gif);"></div>
				<div id="nr_progresso" style="width:100%; height:20px; position:relative; margin-top: -16px; color:#FFFFFF; font-size:12px; font-weight:bold; font-family:Arial, Helvetica, sans-serif; text-align:center; vertical-align:middle;"></div>
			</div>
		</td>
		<td align="right" width="30%">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3"><hr /></td>
	</tr>
	<tr>
		<td colspan="3">
			<div id="log_txt" style="text-align:center;">Aguarde</div>
		</td>
	</tr>
</table>
<br />
<br />
<script language="javascript">
	var porcentagem = 0;
	function progress_update(){
		p = document.getElementById("progresso");
		n = document.getElementById("nr_progresso");
		porcentagem++;
		p.style.width = porcentagem + "%";
		n.innerHTML = porcentagem + "%";
	}
	function progress_total(){
		clearInterval(i);
		p = document.getElementById("progresso");
		n = document.getElementById("nr_progresso");
		l = document.getElementById("log_txt");
		p.style.width = "100%";
		n.innerHTML = "100%";
		l.innerHTML = '<input type="button" value="Ver Log" class="botao_aqua" onClick="hide_log(); window.open(\'salva_import_log.php?modo=display\');">&nbsp;&nbsp;&nbsp;<input type="button" value="Download Log" class="botao_aqua" onClick="hide_log(); window.location = \'salva_import_log.php?modo=download\';">';
	}
	function hide_log(){
		document.getElementById("log_txt").innerHTML = "";
	}
	function aguarde(){
		l = document.getElementById("log_txt");
		if(l.innerHTML != "Aguarde...") l.innerHTML += ".";
		else l.innerHTML = "Aguarde";
	}
	var i = setInterval("aguarde()", 1000);
</script>
<?
termina_quadro_branco();
termina_pagina();

$id_instituicao = $_SESSION["id_instituicao"];
$passo = floor(count($_SESSION["csv"])/100);
$cont = 0;
$erro = 0;
$erro1 = 0;
$acerto = 0;
sleep(5);
foreach($_SESSION["csv"] as $dados){
	if(!is_valid_email(trim($dados["email_pessoa"]))){
		$msg .= 'Erro email: ' . $dados["email_pessoa"] . ' - Formato incorreto' . chr(13) . chr(10);
		$erro1++;
	}
	else{
		$query = "SELECT email_pessoa FROM pessoas WHERE email_pessoa='" . trim($dados["email_pessoa"]) . "'";
		$result = mysql_query($query) or tela_erro("Erro de conexo ao banco de dados: " . mysql_error(), false);
		if(mysql_num_rows($result)>0){
			$msg .= 'Erro email: ' . $dados["email_pessoa"] . ' - Duplicado' . chr(13) . chr(10);
			$erro++;
		}
		else{
			$query = "INSERT INTO pessoas (id_instituicao";
	
			foreach ($dados as $chave => $valor){
				 $query .= ", " . trim($chave);
			}
			
			$query .= ") VALUES (" . trim($id_instituicao) . ",";
			
			$i = 1;
			foreach($dados as $chave => $valor){
				$query .= "'" . trim($valor) . "'";
				if($i != count($dados)) $query .= ",";
				$i++;
			}
			
			$query .= ");";
	
			$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
			$result = mysql_query("SELECT LAST_INSERT_ID();") or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
			$registro = mysql_fetch_row($result);
			$id_pessoa = $registro[0];
		
			foreach ($_SESSION["segmentos"] as $segmento){
				$query = "INSERT INTO segmentos_pessoas (id_segmento, id_pessoa) VALUES (" . $segmento . "," . $id_pessoa . ")";
				$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
			}
			$acerto++;
		}
	}
	$cont++;
	if($cont == $passo){
		echo('<script language="javascript">progress_update();</script>');
		flush();
		$cont = 0;
	}
}
require("desconectar_mysql.php");
$msg .= $acerto . ' - Emails Incluidos no Banco de Dados' . chr(13) . chr(10);
$msg .= $erro . ' - Emails duplicados' . chr(13) . chr(10);
$msg .= $erro1 . ' - Emails com formato incorreto' . chr(13) . chr(10);
$msg .= ($erro+$erro1+$acerto) . ' - Emails Processados';
$_SESSION["msg"] = $msg;
unset($_SESSION["csv"]);
echo('<script language="javascript">progress_total();</script>');
?>