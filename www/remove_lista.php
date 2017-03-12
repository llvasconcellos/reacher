<?
require("funcoes.php");

$email_pessoa = trim($_REQUEST["id"]);

require("conectar_mysql.php");
$query = "UPDATE pessoas SET recebe_email_pessoa = 'n', dt_nao_recebe_email = NOW(), motivo=2 WHERE email_pessoa='" . $email_pessoa . "'";
$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error(), false);
require("desconectar_mysql.php");

?>
<html>
	<head>
		<title>Obriado pela sua atenção!</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link href="estilo.css" rel="stylesheet" rev="stylesheet">
	</head>
	<body style="background-color: #FFFFFF"><br><br><br><br><br><br><br><br><center>
<?
inicia_quadro_branco('width="500"', 'Sucesso!'); ?>
	<table width="100%">
		<tr>
			<td><img src="imagens/ok.jpg"></td>
			<td>
				Você foi removido da nossa lista de emails. Obrigado por utilizar nosso serviço!
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center"><a href="Javascript: self.close();">[Fechar]</a></td>
		</tr>
	</table>
<?
termina_quadro_branco(); 
?>
</center>
</body>
</html>