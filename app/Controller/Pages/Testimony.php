<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Testimony as EntityTestimony;

class Testimony extends Page {

    /**
     * Método responsável por obter a renderização dos itens de depoimentos para a página
     *
     * @return [type]
     *   [return description]
     */
    private static function getTestimonyItens() {
        // Depoimentos
        $itens = '';

        // Resultados da página
        $results = EntityTestimony::getTestimonies(null, 'id DESC');

        // Renderiza o item
        while($obTestimony = $results->fetchObject(EntityTestimony::class)) {
            $itens .= View::render('pages/testimony/item', [
                'nome' => $obTestimony->nome,
                'mensagem' => $obTestimony->mensagem,
                'data' => date('d/m/Y H:i:s', strtotime($obTestimony->data))
            ]);
        }

        // Retorna os depoimentos
        return $itens;
    }
    /**
     * Método responsável por retornar o conteúdo (view) de depoimentos
     *
     * @return string
     */
    public static function getTestimonies() {
        // View de DEPOIMENTOS
        $content = View::render('pages/testimonies', [
            'itens' => self::getTestimonyItens()
        ]);

        // Retorna a View de DEPOIMENTOS
        return parent::getPage('DEPOIMENTOS', $content);
    }

    /**
     * Método responsável por cadastrar um depoimento
     *
     * @param Request $request
     *
     * @return string
     */
    public static function insertTestimony($request) {
        // Dados do POST
        $postVars = $request->getPostVars();

        // Nova instância de depoimento
        $obTestimony = new EntityTestimony;
        $obTestimony->nome = $postVars['nome'];
        $obTestimony->mensagem = $postVars['mensagem'];
        
        $obTestimony->cadastrar();
        
        return self::getTestimonies();
    }
}