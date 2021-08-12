<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Organization;

class Home extends Page {

    /**
     * Método responsável por retornar a view da Home
     * @return String
     */
    public static function getHome(){
      $objOrganization = new Organization();

      $content =  View::render('pages/home', [
                                                'name' => $objOrganization->name
                                            ]);
      //retorna a view da página
      return parent::getPage('Framework - MVC', $content);
    }

}//fim da classe Home
