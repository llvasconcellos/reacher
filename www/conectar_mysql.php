<?php
$db = mysql_connect("localhost", "root", "") or tela_erro("Erro de conexão com o banco: " . mysql_error(),true);
mysql_select_db ("reacher");
?>