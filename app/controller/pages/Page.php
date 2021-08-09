<?php

namespace App\Controller\Pages;

use \App\Utils\View;

class Page {
    /**
     * Método responsável por retornar a view das páginas
     * @return String
     */
    public static function getPage($title, $content){
        return View::render('pages/page', [
           "title"   =>  $title,
           "header"  =>  self::getHeader(), 
           "content" => $content,
           "footer"  =>  self::getFooter()
        ]);
    }

    /**
     * Retorna o Header da Página
     *
     * @return string
     */
    private static function getHeader(){
        return View::render('pages/header');
    }
    
    /**
     * Retorna o Footer da Página
     *
     * @return string
     */
    private static function getFooter(){
        return View::render('pages/footer');
    }

}//fim da classe Home
