<?
session_start();
$modo = $_GET["modo"];
if($modo == "download"){
	header('Content-type: text/plain');
	header('Content-Disposition: attachment; filename="log.txt"');
	header("Content-Length: " .(string)(strlen($_SESSION["msg"])) );
}
elseif($modo == "display"){
	$_SESSION["msg"] = str_replace(chr(13) . chr(10), "<br>", $_SESSION["msg"]);
}
else{
	tela_erro("Falta informações para a visualização deste Log", false);
}
echo($_SESSION["msg"]);
session_destroy();
?>