<?php

class Controller_home extends Controller {

    public function __construct()
    {
        $this->model = new Model_Home();
        $this->view = new View();
    }

    function action_index()
    {
        if (empty($_COOKIE['auth'])) {
            if ($_COOKIE['auth'] == false) {
                $host = 'https://' . $_SERVER['HTTP_HOST'];
                header('HTTP/1.1 200');
                header('Location:' . $host . '/login');
            }
        }
        $data =  $this->model->getUser($_COOKIE['userId']);

        $this->view->generate('home_view.php', 'template_view.php', $data);
    }
}