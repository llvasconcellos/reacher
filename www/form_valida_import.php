<?
require("funcoes.php");
ini_set("memory_limit", "128M");
session_start();
$campos_arquivo = $_POST["campos_arquivo"];
$file = $_FILES["arquivo"]["tmp_name"];
if(strlen($file) == 0) tela_erro("Erro no arquivo", false);
$_SESSION["id_instituicao"] = $_POST["id_instituicao"];
$segmentos = array();
foreach ($_POST as $chave => $valor){
	if(substr($chave, 0, 9) == "segmento_")
		$segmentos[] = str_replace("segmento_", "", $chave);
}
if(count($segmentos) == 0) tela_erro("Selecione pelo menos um segmento de mercado.", false);
$_SESSION["segmentos"] = $segmentos;
$_SESSION["csv"] = array_diff(file($file), array("\r\n", "\n", "\r", "\n\r"));
sort($_SESSION["csv"]);

switch($_POST["separador"]){
	case "0":
		$separador = ";";
		break;
	case "1":
		$separador = ",";
		break;
	case "2":
		$separador = chr(9);
		break;
}

$dados = array();

foreach($_SESSION["csv"] as $linha){
	if(ereg($separador, $linha))
		$dados[] = array_combine_reacher($campos_arquivo, split($separador, trim($linha)));
	else
		$dados[] = array_combine_reacher($campos_arquivo, array(trim($linha)));
}

$_SESSION["csv"] = $dados;

inicia_pagina();
monta_titulo_secao("Verifique a formatação dos dados antes da importação");
inicia_quadro_branco('width="100%"', "Grava Informações"); ?>
<table width="100%">
	<tr>
		<td align="right">
			<form action="salva_import.php" method="post">
				<input type="submit" value="Anexar ao Banco de Dados" class="botao_aqua">
			</form>
		</td>
	</tr>
</table>
<? termina_quadro_branco(); ?>
<br />
<? inicia_quadro_branco('width="100%"', "Dados para Importação"); ?>
<BR>
<table width="100%" class="conteudo_quadro_claro" border="0" cellpadding="2" cellspacing="0">
	<tr style="background-color:#A6C1DC;">
		<?
		for($i = 0; $i < count($campos_arquivo); $i++){ ?>
			<td width="<?=round(100/count($campos_arquivo))?>%"><?=$campos_arquivo[$i]?></td>
		<? } ?>
	</tr>
	<tr>
		<td colspan="<?=count($campos_arquivo);?>">&nbsp;</td>
	</tr>
	<?
	$cont = 0;
	$j = 0;
	foreach($dados as $inf){
		if($j == 0){ 
			?>
			<tr style="background-color: #E6EDF7;" onMouseOver="this.style.backgroundColor = '#BACAEB';" onMouseOut="this.style.backgroundColor = '#E6EDF7';">
			<?
			$j = 1;
		}
		else{
			?>
			<tr onMouseOver="this.style.backgroundColor = '#BACAEB';" onMouseOut="this.style.backgroundColor = '';">
			<?
			$j = 0;
		}
		foreach($campos_arquivo as $temp){
			echo('<td valign="top">' . $inf[$temp] . '</td>');
		}
		echo("</tr>");
		if($cont == 20) break;
		$cont++;
	}
	?>
</table>
<br>
<div style="text-align:right;"><span style="color:#FF0000"><?=count($dados)?></span>&nbsp;Registros Procesados</div>
<br>
<? termina_quadro_branco();
termina_pagina();
?>