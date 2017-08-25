
<?php

/**
 * Created by PhpStorm.
 * User: dcandrade
 * Date: 4/5/16
 * Time: 2:47 AM
 */

/**
 * Created by PhpStorm.
 * User: Allen, Ana Jaíze, André, Antônio, Daniel, Wanderson
 * Date: 3/6/16
 * Time: 11:42 PM
 */

require_once '../util/bd/CategoriaDAL.php';
require_once '../model/others/Categoria.php';

/**
 * Class ControllerCategoria - utilizada para interagir entre a view e o banco de dados, garantindo o fluxo de informações.
 */
class ControllerCategoria
{

    private $dal;

    /**
     * retorna os nomes de todas as categoras
     * @return array
     */
    public function getNomesCategorias(){
        $this->dal = new CategoriaDAL();
        $categorias = $this->dal->getNomesCategorias();
        $this->dal->fechar();
        return $categorias;
    }

}