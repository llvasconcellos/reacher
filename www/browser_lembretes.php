<?
require("funcoes.php");
inicia_pagina();
monta_titulo_secao("Lembretes Cadastrados");

$busca = $_REQUEST["busca"];
$organizar = $_REQUEST["organizar"];
$script = $_SERVER['PHP_SELF'];

inicia_quadro_branco('width="100%"', ''); ?>
	<table width="100%" cellpadding="2" cellspacing="2" border="0">
		<form action="<?=$script?>" method="post">
		<tr>
			<td width="80" align="center">
				<a title="Clique para adicionar um novo lembrete" href="form_lembrete.php">
					<img border="0" align="absmiddle" src="imagens/icone_cal_mais.gif">
				</a>
				<br>
				<span style="font-size:9px;">Novo Lembrete</span>
			</td>
			<td width="100" class="label">Busca:</td>
			<td width="200"><input type="text" name="busca" class="input_text" value="<?=$busca?>"></td>
			<td width="100">
				<select name="organizar">
					<option value="titulo"<? if($organizar == "titulo") echo(" selected"); ?>>Titulo</option>
					<option value="texto"<? if($organizar == "texto") echo(" selected"); ?>>Texto</option>
					<option value="data"<? if($organizar == "data") echo(" selected"); ?>>Data</option>
				</select>
			</td>
			<td width="20"><input type="image" src="imagens/lupa.gif"></td>
			<td>&nbsp;</td>
		</tr>
		</form>
	</table>
<? termina_quadro_branco();

$query = "SELECT ";
$query .= " CONCAT('<a title=\"Editar\" href=\"form_lembrete.php?modo=update&id_lembrete=', id_lembrete , '\"><img border=\"0\" src=\"imagens/editar.gif\"></a>') as editar,";
$query .= " CONCAT('<a title=\"Copiar\" href=\"form_lembrete.php?modo=copiar&id_lembrete=', id_lembrete , '\"><img border=\"0\" src=\"imagens/copiar.gif\"></a>') as copiar,";
$query .= "titulo, ";
$query .= " CONCAT('<xmp>', LEFT(texto,50) , ' ...</xmp>') as texto,";
$query .= " DATE_FORMAT(data,'%d/%m/%Y') as data,";
$query .= " CASE status WHEN 1 THEN CONCAT('<a href=\"javascript: alterar_status(', id_lembrete , ',2);\"><img border=\"0\" title=\"Lembrete agendado para envio\" src=\"imagens/icone_email_agendado.gif\"></a>') WHEN 2 THEN CONCAT('<a href=\"javascript: alterar_status(', id_lembrete , ',1);\"><img border=\"0\" title=\"Lembrete enviado\" src=\"imagens/icone_email_enviado.gif\"></a>') END as status,";
$query .= " CONCAT('<a href=\"javascript: apagar(', id_lembrete , ');\"><img border=\"0\" src=\"imagens/lixeira.gif\"></a>') as apagar";
$query .= " FROM lembretes ";

if(!empty($busca)) {
	if($organizar == "titulo"){
		$query .= " WHERE titulo LIKE '%" .  addslashes(trim($busca)) . "%'";
		$string = "&busca=" .  $busca . "&organizar=titulo";
	}
	if($organizar == "texto"){
		$query .= " WHERE texto LIKE '%" .  addslashes(trim($busca)) . "%'";
		$string = "&busca=" .  $busca . "&organizar=texto";
	}
	if($organizar == "data"){
		$query .= " WHERE data LIKE '%" .  addslashes(trim($busca)) . "%'";
		$string = "&busca=" .  $busca . "&organizar=data";
	}
}

$colunas[0]['largura'] = "5%";
$colunas[0]['label'] = "&nbsp;";
$colunas[0]['campo'] = "editar";
$colunas[0]['alinhamento'] = "left";
$colunas[0]['ordena'] = false;

$colunas[1]['largura'] = "5%";
$colunas[1]['label'] = "&nbsp;";
$colunas[1]['campo'] = "copiar";
$colunas[1]['alinhamento'] = "left";
$colunas[1]['ordena'] = false;

$colunas[2]['largura'] = "20%";
$colunas[2]['label'] = 'Título';
$colunas[2]['campo'] .= 'titulo';
$colunas[2]['alinhamento'] = "left";
$colunas[2]['ordena'] = true;

$colunas[3]['largura'] = "20%";
$colunas[3]['label'] = 'Texto';
$colunas[3]['campo'] .= 'texto';
$colunas[3]['alinhamento'] = "left";
$colunas[3]['ordena'] = true;

$colunas[4]['largura'] = "20%";
$colunas[4]['label'] = 'Data';
$colunas[4]['campo'] .= 'data';
$colunas[4]['alinhamento'] = "right";
$colunas[4]['ordena'] = true;

$colunas[5]['largura'] = "4%";
$colunas[5]['label'] = "Status";
$colunas[5]['campo'] = "status";
$colunas[5]['alinhamento'] = "center";
$colunas[5]['ordena'] = true;

$colunas[6]['largura'] = "4%";
$colunas[6]['label'] = "&nbsp;";
$colunas[6]['campo'] = "apagar";
$colunas[6]['alinhamento'] = "right";
$colunas[6]['ordena'] = false;
?>
<script language="javascript">
	function apagar(id){
		if(confirm("Deseja remover este lembrete do sistema?"))
			window.location = 'salva_lembrete.php?modo=apagar&id_lembrete=' + id + '<?=$string?>';
	}
	function alterar_status(id, status){
		if(confirm("Deseja modificar o status deste lembrete?"))
			window.location = 'salva_lembrete.php?modo=alterar_status&id_lembrete=' + id + '&status_lembrete=' + status + '<?=$string?>';
	}
</script>
<? 
browser($query, $colunas, $string, '', 20, 2, true); ?>
<script language="javascript">
	document.forms[0].elements[0].focus();
</script>
<? termina_pagina(); ?>
