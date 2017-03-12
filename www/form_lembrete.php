<?php
require("funcoes.php");

$modo = $_REQUEST["modo"];
if(empty($modo)) $modo = "add";

if(($modo == "update") || ($modo == "copiar")){
	$id_lembrete = trim($_GET["id_lembrete"]);
	require("conectar_mysql.php");
	$query = "SELECT titulo, destinatario, texto, data, status FROM lembretes WHERE id_lembrete=" . $id_lembrete;
	$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error(), false);
	$registro = mysql_fetch_assoc($result);
	$texto = stripslashes($registro["texto"]);
	$data = $registro["data"];
	$titulo = $registro["titulo"];
	$destinatario = $registro["destinatario"];
	$status = $registro["status"];
	$id = $id_lembrete;
	require("desconectar_mysql.php");
}
else{
	$destinatario = retorna_config("email_admin");
}

$data = split(";", $data);
$tipo = $data[0];

if($tipo == "D"){
	$data = split(",", $data[1]);
	$dia = $data[0];
	$mes = $data[1];
	$ano = $data[2];
}
elseif($tipo == "W"){
	$semana = $data[1];
}

inicia_pagina(true);
monta_titulo_secao("Cadastro de Lembrete");
?>
<table width="100%">
	<tr>
		<td align="center" valign="top">
			<? inicia_quadro_branco('width="100%"', "Formulário de Cadastro"); ?>
				<script language="javascript" type="text/javascript">
					function valida_form() {
						var f = document.forms[0];
						if(f.titulo.value == ""){
							alert("Informe um título.");
							return false;
						}
						if(f.destinatario.value == ""){
							alert("Informe um email para envio.");
							return false;
						}
						if(!checkEmail(f.destinatario.value)) return false;
						f.texto.value = oEdit1.getHTMLBody();
						if(f.texto.value == ""){
							alert("Digite o texto da mensagem.");
							return false;
						}
						return true;
					}
					function checkEmail(email) {
						if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)){
							return (true)
						}
						alert("Email incorreto.")
						return (false)
					}
					function seleciona_datas(este){
						var f = document.forms[0];
						if(este.checked){
							document.getElementById('field_datas').style.border='solid 1px red';
							document.getElementById('field_week').style.border='solid 1px black';
							document.getElementById('field_datas').style.padding='4px';
							document.getElementById('field_week').style.padding='4px';
							f.semana.disabled = true;
							f.dia.disabled = false;
							f.mes.disabled = false;
							f.ano.disabled = false;
						}
					}
					function seleciona_week(este){
						var f = document.forms[0];
						if(este.checked){
							document.getElementById('field_week').style.border='solid 1px red';
							document.getElementById('field_datas').style.border='solid 1px black';
							document.getElementById('field_week').style.padding='4px';
							document.getElementById('field_datas').style.padding='4px';
							f.semana.disabled = false;
							f.dia.disabled = true;
							f.mes.disabled = true;
							f.ano.disabled = true;
						}
					}
				</script>
				<table width="98%" cellpadding="2" cellspacing="2" border="0">
					<form action="salva_lembrete.php" method="post" onSubmit="return valida_form();">
					<input type="hidden" name="texto" value=''>
					<tr>
						<td width="10%" class="label">Título:</td>
						<td width="90%">
							<input type="text" class="input_text" name="titulo" maxlength="100" value="<?=$titulo?>" style="width:98%">
						</td>
					</tr>
					<tr>
						<td width="10%" class="label">Destinatário:</td>
						<td width="90%">
							<input type="text" class="input_text" name="destinatario" maxlength="100" value="<?=$destinatario?>" style="width:98%">
						</td>
					</tr>
					<tr>
						<td class="label">Agendamento:</td>
						<td style="text-align: left;">
							<table width="100%">
								<tr>
									<td width="60%">
										<fieldset style="text-align:right;" id="field_datas">
											<legend><b>Datas Específica</b></legend>
											<input onclick="seleciona_datas(this);" name="tipo" type="radio" style="float:left;" <? if(strlen($dia)>0) echo("checked");?> />&nbsp;&nbsp;
											Dia:&nbsp;<select name="dia" style="width:60px;"<? if($modo != "update") echo(' disabled="disabled"'); ?>>
												<option value=""></option>
												<option value="**"<? if($dia == "**") echo(' selected'); ?>>Todos</option>
												<?
												for($i = 1; $i < 32; $i++){
													echo('<option value="' . str_pad($i, 2, "0", STR_PAD_LEFT) . '"');
													if(str_pad($i, 2, "0", STR_PAD_LEFT) == $dia) echo(' selected');
													echo('>' . str_pad($i, 2, "0", STR_PAD_LEFT) . '</option>');
												}
												?>
											</select>&nbsp;&nbsp;
											Mês:&nbsp;<select name="mes" style="width:70px;"<? if($modo != "update") echo(' disabled="disabled"'); ?>>
												<option value=""></option>
												<option value="**"<? if($mes == "**") echo(' selected'); ?>>Todos</option>
												<option value="01"<? if($mes == "01") echo(' selected'); ?>>Janeiro</option>
												<option value="02"<? if($mes == "02") echo(' selected'); ?>>Fevereiro</option>
												<option value="03"<? if($mes == "03") echo(' selected'); ?>>Março</option>
												<option value="04"<? if($mes == "04") echo(' selected'); ?>>Abril</option>
												<option value="05"<? if($mes == "05") echo(' selected'); ?>>Maio</option>
												<option value="06"<? if($mes == "06") echo(' selected'); ?>>Junho</option>
												<option value="07"<? if($mes == "07") echo(' selected'); ?>>Julho</option>
												<option value="08"<? if($mes == "08") echo(' selected'); ?>>Agosto</option>
												<option value="09"<? if($mes == "09") echo(' selected'); ?>>Setembro</option>
												<option value="10"<? if($mes == "10") echo(' selected'); ?>>Outubro</option>
												<option value="11"<? if($mes == "11") echo(' selected'); ?>>Novembro</option>
												<option value="12"<? if($mes == "12") echo(' selected'); ?>>Dezembro</option>
											</select>&nbsp;&nbsp;
											Ano:&nbsp;<select name="ano" style="width:60px;"<? if($modo != "update") echo(' disabled="disabled"'); ?>>
												<option value=""></option>
												<option value="**"<? if($ano == "**") echo(' selected'); ?>>Todos</option>
												<?
												for($i = date("Y"); $i < date("Y")+20; $i++){
													echo('<option value="' . $i . '"');
													if($i == $ano) echo(' selected');
													echo('>' . $i . '</option>');
												}
												?>
											</select>
										</fieldset>
									</td>
									<td width="5%" align="center">OU</td>
									<td>
										<fieldset style="text-align:right;" id="field_week">
											<legend><b>Dias da Semana</b></legend>
											<input type="radio" name="tipo" style="float:left;" onclick="seleciona_week(this);" <? if(strlen($semana)>0) echo("checked");?>/>&nbsp;&nbsp;
											Dia:&nbsp;
											<select name="semana" style="width:100px;"<? if($modo != "update") echo(' disabled="disabled"'); ?>>
												<option value=""></option>
												<option value="*"<? if($semana == "*") echo(' selected'); ?>>Todos</option>
												<option value="0"<? if($semana == "0") echo(' selected'); ?>>Domingo</option>
												<option value="1"<? if($semana == "1") echo(' selected'); ?>>Segunda</option>
												<option value="2"<? if($semana == "2") echo(' selected'); ?>>Terça</option>
												<option value="3"<? if($semana == "3") echo(' selected'); ?>>Quarta</option>
												<option value="4"<? if($semana == "4") echo(' selected'); ?>>Quinta</option>
												<option value="5"<? if($semana == "5") echo(' selected'); ?>>Sexta</option>
												<option value="6"<? if($semana == "6") echo(' selected'); ?>>Sábado</option>
											</select>
										</fieldset>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<?
					if($modo == "update"){ ?>
					<tr>
						<td class="label">&nbsp;</td>
						<td class="label">
							<fieldset>
								<legend><b>Status do Lembrete</b></legend>
								<table width="100%">
									<tr>
										<td width="40%" class="label">Agendado para envio</td>
										<td><input type="radio" name="status" value="1"<? if ($status == "1") echo(" checked");?>></td>
										<td width="10%">&nbsp;</td>
										<td width="40%" class="label">Não enviar</td>
										<td><input type="radio" name="status" value="2"<? if(($status == "2") || ($modo == "add")) echo(" checked");?>></td>
									</tr>
								</table>
							</fieldset>
						</td>
					</tr>
					<? } ?>
					<tr>
						<td colspan="2">
							<hr>
						</td>
					</tr>
					<tr>
						<td colspan="2" class="label" style="text-align: left;">Editor HTML Online</td>
					</tr>
					<tr>
						<td colspan="2" height="400">
						<?
						require("editor.php");
						$editor = new editorHTML($texto, "100%", "400px");
						?>
						</td>
					</tr>
				</table>
			<? termina_quadro_branco(); ?>
			<br>
			<? inicia_quadro_branco('width="100%"', "Grava Informações"); ?>
			<table width="100%">
				<tr>
					<td align="right">
						<?
						if($modo == "update"){
							//echo('<input type="button" value="Pré-Visualizar" class="botao_aqua" onClick="window.open(\'previsualizar.php?tipo=mala&id=' . $id_lembrete . '\');">&nbsp;');
							echo('<input type="button" value="Apagar" class="botao_aqua" onclick="apagar(' . $id_lembrete . ');">');
						}
						elseif ($modo == "add") echo('<input type="reset" value="Limpar Campos" class="botao_aqua">');
						?>&nbsp;<input type="submit" value="Salvar" class="botao_aqua">
					</td>
				</tr>
			</table>
			<? termina_quadro_branco(); 
			if($modo != "update") $modo = "add";
			echo('<input type="hidden" name="modo" value="' . $modo . '">');
			echo('<input type="hidden" name="id_lembrete" value="' . $id_lembrete . '">');
			?>
			</form>
		</td>
	</tr>
</table>
<script language="javascript">
	function apagar(id){
		if(confirm("Deseja remover este lembrete do sistema?"))
			window.location = 'salva_lembrete.php?modo=apagar&id_lembrete=' + id;
	}
</script>
<? termina_pagina(); ?>