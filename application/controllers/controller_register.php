<?php

class Controller_Register extends Controller {

    public function __construct()
    {
        $this->model = new Model_Register();
        $this->view = new View();
    }

    function action_index()
    {
        $data = '';
        if (!empty($_POST['register'])){
            $error = false;
            if (!$this->model->checkName($_POST['edrpou'])){
                $data = $data . 'Вкажіть ЕДРПОУ компанії<br>';
                $error = true;
            }
            if (!$this->model->checkName($_POST['companyName'])){
                $data = $data . 'Вкажіть назву компанії<br>';
                $error = true;
            }
            if (!$this->model->checkName($_POST['personName'])){
                $data = $data . 'Вкажіть ПІБ уповноваженної особи<br>';
                $error = true;
            }
            if (!$this->model->checkName($_POST['phone'])){
                $data = $data . 'Вкажіть номер телефона<br>';
                $error = true;
            }
            if (!$this->model->checkEmail($_POST['email'])){
                $data = $data . 'Вкажіть електронну адресу<br>';
                $error = true;
            }
            if (!$this->model->checkPassword($_POST['password'])){
                $data = $data . 'Пароль не достатньо складний<br>';
                $error = true;
            }
            if ($_POST['passwordConfirm'] != $_POST['password']){
                $data = $data . 'Паролі не співпадають<br>';
                $error = true;
            }

            $data = array(
                'error' => $data,
                'edrpou' => $_POST['edrpou'],
                'companyName' => $_POST['companyName'],
                'personName' => $_POST['personName'],
                'phone' => $_POST['phone'],
                'email' => $_POST['email'],
            );
            if (!$error){
                $reset_hash = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);

                $this->model->register($_POST['edrpou'], $_POST['companyName'], $_POST['personName'], $_POST['phone'], $_POST['email'], $this->model->generateHash($_POST['password']), $reset_hash);

                $mail = new Email();
                $mail->setSubject('Activation')
                    ->setTextMessage("Ви успішно зареєструвались на сайті Біла ромашка : Безнал. Для активації доступу перейдіть за посиланням 'https://beznal.bilaromashka.com.ua/register/activation/?GUID=$reset_hash'>.")
                    ->setHtmlMessage("Ви успішно зареєструвались на сайті Біла ромашка : Безнал.<br>Для активації доступу перейдіть за посиланням <a href='https://beznal.bilaromashka.com.ua/register/activation/?GUID=$reset_hash'>Активація аккаунту</a>.")
                    ->addTo($_POST['email']);

                $mail->send();

                $data = array('info' => 'Ви зареєстровані. Перевірте електронну пошту, вам надіслано листа з активацією');
                $this->view->generate('info_view.php', 'template_view.php', $data);
                return;
            }
        }
        $this->view->generate('register_view.php', 'template_view.php', $data);
    }
}