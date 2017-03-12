<?php
require("funcoes.php");

$modo = $_REQUEST["modo"];
if(empty($modo)) $modo = "add";

if($modo == "add"){
	$id_modelo = trim($_GET["id_modelo"]);
	require("conectar_mysql.php");
	$query = "SELECT * FROM modelos WHERE id_modelo='" . $id_modelo . "'";
	$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error(), false);
	$registro = mysql_fetch_assoc($result);
	$css_mala = stripslashes($registro["css_modelo"]);
	$html_mala = stripslashes($registro["html_modelo"]);
	require("desconectar_mysql.php");
}
elseif(($modo == "update") || ($modo == "copiar")){
	$id_mala = trim($_GET["id_mala"]);
	require("conectar_mysql.php");
	$query = "SELECT nome_mala, assunto_mala, css_mala, html_mala, DATE_FORMAT(data_mala,'%d/%m/%Y') as data_mala, status_mala FROM malas WHERE id_mala='" . $id_mala . "'";
	$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error(), false);
	$registro = mysql_fetch_assoc($result);
	$css_mala = stripslashes($registro["css_mala"]);
	$html_mala = stripslashes($registro["html_mala"]);
	$data_mala = $registro["data_mala"];
	$nome_mala = $registro["nome_mala"];
	$assunto_mala = $registro["assunto_mala"];
	$status_mala = $registro["status_mala"];
	require("desconectar_mysql.php");
}

