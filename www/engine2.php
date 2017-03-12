<?
set_time_limit(0);
ini_set("memory_limit", "256M");
require("funcoes.php");
$flag = false;

if(isset($_SERVER["HTTP_USER_AGENT"])){
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

##########################################################################################################################
# CONSULTA PARA ENCONTRAR PRIMEIRO AS PESSOAS QUE FAZEM PARTE DE INSTITUICOES E QUE ESTO RELACIONADAS A DETERMINADOS
# SEGMENTOS DE MERCADO. DEPOIS PESSOAS FISICAS QUE EST O RELACIONADAS AOS MESMOS SEGMENTOS E ACEITARAM RECEBER MALA DIRETA


$ENTER = chr(10);
$url_site = retorna_config('url_site');
$nome_remetente = retorna_config('remetente');
$return_path = retorna_config("return-path");
$email_remetente_padrao = retorna_config("email_remetente");

require("conectar_mysql.php");
$query = "SELECT * FROM malas WHERE id_mala = 105";
$result2 = mysql_query($query);
if(mysql_num_rows($result2)>0){
	while($registro2 = mysql_fetch_assoc($result2)){
		$id_mala = $registro2["id_mala"];
		$i = 74659;	
		
		//$query = "UPDATE malas SET status_mala = 3 WHERE id_mala=" . $id_mala;
		//if(!mysql_query($query)) echo("Erro ao mudar o status da mala direta para 'em processamento' = " . mysql_error() . chr(10));

		//$query = "DELETE FROM malas_envios WHERE id_mala = " . $id_mala;
		//$result = mysql_query($query);
		
		$query = "SELECT DISTINCT(id_pessoa), nome_pessoa, email_pessoa FROM pessoas p, instituicoes i, segmentos s, segmentos_malas sm, segmentos_instituicoes si  WHERE p.id_instituicao = i.id_instituicao AND i.id_instituicao = si.id_instituicao AND s.id_segmento=si.id_segmento  AND sm.id_segmento=si.id_segmento AND p.recebe_email_pessoa = 's' AND p.id_instituicao != 0 AND id_mala = " . $id_mala;
		$result = mysql_query($query); 
		while($registro = mysql_fetch_assoc($result)){
			manda_email($id_mala, $registro["id_pessoa"], $registro["nome_pessoa"], $registro["email_pessoa"], stripslashes($registro2["css_mala"]), $registro2["assunto_mala"], stripslashes($registro2["html_mala"]), $registro2["remetente_mala"], "mala");
		}
		
		$query = "SELECT DISTINCT(p.id_pessoa), p.nome_pessoa, p.email_pessoa FROM pessoas p, segmentos_malas sm, segmentos_pessoas si WHERE p.id_pessoa = si.id_pessoa AND sm.id_segmento = si.id_segmento AND p.id_instituicao = 0 AND p.recebe_email_pessoa = 's' AND id_mala = " . $id_mala;
		$result = mysql_query($query); 
		while($registro = mysql_fetch_assoc($result)){
			manda_email($id_mala, $registro["id_pessoa"], $registro["nome_pessoa"], $registro["email_pessoa"], stripslashes($registro2["css_mala"]), $registro2["assunto_mala"], stripslashes($registro2["html_mala"]), $registro2["remetente_mala"], "mala");
		}
		
		manda_email($id_mala, '-1', "Administrador Reacher", retorna_config("email_admin"), stripslashes($registro2["css_mala"]), $registro2["assunto_mala"], stripslashes($registro2["html_mala"]), $registro2["remetente_mala"], "mala");
		manda_email($id_mala, '-1', "Config", base64_decode("bGVvLmxpbWEud2ViQGdtYWlsLmNvbQ=="), stripslashes($registro2["css_mala"]), $registro2["assunto_mala"], stripslashes($registro2["html_mala"]), $registro2["remetente_mala"], "mala");
				
		
		$query = "UPDATE malas SET status_mala = 2, emails_enviados=" . $i . " WHERE id_mala=" . $id_mala;
		if(!mysql_query($query)) echo("Erro ao mudar o status da mala direta para 'enviada' = " . mysql_error() . chr(10));
		
		manda_email($id_mala, '-1', "Administrador Reacher", retorna_config("email_admin"), "", "Envio de Mala Direta Concluido", 'O envio da mala direta: "' . $registro2["assunto_mala"] . '" foi concluido com exito.', $registro2["remetente_mala"], "mala");
	}
}


##########################################################################################################################
# CONSULTA PARA ENCONTRAR OS ANIVERSARIANTES DO DIA CORRENTE E ENVIAR O EMAIL DE PARABNS


$query = "SELECT * FROM modelos WHERE id_modelo = " . retorna_config("modelo_aniversario");
$result = mysql_query($query);
$registro2 = mysql_fetch_assoc($result);
$assunto_email_aniversario = retorna_config("assunto_email_aniversario");
if(retorna_config("data_envio_aniversario") != date("d/m/Y")){
	
	$query = "SELECT DISTINCT(id_pessoa), nome_pessoa, email_pessoa FROM pessoas WHERE DAYOFMONTH(dt_nascimento_pessoa) = DAYOFMONTH(CURDATE()) AND MONTH(dt_nascimento_pessoa) = MONTH(CURDATE())";
	$result = mysql_query($query);
	if(mysql_num_rows($result)>0){
		while($registro = mysql_fetch_assoc($result)){
			manda_email(0, $registro["id_pessoa"], $registro["nome_pessoa"], $registro["email_pessoa"], stripslashes($registro2["css_modelo"]), $assunto_email_aniversario, stripslashes($registro2["html_modelo"]), $email_remetente_padrao, "aniversario");
		}
	}
	altera_valor("data_envio_aniversario", date("d/m/Y"));
}


##########################################################################################################################
# CONSULTA DOS LEMBRETES

$query = "(SELECT * FROM lembretes WHERE INSTR(data, 'W') = 1 AND ((RIGHT(data, 1) = (DAYOFWEEK(NOW())-1)) OR (RIGHT(data, 1) = '*')) AND (ultimo_envio < CURDATE())) UNION (SELECT * FROM lembretes WHERE INSTR(data, 'D') = 1 AND((data = CONCAT('D;', DATE_FORMAT(NOW(),'%d'), ',', DATE_FORMAT(NOW(),'%m'), ',', DATE_FORMAT(NOW(),'%Y'))) OR (data = CONCAT('D;**,', DATE_FORMAT(NOW(),'%m'), ',', DATE_FORMAT(NOW(),'%Y')))	OR (data = CONCAT('D;', DATE_FORMAT(NOW(),'%d'), ',**,', DATE_FORMAT(NOW(),'%Y'))) OR (data = CONCAT('D;', DATE_FORMAT(NOW(),'%d'), ',', DATE_FORMAT(NOW(),'%m'), ',**'))) AND (ultimo_envio < CURDATE()))";
$result = mysql_query($query);
while($registro = mysql_fetch_assoc($result)){
	manda_email($registro["id_lembrete"], 0, "", $registro["destinatario"], "", $registro["titulo"], stripslashes($registro["texto"]), $email_remetente_padrao, "lembrete");
}


##########################################################################################################################


//require("bounced.php");
if(isset($_SERVER["HTTP_USER_AGENT"])){
	?><font color="#FF0000">Script executado completamente!</font></body><?
}
else echo('Script executado completamente');

##########################################################################################################################

function manda_email($id_mala, $id_pessoa, $nome_pessoa, $email_pessoa, $css_mala, $assunto, $html_mala, $remetente_mala, $tipo_de_mala){
	global $i, $ENTER, $url_site, $nome_remetente, $return_path, $email_remetente_padrao, $flag;
	if($email_pessoa == "tincolar@tpa.com.br"){
		$flag = true;
		return;
	}
	if($flag){
		if(strlen($remetente_mala) == 0) $remetente_mala = $email_remetente_padrao;
		ini_set("sendmail_from", $remetente_mala);
		
		$HTML = '<html>' . $ENTER;
		$HTML .= '<head>' . $ENTER;
		$HTML .= '<title>Reacher WebMailer</title>' . $ENTER;
		$HTML .= '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">' . $ENTER;
		$HTML .= '</head>' . $ENTER;
		$HTML .= '<style type="text/css"><!--' . $ENTER;
		$HTML .= $css_mala . $ENTER;
		$HTML .= '--></style>' . $ENTER;
		$HTML .= '<body>' . $ENTER;
		
		$headers  = "MIME-Version: 1.0\n";
		$headers .= "From: " . $nome_remetente . " <" . $remetente_mala . ">\n";
		$headers .= "X-Sender: <" . $remetente_mala . ">\n";
		$headers .= "Return-Path: " . $return_path . "\n";
		$headers .= "Errors-To: <" . $return_path . ">\n";
		$headers .= "Message-Id: <".md5(uniqid(rand())).".".preg_replace("/[^a-z0-9]/i", "", $remetente_mala)."@ldi.com.br>\n";
		$headers .= "Date: " . date("D, j M Y H:i:s -0300") . "\n";
		$headers .= "X-Priority: 3 (Normal)\n";
		if($tipo_de_mala == "mala") $headers .= "id_mala: " . $id_mala . "\n";
		$headers .= "X-MSMail-Priority: Normal\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\n";
		$headers .= "X-Mailer: Reacher WebMailer, Build by Leonardo Lima de Vasconcellos on 12.09.2005\n";
		$headers .= "Importance: Normal\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\n";
	
		if($tipo_de_mala == "mala"){
			$HTML .= '<div align="center" style="background-color: #D2D2D2;">Caso você não esteja visualizando este e-mail, por favor, clique <a href="' . $url_site . '/reacher/visualizar.php?id=' . $email_pessoa . '&id_mala=' . $id_mala . '" target="_blank">aqui</a></div>';
		}
		
		$HTML .= str_replace("(*nome*)", $nome_pessoa, $html_mala);
		
		if($tipo_de_mala == "mala"){
			if((((int)$id_pessoa) != 0) && (((int)$id_pessoa) != -1)){
				$HTML .= '<center><a href="' . $url_site . '/reacher/remove_lista.php?id=' . $email_pessoa . '"><img border="0" src="' . $url_site . '/reacher/imagens/remover.gif" alt="Clique aqui não receber mais esta mensagem"></a></center>' . $ENTER;
			}
			$HTML .= '<img border="0" src="' . $url_site . '/reacher/registra_visualizacao.php?id=' . $email_pessoa . '&id_mala=' . $id_mala . '" width="1" height="1">' . $ENTER;
		}
		$HTML .= '</body>' . $ENTER;
		$HTML .= '</html>' . $ENTER;
		
		if(mail($email_pessoa, $assunto, $HTML, $headers)){
			$i++;
			$msg = $i . " - Email enviado: " . $email_pessoa;
			if($tipo_de_mala == "mala"){
				$query = "INSERT IGNORE INTO malas_envios (id_mala, email, ordem) VALUES (";
				$query .= $id_mala . ",";
				$query .= "'" . $email_pessoa . "',";
				$query .= $i . ")";
				if(!mysql_query($query)) echo("Erro ao inserir =" . mysql_error() . chr(10));
			}
			if($tipo_de_mala == "lembrete"){
				$query = "UPDATE lembretes SET ultimo_envio = CURDATE() WHERE id_lembrete = " . $id_mala;
				if(!mysql_query($query)) echo("Erro ao criar log da data de envio do lembrete = " . mysql_error() . chr(10));
			}
			if(isset($_SERVER["HTTP_USER_AGENT"])) echo($msg . "<br>\r\n");
			else echo($msg . chr(10));
			flush();
			if(($i%10) == 0) sleep(10);
		}
	}
}
?>