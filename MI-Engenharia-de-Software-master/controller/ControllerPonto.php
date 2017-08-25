<?php
/**
 * Created by PhpStorm.
 * User: Allen, Ana Jaíze, André, Antônio, Daniel, Wanderson
 * Date: 3/6/16
 * Time: 11:42 PM
 */
require_once '../model/usuario/PontoColeta.php';
require_once '../util/bd/PontoColetaDAL.php';

/**
 * Class ControllerPonto - utilizada para interagir entre a view e o banco de dados, garantindo o fluxo de informações.
 */
class ControllerPonto
{
    private $dal;

    /**
     * Retorna o ponto de coleta pelo id
     * @param $id
     * @return null|PontoColeta
     */
    public function getPontoColeta($id)
    {
        $this->dal = new PontoColetaDAL();
        $ponto = $this->dal->getPontoColetaUsuario($id);
        $this->dal->fechar();

        return $ponto;
    }

    /**
     * Cadastra um novo ponto de coleta
     * @param $idUsuario
     * @param $nome
     * @param $estado
     * @param $cidade
     * @param $bairro
     * @param $endereco
     * @param $cep
     * @param $telefone
     */
    public function cadastrarPontoColeta($idUsuario, $nome, $estado, $cidade, $bairro, $endereco, $cep, $telefone)
    {
        $endereco = new Endereco($endereco, $bairro, $cidade, $estado, $cep);
        $dal = new EnderecoDAL();
        $idEndereco = $dal->insertEndereco($endereco);
        $dal->fechar();

        $ponto = new PontoColeta($nome, $idEndereco, $telefone);
        $dal = new PontoColetaDAL();
        $idPonto = $dal->addPontoColeta($ponto, $idEndereco);
        $dal->fechar();

        $dal = new UsuarioDAL();
        $dal->addPontoColeta($idUsuario, $idPonto);
        $dal->fechar();
    }

    /**
     * Retorna todos os pontos de uma campanha
     * @param $idCampanha
     * @return array
     */
    public function getPontosCampanha($idCampanha)
    {
        $this->dal = new PontoColetaDAL();
        $pontos = $this->dal->getPontosCampanha($idCampanha);
        $this->dal->fechar();

        return $pontos;
    }

    /**
     * Retorna todos os pontos de um usuário
     * @param $idCampanha
     * @return array
     */
    public function getPontos($idCampanha)
    {
        $this->dal = new PontoColetaDAL();
        $pontos = $this->dal->getPontos($idCampanha);
        $this->dal->fechar();

        return $pontos;
    }

    public function confirmarDoacao($idDoacao)
    {
        $this->dal = new UsuarioDAL();
        $idUsuario = $this->dal->getIdUsuario($idDoacao);
        $ponto = new PontoColetaDAL();
        $ponto->confirmarDoacao($idDoacao);
        $this->dal->fechar();
    }

    public function getDoacoesCpf($cpf)
    {
        $this->dal = new PontoColetaDAL();
        $pontos = $this->dal->getDoacoesCpf($cpf);
        $this->dal->fechar();

        return $pontos;
    }

}