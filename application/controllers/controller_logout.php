<?php

class Controller_Logout extends Controller {

    function action_index()
    {
        setcookie('auth', false);
        $host = 'https://' . $_SERVER['HTTP_HOST'];
        header('HTTP/1.1 200');
        header('Location:' . $host . '/login');
    }
}