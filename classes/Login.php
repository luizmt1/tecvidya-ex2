<?php
//class Login
class Login {
    private     $db_connection              = null;
    private     $user_login                  = "";
    private     $user_email                 = "";
    private     $user_password_hash         = "";
    private     $user_is_logged_in          = false;
    public      $errors                     = array();
    public      $messages                   = array();
    public function __construct() {
        session_start();                                        
        if (isset($_GET["logout"])) {
            $this->doLogout();
        } 
        elseif (!empty($_SESSION['user_login']) && ($_SESSION['user_logged_in'] == 1)) {
            $this->loginWithSessionData();                
        } elseif (isset($_POST["login"])) {
                $this->loginWithPostData();
        }
    }
    private function loginWithSessionData() {
        $this->user_is_logged_in = true;
    }
    private function loginWithPostData() {
        if (!empty($_POST['user_login']) && !empty($_POST['user_password'])) {
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if (!$this->db_connection->connect_errno) {
                $this->user_login = $this->db_connection->real_escape_string($_POST['user_login']);            
                $checklogin = $this->db_connection->query("SELECT user_login, user_email, user_password_hash FROM users WHERE user_login = '".$this->user_login."';");
                if ($checklogin->num_rows == 1) {
                    $result_row = $checklogin->fetch_object();
                    if (crypt($_POST['user_password'], $result_row->user_password_hash) == $result_row->user_password_hash) {
                        $_SESSION['user_login'] = $result_row->user_login;
                        $_SESSION['user_email'] = $result_row->user_email;
                        $_SESSION['user_logged_in'] = 1;
                        $this->user_is_logged_in = true; 
                    } else {
                        $this->errors[] = "Usuário ou senha senha errada. Tente novamente.";
                    }                
                } else {
                    $this->errors[] = "O usuário não existe.";
                }
            } else {
                
                $this->errors[] = "Erro de conexão com o banco de dados.";
            }
        } elseif (empty($_POST['user_login'])) {

            $this->errors[] = "O nome do usuário está vazio.";
        } elseif (empty($_POST['user_password'])) {

            $this->errors[] = "O campo Senha está vazio.";
        }
    }
    public function doLogout() 
    {
            $_SESSION = array();
            session_destroy();
            $this->user_is_logged_in = false;
            $this->messages[] = "Você foi deslogado.";
    }
    public function isUserLoggedIn() {
        return $this->user_is_logged_in;
    }
}