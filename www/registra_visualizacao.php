<?
$email_pessoa = $_GET["id"];
$id_mala = $_GET["id_mala"];

require("conectar_mysql.php");
$query = "SELECT id_pessoa FROM pessoas WHERE email_pessoa = '" . $email_pessoa . "'";
$result = mysql_query($query);
$registro = mysql_fetch_assoc($result);
$id_pessoa = $registro["id_pessoa"];

$query = "INSERT INTO malas_visualizacoes (id_mala, id_pessoa) VALUES (" . $id_mala . "," . $id_pessoa . ")";
$result = mysql_query($query);
require("desconectar_mysql.php");

header("Content-type: image/png");
$im     = imagecreate(1,1);
$white = imagecolorallocate($im, 255, 255, 255);
imagepng($im);
imagedestroy($im);
?>