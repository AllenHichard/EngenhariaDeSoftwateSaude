<?php
/**
 * Created by PhpStorm.
 * User: dcandrade
 * Date: 3/13/16
 * Time: 8:32 PM
 */

namespace categoria;
/**
 * Created by PhpStorm.
 * User: Allen, Ana Jaíze, André, Antônio, Daniel, Wanderson
 * Date: 3/6/16
 * Time: 11:42 PM
 */

class Categoria
{
    private $id;
    private $nome;
    private $imagem;

    /**
     * Categoria constructor.
     * @param $imagem
     */
    public function __construct($nome, $imagem, $id = null)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->imagem = $imagem;
    }

    /**
     * @return mixed
     */
    public function getImagem()
    {
        return $this->imagem;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }


}