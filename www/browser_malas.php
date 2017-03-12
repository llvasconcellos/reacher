<?
require("funcoes.php");
inicia_pagina();
monta_titulo_secao("Malas Diretas Cadastradas");

$busca = $_REQUEST["busca"];
$organizar = $_REQUEST["organizar"];
$script = $_SERVER['PHP_SELF'];

inicia_quadro_branco('width="100%"', ''); ?>
	<table width="100%" cellpadding="2" cellspacing="2" border="0">
		<form action="<?=$script?>" method="post">
		<tr>
			<td width="80" align="center">
				<a title="Clique para adicionar um novo modelo" href="form_mala.php">
					<img border="0" align="absmiddle" src="imagens/icone_mala_mais.gif">
				</a>
				<br>
				<span style="font-size:9px;">Nova Mala Direta</span>
			</td>
			<td width="100" class="label">Busca:</td>
			<td width="200"><input type="text" name="busca" class="input_text" value="<?=$busca?>"></td>
			<td width="100">
				<select name="organizar">
					<option value="nome_mala"<? if($organizar == "nome_mala") echo(" selected"); ?>>Nome</option>
					<option value="css_mala"<? if($organizar == "css_mala") echo(" selected"); ?>>CSS</option>
					<option value="html_mala"<? if($organizar == "html_mala") echo(" selected"); ?>>HTML</option>
					<option value="data_mala"<? if($organizar == "data_mala") echo(" selected"); ?>>Data</option>
				</select>
			</td>
			<td width="20"><input type="image" src="imagens/lupa.gif"></td>
			<td>&nbsp;</td>
		</tr>
		</form>
	</table>
<? termina_quadro_branco();

$query = "SELECT ";
$query .= " CONCAT('<a title=\"Editar\" href=\"form_mala.php?modo=update&id_mala=', id_mala , '\"><img border=\"0\" src=\"imagens/editar.gif\"></a>') as editar,";
$query .= " CONCAT('<a title=\"Copiar\" href=\"form_mala.php?modo=copiar&id_mala=', id_mala , '\"><img border=\"0\" src=\"imagens/copiar.gif\"></a>') as copiar,";
$query .= "nome_mala, DATE_FORMAT(data_mala,'%d/%m/%Y') as data_mala, ";
$query .= " CONCAT('<xmp>', LEFT(css_mala,50) , '</xmp>') as css_mala,";
$query .= " CONCAT('<xmp>', LEFT(html_mala,50) , '</xmp>') as html_mala,";
$query .= " CASE status_mala WHEN 1 THEN CONCAT('<a href=\"javascript: alterar_status(', id_mala , ',2);\"><img border=\"0\" title=\"Mala Direta agendada para envio\" src=\"imagens/icone_email_agendado.gif\"></a>') WHEN 2 THEN CONCAT('<a href=\"javascript: alterar_status(', id_mala , ',1);\"><img border=\"0\" title=\"Mala Direta enviada\" src=\"imagens/icone_email_enviado.gif\"></a>') WHEN 3 THEN '<a href=\"javascript: alert(\'Mala direta em processamento. Aguarde a conclusão do envio.\');\"><img border=\"0\" title=\"Em processamento\" src=\"imagens/executando.png\"></a>' END as status_mala,";
$query .= " CONCAT('<a href=\"javascript: apagar(', id_mala , ');\"><img border=\"0\" src=\"imagens/lixeira.gif\"></a>') as apagar";
$query .= " from malas ";

if(!empty($busca)) {
	if($organizar == "nome_mala"){
		$query .= " WHERE nome_mala LIKE '%" .  addslashes(trim($busca)) . "%'";
		$string = "&busca=" .  $busca . "&organizar=nome_mala";
	}
	if($organizar == "css_mala"){
		$query .= " WHERE css_mala LIKE '%" .  addslashes(trim($busca)) . "%'";
		$string = "&busca=" .  $busca . "&organizar=css_mala";
	}
	if($organizar == "html_mala"){
		$query .= " WHERE html_mala LIKE '%" .  addslashes(trim($busca)) . "%'";
		$string = "&busca=" .  $busca . "&organizar=html_mala";
	}
	if($organizar == "data_mala"){
		$query .= " WHERE data_mala LIKE '%" .  addslashes(trim($busca)) . "%'";
		$string = "&busca=" .  $busca . "&organizar=data_mala";
	}
}

$colunas[0]['largura'] = "3%";
$colunas[0]['label'] = "&nbsp;";
$colunas[0]['campo'] = "editar";
$colunas[0]['alinhamento'] = "left";
$colunas[0]['ordena'] = false;

$colunas[1]['largura'] = "5%";
$colunas[1]['label'] = "&nbsp;";
$colunas[1]['campo'] = "copiar";
$colunas[1]['alinhamento'] = "left";
$colunas[1]['ordena'] = false;

$colunas[2]['largura'] = "26%";
$colunas[2]['label'] = 'Nome';
$colunas[2]['campo'] .= 'nome_mala';
$colunas[2]['alinhamento'] = "left";
$colunas[2]['ordena'] = true;

$colunas[3]['largura'] = "15%";
$colunas[3]['label'] = 'Data';
$colunas[3]['campo'] .= 'data_mala';
$colunas[3]['alinhamento'] = "left";
$colunas[3]['ordena'] = true;

$colunas[4]['largura'] = "20%";
$colunas[4]['label'] = 'CSS';
$colunas[4]['campo'] .= 'css_mala';
$colunas[4]['alinhamento'] = "left";
$colunas[4]['ordena'] = true;

$colunas[5]['largura'] = "20%";
$colunas[5]['label'] = 'HTML';
$colunas[5]['campo'] = 'html_mala';
$colunas[5]['alinhamento'] = "left";
$colunas[5]['ordena'] = true;

$colunas[6]['largura'] = "4%";
$colunas[6]['label'] = "Status";
$colunas[6]['campo'] = "status_mala";
$colunas[6]['alinhamento'] = "center";
$colunas[6]['ordena'] = true;

$colunas[7]['largura'] = "4%";
$colunas[7]['label'] = "&nbsp;";
$colunas[7]['campo'] = "apagar";
$colunas[7]['alinhamento'] = "right";
$colunas[7]['ordena'] = false;
?>
<script language="javascript">
	function apagar(id){
		if(confirm("Deseja remover este mala direta do sistema?"))
			window.location = 'salva_mala.php?modo=apagar&pagina=<?=$_REQUEST["pagina"]?>&id_mala=' + id + '<?=$string?>';
	}
	function alterar_status(id, status){
		if(confirm("Deseja modificar o status desta mala direta?"))
			window.location = 'salva_mala.php?modo=alterar_status&pagina=<?=$_REQUEST["pagina"]?>&id_mala=' + id + '&status_mala=' + status + '<?=$string?>';
	}
</script>
<? 
browser($query, $colunas, $string, '', 20, 2, true); ?>
<script language="javascript">
	document.forms[0].elements[0].focus();
</script>
<? termina_pagina(); ?>
