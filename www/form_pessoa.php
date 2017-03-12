<?
require("funcoes.php");

$modo = $_REQUEST["modo"];
if(empty($modo)) $modo = "add";

if(($modo == "update") || ($modo == "copiar")){
	$id_pessoa = trim($_GET["id_pessoa"]);
	require("conectar_mysql.php");
	$query = "SELECT id_pessoa, nome_pessoa, id_instituicao, telefone_pessoa, ramal_pessoa, email_pessoa, departamento_pessoa, DATE_FORMAT(dt_nascimento_pessoa,'%d/%m/%Y') as dt_nascimento_pessoa, recebe_email_pessoa FROM pessoas WHERE id_pessoa='" . $id_pessoa . "'";
	$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error(), false);
	$registro = mysql_fetch_assoc($result);
	$id_pessoa = $registro["id_pessoa"];
	$nome_pessoa = $registro["nome_pessoa"];
	$id_instituicao = $registro["id_instituicao"];
	$telefone_pessoa = $registro["telefone_pessoa"];
	$ramal_pessoa = $registro["ramal_pessoa"];
	$email_pessoa = $registro["email_pessoa"];
	$departamento_pessoa = $registro["departamento_pessoa"];
	$dt_nascimento_pessoa = $registro["dt_nascimento_pessoa"];
	$recebe_email_pessoa = $registro["recebe_email_pessoa"];
	require("desconectar_mysql.php");
}
elseif($modo == "pessoa_instituicao") $id_instituicao = $_GET["id_instituicao"];

inicia_pagina();
monta_titulo_secao("Cadastro de Pessoas");
?>
<script language="JavaScript" src="calendar1.js"></script>
<script language="JavaScript" src="data.js"></script>
<script language="javascript">
	function valida_form(){
		var f = document.forms[0];
		if(f.nome_pessoa.value == ""){
			alert("Informe o nome da pessoa");
			return false;
		}
		if(f.email_pessoa.value == ""){
			alert("Informe o email da pessoa.");
			return false;
		}
		if(!checkEmail(f.email_pessoa.value)) return false;
		return true;
	}
	function checkEmail(email) {
		if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)){
			return (true)
		}
		alert("Email incorreto.")
		return (false)
	}
	function mostra_segmentos(){
		var d = document.getElementById("box_segmentos");
		d.style.height = "";
		d.style.overflow = "";
		d.style.visibility = "visible";
	}
	function esconde_segmentos(){
		var d = document.getElementById("box_segmentos");
		d.style.height = "0px";
		d.style.overflow = "hidden";
		d.style.visibility = "hidden";
	}
	function editar_instituicao(id_instituicao){
		window.location = "form_instituicao.php?modo=update&id_instituicao=" + id_instituicao;
	}
