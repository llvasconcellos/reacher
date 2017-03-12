<?
require("funcoes.php");
inicia_pagina();
monta_titulo_secao("Pessoas Cadastradas");

$busca = $_REQUEST["busca"];
$organizar = $_REQUEST["organizar"];
$script = $_SERVER['PHP_SELF'];

inicia_quadro_branco('width="100%"', ''); ?>
	<table width="100%" cellpadding="2" cellspacing="2" border="0">
		<form action="<?=$script?>" method="post">
		<tr>
			<td width="70" align="center">
				<a title="Clique para adicionar uma nova pessoa" href="form_pessoa.php">
					<img border="0" align="absmiddle" src="imagens/icone_pessoa_mais.gif">
				</a>
				<br>
				<span style="font-size:9px;">Nova Pessoa</span>
			</td>
			<td width="100" class="label">Busca:</td>
			<td width="200"><input type="text" name="busca" class="input_text" value="<?=$busca?>"></td>
			<td width="100">
				<select name="organizar">
					<option value="nome_pessoa"<? if($organizar == "nome_pessoa") echo(" selected"); ?>>Nome</option>
					<option value="email_pessoa"<? if($organizar == "email_pessoa") echo(" selected"); ?>>Email</option>
					<option value="nome_instituicao"<? if($organizar == "nome_instituicao") echo(" selected"); ?>>Instituição</option>
					<option value="dt_nascimento_pessoa"<? if($organizar == "dt_nascimento_pessoa") echo(" selected"); ?>>Data de Nascimento</option>
				</select>
			</td>
			<td width="20"><input type="image" src="imagens/lupa.gif"></td>
			<td>&nbsp;</td>
		</tr>
		</form>
	</table>
<? termina_quadro_branco();

$query = "SELECT ";
$query .= " CONCAT('<a title=\"Editar\" href=\"form_pessoa.php?modo=update&id_pessoa=', id_pessoa , '\"><img border=\"0\" src=\"imagens/editar.gif\"></a>') as id_pessoa,";
$query .= " CONCAT('<a title=\"Copiar\" href=\"form_pessoa.php?modo=copiar&id_pessoa=', id_pessoa , '\"><img border=\"0\" src=\"imagens/copiar.gif\"></a>') as copiar,";
$query .= "nome_pessoa, email_pessoa, DATE_FORMAT(dt_nascimento_pessoa,'%d/%m/%Y') as dt_nascimento_pessoa, ";
$query .= "CASE p.id_instituicao WHEN '0' THEN 'Pessoa Fisica' ELSE nome_instituicao END, ";
$query .= "CONCAT('<a href=\"javascript: apagar(', id_pessoa , ');\"><img border=\"0\" src=\"imagens/lixeira.gif\"></a>')";
$query .= " from pessoas p LEFT OUTER JOIN instituicoes i ON i.id_instituicao = p.id_instituicao";

if(!empty($busca)) {
	if($organizar == "nome_pessoa"){
		$query .= " WHERE nome_pessoa LIKE '%" . trim($busca) . "%'";
		$string = "&busca=" .  $busca . "&organizar=nome_pessoa";
	}
	if($organizar == "email_pessoa"){
		$query .= " WHERE email_pessoa LIKE '%" . trim($busca) . "%'";
		$string = "&busca=" .  $busca . "&organizar=email_pessoa";
	}
	if($organizar == "nome_instituicao"){
		$query .= " WHERE nome_instituicao LIKE '%" . trim($busca) . "%'";
		$string = "&busca=" .  $busca . "&organizar=nome_instituicao";
	}
	if($organizar == "dt_nascimento_pessoa"){
		$query .= " WHERE dt_nascimento_pessoa LIKE '%" . trim($busca) . "%'";
		$string = "&busca=" .  $busca . "&organizar=dt_nascimento_pessoa";
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

$colunas[2]['largura'] = "25%";
$colunas[2]['label'] = 'Nome';
$colunas[2]['campo'] .= 'nome_pessoa';
$colunas[2]['alinhamento'] = "left";

$colunas[3]['largura'] = "20%";
$colunas[3]['label'] = 'Email';
$colunas[3]['campo'] = 'email_pessoa';
$colunas[3]['alinhamento'] = "left";

$colunas[4]['largura'] = "16%";
$colunas[4]['label'] = 'Data&nbsp;Nascimento';
$colunas[4]['campo'] = "dt_nascimento_pessoa";
$colunas[4]['alinhamento'] = "center";

$colunas[5]['largura'] = "27%";
$colunas[5]['label'] = "Instituição";
$colunas[5]['campo'] = "nome_instituicao";
$colunas[5]['alinhamento'] = "left";

$colunas[6]['largura'] = "4%";
$colunas[6]['label'] = "&nbsp;";
$colunas[6]['campo'] = "";
$colunas[6]['alinhamento'] = "right";
?>
<script language="javascript">
	function apagar(id){
		if(confirm("Deseja remover esta pessoa do sistema?"))
			window.location = 'salva_pessoa.php?modo=apagar&pagina=<?=$_REQUEST["pagina"]?>&id_pessoa=' + id + '<?=$string?>';
	}
</script>
<? browser($query, $colunas, $string, '', 20, 2, true); ?>
<script language="javascript">
	document.forms[0].elements[0].focus();
</script>
<? termina_pagina(); ?>