inicia_pagina(true);
monta_titulo_secao("Cadastro de Mala Direta");
?>
<table width="100%">
	<tr>
		<td align="center" valign="top">
			<? inicia_quadro_branco('width="100%"', "Formulário de Cadastro"); ?>
				<script language="JavaScript" src="calendar1.js"></script>
				<script language="JavaScript" src="data.js"></script>
				<script language="javascript" type="text/javascript">
					function valida_form() {
						var f = document.forms[0];
						if(f.nome_mala.value == ""){
							alert("Informe um nome para identificar a mala direta.");
							return false;
						}
						if (!editor.cbMode.checked) f.html_mala.value = editor.idEditbox.document.body.innerHTML;
						else f.html_mala.value = editor.idEditbox.document.body.innerText;
						return true;
					}
					function aplicar_estilo(){
						var e = unescape(document.forms[0].css_mala.value);
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
				</script>
				<table width="98%" cellpadding="2" cellspacing="2" border="0">
					<form action="salva_mala.php" method="post" onSubmit="return valida_form();">
					<? if($modo == "add"){ ?>
						<tr>
							<td class="label" width="6%">Modelo:</td>
							<td>
								<select name="id_modelo" onChange="self.location = 'form_mala.php?modo=add&id_modelo=' + this.value">
									<option value="0">Selecione o Modelo</option>
									<?php
									$query = "SELECT id_modelo, nome_modelo FROM modelos ORDER BY nome_modelo";
									require("conectar_mysql.php");
									$result = mysql_query($query) or tela_erro("Erro na consulta ao Banco de dados: " . mysql_error(), false);
									while($registro = mysql_fetch_assoc($result)){
										echo('<option value="' . $registro["id_modelo"] . '"');
										if($_REQUEST["id_modelo"] == $registro["id_modelo"]) echo(" selected");
										echo('>' . $registro["nome_modelo"] . '</option>');
									}
									require("desconectar_mysql.php");
									?>
								</select>
							</td>
							<td width="5%"><span id="edit_inst" style="visibility: <? if($id_instituicao != 0) echo('visible'); else echo('hidden'); ?>"><a title="Editar informações da instituição" href="Javascript: editar_instituicao(document.forms[0].elements[0].value);"><img border="0" src="imagens/editar.gif"></a></span></td>
						</tr>
					<? } ?>
					<tr>
						<td width="6%" class="label" style="text-align: left;">Nome:</td>
						<td style="text-align: left;">
							<input type="text" class="input_text" name="nome_mala" maxlength="50" value="<?=$nome_mala?>">
						</td>
						<td></td>
					</tr>
					<tr>
						<td width="6%" class="label" style="text-align: left;">Assunto:</td>
						<td style="text-align: left;">
							<input type="text" class="input_text" name="assunto_mala" maxlength="100" value="<?=$assunto_mala?>">
						</td>
						<td></td>
					</tr>
					<tr>
						<td width="6%" class="label" style="text-align: left;">Data:</td>
						<td style="text-align: left;">
							<input type="text" class="input_text" name="data_mala" value="<?=$data_mala?>" maxlength="10" onKeypress="return ajustar_data(this,event);" >
						</td>
						<td width="5%" align="right"><a href="javascript: cal1.popup();"><img src="imagens/cal.gif" border="0" alt="Clique aqui para escolher a data de nascimento"></a></td>
					</tr>
					<?
					if($modo == "update"){ ?>
					<tr>
						<td class="label"></td>
						<td class="label">
							<fieldset>
								<legend><b>Status da Mala Direta</b></legend>
								<table width="100%">
									<tr>
										<td width="40%" class="label">Agendada para envio</td>
										<td><input type="radio" name="status_mala" value="1"<? if ($status_mala == "1") echo(" checked");?>></td>
										<td width="10%">&nbsp;</td>
										<td width="40%" class="label">Enviada</td>
										<td><input type="radio" name="status_mala" value="2"<? if(($status_mala == "2") || ($modo == "add")) echo(" checked");?>></td>
									</tr>
								</table>
							</fieldset>
						</td>
					</tr>
					<? } ?>
					<tr>
						<td colspan="3">
							<hr>
						</td>
					</tr>
					<tr>
						<td colspan="3" class="label" style="text-align: left;">Editor HTML Online</td>
					</tr>
					<tr>
						<td colspan="3"><iframe width="100%" height="400" src="../editor.php?var=html_mala" name="editor" id="editor"></iframe></td>
					</tr>
				</table>
			<? termina_quadro_branco(); ?>
			<br>
			<? inicia_quadro_branco('width="100%"', "Segmentos de Mercado"); ?>
			<table width="100%" border="0">
				<?
				require("conectar_mysql.php");
				$i = 0;
				$query = "SELECT * FROM segmentos";
				$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error(), false);
				if(mysql_num_rows($result) == 0) echo("Nenhum registro encontrado.");
				while($registro = mysql_fetch_assoc($result)){
					if($i == 0) echo('<tr>');
					echo('<td width="2%">');
					
					if(($modo == "update") || ($modo == "copiar")){
						$query = "SELECT * FROM segmentos_malas WHERE id_segmento=" . $registro["id_segmento"] . " AND id_mala=" . $id_mala;
						$result2 = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error(), false);
					}
					if((mysql_num_rows($result2)>0) && (($modo == "update") || ($modo == "copiar"))) echo('<input type="checkbox" name="segmento_' . $registro["id_segmento"] . '" checked></td>');
					else echo('<input type="checkbox" name="segmento_' . $registro["id_segmento"] . '"></td>');
					
					echo('<td width="40%" align="left">' . $registro["nome_segmento"] . '</td>');
					if($i == 0){
						echo('<td width="6%"></td>');
						$i++;
					}
					else{
						 echo('</tr>');
						 $i--;
					}
				}
				require("desconectar_mysql.php");
				?>
			</table>
			<? termina_quadro_branco(); ?>
			<br>
			<? inicia_quadro_branco('width="100%"', "Grava Informações"); ?>
			<table width="100%">
				<tr>
					<td align="right">
						<?
						if($modo == "update"){
							echo('<input type="button" value="Pré-Visualizar" class="botao_aqua" onClick="window.open(\'previsualizar.php?tipo=mala&id=' . $id_mala . '\');">&nbsp;');
							echo('<input type="button" value="Apagar" class="botao_aqua" onclick="self.location=\'salva_mala.php?modo=apagar&id_mala=' . $id_mala . '\'">');
						}
						elseif ($modo == "add") echo('<input type="reset" value="Limpar Campos" class="botao_aqua">');
						?>&nbsp;<input type="submit" value="Salvar" class="botao_aqua">
					</td>
				</tr>
			</table>
			<? termina_quadro_branco(); 
			if($modo != "update") $modo = "add";
			echo('<input type="hidden" name="modo" value="' . $modo . '">');
			echo('<input type="hidden" name="id_mala" value="' . $id_mala . '">');
			?>
			<input type="hidden" name="html_mala" id="html_mala" value='<?=rawurlencode($html_mala)?>'>
			<input type="hidden" name="css_mala" value='<?=rawurlencode($css_mala)?>'>
			</form>
			<? inicia_quadro_azul('width="100%"', "Mala Direta"); ?>
			<div style="width: 100%; text-align:justify;">
				<img align="absmiddle" src="imagens/info.gif">
				&nbsp;Este formulário cria a página que será enviada no email da mala direta. É possivel definir uma data posterior para o envio dos emails.
				<hr>
				<img align="absmiddle" src="imagens/atencao.gif">
				&nbsp;Para ser possível o envio de emails personalizados, com o nome do destinatário, será necessário a inclusão da palavra chave <font color="#FF0000">(*nome*)</font> dentro do corpo da mensagem toda a vez que desejar se referir ao nome do destinatário. O sistema então, automaticamente, substituirá o a palavra chave pelo nome de cada destinatário do email.
				<hr>
				<img align="absmiddle" src="imagens/atencao.gif">
				&nbsp;Para escolher onde será criada a tabela dinâmica de oferecimento de outras familias de produtos deve-se incluir no texto a palavra chave <font color="#FF0000">(*dispomos_tambem*)</font>.
				<hr><br><br><br>
				<center>
					<table width="80%">
						<tr>
							<td align="center" valign="top" width="25%"><a title="Clique para adicionar uma nova instituição" href="form_instituicao.php"><img border="0" align="absmiddle" src="imagens/icone_instituicao_mais.gif"></a></td>
							<td align="center" valign="top" width="25%"><a title="Clique para adicionar uma nova pessoa" href="form_pessoa.php"><img border="0" align="absmiddle" src="imagens/icone_pessoa_mais.gif"></a></td>
							<td align="center" valign="top" width="25%"><a title="Clique para adicionar um novo segmento de mercado" href="form_segmento.php"><img border="0" align="absmiddle" src="imagens/icone_segmento_mais.gif"></a></td>
							<td align="center" valign="top" width="25%"><a title="Clique para adicionar um novo modelo de mala direta" href="form_modelo.php"><img border="0" align="absmiddle" src="imagens/icone_modelo_mais.gif"></a></td>
						</tr>
						<tr>
							<td align="center" valign="top">Nova Instituição</td>
							<td align="center" valign="top">Nova Pessoa</td>
							<td align="center" valign="top">Novo Segmento de Mercado</td>
							<td align="center" valign="top">Novo Modelo de Mala Direta</td>
						</tr>
					</table>
				</center>
			</div>
			<? termina_quadro_azul(); ?>
		</td>
	</tr>
</table>
<script language="javascript">
	var i = setInterval(espera, 1000);	
	function espera(){
		if(self.editor.document.readyState == "complete"){
			aplicar_estilo();
			clearInterval(i);
		}
	}
	var cal1 = new calendar1(document.forms[0].elements['data_mala']);
	cal1.year_scroll = true;
	cal1.time_comp = false;
	document.forms[0].elements[0].focus();
</script>
<? termina_pagina(); ?>