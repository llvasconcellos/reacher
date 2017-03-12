<?
require("funcoes.php");
require("permissao_documento.php");

$id_mala = trim($_POST["id_mala"]);
if(strlen($id_mala)==0) tela_erro("Mala direta não informada", true);
set_time_limit(0);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
	<html>
		<head>
			<title>Envio Manual de Mala Direta</title>
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
			<link href="estilo.css" rel="stylesheet" rev="stylesheet">
		</head>
		<body style="background-color:#FFFFFF;">
<?
inicia_quadro_branco('width="100%"', "Enviando Mala Direta...");
?>
<br />
<br />
<table width="100%">
	<tr>
		<td align="right" width="30%">Progresso:</td>
		<td>
			<div style="width:100%; height:20px; border: 1px solid #000099; background-color:#535353; text-align:left;">
				<div id="progresso" style=" width:0px; height:20px; background-color:#0000FF; background-image:url(imagens/pbar.gif);"></div>
				<div id="nr_progresso" style="width:100%; height:20px; position:relative; margin-top: -16px; color:#FFFFFF; font-size:12px; font-weight:bold; font-family:Arial, Helvetica, sans-serif; text-align:center; vertical-align:middle;"></div>
			</div>
		</td>
		<td align="right" width="30%">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3"><hr /></td>
	</tr>
	<tr>
		<td colspan="3">
			<div id="log_txt" style="text-align:center; width:100%;">Aguarde</div>
		</td>
	</tr>
</table>
<br />
<br />
<script language="javascript">
	var msg = "";
	var porcentagem = 0;
	function progress_update(){
		p = document.getElementById("progresso");
		n = document.getElementById("nr_progresso");
		porcentagem++;
		p.style.width = porcentagem + "%";
		n.innerHTML = porcentagem + "%";
	}
	function progress_total(){
		clearInterval(i);
		self.resizeTo(400, 370);
		p = document.getElementById("progresso");
		n = document.getElementById("nr_progresso");
		l = document.getElementById("log_txt");
		p.style.width = "100%";
		n.innerHTML = "100%";
		l.innerHTML = '<center><textarea style="width:99%; height:100px;">' + msg + '</textarea><br><br>[<a href="javascript: self.close();">FECHAR</a>]</center>';
	}
	function aguarde(){
		l = document.getElementById("log_txt");
		if(l.innerHTML != "Aguarde...") l.innerHTML += ".";
		else l.innerHTML = "Aguarde";
	}
	var i = setInterval("aguarde()", 1000);
</script>
<?
termina_quadro_branco();
?>
</body>
<?
flush();
$dest = trim($_POST["dest"]);
$dest = str_replace(chr(10), "", $dest);
$dest = str_replace(chr(13), "", $dest);
$dest = str_replace(chr(9), "", $dest);
$dest = str_replace(" ", "", $dest);
$dest = str_replace("'", "", $dest);
$dest = str_replace('"', "", $dest);

if(ereg(";", $dest)) $dest =  split(";",$dest);
else $dest = array($dest);

$passo = ceil(count($dest)/100);
$cont = 0;
sleep(5);
require("conectar_mysql.php");




$query = "SELECT * FROM malas WHERE id_mala = " . $id_mala;
$result = mysql_query($query);
$registro = mysql_fetch_assoc($result);
$css_mala = stripslashes($registro["css_mala"]);
$assunto = $registro["assunto_mala"];
if(strlen($registro["remetente_mala"])>0) $remetente_mala = $registro["remetente_mala"];
else $remetente_mala = retorna_config("email_remetente");
$url_site = retorna_config("url_site");

foreach($dest as $email_pessoa){	
	$html_mala = str_replace("(*nome*)", $email_pessoa, stripslashes($registro["html_mala"]));
	$ENTER = chr(10);
	$HTML = '<html>' . $ENTER;
	$HTML .= '<head>' . $ENTER;
	$HTML .= '<title>Reacher WebMailer</title>' . $ENTER;
	$HTML .= '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">' . $ENTER;
	$HTML .= '</head>' . $ENTER;
	$HTML .= '<style type="text/css"><!--' . $ENTER;
	$HTML .= $css_mala . $ENTER;
	$HTML .= '--></style>' . $ENTER;
	$HTML .= '<body>' . $ENTER;
	$HTML .= '<div align="center" style="background-color: #D2D2D2;">Caso você não esteja visualizando este e-mail, por favor, clique <a href="' . $url_site . '/reacher/visualizar.php?id_pessoa=0&id=' . $id_mala . '" target="_blank">aqui</a></div>' . $ENTER;
	$HTML .= $html_mala . $ENTER;
	$HTML .= '</body>' . $ENTER;
	$HTML .= '</html>' . $ENTER;

	$headers  = "MIME-Version: 1.0\n";
	$headers .= "From: " . $remetente_mala . " <" . $remetente_mala . ">\n";
	$headers .= "X-Sender: <" . $remetente_mala . ">\n";
	$headers .= "Return-Path: " . $remetente_mala . "\n";
	$headers .= "Errors-To: <" . $remetente_mala . ">\n";
	$headers .= "Message-Id: <".md5(uniqid(rand())).".".preg_replace("/[^a-z0-9]/i", "", $remetente_mala)."@ldi.com.br>\n";
	$headers .= "Date: " . date("D, j M Y H:i:s -0300") . "\n";
	$headers .= "X-Priority: 3 (Normal)\n";
	$headers .= "X-MSMail-Priority: Normal\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\n";
	$headers .= "X-Mailer: MAIL_MATE, Build by Leonardo Lima de Vasconcellos on 14.04.2008\n";
	$headers .= "Importance: Normal\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\n";

	ini_set("sendmail_from", $remetente_mala);
	if(mail($email_pessoa, $assunto, $HTML, $headers)){
		echo('<script language="javascript">msg += "' . "Email enviado: " . $email_pessoa . '\r";</script>');
		$cont++;
	}
	if($cont == $passo){
		echo('<script language="javascript">progress_update();</script>');
		flush();
		$cont = 0;
	}
}
echo('<script language="javascript">progress_total();</script>');
require("desconectar_mysql.php");
?>