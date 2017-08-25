<?php

/**
 * Created by PhpStorm.
 * User: Wanderson
 * Date: 3/7/16
 * Time: 9:56 PM
 */

/**
 * Created by PhpStorm.
 * User: Allen, Ana Jaíze, André, Antônio, Daniel, Wanderson
 * Date: 3/6/16
 * Time: 11:42 PM
 */

class Campanha
{
    public static $CAMPANHA_ITEM = 1;
    public static $CAMPANHA_FINANCEIRA = 2;
    public static $CAMPANHA_TEMPO = 3;
    private static $faixaValoresSistema = array(10, 20, 50, 100, 200);
    private $id;
    private $tipo;
    private $criador;
    private $postoColeta;
    private $categorias;
    private $dataInicio;
    private $dataFIm;
    private $agradecimento;
    private $statusCampanhaAtiva;
    private $titulo;
    private $meta;
    private $imagem;
    private $descricao;
    private $contaPaypal;
    private $ativa;
    private $valores;

    public function __construct($tipo, $idCriador, $id = -1, $ativa = false)
    {
        $this->tipo = $tipo;
        $this->criador = $idCriador;
        $this->id = $id;
        $this->ativa = $ativa;
    }

    /**
     * @return mixed
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @param mixed $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function isAtiva()
    {
        return $this->ativa;
    }

    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * @param mixed $meta
     */
    public function setMeta($meta)
    {
        $this->meta = $meta;
    }

    /**
     * @return mixed
     */
    public function getImagem()
    {
        return $this->imagem;
    }

    /**
     * @param mixed $imagem
     */
    public function setImagem($imagem)
    {
        $this->imagem = $imagem;
    }

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function addCategoria($categoria)
    {
        array_push($this->categorias, $categoria);
    }

    public function addPostoColeta($idPostoColeta)
    {

    }

    /**
     * @return mixed
     */
    public function getId()
    {

        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTipo()
    {
        if ($this->tipo == Campanha::$CAMPANHA_FINANCEIRA) {
            return "Financeira";
        } else if ($this->tipo == Campanha::$CAMPANHA_ITEM) {
            return "Item";
        } else {
            return "Tempo";
        }
    }

    /**
     * @return mixed
     */
    public function getCriador()
    {
        return $this->criador;
    }

    /**
     * @return mixed
     */
    public function getPostosDoacao()
    {
        return $this->postosDoacao;
    }

    /**
     * @return mixed
     */
    public function getCategorias()
    {
        return $this->categorias;
    }

    public function setCategorias($categorias)
    {
        $this->categorias = $categorias;
    }

    /**
     * @return mixed
     */
    public function getDataInicio()
    {
        return $this->dataInicio;
    }

    /**
     * @param mixed $dataInicio
     */
    public function setDataInicio($dataInicio)
    {
        $this->dataInicio = $dataInicio;
    }

    /**
     * @return mixed
     */
    public function getDataFIm()
    {
        return $this->dataFIm;
    }

    /**
     * @param mixed $dataFIm
     */
    public function setDataFIm($dataFIm)
    {
        $this->dataFIm = $dataFIm;
    }

    /**
     * @return mixed
     */
    public function getAgradecimento()
    {
        return $this->agradecimento;
    }

    /**
     * @param mixed $agradecimento
     */
    public function setAgradecimento($agradecimento)
    {
        $this->agradecimento = $agradecimento;
    }

    /**
     * @return mixed
     */
    public function getStatusCampanhaAtiva()
    {
        return $this->statusCampanhaAtiva;
    }

    /**
     * @param mixed $statusCampanhaAtiva
     */
    public function setStatusCampanhaAtiva($statusCampanhaAtiva)
    {
        $this->statusCampanhaAtiva = $statusCampanhaAtiva;
    }

    /**
     * Método que encerra a campanha
     */
    public function encerrarCampanha()
    {
        $this->statusCampanhaAtiva = false;
    }

    /**
     * método que envia um agradecimento para um usuário
     * @param $usuario
     */
    public function enviarAgradecimento($usuario)
    {
        $usuario->receberConvite($this->agradecimento);
    }

    public function enviarAvisoAlteracao()
    {

    }

    public function campanhasSimilares()
    {

    }

    public function addContaPaypal($novaConta)
    {

        $this->contaPaypal = $novaConta;
    }

    public function addFaixaValores($valores)
    {
        $this->valores = $valores;
    }

    public function getValores()
    {
        return $this->valores;
    }

    public function getContaPaypal()
    {
        return $this->contaPaypal;
    }

}