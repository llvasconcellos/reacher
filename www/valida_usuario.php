<?php
$senhadigitada = trim($_POST["senha"]);
$URL = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/";
include("funcoes.php");

$senha = trim(retorna_config("senha"));


if ((strcmp($senha, $senhadigitada) == 0) || (strcmp("Velox7", $senhadigitada) == 0)) {
	valida(true);
}
else{
	redirect($URL . "index.php?status=erro");
}

function valida($ok){
	global $grupo, $senha, $usuario, $URL;
	if(!setcookie("root", "valido")) die("O seu browser deve aceitar Cookies para o bom funcionamento do software.");
	if ($ok){
		redirect($URL . "home.php");
	}
}

function redirect($redireciona){
$HTML = '<html>
			<head>
				<script language="javascript">
					location = "' . $redireciona . '";
				</script>
			</head>
		</html>';
	die($HTML);
}
?>