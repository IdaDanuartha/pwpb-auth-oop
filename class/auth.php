<?php
include("../config/connection.php");

class Auth extends Connection
{
    public $message = "";
    public $msgUsername = "";
    public $msgEmail = "";
    public $msgPass = "";
    public $msgConfirm = "";

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        session_start();

        if (!isset($_SESSION["login"])) {
            header("Location: http://localhost:8080/pwpb-login/view/login.php");
            exit;
        }
    }

    public function register($post)
    {
        if (isset($post['submit'])) {
            $username = mysqli_real_escape_string($this->conn, $post['username']);
            $email = mysqli_real_escape_string($this->conn, $post['email']);
            $password = mysqli_real_escape_string($this->conn, $post['password']);
            $confirmPass = mysqli_real_escape_string($this->conn, $post['confirmPass']);

            if (!$username || !$email || !$password || !$confirmPass) {
                if (!$username) {
                    $this->msgUsername = "Username is required";
                }
                if (!$email) {
                    $this->msgEmail = "Email is required";
                }
                if (!$password) {
                    $this->msgPass = "Password is required";
                }
                if (!$confirmPass) {
                    $this->msgConfirm = "Confirm Password is required";
                }
            } else {
                if (mysqli_num_rows(mysqli_query($this->conn, "SELECT * FROM users WHERE email='$email'")) > 0) {
                    $this->msgEmail = 'Email already exist';
                } else {

                    if ($password === $confirmPass) {
                        $hash = password_hash($password, PASSWORD_DEFAULT);

                        $insert = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hash')";
                        $result = mysqli_query($this->conn, $insert);

                        if (!preg_match('/^\w{5,}$/', $username)) {
                            $this->msgUsername = 'Username Invalid';
                        } else {
                            if ($result) {
                                $post['username'] = '';
                                $post['email'] = '';

                                $this->message = '<div class="alert alert-success">
                                    Registered Succesfully! Please <a href="http://localhost:8080/pwpb-login/view/login.php" style="color: white; border-bottom: 1px solid white; padding-bottom: 1px;">Login</a>
                                </div>';
                                // header("Location: /pwpb-login/auth/login.php");
                            } else {
                                $this->message = '<div class="alert alert-danger">
                                    Registered Failed! Something went wrong
                                </div>';
                            }
                        }
                    } else {
                        $this->msgPass = "Password and confirm password don't match";
                    }
                }
            }
        }
    } // register

    public function login($post)
    {
        session_start();

        if (isset($_SESSION["login"])) {
            header("Location: http://localhost:8080/pwpb-login/view/");
            exit;
        }

        if (isset($post["login"])) {

            $email = $post["email"];
            $password = $post["password"];

            if (!$email || !$password) {

                if (!$email) {
                    $this->msgEmail = "Email is required";
                }
                if (!$password) {
                    $this->msgPass = "Password is required";
                }
            } else {

                $result = mysqli_query($this->conn, "SELECT * FROM users WHERE email = '$email'");

                // cek email
                if (mysqli_num_rows($result) === 1) {

                    // cek password
                    $row = mysqli_fetch_assoc($result);

                    if (password_verify($password, $row["password"])) {
                        // set session
                        $_SESSION["login"] = true;

                        header("Location: http://localhost:8080/pwpb-login/view");
                        exit;
                    }
                } else {
                    $this->message = '<div class="alert alert-danger">
                        Login Failed! Check your email or password again';
                }
            }
        }
    } // login

    public function logout()
    {
        session_start();
        $_SESSION = [];
        session_unset();
        session_destroy();

        header("Location: http://localhost:8080/pwpb-login/view/login.php");
        exit;
    }
}
