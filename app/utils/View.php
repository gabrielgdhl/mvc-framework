<?php

namespace App\Utils;

class View {

    /**
     * Variáveis padrões
     *
     * @var array
     */
    private static $vars = [];

    /**
     * Método que inicializa as variáveis da classe
     *
     * @param array $vars
     */
    public static function init($vars = []){
        self::$vars = $vars;
    }

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

        //Une as variáveis da view 
        $args = array_merge(self::$vars, $args);

        //Variável com o array de chaves vinda do controler
        $keys = array_keys($args);

        //transforma chaves do array em variáveis da view {{nome_variável}}
        $keys = array_map(function($item){
            return "{{".$item."}}";
        }, $keys);

        //Retorna a página renderizada, substituindo as varivéis por seu conteúdo
        return str_replace($keys, array_values($args), $content);
    }

}