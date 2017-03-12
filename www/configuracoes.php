<?
require("funcoes.php");
require("permissao_documento.php");

if($_POST["modo"] == "update"){
	switch($_POST["config"]){
		case "senha":
			altera_valor("senha",$_POST["senha"]);
			$msg = "Senha alterada com sucesso!";
			break;
		case "email_admin":
			altera_valor("email_admin",$_POST["email_admin"]);
			$msg = "Email do administrador alterado com sucesso!";
			break;
		case "url_site":
			altera_valor("url_site",$_POST["url_site"]);
			$msg = "Endereço do site alterado com sucesso!";
			break;
		case "remetente":
			altera_valor("remetente",$_POST["remetente"]);
			altera_valor("email_remetente",$_POST["email_remetente"]);
			$msg = "Nome e email do remetente alterado com sucesso!";
			break;
		case "modelo_aniversario":
			altera_valor("modelo_aniversario",$_POST["modelo_aniversario"]);
			$msg = "Modelo de mala direta para aniversariante alterado com sucesso!";
			break;
		case "assunto_email_aniversario":
			altera_valor("assunto_email_aniversario",$_POST["assunto_email_aniversario"]);
			$msg = "Assunto da mala direta para aniversariante alterado com sucesso!";
			break;
	}
}
inicia_pagina();
monta_titulo_secao("Opções de Configuração");
?>
<table width="100%">
	<tr>
		<td width="25%" valign="top">
			<? inicia_quadro_azul('width="100%"', "Re@cher WebMailer"); ?>
			<div style="width: 100%; text-align:justify;">
				<img align="absmiddle" src="imagens/info.gif">
				&nbsp;Neste formul&aacute;rio &eacute; possivel alterar as configura&ccedil;&otilde;es essenciais para o funcionamento do sistema.
			</div>
			<? termina_quadro_azul(); ?>
		</td>
		<td width="75%">
			<? inicia_quadro_branco('width="100%"', "Pagina Inicial"); 
				if($_POST["modo"] == "update") echo('<span style="color: #FF0000; font-weight: bold;">' . $msg . '</span><br><br>'); ?>
				
					<span class="celula"><B>Senha de Administrador</B></span><br><br>
					<script language="javascript">
						function confirma_senha(){
							var f = document.forms[0];
							if(f.senha.value != f.confirma.value){
								alert('A senha não confere.');
								return false;
							}
							else return true;
						}
						function confirma_email_admin(){
							var f = document.forms[1];
							if(f.email_admin.value == ""){
								alert('Digite um email para o administrador.');
								return false;
							}
							else if(!checkEmail(f.email_admin.value)) return false;
							else return true;
						}
						function confirma_url_site(){
							var f = document.forms[2];
							if(f.url_site.value == ""){
								alert('Digite um endereço para o site.');
								return false;
							}
							else return true;
						}
						function confirma_remetente(){
							var f = document.forms[3];
							if(f.remetente.value == ""){
								alert('Digite um nome para o campo "De" do email.');
								return false;
							}
							if(f.email_remetente.value == ""){
								alert('Digite um email para o campo "De" do email.');
								return false;
							}
							else if(!checkEmail(f.email_remetente.value)) return false;
							else return true;
						}
						function confirma_modelo(){
							var f = document.forms[4];
							if(f.modelo_aniversario.value == ""){
								alert('Escolha um modelo de mala direta para ser envia no dia do aniversário de um contato.');
								return false;
							}
							else return true;
						}
						function checkEmail(email) {
							if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)){
								return (true)
							}
							alert("Email incorreto.")
							return (false)
						}
					</script>
					<center>
						<table width="80%">
							<tr>
								<td>
									<fieldset>
									<legend class="celula"><B>Senha de Administrador</B></legend>
									<table width="100%" cellpadding="2" cellspacing="2">
										<form onSubmit="return confirma_senha();" action="<?=$_SERVER['SCRIPT_NAME']?>" method="post">
										<tr>
											<td align="right" width="25%">Senha:</td>
											<td><input type="password" name="senha" maxlength="30" class="input_text"></td>
										</tr>
										<tr>
											<td align="right">Confirma Senha:</td>
											<td><input type="password" name="confirma" maxlength="30" class="input_text"></td>
										</tr>
										<tr>
											<td></td>
											<td align="right"><input type="reset" value="Cancelar" class="botao_aqua">&nbsp;<input type="submit" value="Salvar" class="botao_aqua"></td>
										</tr>
										<input type="hidden" name="config" value="senha">
										<input type="hidden" name="modo" value="update">
										</form>
									</table>
									</fieldset>
									<br><br>
									<fieldset>
										<legend class="celula"><B>Email do Administrador</B></legend>
										<table width="100%" cellpadding="2" cellspacing="2">
											<form onSubmit="return confirma_email_admin();" action="<?=$_SERVER['SCRIPT_NAME']?>" method="post">
											<tr>
												<td align="right" width="10%">Email:</td>
												<td><input type="text" name="email_admin" maxlength="50" class="input_text" value="<?=retorna_config("email_admin")?>"></td>
											</tr>
											<tr>
												<td></td>
												<td align="right"><input type="reset" value="Cancelar" class="botao_aqua">&nbsp;<input type="submit" value="Salvar" class="botao_aqua"></td>
											</tr>
											<input type="hidden" name="config" value="email_admin">
											<input type="hidden" name="modo" value="update">
											</form>
										</table>
									</fieldset>
									<br><br>
									<fieldset>
										<legend class="celula"><B>Endere&ccedil;o do Site</B></legend>
										<table width="100%" cellpadding="2" cellspacing="2">
											<form onSubmit="return confirma_url_site();" action="<?=$_SERVER['SCRIPT_NAME']?>" method="post">
											<tr>
												<td align="right" width="10%">URL:</td>
												<td><input type="text" name="url_site" maxlength="50" class="input_text" value="<?=retorna_config("url_site")?>"></td>
											</tr>
											<tr>
												<td></td>
												<td align="right"><input type="reset" value="Cancelar" class="botao_aqua">&nbsp;<input type="submit" value="Salvar" class="botao_aqua"></td>
											</tr>
											<input type="hidden" name="config" value="url_site">
											<input type="hidden" name="modo" value="update">
											</form>
										</table>
									</fieldset>
									<br><br>
									<fieldset>
										<legend class="celula"><B>Remetende informado na mala direta</B></legend>
										<table width="100%" cellpadding="2" cellspacing="2">
											<form onSubmit="return confirma_remetente();" action="<?=$_SERVER['SCRIPT_NAME']?>" method="post">
											<tr>
												<td align="right" width="30%">Nome do Remetente:</td>
												<td><input type="text" name="remetente" maxlength="50" class="input_text" value="<?=retorna_config("remetente")?>"></td>
											</tr>
											<tr>
												<td align="right">Email do Remetente:</td>
												<td><input type="text" name="email_remetente" maxlength="50" class="input_text" value="<?=retorna_config("email_remetente")?>"></td>
											</tr>
											<tr>
												<td></td>
												<td align="right"><input type="reset" value="Cancelar" class="botao_aqua">&nbsp;<input type="submit" value="Salvar" class="botao_aqua"></td>
											</tr>
											<input type="hidden" name="config" value="remetente">
											<input type="hidden" name="modo" value="update">
											</form>
										</table>
									</fieldset>
									<br><br>
									<fieldset>
										<legend class="celula"><B>Modelo de Mala para Aniversariantes</B></legend>
										<table width="100%" cellpadding="2" cellspacing="2">
											<form onSubmit="return confirma_modelo();" action="<?=$_SERVER['SCRIPT_NAME']?>" method="post">
											<tr>
												<td align="right" width="10%">Modelo:</td>
												<td>
													<select name="modelo_aniversario">
														<optgroup label="Modelos Disponíveis">
															<?php
															$query = "SELECT id_modelo, nome_modelo FROM modelos ORDER BY nome_modelo";
															require("conectar_mysql.php");
															$result = mysql_query($query) or tela_erro("Erro na consulta ao Banco de dados: " . mysql_error(), false);
															while($registro = mysql_fetch_assoc($result)){
																echo('<option value="' . $registro["id_modelo"] . '"');
																if(retorna_config("modelo_aniversario") == $registro["id_modelo"]) echo(" selected");
																echo('>' . $registro["nome_modelo"] . '</option>');
															}
															require("desconectar_mysql.php");
															?>
														</optgroup>
													</select>
												</td>
											</tr>
											<tr>
												<td></td>
												<td align="right"><input type="reset" value="Cancelar" class="botao_aqua">&nbsp;<input type="submit" value="Salvar" class="botao_aqua"></td>
											</tr>
											<input type="hidden" name="config" value="modelo_aniversario">
											<input type="hidden" name="modo" value="update">
											</form>
										</table>
									</fieldset>
									<br><br>
									<fieldset>
										<legend class="celula"><B>Assunto do email de Parab&eacute;ns</B></legend>
										<table width="100%" cellpadding="2" cellspacing="2">
											<form action="<?=$_SERVER['SCRIPT_NAME']?>" method="post">
											<tr>
												<td align="right" width="15%">Assunto:</td>
												<td><input type="text" name="assunto_email_aniversario" maxlength="255" class="input_text" value="<?=retorna_config("assunto_email_aniversario")?>"></td>
											</tr>
											<tr>
												<td></td>
												<td align="right"><input type="reset" value="Cancelar" class="botao_aqua">&nbsp;<input type="submit" value="Salvar" class="botao_aqua"></td>
											</tr>
											<input type="hidden" name="config" value="assunto_email_aniversario">
											<input type="hidden" name="modo" value="update">
											</form>
										</table>
									</fieldset>
								</td>
							</tr>
						</table>
					</center>
			<? termina_quadro_branco(); ?>
		</td>
	</tr>
</table>
<?
termina_pagina();
?>