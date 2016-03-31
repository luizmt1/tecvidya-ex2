<?php
require_once("dao/db_connection.php");
require_once("classes/signup.php");
$signup = new signup();
include("views/usersignup.php");
?>