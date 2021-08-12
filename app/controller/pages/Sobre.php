<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Organization;

class Sobre extends Page {

    /**
     * Método responsável por retornar a view Sobre
     * @return String
     */
    public static function getSobre(){
      $objOrganization = new Organization();

      $content =  View::render('pages/sobre', [
                                                'name'        => $objOrganization->name,
                                                'description' => $objOrganization->description,
                                                'site'        => $objOrganization->site
                                            ]);
      //retorna a view da página
      return parent::getPage('Sobre - Framework - MVC', $content);
    }

}//fim da classe Home
