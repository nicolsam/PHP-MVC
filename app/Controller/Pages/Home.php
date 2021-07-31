<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Organization;

class Home extends Page {

    /**
     * Método responsável por retornar o conteúdo (view) da Home
     *
     * @return string
     */
    public static function getHome() {
        $obOrganization = new Organization;

        // View da Home
        $content = View::render('pages/home', [
            'name' => $obOrganization->name,
            'description' => $obOrganization->description,
        ]);

        // Retorna a View da página
        return parent::getPage('Portal dos descontos', $content);
    }
}