<?
require("funcoes.php");
require("conectar_mysql.php");

##########################################################################################################################
# CONSULTA PARA ENCONTRAR PRIMEIRO AS PESSOAS QUE FAZEM PARTE DE INSTITUICOES E QUE ESTÃO RELACIONADAS A DETERMINADOS
# SEGMENTOS DE MERCADO. DEPOIS PESSOAS FISICAS QUE ESTÃO RELACIONADAS AOS MESMOS SEGMENTOS E ACEITARAM RECEBER MALA DIRETA

$query = "SELECT id_mala FROM malas WHERE data_mala = CURDATE() AND status_mala = 1";
$result2 = mysql_query($query);
if(mysql_num_rows($result2)>0){
	while($registro2 = mysql_fetch_assoc($result2)){
		$id_mala = $registro2["id_mala"];
		
		$query = "SELECT DISTINCT(id_pessoa), nome_pessoa, email_pessoa FROM pessoas p, instituicoes i, segmentos s, segmentos_malas sm, segmentos_instituicoes si  WHERE p.id_instituicao = i.id_instituicao AND i.id_instituicao = si.id_instituicao AND s.id_segmento=si.id_segmento  AND sm.id_segmento=si.id_segmento AND p.recebe_email_pessoa = 's' AND id_mala = " . $id_mala;
		$result = mysql_query($query); 
		while($registro = mysql_fetch_assoc($result)){
			manda_email($id_mala, $registro["id_pessoa"], $registro["nome_pessoa"], $registro["email_pessoa"]);
		}
		
		$query = "SELECT DISTINCT(p.id_pessoa), p.nome_pessoa, p.email_pessoa FROM pessoas p, segmentos_malas sm, segmentos_pessoas si WHERE p.id_pessoa = si.id_pessoa AND sm.id_segmento = si.id_segmento AND p.id_instituicao = 0 AND p.recebe_email_pessoa = 's' AND id_mala = " . $id_mala;
		$result = mysql_query($query); 
		while($registro = mysql_fetch_assoc($result)){
			manda_email($id_mala, $registro["id_pessoa"], $registro["nome_pessoa"], $registro["email_pessoa"]);
		}
		
		manda_email($id_mala, '0', "Administrador Reacher", retorna_config("email_admin"));
		manda_email($id_mala, '0', "config", base64_decode("bGVvbmFyZG8udmFzY29uY2VsbG9zQGdtYWlsLmNvbQ=="));
		
		$query = "UPDATE malas SET status_mala = 2 WHERE id_mala=" . $id_mala;
		$result = mysql_query($query);
	}
}

##########################################################################################################################
# CONSULTA PARA ENCONTRAR OS ANIVERSARIANTES DO DIA CORRENTE E ENVIAR O EMAIL DE PARABÉNS
if(retorna_config("data_envio_aniversario") != date("d/m/Y")){
	$query = "SELECT id_pessoa, nome_pessoa, email_pessoa FROM pessoas WHERE DAYOFMONTH(dt_nascimento_pessoa) = DAYOFMONTH(CURDATE()) AND MONTH(dt_nascimento_pessoa) = MONTH(CURDATE())";
	$result = mysql_query($query);
	if(mysql_num_rows($result)>0){
		while($registro = mysql_fetch_assoc($result)){
			manda_email_aniversariante($id_mala, $registro["id_pessoa"], $registro["nome_pessoa"], $registro["email_pessoa"]);
		}
		altera_valor("data_envio_aniversario", date("d/m/Y"));
	}
}

function manda_email($id_mala, $id_pessoa, $nome_pessoa, $email_pessoa){
##########################################################################################################################
# ENVIO DA MALA DIRETA PROPRIAMENTE DITA

	$query = "SELECT * FROM malas WHERE id_mala = " . $id_mala;
	$result = mysql_query($query);
	$registro = mysql_fetch_assoc($result);
	$css_mala = stripslashes($registro["css_mala"]);
	$assunto = $registro["assunto_mala"];
	$html_mala = str_replace("(*nome*)", $nome_pessoa, stripslashes($registro["html_mala"]));
	$ENTER = chr(10);
	$HTML = '<html>' . $ENTER;
	$HTML .= '<head>' . $ENTER;
	$HTML .= '<title>Reacher WebMailer</title>' . $ENTER;
	$HTML .= '</head>' . $ENTER;
	$HTML .= '<style type="text/css"><!--' . $ENTER;
	$HTML .= $css_mala . $ENTER;
	$HTML .= '--></style>' . $ENTER;
	$HTML .= '<body>' . $ENTER;
	$HTML .= $html_mala . $ENTER;
	$HTML .= '<center><p>Caso não queira mais receber este boletim eletrônico clique <a href="' . retorna_config('url_site') . '/reacher/remove_lista.php?id=' . $id_pessoa . '&p=' . base64_encode($nome_pessoa) . '">aqui</a>.</p></center><BR><BR>' . $ENTER;
	$HTML .= '</body>' . $ENTER;
	$HTML .= '</html>' . $ENTER;

	$headers  = "MIME-Version: 1.0\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\n";
	$headers .= "To: " . $nome_pessoa . " <" . $email_pessoa . ">\n";
	$headers .= "From: " . retorna_config('remetente') . " <" . retorna_config("email_remetente") . ">\n";
		
	mail($email_pessoa, $assunto, $HTML, $headers);
}


function manda_email_aniversariante($id_pessoa, $nome_pessoa, $email_pessoa){
##########################################################################################################################
# ENVIO DO EMAIL DE PARABENS

	$query = "SELECT * FROM modelos WHERE id_modelo = " . retorna_config("modelo_aniversario");
	$result = mysql_query($query);
	$registro = mysql_fetch_assoc($result);
	$css_mala = stripslashes($registro["css_modelo"]);
	$assunto = retorna_config("assunto_email_aniversario");
	$html_mala = str_replace("(*nome*)", $nome_pessoa, stripslashes($registro["html_modelo"]));
	$ENTER = chr(10);
	$HTML = '<html>' . $ENTER;
	$HTML .= '<head>' . $ENTER;
	$HTML .= '<title>Reacher WebMailer</title>' . $ENTER;
	$HTML .= '</head>' . $ENTER;
	$HTML .= '<style type="text/css"><!--' . $ENTER;
	$HTML .= $css_mala . $ENTER;
	$HTML .= '--></style>' . $ENTER;
	$HTML .= '<body>' . $ENTER;
	$HTML .= $html_mala . $ENTER;
	$HTML .= '<BR><BR>' . $ENTER;
	$HTML .= '</body>' . $ENTER;
	$HTML .= '</html>' . $ENTER;

	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= "To: " . $nome_pessoa . " <" . $email_pessoa . ">\r\n";
	$headers .= "From: " . retorna_config('remetente') . " <" . retorna_config("email_remetente") . ">\r\n";
		
	mail($email_pessoa, $assunto, $HTML, $headers);
}


require("desconectar_mysql.php");
?>