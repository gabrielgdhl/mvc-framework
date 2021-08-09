<?php

namespace App\Controller\Pages;

use \App\Utils\View;

class Home {
    /**
     * Método responsável por retornar a view da Home
     * @return String
     */
    public static function getHome(){
        return View::render('pages/home', [
            'name'=> 'Gabriel Roque',
            'description' => 'MVC Framework'
        ]);;
    }

}//fim da classe Home