</script>
<table width="100%">
	<tr>
		<td width="25%" valign="top" align="left">
			<? inicia_quadro_azul('width="100%"', "Pessoa"); ?>
			<div style="width: 100%; text-align:justify;">
				<img align="absmiddle" src="imagens/info.gif">
				&nbsp;Neste formulário é possivel gravar informações de clientes finais ou contatos em empresas consumidoras dos produtos anunciados.
				<center>
					<hr>
					<a title="Clique para adicionar um novo segmento de mercado" href="form_segmento.php">
						<img border="0" align="absmiddle" src="imagens/icone_segmento_mais.gif">
					</a>
					<br>
					<span style="font-size:9px;">Novo Segmento de Mercado</span>
				</center>
			</div>
			<? termina_quadro_azul(); ?>
		</td>
		<td width="75%" align="center" valign="top">
			<? inicia_quadro_branco('width="100%"', "Formulário de Cadastro"); ?>
			<form action="salva_pessoa.php" method="post" onSubmit="return valida_form();">
			<center>
				<table width="90%" border="0" cellspacing="3">
					<tr>
						<td class="label" width="30%">Instituição:</td>
						<td>
							<select name="id_instituicao" onChange="if(this.value == 0){ mostra_segmentos(); document.getElementById('edit_inst').style.visibility = 'hidden'; } else{ esconde_segmentos(); document.getElementById('edit_inst').style.visibility = 'visible'; }">
								<option value="0">Pessoa Física</option>
								<?php
								$query = "SELECT id_instituicao, nome_instituicao FROM instituicoes ORDER BY nome_instituicao";
								require("conectar_mysql.php");
								$result = mysql_query($query) or tela_erro("Erro na consulta ao Banco de dados: " . mysql_error(), false);
								while($registro = mysql_fetch_assoc($result)){
									echo('<option value="' . $registro["id_instituicao"] . '"');
									if(((!empty($id_pessoa)) || ($modo == "pessoa_instituicao")) && ($registro["id_instituicao"] == $id_instituicao)) echo(" selected");
									echo('>' . $registro["nome_instituicao"] . '</option>');
								}
								require("desconectar_mysql.php");
								?>
							</select>
						</td>
						<td width="5%"><span id="edit_inst" style="visibility: <? if($id_instituicao != 0) echo('visible'); else echo('hidden'); ?>"><a title="Editar informações da instituição" href="Javascript: editar_instituicao(document.forms[0].elements[0].value);"><img border="0" src="imagens/editar.gif"></a></span></td>
					</tr>
					<tr>
						<td class="label">Nome:</td>
						<td><input type="text" name="nome_pessoa" value="<?=$nome_pessoa?>" maxlength="50" class="input_text"></td>
						<td></td>
					</tr>
					<tr>
						<td class="label">Telefone:</td>
						<td><input type="text" name="telefone_pessoa" value="<?=$telefone_pessoa?>" maxlength="15" class="input_text"></td>
						<td></td>
					</tr>
					<tr>
						<td class="label">Ramal:</td>
						<td><input type="text" name="ramal_pessoa" value="<?=$ramal_pessoa?>" maxlength="5" class="input_text"></td>
						<td></td>
					</tr>
					<tr>
						<td class="label">Email:</td>
						<td><input type="text" name="email_pessoa" value="<?=$email_pessoa?>" maxlength="50" class="input_text"></td>
						<td></td>
					</tr>
					<tr>
						<td class="label">Departamento:</td>
						<td><input type="text" name="departamento_pessoa" value="<?=$departamento_pessoa?>" maxlength="30" class="input_text"></td>
						<td></td>
					</tr>
					<tr>
						<td class="label">Data de Nascimento:</td>
						<td><input type="text" name="dt_nascimento_pessoa" value="<?=$dt_nascimento_pessoa?>" maxlength="10" onKeypress="return ajustar_data(this,event);" class="input_text"></td>
						<td align="right"><a href="javascript: cal1.popup();"><img src="imagens/cal.gif" border="0" alt="Clique aqui para escolher a data de nascimento"></a></td>
					</tr>
					<tr>
						<td class="label"></td>
						<td class="label">
							<fieldset>
								<legend><b>Recebe Email</b></legend>
								<table width="100%">
									<tr>
										<td width="40%" class="label">Sim</td>
										<td><input type="radio" name="recebe_email_pessoa" value="s"<? if(($recebe_email_pessoa == "s") || ($modo == "add")) echo(" checked");?>></td>
										<td width="10%">&nbsp;</td>
										<td width="40%" class="label">Não</td>
										<td><input type="radio" name="recebe_email_pessoa" value="n"<? if ($recebe_email_pessoa == "n") echo(" checked");?>></td>
									</tr>
								</table>
							</fieldset>

						<!--<td>
							<select name="recebe_email_pessoa">
								<option value="s"<? if ($recebe_email_pessoa == "s") echo(" selected");?>>Sim</option>
								<option value="n"<? if ($recebe_email_pessoa == "n") echo(" selected");?>>Não</option>
							</select>
						</td>
						<td></td>-->
					</tr>
				</table>
			</center>
			<? termina_quadro_branco(); ?>
			<div id="box_segmentos" style="width: 100%;">
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
						
						if($modo == "update"){
							$query = "SELECT * FROM segmentos_pessoas WHERE id_segmento=" . $registro["id_segmento"] . " AND id_pessoa=" . $id_pessoa;
							$result2 = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error(), false);
						}
						
						if((mysql_num_rows($result2)>0) && ($modo == "update")) echo('<input type="checkbox" name="segmento_' . $registro["id_segmento"] . '" checked></td>');
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
			</div>
			<br>
			<? inicia_quadro_branco('width="100%"', "Grava Informações"); ?>
			<table width="100%">
				<tr>
					<td align="right"><?
							if($modo == "update") echo('<input type="button" value="Apagar" class="botao_aqua" onclick="self.location=\'salva_pessoa.php?modo=apagar&id_pessoa=' . $id_pessoa . '\'">');
							elseif ($modo == "add") echo('<input type="reset" value="Limpar Campos" class="botao_aqua">');
							?>&nbsp;<input type="submit" value="Salvar" class="botao_aqua">
					</td>
				</tr>
			</table>
			<? termina_quadro_branco(); ?>
			<?
			if($modo != "update") $modo = "add";
			echo('<input type="hidden" name="modo" value="' . $modo . '">');
			echo('<input type="hidden" name="id_pessoa" value="' . $id_pessoa . '">');
			?>
			</form>
		</td>
	</tr>
</table>
<script language="javascript">
	document.forms[0].elements[1].focus();
	var cal1 = new calendar1(document.forms[0].elements['dt_nascimento_pessoa']);
	cal1.year_scroll = true;
	cal1.time_comp = false;
</script>
<?
termina_pagina();
?>