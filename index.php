<html lang="pt">
<title>Login</title>
<head>
<link rel="stylesheet" href="css/cssstyle.css">
</head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<body>
<?php
require_once ("dao/db_connection.php");
require_once ("classes/Login.php");
$login = new Login ();
if ($login->isUserLoggedIn () == true) {
include ("views/logged_in.php");
} else {
	include ("views/not_logged_in.php");
}
?>
</html>
</body>