<?
ignore_user_abort(true);
set_time_limit(0);
exec("/usr/local/bin/php4 " . $_SERVER['DOCUMENT_ROOT'] . "/reacher/engine.php > log.txt");
?>