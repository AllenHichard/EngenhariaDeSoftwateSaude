<?php
/**
 * Created by PhpStorm.
 * User: dcandrade
 * Date: 3/16/16
 * Time: 12:34 AM
 */

/**
 * Created by PhpStorm.
 * User: Allen, Ana Jaíze, André, Antônio, Daniel, Wanderson
 * Date: 3/6/16
 * Time: 11:35 PM
 */

require_once 'CampanhaDAL.php';

/**
 * Class CategoriaDAL - responsável apenas pode manipular as categorias no banco
 */
class CategoriaDAL extends DAL
{
    /**
     * Recupera uma categoria com base no seu nome
     * @param $nomeCategoria
     * @return array
     */
    public function getIDCategoria($nomeCategoria)
    {
        $nomeCategoria = "'".$nomeCategoria."'";
        $sql = "SELECT id FROM categoria WHERE nome = $nomeCategoria";

        $resultado = $this->conexao->query($sql)->fetch_array();

        return $resultado['id'];
    }

    /**
     * Recupera uma categoria com base no seu ID
     * @param $idCategoria
     * @return Categoria
     */
    public function getCategoria($idCategoria)
    {
        $sql = "SELECT * FROM categoria WHERE id = " . $idCategoria;

        $resultado = $this->conexao->query($sql);
        $row = $resultado->fetch_array();

        $categoria = new Categoria($row['nome'], $row['imagem_categoria'], $row['id']);

        return $categoria;
    }

    /**
     * Retorna o nome de todas as categorias.
     * @return array
     */
    public function getNomesCategorias(){

        $this->dal = new CampanhaDAL();
        $categorias = $this->dal->getNomesCategorias();
        $this->dal->fechar();
        return $categorias;

    }


}