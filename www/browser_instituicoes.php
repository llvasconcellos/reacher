<?
require("funcoes.php");
inicia_pagina();
monta_titulo_secao("Instituições Cadastradas");

$busca = $_REQUEST["busca"];
$organizar = $_REQUEST["organizar"];
$script = $_SERVER['PHP_SELF'];

inicia_quadro_branco('width="100%"', ''); ?>
	<table width="100%" cellpadding="2" cellspacing="2" border="0">
		<form action="<?=$script?>" method="post">
		<tr>
			<td width="70" align="center">
				<a title="Clique para adicionar uma nova instituição" href="form_instituicao.php">
					<img border="0" align="absmiddle" src="imagens/icone_instituicao_mais.gif">
				</a>
				<br>
				<span style="font-size:9px;">Nova Instituição</span>
			</td>
			<td width="100" class="label">Busca:</td>
			<td width="200"><input type="text" name="busca" class="input_text" value="<?=$busca?>"></td>
			<td width="100">
				<select name="organizar">
					<option value="nome_instituicao"<? if($organizar == "nome_instituicao") echo(" selected"); ?>>Nome</option>
					<option value="cidade_instituicao"<? if($organizar == "cidade_instituicao") echo(" selected"); ?>>Cidade</option>
					<option value="estado_instituicao"<? if($organizar == "estado_instituicao") echo(" selected"); ?>>Estado</option>
				</select>
			</td>
			<td width="20"><input type="image" src="imagens/lupa.gif"></td>
			<td>&nbsp;</td>
		</tr>
		</form>
	</table>
<? termina_quadro_branco();

$query = "SELECT ";
$query .= " CONCAT('<a title=\"Editar\" href=\"form_instituicao.php?modo=update&id_instituicao=', id_instituicao , '\"><img border=\"0\" src=\"imagens/editar.gif\"></a>') as id_instituicao,";
$query .= " CONCAT('<a title=\"Copiar\" href=\"form_instituicao.php?modo=copiar&id_instituicao=', id_instituicao , '\"><img border=\"0\" src=\"imagens/copiar.gif\"></a>') as copiar,";
$query .= "nome_instituicao, telefone_instituicao, cidade_instituicao, estado_instituicao, cep_instituicao, ";
$query .= "CONCAT('<a href=\"javascript: apagar(', id_instituicao , ');\"><img border=\"0\" src=\"imagens/lixeira.gif\"></a>')";
$query .= " from instituicoes ";

if(!empty($busca)) {
	if($organizar == "nome_instituicao"){
		$query .= " WHERE nome_instituicao LIKE '%" . trim($busca) . "%'";
		$string = "&busca=" .  $busca . "&organizar=nome_instituicao";
	}
	if($organizar == "cidade_instituicao"){
		$query .= " WHERE cidade_instituicao LIKE '%" . trim($busca) . "%'";
		$string = "&busca=" .  $busca . "&organizar=cidade_instituicao";
	}
	if($organizar == "estado_instituicao"){
		$query .= " WHERE estado_instituicao LIKE '%" . trim($busca) . "%'";
		$string = "&busca=" .  $busca . "&organizar=estado_instituicao";
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
$colunas[2]['campo'] .= 'nome_instituicao';
$colunas[2]['alinhamento'] = "left";

$colunas[3]['largura'] = "15%";
$colunas[3]['label'] = 'Telefone';
$colunas[3]['campo'] .= 'telefone_instituicao';
$colunas[3]['alinhamento'] = "left";

$colunas[4]['largura'] = "15%";
$colunas[4]['label'] = 'Cidade';
$colunas[4]['campo'] = 'cidade_instituicao';
$colunas[4]['alinhamento'] = "left";

$colunas[5]['largura'] = "10%";
$colunas[5]['label'] = 'Estado';
$colunas[5]['campo'] = "estado_instituicao";
$colunas[5]['alinhamento'] = "left";

$colunas[6]['largura'] = "15%";
$colunas[6]['label'] = "CEP";
$colunas[6]['campo'] = "cep_instituicao";
$colunas[6]['alinhamento'] = "left";

$colunas[7]['largura'] = "4%";
$colunas[7]['label'] = "&nbsp;";
$colunas[7]['campo'] = "";
$colunas[7]['alinhamento'] = "right";
?>
<script language="javascript">
	function apagar(id){
		if(confirm("Deseja remover esta instituição do sistema?"))
			window.location = 'salva_instituicao.php?modo=apagar&pagina=<?=$_REQUEST["pagina"]?>&id_instituicao=' + id + '<?=$string?>';
	}
</script>
<? 
browser($query, $colunas, $string, '', 20, 2, true); ?>
<script language="javascript">
	document.forms[0].elements[0].focus();
</script>
<? termina_pagina(); ?>
