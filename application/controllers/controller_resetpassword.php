<?php

class Controller_resetpassword extends Controller {

    public function __construct()
    {
        $this->model = new Model_ResetPassword();
        $this->view = new View();
    }

    function action_index()
    {
        $data = [];
        if (!empty($_POST['email'])) {
            $email = $_POST['email'];

            $user = $this->model->checkUserEmail($email);

            if (count($user) > 0) {
                $isValid = $user[0][0];
                $personName = $user[0][1];
                $userId = $user[0][2];
                $reset_hash = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);

                $this->model->resetUserPassword($userId, $reset_hash);

                $mail = new Email();
                $mail->setSubject('Password recovery')
                    ->setTextMessage("На сайті Біла ромашка : Безнал, запросили зміну пароля для облікового запису '$personName'. Для зміни пароля перейдіть за посиланням 'https://beznal.bilaromashka.com.ua/resetpassword/new/?GUID=$reset_hash'>. Посилання будет доступна на протязі 2х годин.")
                    ->setHtmlMessage("На сайті Біла ромашка : Безнал, запросили зміну пароля для облікового запису '$personName'. Для зміни пароля перейдіть за посиланням <a href='https://beznal.bilaromashka.com.ua/resetpassword/new/?GUID=$reset_hash'>Відновлення пароля</a>. Посилання будет доступна на протязі 2х годин.")
                    ->addTo ($email);

                $mail->send();

                $data = array('isValid' => $isValid, 'personName' => $personName, 'email' => $email);
            } else {
                $data = array('isValid' => 0, 'email' => $email);
            }
        }
       $this->view->generate('resetpassword_view.php', 'template_view.php', $data);
    }

    function action_new($get)
    {
        $data = $get['GUID'];
        $this->view->generate('newpassword_view.php', 'template_view.php', $data);
    }
}