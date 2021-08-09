<?php

namespace App\Utils;

class View {

    /**
     * Método responsável por retornar o conteúdo de uma view
     *
     * @param string $view
     * @return string
     */
    private static function getContentView($view){
        $file = __DIR__.'/../../resources/view/'.$view.'.html';
        return file_exists($file) ? file_get_contents($file) : '';
    }

    /**
     * Método responsável pela renderização da view
     * @param string $view
     * @param array $args
     * @return string
     */
    public static function render($view, $args = []){
        //variável com o conteúdo da view
        $content = self::getContentView($view);

        $keys = array_keys($args);

        return $content;
    }

}