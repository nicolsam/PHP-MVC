<?php

namespace App\Controller\Pages;

use \App\Utils\View;

class Page {

    /**
     * Método responsável por renderizar o Header da página
     *
     * @return string
     */
    private static function getHeader() {
        return View::render('pages/header');
    }

    /**
     * Método responsável por renderizar o Footer da página
     *
     * @return string
     */
    private static function getFooter() {
        return View::render('pages/footer');
    }

    /**
     * Método responsável por retornar o conteúdo (view) de uma página genérica
     * @return string
     */
    public static function getPage($title, $content) {
        return View::render('pages/page', [
            'title' => $title,
            'header' => self::getHeader(),
            'content' => $content,
            'footer' => self::getFooter()
        ]);
    }

    /**
     * Método responsável por renderizar o Layout de paginação
     *
     * @param Request $request
     * @param Pagination $obPagination
     *
     * @return string

     */
    public static function getPagination($request, $obPagination) {
        // Páginas
        $pages = $obPagination->getPages();

        // Verifica a quantidade de páginas
        if(count($pages) <= 1) return '';

        // link
        $links = '';

        // URL atual sem GETs
        $url = $request->getRouter()->getCurrrentUrl();

        // GET
        $queryParams = $request->getQueryParams();

        // Renderiza os links
        foreach($pages as $page) {
            // Altera a página
            $queryParams['page'] = $page['pagina'];

            // Link
            $link = $url.'?'.http_build_query($queryParams);

            $links .= View::render('pages/pagination/link', [
                'page' => $page['pagina'],
                'link' => $link,
            ]);
        }

        // Renderiza Box de paginação

        return View::render('pages/pagination/box', [
            'links' => $links,
        ]);
    }
}