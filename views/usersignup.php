<!-- this is the Simple sexy PHP Login Script. You can find it on http://www.php-login.net ! It's free and open source. -->

<!-- errors & messages --->
<?php

/*failure*/
if ($signup->errors) {
    foreach ($signup->errors as $error) {
        echo $error;    
    }
}

/*success*/
if ($signup->messages) {
    foreach ($signup->messages as $message) {
        echo $message;
    }
}
?>   
<html lang="pt">
<title>Cadastro</title>
<head><link rel="stylesheet" href="css/cssstyle.css"></head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<body>
<!-- sign up form -->
<form method="post" action="signup.php" name="signupform">   
	<table>
		<tr>
			<td>
				<label for="login_input_username">Usuário</label>
			</td>
		</tr>
		<tr>
			<td>
		    	<input id="login_input_username" class="login" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_login" placeholder="login" required />
			</td>
		</tr>
		<tr>
			<td>
				<label for="login_input_email">E-email</label>
			</td>
		</tr>
		<tr>
			<td>
				<input id="login_input_email" class="email" class="login_input"  type="email" pattern="(.*){3,64}" name="user_email" placeholder="e-mail" required />
			</td>
		</tr>
		<tr>
			<td>
				<label for="login_input_password_new">Senha</label>
			</td>
		</tr>
		<tr>
			<td>
				<input id="login_input_password_new"  class="password" type="password" name="user_password_new" required autocomplete="off" placeholder="senha"/>
			</td>
		</tr>
		<tr>
			<td>
		    	<label for="login_input_password_repeat">Confirme a senha</label>
			</td>
		</tr>
		<tr>
			<td>
				 <input id="login_input_password_repeat" class="password" class="login_input" type="password" name="user_password_repeat" required autocomplete="off" placeholder="confirme a senha"/>
			</td>
		</tr>
		<tr>
			<td>
				&nbsp;
			</td>
		</tr>
		<tr>
			<td>
				<input type="submit"  name="signup" class="btn" value="Cadastrar" />
			</td>
		</tr>
	</table>
</form>

<!-- backlink -->
<a href="index.php" style="text-decoration:none"><img src="image/back-button.png" style='width:14px;height:16px;' alt="Voltar ao login">&nbsp;Voltar ao login...</a>
</html>
</body>