<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Organization;

class About extends Page {

    /**
     * Método responsável por retornar o conteúdo (view) da Home
     *
     * @return string
     */
    public static function getAbout() {
        $obOrganization = new Organization;

        // View da Home
        $content = View::render('pages/about', [
            'name' => $obOrganization->name,
            'description' => $obOrganization->description,
        ]);

        // Retorna a View da página
        return parent::getPage('SOBRE', $content);
    }
}