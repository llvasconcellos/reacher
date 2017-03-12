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
	$remetente_mala = retorna_config("email_admin");
	$css = "modelo";
	$id = $id_modelo;
	require("desconectar_mysql.php");
}
elseif(($modo == "update") || ($modo == "copiar")){
	$id_mala = trim($_GET["id_mala"]);
	require("conectar_mysql.php");
	$query = "SELECT nome_mala, remetente_mala, assunto_mala, css_mala, html_mala, DATE_FORMAT(data_mala,'%d/%m/%Y') as data_mala, status_mala, emails_enviados, bounces FROM malas WHERE id_mala='" . $id_mala . "'";
	$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error(), false);
	$registro = mysql_fetch_assoc($result);
	$css_mala = stripslashes($registro["css_mala"]);
	$html_mala = stripslashes($registro["html_mala"]);
	$data_mala = $registro["data_mala"];
	$remetente_mala = $registro["remetente_mala"];
	$nome_mala = $registro["nome_mala"];
	$assunto_mala = $registro["assunto_mala"];
	if($modo == "copiar") $status_mala = "1";
	else $status_mala = $registro["status_mala"];
	$emails_enviados = $registro["emails_enviados"];
	$bounces = $registro["bounces"];
	$css = "mala";
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
						if(f.remetente_mala.value == ""){
							alert("Informe um email de remetente.");
							return false;
						}
						if(!checkEmail(f.remetente_mala.value)) return false;
						f.html_mala.value = oEdit1.getHTMLBody();
						return true;
					}
					function checkEmail(email) {
						if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)){
							return (true)
						}
						alert("Email incorreto.")
						return (false)
					}
					function aplicar_estilo(){
						var e = unescape(document.forms[0].css_mala.value);
						if(e.length>0){
							self.oEdit1.document.styleSheets[0].cssText = e;
							self.oEdit1.document.styleSheets[0].cssText += "\nBODY {border: 1px black solid;border-top: none;}";
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
						if(confirm("Deseja remover este mala direta do sistema?"))
							window.location = 'salva_mala.php?modo=apagar&pagina=<?=$_REQUEST["pagina"]?>&id_mala=' + id + '<?=$string?>';
					}
					function envia_outlook(){
						if(confirm("Deseja enviar esta mala direta utilizando o seu Microsoft Outlook?\r\nEsta opção só funciona com o Microsoft Internet Explorer e o Microsoft Outlook 2007")){
							var janela = window.open('engine_outlook.php?id_mala=<?=$id_mala?>','WindowEnviaOutook','height=200,width=400,menubar=no,resizable=yes,scrollbars=yes,left=100,top=100,status=yes,toolbar=no');
						}
					}
				</script>
				<table width="98%" cellpadding="2" cellspacing="2" border="0">
					<form action="salva_mala.php" method="post" onSubmit="return valida_form();">
						
					<input type="hidden" name="html_mala" value=''>
					<input type="hidden" name="css_mala" value='<?=rawurlencode($css_mala)?>'>
					<? if($modo == "add"){ ?>
						<tr>
							<td class="label" width="15%">Modelo:</td>
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
						<td class="label">Nome:</td>
						<td style="text-align: left;">
							<input type="text" class="input_text" name="nome_mala" maxlength="50" value="<?=$nome_mala?>">
						</td>
						<td></td>
					</tr>
					<tr>
						<td class="label">Email Remetente:</td>
						<td style="text-align: left;">
							<input type="text" class="input_text" name="remetente_mala" maxlength="255" value="<?=$remetente_mala?>">
						</td>
						<td></td>
					</tr>
					<tr>
						<td class="label">Assunto:</td>
						<td style="text-align: left;">
							<input type="text" class="input_text" name="assunto_mala" maxlength="100" value="<?=$assunto_mala?>">
						</td>
						<td></td>
					</tr>
					<tr>
						<td class="label">Data:</td>
						<td style="text-align: left;">
							<input type="text" class="input_text" name="data_mala" value="<?=$data_mala?>" maxlength="10" onKeypress="return ajustar_data(this,event);" >
						</td>
						<td width="5%" align="right"><a href="javascript: cal1.popup();"><img src="imagens/cal.gif" border="0" alt="Escolha a data para o envio."></a></td>
					</tr>
					<tr>
						<td colspan="3" class="label" style="text-align: left;">Editor HTML Online</td>
					</tr>
					<tr>
						<td colspan="3" height="400">
						<?
						require("editor.php");
						if(empty($id_mala)) $editor = new editorHTML($html_mala, "100%", "400px");
						else $editor = new editorHTML($html_mala, "100%", "400px", "dincss.php?oque=" . $css . "&id=" . $id_mala);
						?>
						</td>
					</tr>
					<?
					if($modo == "update"){ ?>
					<tr>
						<td class="label" colspan="2">
							<fieldset>
								<legend><b>Status da Mala Direta</b></legend>
								<table width="100%">
									<tr>
										<td width="30%" class="label">Agendada para envio</td>
										<td><input type="radio" name="status_mala" value="1"<? if ($status_mala == "1") echo(" checked");?>></td>
										<td width="5%">&nbsp;</td>
										<td width="30%" class="label">Em Processamento</td>
										<td><input type="radio" name="status_mala" value="3"<? if(($status_mala == "3")) echo(" checked");?>></td>
										<td width="5%">&nbsp;</td>
										<td width="30%" class="label">Enviada</td>
										<td><input type="radio" name="status_mala" value="2"<? if(($status_mala == "2") || ($modo == "add")) echo(" checked");?>></td>
									</tr>
								</table>
							</fieldset>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<hr>
						</td>
					</tr>
					<tr>
						<td colspan="2" class="label" style="text-align: left;"><a href="Javascript: edita_css();" class="menu" style="color:#000000;"><img border="0" id="seta_verde" align="absmiddle" src="imagens/seta_verde_direita.gif">Alternativas de Envio</a></td>
					</tr>
					<tr>
						<td align="right" colspan="2">
							<div id="box_css" style="text-width: 100%; height: 0px; overflow: hidden; visibility: hidden;">
								<fieldset>
									<legend><b>Envio para destinatários avulsos</b></legend>
									<table width="100%">
										<tr>
											<td class="label" valign="top" width="20%">Destinatários:</td>
											<td style="text-align: left;">
												<textarea class="input_text" style="background-image:none;" rows="3" title="Emails separados por ponto e vírgula" name="destinatarios"></textarea>
											</td>
											<td valign="top" width="5%"><a href="javascript: envia_manual();"><img src="imagens/sendmail.gif" border="0" alt="Enviar manualmente"></a></td>
										</tr>
									</table>
								</fieldset>
								<hr />
								<fieldset>
									<legend><b>Envio de Mala Direta usando Microsoft Office Outlook</b></legend>
									<table width="100%">
										<tr>
											<td class="label" valign="middle" width="100">Destinatários/Envio:</td>
											<td style="text-align: left;" width="50">
												<input type="text" class="input_text" name="qtd_outlook" value="20" maxlength="5">
											</td>
											<td class="label" valign="middle" width="100">Pré-visualizar:</td>
											<td style="text-align: left;" width="50">
												<input type="checkbox" name="preview_outlook" checked="checked">
											</td>
											<td class="label" valign="middle" width="50">Enviar:</td>
											<td style="text-align: left;">
												<input type="checkbox" name="envio_outlook" checked="checked">
											</td>
											<td class="label" valign="middle" width="150">Alterar Status para Enviada?</td>
											<td style="text-align: left;">
												<input type="checkbox" name="envio_outlook_altera_status" checked="checked">
											</td>
											<td valign="top" width="5%"><a href="javascript: envia_outlook();"><img src="imagens/sendoutlook.gif" border="0" alt="Enviar usando Microsoft Oulook"></a></td>
										</tr>
									</table>
								</fieldset>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<hr>
						</td>
					</tr>
					<? } ?>
					<? if($status_mala == "2"){ ?>
						<tr>
							<td colspan="3">
							<fieldset>
								<legend><b>Relatório</b></legend>
								<table width="100%">
									<tr>
										<td width="15%" class="label">Emails Enviados:</td>
										<td><?=$emails_enviados?></td>
										<td width="5%">&nbsp;</td>
										<td width="20%" class="label">Emails Retornados:</td>
										<td><?=$bounces?></td>
										<td width="5%">&nbsp;</td>
										<td width="15%" class="label">Visualizações:</td>
										<td>
											<?php
											$query = "SELECT count(id_mala) FROM malas_visualizacoes WHERE id_mala = " . $id_mala;
											require("conectar_mysql.php");
											$result = mysql_query($query) or tela_erro("Erro na consulta ao Banco de dados: " . mysql_error(), false);
											$registro = mysql_fetch_row($result);
											echo($registro[0]);
											require("desconectar_mysql.php");
											?>
										</td>
										<td width="5%">&nbsp;</td>
										<td width="20%" class="label">Visualizações Únicas:</td>
										<td>
											<?php
											$query = "SELECT id_mala FROM malas_visualizacoes WHERE id_mala = " . $id_mala . " GROUP BY id_pessoa";
											require("conectar_mysql.php");
											$result = mysql_query($query) or tela_erro("Erro na consulta ao Banco de dados: " . mysql_error(), false);
											echo(mysql_num_rows($result));
											require("desconectar_mysql.php");
											?>
										</td>
									</tr>
									<tr>
										<td colspan="11" align="center"><hr />
											<input type="button" value="Ver Relatório" class="botao_aqua" onClick="window.open('relatorio_envio_mala.php?modo=display&id_mala=<?=$id_mala?>');">
											&nbsp;&nbsp;<input type="button" value="Download Relatório" class="botao_aqua" onClick="window.location = 'relatorio_envio_mala.php?modo=download&id_mala=<?=$id_mala?>';">
										</td>
									</tr>
								</table>
							</fieldset>
							</td>
						</tr>
					<? } ?>
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
							
						}
						elseif ($modo == "add") echo('<input type="reset" value="Limpar Campos" class="botao_aqua">');
						?>&nbsp;
						<? 
						if(($status_mala == "1") || ($modo == "copiar") || ($modo == "add")){ 
							echo('<input type="button" value="Apagar" class="botao_aqua" onclick="apagar(' . $id_mala . ');">');
							echo('&nbsp;<input type="submit" value="Salvar" class="botao_aqua">');
						}
						?>
					</td>
				</tr>
			</table>
			<? termina_quadro_branco(); 
			if($modo != "update") $modo = "add";
			echo('<input type="hidden" name="modo" value="' . $modo . '">');
			echo('<input type="hidden" name="id_mala" value="' . $id_mala . '">');
			?>
			</form>
			<? inicia_quadro_azul('width="100%"', "Mala Direta"); ?>
			<div style="width: 100%; text-align:justify;">
				<img align="absmiddle" src="imagens/info.gif">
				&nbsp;Este formul&aacute;rio cria a p&aacute;gina que ser&aacute; enviada no email da mala direta. &Eacute; possivel definir uma data posterior para o envio dos emails.
				<hr>
				<img align="absmiddle" src="imagens/atencao.gif">
				&nbsp;Para ser poss&iacute;vel o envio de emails personalizados, com o nome do destinat&aacute;rio, ser&aacute; necess&aacute;rio a inclus&atilde;o da palavra chave <font color="#FF0000">(*nome*)</font> dentro do corpo da mensagem toda a vez que desejar se referir ao nome do destinat&aacute;rio. O sistema ent&atilde;o, automaticamente, substituir&aacute; o a palavra chave pelo nome de cada destinat&aacute;rio do email.
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
							<td align="center" valign="top">Nova Institui&ccedil;&atilde;o</td>
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
<form method="post" target="WindowEnviaManual" action="engine_manual.php" onSubmit="if (!buttonClicked) return false">
	<input type="hidden" name="dest" />
	<input type="hidden" name="id_mala" value="<?=$id_mala?>" />
</form>
<script language="javascript">
	var buttonClicked=false;
	var cal1 = new calendar1(document.forms[0].elements['data_mala']);
	cal1.year_scroll = true;
	cal1.time_comp = false;
	document.forms[0].elements[2].focus();
	function envia_manual(){
		if(confirm("Deseja enviar esta mala direta para os endereços do campo 'Destinatários'?")){
			document.forms[1].dest.value = document.forms[0].destinatarios.value;
			myOpenWindow();
			buttonClicked=true;
			setTimeout('document.forms[1].submit()',500);
		}
	}
	function myOpenWindow() {
		myWindowHandle = window.open('about:blank','WindowEnviaManual','height=200,width=400,menubar=no,resizable=no,scrollbars=no,left=100,top=100,status=no,toolbar=no');
	}
</script>
<? termina_pagina(); ?>