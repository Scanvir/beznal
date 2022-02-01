<?php

class Controller_Resetpassword extends Controller {

    public function __construct()
    {
        $this->model = new Model_ResetPassword();
        $this->view = new View();
    }

    function action_index()
    {
        $data = array();
        if (!empty($_POST['email'])) {
            $email = $_POST['email'];

            $user = $this->model->checkUserEmail($email);

            if (count($user) > 0) {
                $personName = $user[0][0];
                $userId = $user[0][1];
                $reset_hash = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);

                $this->model->resetUserPassword($userId, $reset_hash);

                $mail = new Email();
                $mail->setSubject('Password recovery')
                    ->setTextMessage("На сайті Біла ромашка : Безнал, запросили зміну пароля для облікового запису '$personName'. Для зміни пароля перейдіть за посиланням 'https://beznal.bilaromashka.com.ua/resetpassword/reset/?GUID=$reset_hash'>. Посилання будет доступна на протязі 2х годин.")
                    ->setHtmlMessage("На сайті Біла ромашка : Безнал, запросили зміну пароля для облікового запису '$personName'.<br>Для зміни пароля перейдіть за посиланням <a href='https://beznal.bilaromashka.com.ua/resetpassword/reset/?GUID=$reset_hash'>Відновлення пароля</a>.<br>Посилання будет доступна на протязі 2х годин.")
                    ->addTo($email);

                $mail->send();

                $data = array('info' => "$personName, на вашу адресу $email надіслано листа з інструкцією");
                $this->view->generate('info_view.php', 'template_view.php', $data);
                return;
            } else if(!$this->model->checkEmail($email)) {
                $data = array('error' => 'Це взагалі не адреса електронної пошти');
            } else {
                $data = array('error' => 'Невідома адреса єлектронної пошти');
            }
        }
       $this->view->generate('resetpassword_view.php', 'template_view.php', $data);
    }

    function action_reset($get) {
        if (isset($get['GUID'])) {
            $reset_hash = $get['GUID'];
            $user = $this->model->checkResetHash($reset_hash);

            if (count($user) > 0) {
                $data = array('id' => $user[0]['id'], 'reset_hash' => $reset_hash);
                $this->view->generate('newpassword_view.php', 'template_view.php', $data);
            }
            else {
                $data = array('error' => 'Термін дії посилання закінчився');
                $this->view->generate('info_view.php', 'template_view.php', $data);
            }
            return;
        }
        $data = array('error' => 'Виникла помилка, будь ласка спробуйте ще раз.');
        $this->view->generate('info_view.php', 'template_view.php', $data);
    }

    function  action_new()
    {
        if (!empty($_POST['confirmpassword']) && !empty($_POST['newpassword']) && !empty($_POST['reset_hash']) && !empty($_POST['id'])) {
            $newpassword = $_POST['newpassword'];
            $confirmpassword = $_POST['confirmpassword'];
            $reset_hash = $_POST['reset_hash'];
            $userId = $_POST['id'];

            if ($newpassword != $confirmpassword) {
                $data = array('error' => 'Паролі не співпадають', 'reset_hash' => $reset_hash, 'id' => $userId);
                $this->view->generate('newpassword_view.php', 'template_view.php', $data, array('GUID' => $reset_hash));
            } else if (!$this->model->checkPassword($newpassword)) {
                $data = array('error' => 'Пароль надто короткий', 'reset_hash' => $reset_hash, 'id' => $userId);
                $this->view->generate('newpassword_view.php', 'template_view.php', $data, array('GUID' => $reset_hash));
            } else {
                $this->model->updateUserPassword($userId, $this->model->generateHash($newpassword));
                $data = array('info' => 'Пароль змінено');
                $this->view->generate('info_view.php', 'template_view.php', $data);
            }
            return;
        }
        $data = array('error' => 'Виникла помилка, будь ласка спробуйте ще раз.');
        $this->view->generate('info_view.php', 'template_view.php', $data);
    }
}