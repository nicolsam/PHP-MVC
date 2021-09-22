<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Testimony as EntityTestimony;
use \App\Model\Db\Pagination;

class Testimony extends Page {

    /**
     * Método responsável por obter a renderização dos itens de depoimentos para a página
     * @param Request $request
     * @param Pagination $obPagination
     * @return string  
     */
    private static function getTestimonyItems($request, &$obPagination) {
        // Depoimentos
        $itens = '';

        // Quantidade total de registros
        $quantidadeTotal = EntityTestimony::getTestimonies(null, null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;

        // Página Atual
        $queryParams = $request->getQueryParams();
        $paginaAtual = $queryParams['page'] ?? 1;

        // Instância de Paginação
        $obPagination = new Pagination($quantidadeTotal, $paginaAtual, 3);

        // Resultados da página
        $results = EntityTestimony::getTestimonies(null, 'id DESC', $obPagination->getLimit());

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
     * @param Request $request
     * 
     * @return string
     */
    public static function getTestimonies($request) {
        // View de DEPOIMENTOS
        $content = View::render('pages/testimonies', [
            'itens' => self::getTestimonyItems($request, $obPagination),
            'pagination' => parent::getPagination($request, $obPagination)
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
        
        // Retorna a página de listagem de depoimentos
        return self::getTestimonies($request);
    }
}