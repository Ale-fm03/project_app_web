<?php
    require_once "models/Usuario.php";
    class Login{
        function main(){
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                require_once "views/login.view.php";
            }
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                               
                $user = new Usuario($_POST['email'], $_POST['pass']);

                $user = $user->login();

                if ($user) {
                    echo "Usuario Encontrado";
                } else {
                    echo "Usuario NO Encontrado";
                }
                
                
            }
        }
    }
    ?>