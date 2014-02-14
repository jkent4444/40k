<?php

//start the session
session_start();

//connect to the database
include('connectMySQL.php');
$db = new MySQLDatabase();
$db->connect();

//check if authenticated user or not
$isUserLoggedIn = false; 

$query = "SELECT * FROM users WHERE session_id='" . session_id() . "' LIMIT 1";
if (!$query) {
    die('Invalid query: ' . mysql_error());
}
$userResult = mysql_query($query);

if (mysql_num_rows($userResult)== 1) { //user is already logged in
    $_SESSION['users'] = mysql_fetch_assoc($userResult);
    $isUserLoggedIn = true;
}

//login functionality adapted from : http://edrackham.com/php/php-login-script-tutorial/


?>