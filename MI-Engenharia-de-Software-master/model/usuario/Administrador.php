<?php
/**
 * Created by PhpStorm.
 * User: Wanderson
 * Date: 3/10/16
 * Time: 11:13 PM
 */
/**
 * Created by PhpStorm.
 * User: Allen, Ana Jaíze, André, Antônio, Daniel, Wanderson
 * Date: 3/6/16
 * Time: 11:42 PM
 */
namespace usuario;


class Administrador extends Usuario
{
    public function __construct(Nome $nome, Cpf $cpf, $email, $endereco, $telefone)
    {
        parent::__construct($nome, $cpf, $email, $endereco, $telefone);
    }

    public function relatorioDoacoesAnonimas()
    {

    }

    public function punirUsuario($cpfUsuario, $periodo)
    {

    }


}