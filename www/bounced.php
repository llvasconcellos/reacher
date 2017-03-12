<?
//////////////////////////////////////////////
$servidor = "mail.joinvillebc.com.br";
$port = "110";
$user = "reacher@joinvillebc.com.br";
$pass = "reacher123";
/////////////////////////////////////////////


require("conectar_mysql.php");
$mailbox = imap_open("{".$servidor.":".$port. "/pop3}INBOX", $user, $pass);
$headers = imap_headers($mailbox);
$failures = array();
for($i=1; $i<=count($headers); $i++){
	$cabec = imap_header($mailbox, $i);
	if($cabec->subject == "failure notice"){
		$failures[] = $i;
	}
}
foreach($failures as $failed){
	$body = imap_body($mailbox, $failed);
	$line = split("\n", $body);
	foreach($line as $linha){
		if((ereg("To:", $linha)) && (!ereg("-To:", $linha))){
			$temp = split(":", $linha);
			$email = trim($temp[1]);
		}
		if(ereg("id_mala:", $linha)){
			$temp = split(":", $linha);
			$id_mala = trim($temp[1]);
		}		
	}
	include("conectar_mysql.php");
	$query = "UPDATE pessoas SET recebe_email_pessoa = 'n', dt_nao_recebe_email = NOW(), motivo=3 WHERE email_pessoa='" . $email . "'";
	$result1 = mysql_query($query);
	$query = "UPDATE malas SET bounces = (bounces + 1) WHERE id_mala=" . $id_mala;
	$result2 = mysql_query($query);
	if($result1 && $result2) imap_delete($mailbox, $failed);
	else die("erro: " . mysql_error());
}
require("desconectar_mysql.php");
imap_close($mailbox, CL_EXPUNGE);




//////////////////////////////////////////////////////////





$mailbox = imap_open("{".$servidor.":".$port. "/pop3}INBOX", $user, $pass);
$headers = imap_headers($mailbox);
$failures = array();
for($i=1; $i<=count($headers); $i++)
	imap_delete($mailbox, $i);
imap_close($mailbox, CL_EXPUNGE);
?>