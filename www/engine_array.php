<?
set_time_limit(0);
ini_set("memory_limit", "512M");
require("funcoes.php");

if(ereg("Mozilla", $_SERVER["HTTP_USER_AGENT"])){
	?>
	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
	<html>
		<head>
			<title>Envio de Mala Direta com Microsoft Outlook</title>
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
			<link href="estilo.css" rel="stylesheet" rev="stylesheet">
		</head>
		<body style="background-color:#FFFFFF;">
		<?
}

envia_malas(seleciona_malas());

require("bounced.php");
if(ereg("Mozilla", $_SERVER["HTTP_USER_AGENT"])){
	?>Script executado completamente!</body><?
}

function envia_malas($malas){
##########################################################################################################################
# ENVIO DA MALA DIRETA PROPRIAMENTE DITA
	$ENTER = chr(10);
	$url_site = retorna_config('url_site');
	$nome_remetente = retorna_config('remetente');
	foreach($malas as $mala){
		ini_set("sendmail_from", $mala["remetente_mala"]);
		$i = 0;
		$relatorio = "";
		$HTML = '<html>' . $ENTER;
		$HTML .= '<head>' . $ENTER;
		$HTML .= '<title>Reacher WebMailer</title>' . $ENTER;
		$HTML .= '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">' . $ENTER;
		$HTML .= '</head>' . $ENTER;
		$HTML .= '<style type="text/css"><!--' . $ENTER;
		$HTML .= $mala["css_mala"] . $ENTER;
		$HTML .= '--></style>' . $ENTER;
		$HTML .= '<body>' . $ENTER;
		
		$headers  = "MIME-Version: 1.0\n";
		$headers .= "From: " . $nome_remetente . " <" . $mala["remetente_mala"] . ">\n";
		$headers .= "X-Sender: <" . $mala["remetente_mala"] . ">\n";
		$headers .= "Return-Path: " . $mala["return-path"] . "\n";
		$headers .= "Errors-To: <" . $mala["return-path"] . ">\n";
		$headers .= "Message-Id: <".md5(uniqid(rand())).".".preg_replace("/[^a-z0-9]/i", "", $mala["remetente_mala"])."@ldi.com.br>\n";
		$headers .= "Date: " . date("D, j M Y H:i:s -0300") . "\n";
		$headers .= "X-Priority: 3 (Normal)\n";
		if($mala["tipo_de_mala"] == "mala") $headers .= "id_mala: " . $mala["id_mala"] . "\n";
		$headers .= "X-MSMail-Priority: Normal\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\n";
		$headers .= "X-Mailer: Reacher WebMailer, Build by Leonardo Lima de Vasconcellos on 12.09.2005\n";
		$headers .= "Importance: Normal\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\n";
		
		foreach($mala["pessoas"] as $pessoa){
			$HTML_PESSOA = "";
			$HTML_FINAL = "";
			if($mala["tipo_de_mala"] == "mala"){
				$HTML_PESSOA .= '<div align="center" style="background-color: #D2D2D2;">Caso você não esteja visualizando este e-mail, por favor, clique <a href="' . $url_site . '/reacher/visualizar.php?id_pessoa=' . $pessoa["id_pessoa"] . '&id=' . $mala["id_mala"] . '" target="_blank">aqui</a></div>';
				if((((int)$pessoa["id_pessoa"]) != 0) && (((int)$pessoa["id_pessoa"]) != -1)){
					$HTML_FINAL .= '<center><a href="' . $url_site . '/reacher/remove_lista.php?id=' . $pessoa["id_pessoa"] . '&p=' . base64_encode($pessoa["nome_pessoa"]) . '"><img border="0" src="' . $url_site . '/reacher/imagens/remover.gif" alt="Clique aqui não receber mais esta mensagem"></a></center>' . $ENTER;
				}
				$HTML_FINAL .= '<img border="0" src="' . $url_site . '/reacher/registra_visualizacao.php?id_pessoa=' . $pessoa["id_pessoa"] . '&id_mala=' . $mala["id_mala"] . '" width="1" height="1">' . $ENTER;
			}			
			$HTML_FINAL .= '</body>' . $ENTER;
			$HTML_FINAL .= '</html>' . $ENTER;
			
			$HTML_PESSOA .= $mala["html_mala"] . $ENTER;
			$HTML_PESSOA = str_replace("(*nome*)", $pessoa["nome_pessoa"], $HTML_PESSOA);
			$HTML_PESSOA .= $HTML_FINAL;
			
			mail($pessoa["email_pessoa"], $mala["assunto"], $HTML_PESSOA, $headers);
			if((int)$pessoa["id_pessoa"] != -1){
				$i++;
				$msg = $i . " - Email enviado: " . $pessoa["email_pessoa"];
				$relatorio .= $msg . chr(13) . chr(10);
				if(ereg("Mozilla", $_SERVER["HTTP_USER_AGENT"])){
					echo($msg . "<br>\r\n");
					flush();
				}
			}
		}
		require("conectar_mysql.php");
		if($mala["tipo_de_mala"] == "mala"){
			$query = "UPDATE malas SET status_mala = 2, emails_enviados=" . $i . ", relatorio='" . addslashes($relatorio) . "' WHERE id_mala=" . $mala["id_mala"];
			while(!mysql_query($query)){
				sleep(5);
			}
		}
		elseif($mala["tipo_de_mala"] == "aniversario"){
			altera_valor("data_envio_aniversario", date("d/m/Y"));
		}
		elseif($mala["tipo_de_mala"] == "lembrete"){
			$query = "UPDATE lembretes SET ultimo_envio = CURDATE() WHERE id_lembrete = " . $mala["id_mala"];
			while(!mysql_query($query)){
				sleep(5);
			}
		}
	}
	unset($malas);
	require("desconectar_mysql.php");
}
?>