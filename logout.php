<?php
include_once('config.php');

$query = "UPDATE users SET session_id= NULL WHERE id='" . $_SESSION['users']['id'] . "' LIMIT 1";
mysql_query($query) or die(mysql_error());

unset($_SESSION['users']);

header('Location: index.php');

?>
