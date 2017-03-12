<?php
require("funcoes.php");

$modo = $_REQUEST["modo"];

if(($modo == "update") || ($modo == "copiar")){
	$id_modelo = trim($_GET["id_modelo"]);
	require("conectar_mysql.php");
	$query = "SELECT * FROM modelos WHERE id_modelo='" . $id_modelo . "'";
	$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error(), false);
	$registro = mysql_fetch_assoc($result);
	$nome_modelo = $registro["nome_modelo"];
	$css_modelo = stripslashes($registro["css_modelo"]);
	$html_modelo = stripslashes($registro["html_modelo"]);
	$css = "modelo";
	$id = $id_modelo;
	require("desconectar_mysql.php");
}

inicia_pagina(true);
monta_titulo_secao("Cadastro de Modelo de Mala Direta");
?>
<table width="100%">
	<tr>
		<td align="center" valign="top">
			<? inicia_quadro_branco('width="100%"', "Formulário de Cadastro"); ?>
				<script language="javascript" type="text/javascript">
					function valida_form() {
						var f = document.forms[0];
						if(f.nome_modelo.value == ""){
							alert("Informe um nome para o modelo.");
							return false;
						}
						f.html_modelo.value = oEdit1.getHTMLBody();
						return true;
					}
					function aplicar_estilo(){
						var e = document.forms[0].css_modelo.value;
						if(e.length>0){
							self.editor.EditBox.document.styleSheets[0].cssText = e;
							self.editor.EditBox.document.styleSheets[0].cssText += "\nBODY {border: 1px black solid;border-top: none;}";
						}
					}
					function edita_css(){
						var d = document.getElementById("box_css");
						var s = document.getElementById("seta_verde");
						
						if(d.style.height == "0px") d.style.height = "";
						else d.style.height = "0px";
						
						if(d.style.overflow == "hidden") d.style.overflow = "";
						else d.style.overflow = "hidden";
						
						if(d.style.visibility == "hidden") d.style.visibility = "visible";
						else d.style.visibility = "hidden";
						
						if(d.style.visibility == "hidden") s.src = "imagens/seta_verde_direita.gif";
						else s.src = "imagens/seta_verde_baixo.gif";
					}
					function apagar(id){
						if(confirm("Deseja remover este modelo do sistema?"))
							window.location = 'salva_modelo.php?modo=apagar&id_modelo=' + id;
					}
				</script>
				<table width="98%" cellpadding="2" cellspacing="2" border="0">
					<form action="salva_modelo.php" method="post" onSubmit="return valida_form();">
					<tr>
						<td width="6%" class="label" style="text-align: left;">Nome:</td>
						<td style="text-align: left;">
							<input type="text" class="input_text" name="nome_modelo" maxlength="50" value="<?=$nome_modelo?>">
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<hr>
						</td>
					</tr>
					<tr>
						<td colspan="2" class="label" style="text-align: left;"><a href="Javascript: edita_css();" class="menu" style="color:#000000;"><img border="0" id="seta_verde" align="absmiddle" src="imagens/seta_verde_direita.gif">Regras de Estilo CSS</a></td>
					</tr>
					<tr>
						<td colspan="2" align="right">
							<div id="box_css" style="text-width: 100%; height: 0px; overflow: hidden; visibility: hidden;">
								<textarea name="css_modelo" style="width: 100%; height: 200px;"><?=$css_modelo?></textarea>
								<input type="button" value="Aplicar Estilos" class="botao_aqua" onClick="aplicar_estilo();">
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="2" class="label">
							
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<hr>
						</td>
					</tr>
					<tr>
						<td colspan="2" class="label" style="text-align: left;">Editor HTML Online</td>
					</tr>
					<tr>
						<td colspan="2">
						<?
						require("editor.php");
						$editor = new editorHTML($html_modelo, "100%", "400px", "dincss.php?oque=" . $css . "&id=" . $id);
						?>
						</td>
					</tr>
				</table>
			<? termina_quadro_branco(); ?>
			<br>
			<? inicia_quadro_branco('width="100%"', "Grava Informações"); ?>
			<table width="100%">
				<tr>
					<td align="right"><?
						if($modo == "update"){
							echo('<input type="button" value="Pré-Visualizar" class="botao_aqua" onClick="window.open(\'previsualizar.php?tipo=modelo&id=' . $id_modelo . '\');">&nbsp;');
							echo('<input type="button" value="Apagar" class="botao_aqua" onclick="apagar(' . $id_modelo . ');">');
						}
						elseif ($modo == "add") echo('<input type="reset" value="Limpar Campos" class="botao_aqua">');
						?>&nbsp;<input type="submit" value="Salvar" class="botao_aqua">
					</td>
				</tr>
			</table>
			<? termina_quadro_branco(); 
			if($modo != "update") $modo = "add";
			echo('<input type="hidden" name="modo" value="' . $modo . '">');
			echo('<input type="hidden" name="id_modelo" value="' . $id_modelo . '">');
			?>
			<input type="hidden" name="html_modelo" id="html_modelo" value='<?=rawurlencode($html_modelo)?>'>
			</form>
			<? inicia_quadro_azul('width="100%"', "Ajuda"); ?>
			<div style="width: 100%; text-align:justify;">
				<img align="absmiddle" src="imagens/info.gif">
				&nbsp;Os modelos de mala direta s&atilde;o documentos HTML em conjunto com regras de estilo css que servem de base para a cria&ccedil;&atilde;o e envio da mala direta. Aqui &eacute; criado o layout gr&aacute;fico e inseridas as imagens que v&atilde;o constituir a mala direta em si.
				Estes documentos HTML podem ser criados em algum editor html externo ou direto no editor de HTML Online.
				<hr>
				<img align="absmiddle" src="imagens/info.gif">
				&nbsp;Estilos CSS s&atilde;o regras para alterar a apar&ecirc;ncia dos elementos HTML padr&atilde;o como links, tabelas, par&aacute;grafos e o corpo do documento. Estas regras est&atilde;o descritas dentro da TAG &lt;style&gt;&lt;/style&gt;.
				<hr>
				<img align="absmiddle" src="imagens/atencao.gif">
				&nbsp;Para ser poss&iacute;vel o envio de emails personalizados, com o nome do destinat&aacute;rio, ser&aacute; necess&aacute;rio a inclus&atilde;o da palavra chave <font color="#FF0000">(*nome*)</font> dentro do corpo da mensagem toda a vez que desejar se referir ao nome do destinat&aacute;rio. O sistema ent&atilde;o, automaticamente, substituir&aacute; o a palavra chave pelo nome de cada destinat&aacute;rio do email.
				<hr>
				<img align="absmiddle" src="imagens/atencao.gif">
				&nbsp;<font color="#FF0000"><b>Aten&ccedil;&atilde;o:</b></font> Para o campo de Estilos CSS devem ser inseridos apenas os c&oacute;digos dentro da tag &lt;style&gt;&lt;/style&gt; n&atilde;o devendo ser inserida a tag em si. J&aacute; para o campo de editor HTML online, devem ser inseridos os c&oacute;digos dentro da tag &lt;body&gt;&lt;/body&gt;.
			</div>
			<? termina_quadro_azul(); ?>
		</td>
	</tr>
</table>
<script language="javascript">
	/*var i = setInterval(espera, 1000);	
	function espera(){
		if(self.editor.document.readyState == "complete"){
			aplicar_estilo();
			clearInterval(i);
		}
	}*/
	document.forms[0].elements[0].focus();
</script>
<? termina_pagina(); ?>