<?
require("funcoes.php");
require("permissao_documento.php");

$id_mala = trim($_GET["id_mala"]);

if($_GET["modo"] == "setstatus"){
	require("conectar_mysql.php");
	$query = "UPDATE malas SET status_mala = 2, emails_enviados=" . $_GET["total"] . " WHERE id_mala=" . $id_mala;
	if(!mysql_query($query)) echo("Erro ao mudar o status da mala direta para 'enviada' = " . mysql_error() . chr(10));
	die("OK");
}




if(strlen($id_mala)==0) tela_erro("Mala direta não informada", true);
set_time_limit(0);
$mala = seleciona_malas($id_mala);



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
flush();
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
		clearInterval(intervalo);
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
	var intervalo = setInterval("aguarde()", 1000);
	function SendMail(para, corpo, assunto){
		var theApp;
		var theMailItem;
		var theApp = new ActiveXObject("Outlook.Application");
		var theMailItem = theApp.CreateItem(0);		
		if(parseInt(opener.document.forms[0].qtd_outlook.value) == 1){
			theMailItem.to = para;
		}
		else {
			primeiro_dest =  para.split(";");
			theMailItem.to = primeiro_dest[0];
			if(primeiro_dest.length > 1)
				theMailItem.bcc = para.replace(primeiro_dest[0] + ";", "");
		}
		theMailItem.Subject = assunto;
		theMailItem.HTMLBody = corpo;
		theMailItem.save();
		if(opener.document.forms[0].preview_outlook.checked) theMailItem.display();
		if(opener.document.forms[0].envio_outlook.checked) theMailItem.send();
	}
</script>
<script language="javascript">
var dests = new Array();
<?
flush();

$i = 0;
$j = 1;
$flag = true;
$arr_num = 0;
$total = count($mala[0]["pessoas"]);


foreach($mala[0]["pessoas"] as $pessoa){
	if($flag == true){
		echo("dests[" . $arr_num . "] = [");
		flush();
	}		
	if($flag == true){
		echo('"');
		flush();
		$flag = false;
	}
	else{
		echo(',"');
		flush();
	}
	echo($pessoa["email_pessoa"] . '"');
	if(($i == 32000) || ($j == $total)){
		echo("];\r\n");
		flush();
		$flag = true;
		$arr_num++;
		$i = 0;
	}
	$i++;
	$j++;
}
?>
var html = opener.oEdit1.getHTMLBody();
var subject = opener.document.forms[0].assunto_mala.value;
var acumulo = parseInt(opener.document.forms[0].qtd_outlook.value);
var conjunto = "";
var j = 0;
var total = 0;
var k = 0;
var sucesso = false;
var url_site = '<?=retorna_config('url_site')?>';
var email_admin = '<?=retorna_config('email_admin')?>';
var id_mala = '<?=$id_mala?>';
var totaldearrays = dests.length;

for(i = 0; i < totaldearrays; i++)
	for(pessoa in dests[i])
		total++;

if(total == 0) alert("Nenhum endereço de email para enviar.\nVerifique se esta mala direta está marcada como agendada para o envio.");
		
if(acumulo > total) acumulo = total;

iniciodoloop:
for(i = 0; i < totaldearrays; i++){
	for(pessoa in dests[i]){
		conjunto += dests[i][pessoa] + ";";
		j++;
		k++;
		if((j == acumulo) || (k == total)) {
			if(conjunto.lastIndexOf(";",conjunto.length) == conjunto.length-1)
				conjunto = conjunto.substring(0,(conjunto.length-1));
			try{
				if(acumulo == 1){
					corpo_email = '<div align="center" style="background-color: #D2D2D2;">Caso você não esteja visualizando este e-mail, por favor, clique <a href="' + url_site + '/reacher/visualizar.php?id=' + conjunto + '&id_mala=' + id_mala + '" target="_blank">aqui</a></div>';
					corpo_email += html;
					corpo_email += '<img border="0" src="' + url_site + '/reacher/registra_visualizacao.php?id=' + conjunto + '&id_mala=' + id_mala + '" width="1" height="1">';
					corpo_email += '<center><a href="' + url_site + '/reacher/remove_lista.php?id=' + conjunto + '"><img border="0" src="' + url_site + '/reacher/imagens/remover.gif" alt="Clique aqui não receber mais esta mensagem"></a></center>';
				}
				else{
					corpo_email = '<div align="center" style="background-color: #D2D2D2;">Caso você não esteja visualizando este e-mail, por favor, clique <a href="' + url_site + '/reacher/visualizar.php?id=' + email_admin + '&id_mala=' + id_mala + '" target="_blank">aqui</a></div>';
					corpo_email += html;
					corpo_email += '<img border="0" src="' + url_site + '/reacher/registra_visualizacao.php?id=' + email_admin + '&id_mala=' + id_mala + '" width="1" height="1">';
				}
				SendMail(conjunto, corpo_email, subject);
				sucesso = true;
			}
			catch(err){
				alert("Não foi possível executar a automação do Microsoft Outlook 2007!\r\n" +
				"É necessário configurar o Internet Explorer e o Outlook seguindo os passos abaixo:\r\n" +
				"____________________________________________________________________\r\n" +
				"Internet Explorer - Ferramentas - Opções de Internet - Segurança - Nivel Personalizado\r\n" + 
				"Baixar Controles ActiveX não Assinados: Prompt\r\n" + 
				"Inicializar e criar script de controles ActiveX não marcados como seguros para script: Prompt\r\n" + 
				"____________________________________________________________________\r\n" +
				"Outlook 2007 - Ferramentas - Central de Confiabilidade - Acesso de Programação:\r\n" +
				"Selecione a opção: Nunca avisar sobre atividades suspeitas");
				totaldearrays = 0;
				break iniciodoloop;
			}
			conjunto = "";
			j = 0;
		}
	}
}


if((sucesso) && (opener.document.forms[0].envio_outlook_altera_status.checked)){
	var xmlHttp;
	try{  // Firefox, Opera 8.0+, Safari  
		xmlHttp=new XMLHttpRequest();  
	}
	catch (e){  // Internet Explorer
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e){
			try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("Este browser nao suporta AJAX!");
			}
		}
	}
	xmlHttp.onreadystatechange=function(){
		if(xmlHttp.readyState==4){
			progress_total();
			self.opener.location = "browser_malas.php";
		}
	}
	xmlHttp.open("GET","engine_outlook.php?modo=setstatus&id_mala=<?=$id_mala?>&total=" + total,true);
	xmlHttp.send(null);
}
if((sucesso) && (!opener.document.forms[0].envio_outlook_altera_status.checked)) progress_total();
else self.close();

</script>
<? termina_quadro_branco(); ?>
</body>