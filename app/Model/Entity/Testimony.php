<?php

namespace App\Model\Entity;

use \App\Model\Db\Database;

class Testimony {

    /**
     * Id do depoimento
     *
     * @var integer
     */
    public $id;

    /**
     * Nome do usuário que fez o depoimento
     *
     * @var string
     */
    public $nome;

    /**
     * Mensagem do depoimento
     *
     * @var string
     */
    public $mensagem;

    /**
     * Data de publicação do depoimento
     *
     * @var string;
     */
    public $data;

    /**
     * Método responsável por cadastrar a instância atual no banco de dados
     *
     * @return boolean
     */
    public function cadastrar() {
        // Define a DATA
        $this->data = date('Y-m-d H:i:s');

        // Insere depoimento no Banco de Dados
        $this->id = (new Database('depoimentos'))->insert([
            'nome'     => $this->nome,
            'mensagem' => $this->mensagem,
            'data'     => $this->data
        ]);

        return true;
    }
}