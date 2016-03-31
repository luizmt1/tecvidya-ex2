<?php
//class signup
class signup {
	private $db_connection = null;
	private $user_login = "";
	private $user_email = "";
	private $user_password = ""; // password without hash
	private $user_password_hash = ""; // hashed password 
	public $signup_successful = false;
	public $errors = array (); // failure messages
	public $messages = array (); // success messages
	
	//constructor in php
	public function __construct() {
		if (isset ( $_POST ["signup"] )) {
			
			$this->registerNewUser ();
		}
	}
	private function registerNewUser() {
		if (empty ( $_POST ['user_login'] )) {
			$this->errors [] = "Empty Username";
		} elseif (empty ( $_POST ['user_password_new'] ) || empty ( $_POST ['user_password_repeat'] )) {
			$this->errors [] = "Empty Password";
		} elseif ($_POST ['user_password_new'] !== $_POST ['user_password_repeat']) {
			$this->errors [] = "A confirmação de senha não confere.";
		} elseif (strlen ( $_POST ['user_login'] ) > 64) {
			$this->errors [] = "O nome de usuário não pode ultrapassar 64 caracteres.";
		} elseif (! preg_match ( '/^[a-z\d]{2,64}$/i', $_POST ['user_login'] )) {
			$this->errors [] = "Esse nome de usuário não obedece o padrão de letras maiúsculas e/ou minúsculas e números no total de 2 a 64 caracteres";
		} elseif (empty ( $_POST ['user_email'] )) {
			$this->errors [] = "Email cannot be empty";
		} elseif (strlen ( $_POST ['user_email'] ) > 64) {
			$this->errors [] = "Email cannot be longer than 64 characters";
		} elseif (! filter_var ( $_POST ['user_email'], FILTER_VALIDATE_EMAIL )) {
			$this->errors [] = "Your email adress is not in a valid email format";
		} elseif (! empty ( $_POST ['user_login'] ) && strlen ( $_POST ['user_login'] ) <= 64 && preg_match ( '/^[a-z\d]{2,64}$/i', $_POST ['user_login'] ) && ! empty ( $_POST ['user_email'] ) && strlen ( $_POST ['user_email'] ) <= 64 && filter_var ( $_POST ['user_email'], FILTER_VALIDATE_EMAIL ) && ! empty ( $_POST ['user_password_new'] ) && ! empty ( $_POST ['user_password_repeat'] ) && ($_POST ['user_password_new'] === $_POST ['user_password_repeat'])) {
			$this->db_connection = new mysqli ( DB_HOST, DB_USER, DB_PASS, DB_NAME );
			
			// in case of connection erro
			if (! $this->db_connection->connect_errno) {
				$this->user_login = $this->db_connection->real_escape_string ( $_POST ['user_login'] );
				$this->user_password = $this->db_connection->real_escape_string ( $_POST ['user_password_new'] );
				$this->user_email = $this->db_connection->real_escape_string ( $_POST ['user_email'] );
				$this->user_password = substr ( $this->user_password, 0, 1024 );
				//salting...
				//http://php.net/manual/en/function.crypt.php
				function get_salt($length) {
					$options = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789./';
					$salt = '';
					for($i = 0; $i <= $length; $i ++) {
						$options = str_shuffle ( $options );
						$salt .= $options [rand ( 0, 63 )];
					}
					return $salt;
				}
			
				// max salt length here...
				$max_salt = CRYPT_SALT_LENGTH;
				
				//hashing with SHA-512 algorithm (Finalmente!!!) 
				//http://www.w3schools.com/php/func_string_crypt.asp
				$hashing_algorithm = '$6$rounds=5000$';
				$salt = get_salt ( $max_salt );
				
				// salt + password + and crypt  = 118 chars
				$this->user_password_hash = crypt ( $this->user_password, $hashing_algorithm . $salt );
				
				// does uer exist?
				$query_check_user_login = $this->db_connection->query ( "SELECT * FROM users WHERE user_login = '" . $this->user_login . "';" );
				
				if ($query_check_user_login->num_rows == 1) {
					$this->errors [] = "Esse usuário já foi cadastrado anteriormente.";
				} else {
					
					// save in database
					$query_new_user_insert = $this->db_connection->query ( "INSERT INTO users (user_login, user_password_hash, user_email) VALUES('" . $this->user_login . "', '" . $this->user_password_hash . "', '" . $this->user_email . "');" );
					
					if ($query_new_user_insert) {
						$this->messages [] = "Você foi cadastrado com sucesso.";
						$this->signup_successful = true;
					} else {
						
						$this->errors [] = "Falha no cadastro! Tente novamente.";
					}
				}
			} else {
				
				$this->errors [] = "Sem conexão com o banco de dados.";
			}
		} else {
			
			$this->errors [] = "Erro desconhecido.";
		}
	}
}