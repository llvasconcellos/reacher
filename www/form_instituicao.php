<?
require("funcoes.php");

$modo = $_REQUEST["modo"];

if(($modo == "update") || ($modo == "copiar")){
	$id_instituicao = trim($_GET["id_instituicao"]);
	require("conectar_mysql.php");
	$query = "SELECT * FROM instituicoes WHERE id_instituicao='" . $id_instituicao . "'";
	$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error(), false);
	$registro = mysql_fetch_assoc($result);
	$nome_instituicao = $registro["nome_instituicao"];
	$razao_social_instituicao = $registro["razao_social_instituicao"];
	$telefone_instituicao = $registro["telefone_instituicao"];
	$fax_instituicao = $registro["fax_instituicao"];
	$endereco_instituicao = $registro["endereco_instituicao"];
	$bairro_instituicao = $registro["bairro_instituicao"];
	$cidade_instituicao = $registro["cidade_instituicao"];
	$estado_instituicao = $registro["estado_instituicao"];
	$cep_instituicao = $registro["cep_instituicao"];
	require("desconectar_mysql.php");
}
	
inicia_pagina();
monta_titulo_secao("Cadastro de Instituições");
?>
<script language="javascript">
	function valida_form(){
		var f = document.forms[0];
		if(f.nome_instituicao.value == ""){
			alert("Informe o nome da instituição");
			return false;
		}
		return true;
	}
</script>
<table width="100%">
	<tr>
		<td width="25%" valign="top">
			<? inicia_quadro_azul('width="100%"', "Instituição"); ?>
			<div style="width: 100%; text-align:justify;">
				<img align="absmiddle" src="imagens/info.gif">
				&nbsp;Instituições são empresas ou qualquer tipo de organizações que dentro do sistema tem o propósito de servir de recipiente para agrupar vários contatos e selecionar seus respectivos segmentos de mercado de interesse.
				<?
				if($modo == "update"){ ?>
					<hr>
					<center>
						<a title="Clique para adicionar uma nova pessoa nesta instituição" href="form_pessoa.php?modo=pessoa_instituicao&id_instituicao=<?=$id_instituicao?>">
							<img border="0" align="absmiddle" src="imagens/icone_pessoa_mais.gif">
						</a>
						<br>
						<span style="font-size:9px;">Nova Pessoa</span>
						<hr>
						<a title="Clique para adicionar um novo segmento de mercado" href="form_segmento.php">
							<img border="0" align="absmiddle" src="imagens/icone_segmento_mais.gif">
						</a>
						<br>
						<span style="font-size:9px;">Novo Segmento de Mercado</span>
					</center>
				<? } ?>
			</div>
			<? termina_quadro_azul(); ?>
		</td>
		<td width="75%" align="center" valign="top">
			<? inicia_quadro_branco('width="100%"', "Formulário de Cadastro"); ?>
			<form action="salva_instituicao.php" method="post" onSubmit="return valida_form();">
			<center>
				<table width="90%" border="0" cellspacing="3">
					<tr>
						<td class="label" width="23%">Nome Fantasia:</td>
						<td><input type="text" name="nome_instituicao" value="<?=$nome_instituicao?>" maxlength="50" class="input_text"></td>
					</tr>
					<tr>
						<td class="label">Razão Social:</td>
						<td><input type="text" name="razao_social_instituicao" value="<?=$razao_social_instituicao?>" maxlength="50" class="input_text"></td>
					</tr>
					<tr>
						<td class="label">Telefone:</td>
						<td><input type="text" name="telefone_instituicao" value="<?=$telefone_instituicao?>" maxlength="15" class="input_text"></td>
					</tr>
					<tr>
						<td class="label">Fax:</td>
						<td><input type="text" name="fax_instituicao" value="<?=$fax_instituicao?>" maxlength="15" class="input_text"></td>
					</tr>
					<tr>
						<td colspan="2">
							<fieldset>
								<legend><b>Endereço</b></legend>
								<table width="100%" cellspacing="3">
									<tr>
										<td width="21%" align="right">Endereço:</td>
										<td><input type="text" name="endereco_instituicao" value="<?=$endereco_instituicao?>" maxlength="100" class="input_text"></td>
									</tr>
									<tr>
										<td align="right">Bairro:</td>
										<td><input type="text" name="bairro_instituicao" value="<?=$bairro_instituicao?>" maxlength="30" class="input_text"></td>
									</tr>
									<tr>
										<td align="right">Cidade:</td>
										<td><input type="text" name="cidade_instituicao" value="<?=$cidade_instituicao?>" size="30" maxlength="100" class="input_text"></td>
									</tr>
									<tr>
										<td align="right">Estado:</td>
										<td><input type="text" name="estado_instituicao" value="<?=$estado_instituicao?>" maxlength="2" class="input_text"></td>
									</tr>
									<tr>
										<td align="right">CEP:</td>
										<td><input type="text" name="cep_instituicao" value="<?=$cep_instituicao?>" maxlength="8" class="input_text"></td>
									</tr>
								</table>
							</fieldset>
						</td>
					</tr>
				</table>
			</center>
			<? 
			if($modo != "update") $modo = "add";
			echo('<input type="hidden" name="modo" value="' . $modo . '">');
			echo('<input type="hidden" name="id_instituicao" value="' . $id_instituicao . '">');
			termina_quadro_branco(); ?>
			<br>
			<? if($modo == "update") browser_pessoas(); ?>
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
						$query = "SELECT * FROM segmentos_instituicoes WHERE id_segmento=" . $registro["id_segmento"] . " AND id_instituicao=" . $id_instituicao;
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
			<br>
			<? inicia_quadro_branco('width="100%"', "Grava Informações"); ?>
			<table width="100%">
				<tr>
					<td align="right"><?
						if($modo == "update") echo('<input type="button" value="Apagar" class="botao_aqua" onclick="self.location=\'salva_instituicao.php?modo=apagar&id_instituicao=' . $id_instituicao . '\'">');
						elseif ($modo == "add") echo('<input type="reset" value="Limpar Campos" class="botao_aqua">');
						?>&nbsp;<input type="submit" value="Salvar" class="botao_aqua">
					</td>
				</tr>
			</table>
			<? termina_quadro_branco(); ?>
			</form>
		</td>
	</tr>
	
