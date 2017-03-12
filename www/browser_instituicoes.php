<?
require("funcoes.php");
inicia_pagina();
monta_titulo_secao("Instituições Cadastradas");

$busca = $_REQUEST["busca"];
$segmento = $_REQUEST["segmento"];
$filtro = $_REQUEST["filtro"];
$organizar = $_REQUEST["organizar"];
$script = $_SERVER['PHP_SELF'];

inicia_quadro_branco('width="100%"', ''); 
?>
	<table width="100%" cellpadding="2" cellspacing="2" border="0">
		<form action="<?=$script?>" method="post">
		<tr>
			<td width="70" align="center">
				<a title="Clique para adicionar uma nova instituição" href="form_instituicao.php">
					<img border="0" align="absmiddle" src="imagens/icone_instituicao_mais.gif">
				</a>
				<br>
				<span style="font-size:9px;">Nova&nbsp;Institui&ccedil;&atilde;o</span>
			</td>
			<td width="50" class="label">Busca:</td>
			<td width="150"><input type="text" name="busca" class="input_text" value="<?=$busca?>"></td>
			<td width="130">
				<select name="filtro">
					<option value="nome_instituicao"<? if($filtro == "nome_instituicao") echo(" selected"); ?>>Nome</option>
					<option value="cidade_instituicao"<? if($filtro == "cidade_instituicao") echo(" selected"); ?>>Cidade</option>
					<option value="estado_instituicao"<? if($filtro == "estado_instituicao") echo(" selected"); ?>>Estado</option>
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
$query .= " CONCAT('<a title=\"Editar\" href=\"form_instituicao.php?modo=update&id_instituicao=', i.id_instituicao , '\"><img border=\"0\" src=\"imagens/editar.gif\"></a>') as editar,";
$query .= " CONCAT('<a title=\"Copiar\" href=\"form_instituicao.php?modo=copiar&id_instituicao=', i.id_instituicao , '\"><img border=\"0\" src=\"imagens/copiar.gif\"></a>') as copiar,";
$query .= "i.nome_instituicao, i.telefone_instituicao, i.cidade_instituicao, i.estado_instituicao, i.cep_instituicao,  ";
$query .= "CONCAT('<a href=\"javascript: apagar(', i.id_instituicao , ');\"><img border=\"0\" src=\"imagens/lixeira.gif\"></a>') as apagar,";
$query .= "CONCAT('<div class=\'titulo_info_box\'>Segmentos</div>', GROUP_CONCAT(s.nome_segmento SEPARATOR '<br>')) as info_box";

$query .= " FROM instituicoes i LEFT OUTER JOIN segmentos_instituicoes si ON i.id_instituicao = si.id_instituicao LEFT OUTER JOIN segmentos s ON si.id_segmento = s.id_segmento";

if(!empty($segmento)) {
	$query .= " WHERE si.id_segmento = " . $segmento;
	$string = "&segmento=" . $segmento;
}

if(!empty($busca)) {
	if(empty($segmento)) $query .= " WHERE ";
	else $query .= " AND ";
	$string .= "&busca=" .  $busca;
	
	if($filtro == "nome_instituicao"){
		$query .= " nome_instituicao LIKE '%" .  addslashes(trim($busca)) . "%'";
	}
	if($filtro == "cidade_instituicao"){
		$query .= " cidade_instituicao LIKE '%" .  addslashes(trim($busca)) . "%'";
	}
	if($filtro == "estado_instituicao"){
		$query .= " estado_instituicao LIKE '%" .  addslashes(trim($busca)) . "%'";
	}
}

$string .= "&organizar=" . $organizar . "&filtro=" . $filtro;

$query .= " GROUP BY i.id_instituicao";

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

$colunas[2]['largura'] = "30%";
$colunas[2]['label'] = 'Nome';
$colunas[2]['campo'] .= 'nome_instituicao';
$colunas[2]['alinhamento'] = "left";
$colunas[2]['ordena'] = true;

$colunas[3]['largura'] = "15%";
$colunas[3]['label'] = 'Telefone';
$colunas[3]['campo'] .= 'telefone_instituicao';
$colunas[3]['alinhamento'] = "left";
$colunas[3]['ordena'] = true;

$colunas[4]['largura'] = "15%";
$colunas[4]['label'] = 'Cidade';
$colunas[4]['campo'] = 'cidade_instituicao';
$colunas[4]['alinhamento'] = "left";
$colunas[4]['ordena'] = true;

$colunas[5]['largura'] = "10%";
$colunas[5]['label'] = 'Estado';
$colunas[5]['campo'] = "estado_instituicao";
$colunas[5]['alinhamento'] = "left";
$colunas[5]['ordena'] = true;

$colunas[6]['largura'] = "5%";
$colunas[6]['label'] = "CEP";
$colunas[6]['campo'] = "cep_instituicao";
$colunas[6]['alinhamento'] = "left";
$colunas[6]['ordena'] = true;

$colunas[7]['largura'] = "4%";
$colunas[7]['label'] = "&nbsp;";
$colunas[7]['campo'] = "apagar";
$colunas[7]['alinhamento'] = "right";
$colunas[7]['ordena'] = false;

?>
<script language="javascript">
	function apagar(id){
		if(confirm("Deseja remover esta instituição do sistema?"))
			window.location = 'salva_instituicao.php?modo=apagar&pagina=<?=$_REQUEST["pagina"]?>&id_instituicao=' + id + '<?=$string?>';
	}
</script>
<? browser($query, $colunas, $string, '', 20, 2, true); ?>
<script language="javascript">
	document.forms[0].elements[0].focus();
</script>
<? termina_pagina(); ?>
