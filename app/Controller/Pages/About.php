<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Organization;

class About extends Page{
    
    /**
     * getAbout
     *
     * @return string
     */
    public static function getAbout(){
        //ORGANIZAÇÃO
        $obOrganization = new Organization;

        //VIEW DA HOME
        $content = View::render('pages/about',[
            'name' => $obOrganization->name,
            'description' => $obOrganization->description
        ]);

        //RETORNA A VIEW DA PAGINA
        return parent::getPage('SOBRE > ROUTE - SYSTEM', $content);
    }

}