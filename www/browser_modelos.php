<?
require("funcoes.php");
inicia_pagina();
monta_titulo_secao("Modelos Cadastrados");

$busca = $_REQUEST["busca"];
$organizar = $_REQUEST["organizar"];
$script = $_SERVER['PHP_SELF'];

inicia_quadro_branco('width="100%"', ''); ?>
	<table width="100%" cellpadding="2" cellspacing="2" border="0">
		<form action="<?=$script?>" method="post">
		<tr>
			<td width="70" align="center">
				<a title="Clique para adicionar um novo modelo" href="form_modelo.php">
					<img border="0" align="absmiddle" src="imagens/icone_modelo_mais.gif">
				</a>
				<br>
				<span style="font-size:9px;">Novo Modelo</span>
			</td>
			<td width="100" class="label">Busca:</td>
			<td width="200"><input type="text" name="busca" class="input_text" value="<?=$busca?>"></td>
			<td width="100">
				<select name="organizar">
					<option value="nome_modelo"<? if($organizar == "nome_modelo") echo(" selected"); ?>>Nome</option>
					<option value="css_modelo"<? if($organizar == "css_modelo") echo(" selected"); ?>>CSS</option>
					<option value="html_modelo"<? if($organizar == "html_modelo") echo(" selected"); ?>>HTML</option>
				</select>
			</td>
			<td width="20"><input type="image" src="imagens/lupa.gif"></td>
			<td>&nbsp;</td>
		</tr>
		</form>
	</table>
<? termina_quadro_branco();

$query = "SELECT ";
$query .= " CONCAT('<a title=\"Editar\" href=\"form_modelo.php?modo=update&id_modelo=', id_modelo , '\"><img border=\"0\" src=\"imagens/editar.gif\"></a>') as id_modelo,";
$query .= " CONCAT('<a title=\"Copiar\" href=\"form_modelo.php?modo=copiar&id_modelo=', id_modelo , '\"><img border=\"0\" src=\"imagens/copiar.gif\"></a>') as copiar,";
$query .= "nome_modelo,";
$query .= " CONCAT('<xmp>', LEFT(css_modelo,50) , '</xmp>') as css_modelo,";
$query .= " CONCAT('<xmp>', LEFT(html_modelo,50) , '</xmp>') as html_modelo,";
$query .= " CONCAT('<a href=\"javascript: apagar(', id_modelo , ');\"><img border=\"0\" src=\"imagens/lixeira.gif\"></a>')";
$query .= " from modelos ";

if(!empty($busca)) {
	if($organizar == "nome_modelo"){
		$query .= " WHERE nome_modelo LIKE '%" . trim($busca) . "%'";
		$string = "&busca=" .  $busca . "&organizar=nome_modelo";
	}
	if($organizar == "css_modelo"){
		$query .= " WHERE css_modelo LIKE '%" . trim($busca) . "%'";
		$string = "&busca=" .  $busca . "&organizar=css_modelo";
	}
	if($organizar == "html_modelo"){
		$query .= " WHERE html_modelo LIKE '%" . trim($busca) . "%'";
		$string = "&busca=" .  $busca . "&organizar=html_modelo";
	}
}

$colunas[0]['largura'] = "3%";
$colunas[0]['label'] = "&nbsp;";
$colunas[0]['campo'] = "";
$colunas[0]['alinhamento'] = "left";

$colunas[1]['largura'] = "5%";
$colunas[1]['label'] = "&nbsp;";
$colunas[1]['campo'] = "";
$colunas[1]['alinhamento'] = "left";

$colunas[2]['largura'] = "30%";
$colunas[2]['label'] = 'Nome';
$colunas[2]['campo'] .= 'nome_modelo';
$colunas[2]['alinhamento'] = "left";

$colunas[3]['largura'] = "25%";
$colunas[3]['label'] = 'CSS';
$colunas[3]['campo'] .= 'css_modelo';
$colunas[3]['alinhamento'] = "left";

$colunas[4]['largura'] = "30%";
$colunas[4]['label'] = 'HTML';
$colunas[4]['campo'] = 'html_modelo';
$colunas[4]['alinhamento'] = "left";

$colunas[5]['largura'] = "4%";
$colunas[5]['label'] = "&nbsp;";
$colunas[5]['campo'] = "";
$colunas[5]['alinhamento'] = "right";
?>
<script language="javascript">
	function apagar(id){
		if(confirm("Deseja remover este modelo do sistema?"))
			window.location = 'salva_modelo.php?modo=apagar&pagina=<?=$_REQUEST["pagina"]?>&id_modelo=' + id + '<?=$string?>';
	}
</script>
<? 
browser($query, $colunas, $string, '', 20, 2, true); ?>
<script language="javascript">
	document.forms[0].elements[0].focus();
</script>
<? termina_pagina(); ?>
