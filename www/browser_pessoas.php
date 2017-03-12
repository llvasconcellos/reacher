<?
require("funcoes.php");
inicia_pagina();
monta_titulo_secao("Pessoas Cadastradas");

$busca = $_REQUEST["busca"];
$segmento = $_REQUEST["segmento"];
$filtro = $_REQUEST["filtro"];
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
			<td width="50" class="label">Busca:</td>
			<td width="150"><input type="text" name="busca" class="input_text" value="<?=$busca?>"></td>
			<td width="100">
				<select name="filtro">
					<option value="nome_pessoa"<? if($filtro == "nome_pessoa") echo(" selected"); ?>>Nome</option>
					<option value="email_pessoa"<? if($filtro == "email_pessoa") echo(" selected"); ?>>Email</option>
					<option value="nome_instituicao"<? if($filtro == "nome_instituicao") echo(" selected"); ?>>Institui&ccedil;&atilde;o</option>
					<option value="dt_nascimento_pessoa"<? if($filtro == "dt_nascimento_pessoa") echo(" selected"); ?>>Data de Nascimento</option>
				</select>
			</td>
			<td width="70" class="label">Segmento:</td>
			<td width="150">
				<select name="segmento" style="width:100%;">
				<option value=""></option>
				<?
				$query = "SELECT id_segmento, nome_segmento FROM segmentos ORDER BY nome_segmento";
				require("conectar_mysql.php");
				$result = mysql_query($query) or tela_erro("Erro na consulta ao Banco de dados: " . mysql_error(), false);
				while($registro = mysql_fetch_assoc($result)){
					echo('<option value="' . $registro["id_segmento"] . '"');
					if(($registro["id_segmento"] == $segmento)) echo(" selected");
					echo('>' . $registro["nome_segmento"] . '</option>');
				}
				require("desconectar_mysql.php");
				?></select>
			</td>
			<td width="20"><input type="image" src="imagens/lupa.gif"></td>
			<td>&nbsp;</td>
		</tr>
		</form>
	</table>
<? termina_quadro_branco();

$query = "SELECT ";
$query .= " CONCAT('<a title=\"Editar\" href=\"form_pessoa.php?modo=update&id_pessoa=', p.id_pessoa , '\"><img border=\"0\" src=\"imagens/editar.gif\"></a>') as editar,";
$query .= " CONCAT('<a title=\"Copiar\" href=\"form_pessoa.php?modo=copiar&id_pessoa=', p.id_pessoa , '\"><img border=\"0\" src=\"imagens/copiar.gif\"></a>') as copiar,";
$query .= "p.nome_pessoa, p.email_pessoa, DATE_FORMAT(p.dt_nascimento_pessoa,'%d/%m/%Y') as dt_nascimento_pessoa, ";
$query .= "CASE p.id_instituicao WHEN '0' THEN 'Pessoa Fisica' ELSE i.nome_instituicao END as nome_instituicao, ";
$query .= " CASE p.recebe_email_pessoa WHEN 'n' THEN '<img border=\"0\" title=\"Não recebe email\" src=\"imagens/n.png\">' WHEN 's' THEN '<img border=\"0\" title=\"Recebe Email\" src=\"imagens/s.png\">' END as recebe_email_pessoa,";
$query .= "CONCAT('<a href=\"javascript: apagar(', p.id_pessoa , ');\"><img border=\"0\" src=\"imagens/lixeira.gif\"></a>') as apagar,";
$query .= "CONCAT('<div class=\'titulo_info_box\'>Segmentos</div>', GROUP_CONCAT(s.nome_segmento SEPARATOR '<br>')) as info_box";
$query .= " FROM segmentos s, segmentos_pessoas sp, pessoas p LEFT OUTER JOIN instituicoes i ON i.id_instituicao = p.id_instituicao ";
$query .= " WHERE sp.id_pessoa = p.id_pessoa AND s.id_segmento = sp.id_segmento";

if(!empty($segmento)) {
	$string = "&segmento=" . $segmento;
	$query .= " AND sp.id_segmento = " . $segmento;
}

if(!empty($busca)) {	
	$string .= "&busca=" .  $busca;
	$query .= " AND ";
	if($filtro == "nome_pessoa"){
		$query .= " nome_pessoa LIKE '%" . addslashes(trim($busca)) . "%'";
	}
	if($filtro == "email_pessoa"){
		$query .= " email_pessoa LIKE '%" . addslashes(trim($busca)) . "%'";
	}
	if($filtro == "nome_instituicao"){
		$query .= " nome_instituicao LIKE '%" . addslashes(trim($busca)) . "%'";
	}
	if($filtro == "dt_nascimento_pessoa"){
		$query .= " dt_nascimento_pessoa LIKE '%" . addslashes(trim($busca)) . "%'";
	}
}


$query .= " GROUP BY p.email_pessoa";
$string .= "&organizar=" . $organizar . "&filtro=" . $filtro;

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

$colunas[2]['largura'] = "25%";
$colunas[2]['label'] = 'Nome';
$colunas[2]['campo'] .= 'nome_pessoa';
$colunas[2]['alinhamento'] = "left";
$colunas[2]['ordena'] = true;

$colunas[3]['largura'] = "20%";
$colunas[3]['label'] = 'Email';
$colunas[3]['campo'] = 'email_pessoa';
$colunas[3]['alinhamento'] = "left";
$colunas[3]['ordena'] = true;

$colunas[4]['largura'] = "16%";
$colunas[4]['label'] = 'Data&nbsp;Nascimento';
$colunas[4]['campo'] = "dt_nascimento_pessoa";
$colunas[4]['alinhamento'] = "center";
$colunas[4]['ordena'] = true;

$colunas[5]['largura'] = "23%";
$colunas[5]['label'] = "Instituição";
$colunas[5]['campo'] = "nome_instituicao";
$colunas[5]['alinhamento'] = "left";
$colunas[5]['ordena'] = true;

$colunas[6]['largura'] = "4%";
$colunas[6]['label'] = "Email?";
$colunas[6]['campo'] = "recebe_email_pessoa";
$colunas[6]['alinhamento'] = "center";
$colunas[6]['ordena'] = true;

$colunas[7]['largura'] = "4%";
$colunas[7]['label'] = "&nbsp;";
$colunas[7]['campo'] = "apagar";
$colunas[7]['alinhamento'] = "right";
$colunas[7]['ordena'] = true;
?>
<script language="javascript">
	function apagar(id){
		if(confirm("Deseja remover esta pessoa do sistema?"))
			window.location = 'salva_pessoa.php?modo=apagar&pagina=<?=$_REQUEST["pagina"]?>&id_pessoa=' + id + '<?=$string?>';
	}
</script>
<div id="navtxt" class="navtext" style="position:absolute; top:-100px; left:0px; visibility:hidden"></div>
<? 
browser($query, $colunas, $string, '', 20, 2, true); ?>
<script language="javascript">
	document.forms[0].elements[0].focus();
</script>
<? termina_pagina(); ?>
