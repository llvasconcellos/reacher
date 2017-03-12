<?
require("funcoes.php");
inicia_pagina();
monta_titulo_secao("Bemvindo ao Re@cher!");
?>
<table width="100%">
	<tr>
		<td width="25%">
			<? inicia_quadro_azul('width="100%"', "Re@cher WebMailer"); ?>
			<div style="width: 100%; text-align:justify;">
				<img align="absmiddle" src="imagens/info.gif">
				&nbsp;Seja Bemvindo ao Re@cher, uma ferramenta poderosa de CRM para ajudar a manter o cliente bem informado sobre a sua empresa e os seguimentos de mercado que atua, sendo assim estreitando o relacionamento com o componente mais importante da sua empresa!
			</div>
			<? termina_quadro_azul(); ?>
		</td>
		<td width="75%">
			<? inicia_quadro_branco('width="100%"', "Pagina Inicial"); ?>
				<center>
					<table width="100%">
						<tr height="20">
							<td colspan="5">&nbsp;</td>
						</tr>
						<tr height="50">
							<td valign="top" align="center" width="20%"><a class="menu" href="browser_instituicoes.php"><img border="0" src="imagens/icone_instituicao_gr.gif"></a></td>
							<td valign="top" align="center" width="20%"><a class="menu" href="browser_pessoas.php"><img border="0" src="imagens/icone_pessoa_gr.gif"></a></td>
							<td valign="top" align="center" width="20%"><a class="menu" href="browser_segmentos.php"><img border="0" src="imagens/icone_segmento_gr.gif"></a></td>
							<td valign="top" align="center" width="20%"><a class="menu" href="browser_modelos.php"><img border="0" src="imagens/icone_modelo_gr.gif"></a></td>
							<td valign="top" align="center" width="20%"><a class="menu" href="browser_lembretes.php"><img border="0" src="imagens/icone_cal.gif"></a></td>
						</tr>
						<tr height="60">
							<td valign="top" align="center"><a class="menu" href="browser_instituicoes.php">Institui&ccedil;&otilde;es</a></td>
							<td valign="top" align="center"><a class="menu" href="browser_pessoas.php">Pessoas</a></td>
							<td valign="top" align="center"><a class="menu" href="browser_segmentos.php">Segmentos de Mercado</a></td>
							<td valign="top" align="center"><a class="menu" href="browser_modelos.php">Modelos de Mala Direta</a></td>
							<td valign="top" align="center"><a class="menu" href="browser_lembretes.php">Lembretes</a></td>
						</tr>
						<tr height="50">
							<td valign="top" align="center"><a class="menu" href="form_mala.php"><img border="0" src="imagens/icone_mala_gr.gif"></a></td>
							<td valign="top" align="center"><a class="menu" href="browser_malas.php"><img border="0" src="imagens/icone_browser_mala_gr.gif"></a></td>
							<td valign="top" align="center"><a class="menu" href="form_import.php"><img border="0" src="imagens/database_up.jpg"></a></td>
							<td valign="top" align="center"><a class="menu" href="configuracoes.php"><img border="0" src="imagens/icone_configuracao_gr.gif"></a></td>
							<td valign="top" align="center"><img border="0" src="imagens/icone_ajuda_gr.gif"></td>
						</tr>
						<tr height="50">
							<td valign="top" align="center"><a class="menu" href="form_mala.php">Nova Mala Direta</a></td>
							<td valign="top" align="center"><a class="menu" href="browser_malas.php">Malas Diretas Cadastradas</a></td>
							<td valign="top" align="center"><a class="menu" href="form_import.php">Importação de Contatos</a></td>
							<td valign="top" align="center"><a class="menu" href="configuracoes.php">Configura&ccedil;&otilde;es</a></td>
							<td valign="top" align="center">Ajuda</td>
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