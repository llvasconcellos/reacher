<?
require("funcoes.php");
inicia_pagina();
monta_titulo_secao("Importação de Cadastros");
?>
<script language="javascript">
	function valida_form(){
		var f = document.forms[0];
		var integrantes = f.elements['campos_arquivo[]'];
		var opcao = 0;
		
		for(var i = 0; i < integrantes.options.length; i++){
			integrantes.options[i].selected = true;
			opcao++;
		}
		if(opcao == 0){
			alert("Selecione os campos.");
			return false;
		}
		return true;
	}
	function adiciona_ao_grupo(){
		var f = document.forms[0];
		var integrantes = f.elements['campos_arquivo[]'];
		for(var i = 0; i < f.campos.options.length; i++){
			if(f.campos.options[i].selected){
				var opcao = document.createElement("OPTION");
				opcao.text = f.campos.options[i].text;
				opcao.value = f.campos.options[i].value;
				integrantes.options.add(opcao);
				f.campos.options.remove(i);
				i = -1;
			}
		}
	}
	function remove_do_grupo(){
		var f = document.forms[0];
		var integrantes = document.forms[0].elements['campos_arquivo[]'];
		for(var i = 0; i < integrantes.options.length; i++){
			if(integrantes.options[i].selected){
				var opcao = document.createElement("OPTION");
				opcao.text = integrantes.options[i].text;
				opcao.value = integrantes.options[i].value;
				f.campos.options.add(opcao);
				integrantes.options.remove(i);
				i = -1;
			}
		}
	}
</script>
<table width="100%">
	<tr>
		<td width="25%" valign="top" align="left">
			<? inicia_quadro_azul('width="100%"', "Importação"); ?>
			<div style="width: 100%; text-align:justify;">
				<img align="absmiddle" src="imagens/info.gif">
				&nbsp;Neste formul&aacute;rio &eacute; possivel importar uma grande quantidade de contatos através do envio de um arquivo de texto, tendo seus valores separados por vírgula, ponto e vírgula ou tabulação.
				Selecione os campos da tabela a serem importados na mesma sequencia que o arquivo que está sendo enviado.
			</div>
			<? termina_quadro_azul(); ?>
		</td>
		<td width="75%" align="center" valign="top">
			<? inicia_quadro_branco('width="100%"', "Importação de Contatos"); ?>
			<form action="form_valida_import.php" method="post" onSubmit="return valida_form();" encType="multipart/form-data">
			<center>
				<br />
				<h6>Sequência dos Campos</h4>
				<table width="100%" border="0">
					<tr>
						<td width="48%" align="center" class="label" style="text-align:left;">Todos os campos</td>
						<td width="4%">&nbsp;</td>
						<td width="48%" align="center" class="label" style="text-align:left;">Campos no arquivo</td>
					</tr>
					<tr>
						<td>
							<select size="12" class="campotxt" name="campos" multiple style="background-image:none;">
								<?php
								$query = "DESC pessoas";
								require("conectar_mysql.php");
								$result = mysql_query($query) or tela_erro("Erro na consulta ao Banco de dados: " . mysql_error(), false);
								while($registro = mysql_fetch_assoc($result))
									if(($registro["Field"] != "id_pessoa") && ($registro["Field"] != "id_instituicao") && ($registro["Field"] != "recebe_email_pessoa"))
										echo('<option value="' . $registro["Field"] . '">' . $registro["Field"] . '</option>');
								require("desconectar_mysql.php");
								?>
							</select>
						</td>
						<td align="center" valign="middle">
							<img src="imagens/seta2.gif" onMouseDown="src='imagens/seta3.gif'" onMouseUp="src='imagens/seta2.gif'; adiciona_ao_grupo();">
							<br>
							<img src="imagens/seta4.gif" onMouseDown="src='imagens/seta5.gif'" onMouseUp="src='imagens/seta4.gif'; remove_do_grupo();">
						</td>
						<td width="48%" align="center" rowspan="2" >
							<select size="12" class="campotxt" name="campos_arquivo[]" multiple style="background-image:none;"></select>
						</td>
					</tr>
				</table>
				<br />
				<hr />
				<h6>Arquivo</h4>
				<table width="90%" border="0" cellspacing="3">
					<tr>
						<td class="label">Arquivo:</td>
						<td><input type="file" name="arquivo" accept="text/csv, text/txt" class="input_text"></td>
						<td width="5%"></td>
					</tr>
					<tr>
						<td class="label">Separador:</td>
						<td>
							<select name="separador">
								<option value="0">Ponto e Vírgula</option>
								<option value="1">Vírgula</option>
								<option value="2">Tabulação</option>
							</select>
						</td>
						<td width="5%"></td>
					</tr>
					<tr>
						<td class="label" width="30%">Institui&ccedil;&atilde;o:</td>
						<td>
							<select name="id_instituicao" onChange="if(this.value == 0){ mostra_segmentos(); document.getElementById('edit_inst').style.visibility = 'hidden'; } else{ esconde_segmentos(); document.getElementById('edit_inst').style.visibility = 'visible'; }">
								<option value="0">Pessoa F&iacute;sica</option>
								<?php
								$query = "SELECT id_instituicao, nome_instituicao FROM instituicoes ORDER BY nome_instituicao";
								require("conectar_mysql.php");
								$result = mysql_query($query) or tela_erro("Erro na consulta ao Banco de dados: " . mysql_error(), false);
								while($registro = mysql_fetch_assoc($result))
									echo('<option value="' . $registro["id_instituicao"] . '">' . $registro["nome_instituicao"] . '</option>');
								require("desconectar_mysql.php");
								?>
							</select>
						</td>
						<td></td>
					</tr>
				</table>
			</center>
			<br />
			<hr />
			<h6>Segmentos de Mercado</h4>
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
					echo('<input type="checkbox" name="segmento_' . $registro["id_segmento"] . '"></td>');
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
						<input type="reset" value="Limpar Campos" class="botao_aqua">
						&nbsp;
						<input type="submit" value="Importar" class="botao_aqua">
					</td>
				</tr>
			</table>
			<? termina_quadro_branco(); ?>
			</form>
		</td>
	</tr>
</table>
<?
termina_pagina();
?>