<?php

class View
{
    //public $template_view; // здесь можно указать общий вид по умолчанию.

    function generate($content_view, $template_view, $data = null, $get = null)
    {
        include 'application/views/'.$template_view;

        if(is_array($get)) {
            // преобразуем элементы массива в переменные
            extract($get);
        }
    }
}
