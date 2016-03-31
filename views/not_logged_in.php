<?php
/*failure*/
if ($login->errors) {
    foreach ($login->errors as $error) {
        echo $error;    
    }
}
/*sucess*/
if ($login->messages) {
    foreach ($login->messages as $message) {
        echo $message;
    }
}

?>
<html lang="pt">
<title>Cadastro</title>
<head><link rel="stylesheet" href="css/cssstyle.css"></head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<body>
<!-- login form -->
<form method="post" action="index.php" name="loginform">
	<table>
		<tr>
			<td>
				<label for="login_input_username">Usuário</label>
			</td>
		</tr>
		<tr>
			<td>
				<input id="login_input_username" class="login" type="text" name="user_login" placeholder="login" required />
			</td>
		</tr>
		<tr>
			<td>
				<label for="login_input_password">Senha</label>
			</td>
		</tr>
		<tr>
			<td>
				<input id="login_input_password" class="password" type="password" name="user_password" autocomplete="off" placeholder="senha" required />
			<td>
		</tr>
		<tr>
			<td>
				&nbsp;
			<td>
		</tr>
		<tr>
			<td>
				<input type="submit"  name="login" class="btn" value="Log in" />
			<td>
		 </tr>
		 <tr>
			<td>
				&nbsp;
			<td>
		 </tr>
		 <tr>
			<td>
				<font>Não tem um login?</font>
			<td>
		 </tr>
		 <tr>
			<td>
				<a href="signup.php"><b>CADASTRE-SE</b></a>
			<td>
		 </tr>
	</table>
</form>
</html>
</body>