</table>
<script language="javascript">
	document.forms[0].elements[0].focus();
</script>
<?
termina_pagina();


function browser_pessoas(){
	global $id_instituicao;
	
	$query = "SELECT ";
	$query .= " CONCAT('<a title=\"Editar\" href=\"form_pessoa.php?modo=update&id_pessoa=', id_pessoa , '\"><img border=\"0\" src=\"imagens/editar.gif\"></a>') as id_pessoa,";
	$query .= " CONCAT('<a title=\"Copiar\" href=\"form_pessoa.php?modo=copiar&id_pessoa=', id_pessoa , '\"><img border=\"0\" src=\"imagens/copiar.gif\"></a>') as copiar,";
	$query .= "nome_pessoa, email_pessoa, DATE_FORMAT(dt_nascimento_pessoa,'%d/%m/%Y') as dt_nascimento_pessoa, ";
	$query .= " CASE recebe_email_pessoa WHEN 'n' THEN '<img border=\"0\" title=\"Mala Direta agendada para envio\" src=\"imagens/icone_email_agendado.gif\">' WHEN 's' THEN '<img border=\"0\" title=\"Mala Direta enviada\" src=\"imagens/icone_email_enviado.gif\">' END as recebe_email_pessoa, ";
	$query .= "CONCAT('<a href=\"javascript: apagar(', id_pessoa , ');\"><img border=\"0\" src=\"imagens/lixeira.gif\"></a>')";
	$query .= " from pessoas p LEFT OUTER JOIN instituicoes i ON i.id_instituicao = p.id_instituicao WHERE p.id_instituicao=" . $id_instituicao;
	
	$colunas[0]['largura'] = "3%";
	$colunas[0]['label'] = "&nbsp;";
	$colunas[0]['campo'] = "";
	$colunas[0]['alinhamento'] = "left";
	
	$colunas[1]['largura'] = "5%";
	$colunas[1]['label'] = "&nbsp;";
	$colunas[1]['campo'] = "";
	$colunas[1]['alinhamento'] = "left";
	
	$colunas[2]['largura'] = "25%";
	$colunas[2]['label'] = 'Nome';
	$colunas[2]['campo'] .= 'nome_pessoa';
	$colunas[2]['alinhamento'] = "left";
	
	$colunas[3]['largura'] = "20%";
	$colunas[3]['label'] = 'Email';
	$colunas[3]['campo'] = 'email_pessoa';
	$colunas[3]['alinhamento'] = "left";
	
	$colunas[4]['largura'] = "16%";
	$colunas[4]['label'] = 'Data&nbsp;Nascimento';
	$colunas[4]['campo'] = "dt_nascimento_pessoa";
	$colunas[4]['alinhamento'] = "center";
	
	$colunas[5]['largura'] = "4%";
	$colunas[5]['label'] = "Email?";
	$colunas[5]['campo'] = "recebe_email_pessoa";
	$colunas[5]['alinhamento'] = "right";
	
	$colunas[6]['largura'] = "4%";
	$colunas[6]['label'] = "&nbsp;";
	$colunas[6]['campo'] = "";
	$colunas[6]['alinhamento'] = "right";
	?>
	<script language="javascript">
		function apagar(id){
			if(confirm("Deseja remover esta pessoa do sistema?"))
				window.location = 'salva_pessoa.php?modo=apagar&pagina=<?=$_REQUEST["pagina"]?>&id_pessoa=' + id + '<?=$string?>';
		}
	</script>
	
	<?
	browser($query, $colunas, $_SERVER['QUERY_STRING'], 'Contatos nesta Instituição', 9999999, 2, false);
}
?>