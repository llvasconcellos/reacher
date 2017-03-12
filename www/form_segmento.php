<?
require("funcoes.php");

$modo = $_REQUEST["modo"];

if(($modo == "update") || ($modo == "copiar")){
	$id_segmento = trim($_GET["id_segmento"]);
	require("conectar_mysql.php");
	$query = "SELECT * FROM segmentos WHERE id_segmento='" . $id_segmento . "'";
	$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error(), false);
	$registro = mysql_fetch_assoc($result);
	$id_segmento = $registro["id_segmento"];
	$nome_segmento = $registro["nome_segmento"];
	require("desconectar_mysql.php");
}


inicia_pagina();
monta_titulo_secao("Cadastro de Segmentos de Mercado");
?>
<script language="javascript">
	function valida_form(){
		var f = document.forms[0];
		if(f.nome_segmento.value == ""){
			alert("Informe o nome do Segmento");
			return false;
		}
		return true;
	}
	function apagar(id){
		if(confirm("Deseja remover este segmento do sistema?"))
			window.location = 'salva_segmento.php?modo=apagar&pagina=<?=$_REQUEST["pagina"]?>&id_segmento=' + id + '<?=$string?>';
	}
</script>
<table width="100%">
	<tr>
		<td width="25%" valign="top" align="left">
			<? inicia_quadro_azul('width="100%"', "Segmento"); ?>
			<div style="width: 100%; text-align:justify;">
				<img align="absmiddle" src="imagens/info.gif">
				&nbsp;Segmentos de mercado representam os tipos de produtos oferecidos pela sua empresa. Sendo assim &eacute; possivel enviar emails direcionados para pessoas que tem interesse em determinados tipos de produtos.
			</div>
			<? termina_quadro_azul(); ?>
		</td>
		<td width="75%" align="center" valign="top">
			<? inicia_quadro_branco('width="90%"', "Formulário de Cadastro"); ?>
			<form action="salva_segmento.php" method="post" onSubmit="return valida_form();">
			<center>
				<table width="90%" border="0" cellspacing="3">
					<tr>
						<td class="label" width="30%">Nome do Segmento:</td>
						<td><input type="text" name="nome_segmento" value="<?=$nome_segmento?>" maxlength="50" class="input_text"></td>
					</tr>
					<tr>
						<td></td>
						<td align="right"><?
							if($modo == "update") echo('<input type="button" value="Apagar" class="botao_aqua" onclick="apagar(' . $id_pessoa . ');">');
							elseif ($modo == "add") echo('<input type="reset" value="Limpar Campos" class="botao_aqua">');
							?>&nbsp;<input type="submit" value="Salvar" class="botao_aqua">
						</td>
					</tr>
				</table>
			</center>
			<? 
			if($modo != "update") $modo = "add";
			echo('<input type="hidden" name="modo" value="' . $modo . '">');
			echo('<input type="hidden" name="id_segmento" value="' . $id_segmento . '">');
			?>
			</form>
			<? termina_quadro_branco(); ?>
		</td>
	</tr>
</table>
<script language="javascript">
	document.forms[0].elements[0].focus();
</script>
<?
termina_pagina();
?>