<?php


namespace App\Utils;

class View{
    
    /**
     * Método responsavel por retornar o conteudo e uma view
     *
     * @param  string $view
     * @return string
     */
    public static function getContentView($view)
    {
        $file = __DIR__.'/../../src/view/'.$view.'.html';
        return file_exists($file) ? file_get_contents($file) : '';
    }

    /**
     * Método responsavel por retornar o conteudo renderizado de uma view
     * @param string $view
     * @param array $vars (string/numeric)
     * @return string
     */
    public static function render($view, $vars = [])
    {
        //CONTEUDO DA VIEW
        $contentView = self::getContentView($view);

        //CHAVES DO ARRAY DE VARIAVEIS
        $keys = array_keys($vars);
        $keys = array_map(function ($item){
            return '{{'.$item.'}}';
        },$keys);

   /*      echo "<pre>";
        var_dump($keys);
        exit(); */

        //RETORN O CONTEUDO RENDERIZADO
        return str_replace($keys, array_values($vars), $contentView);
    }
}