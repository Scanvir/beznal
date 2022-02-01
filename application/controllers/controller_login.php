<?php

class Controller_Login extends Controller {

    public function __construct()
    {
        $this->model = new Model_Login();
        $this->view = new View();
    }

    function action_index()
    {
        if (!empty($_POST['email']) && !empty($_POST['password'])){
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->model->checkUserEmail($email);

            if (count($user) > 0) {
                $hash = $user[0][0];
                $userID = $user[0][1];

                $verify = $this->model->verifyHash($password, $hash);
                if ($verify) {
                    setcookie('auth', true);
                    setcookie('userId', $userID);
                    $host = 'https://' . $_SERVER['HTTP_HOST'];
                    header('HTTP/1.1 200');
                    header('Location:' . $host . '/home');
                }
            }
        }
        $this->view->generate('login_view.php', 'template_view.php');
    }
}