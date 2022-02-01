<?php

class Controller_Info extends Controller {

    public function __construct()
    {
        $this->view = new View();
    }

    function action_index()
    {
        $data = array('error' => '404 Сторінка не знайдена');
        $this->view->generate('info_view.php', 'template_view.php', $data);
    }
}