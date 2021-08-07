<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Organization;

class Testimony extends Page {

    /**
     * Método responsável por retornar o conteúdo (view) de depoimentos
     *
     * @return string
     */
    public static function getTestimonies() {
        // View de DEPOIMENTOS
        $content = View::render('pages/testimonies', []);

        // Retorna a View de DEPOIMENTOS
        return parent::getPage('DEPOIMENTOS', $content);
    }
}