<?php
/**
 * Created by PhpStorm.
 * User: dcandrade
 * Date: 3/6/16
 * Time: 10:47 PM
 */

namespace agradecimento;
/**
 * Created by PhpStorm.
 * User: Allen, Ana Jaíze, André, Antônio, Daniel, Wanderson
 * Date: 3/6/16
 * Time: 11:42 PM
 */

class Agradecimento
{
    private $agradecimentoPadrao;
    private $remetente;
    private $destinatario;
    private $campanha;
    private $mensagem;
    private $idDoador;
    private $mensagemPersonalizada;

    /**
     * Agradecimento constructor.
     * @param $remetente
     * @param $destinatario
     * @param $campanha (campanha) Campanha cujo o usuário doou
     * @param null $agradecimentoPadrao (String) Agracimento padrão a ser enviado
     */


    public function __construct($remetente, $destinatario, $mensagem, $idDoacao)
    {
        $this->remetente = $remetente;
        $this->destinatario = $destinatario;
        $this->mensagem = $mensagem;
        $this->idDoador = $idDoacao;
    }

    public function getAgradecimentoPadrao()
    {
        return $this->ag;
    }

    /**
     * Envia um agradecimento personalizado
     * @param $mensagem (String) Mensagem a ser enviada
     */
    public function enviarAgradecimentoPersonalizado($mensagem)
    {
        $this->mensagemPersonalizada = $mensagem;
        $this->enviarAgradecimento();
    }

    /**
     * Envia um agradecimento com a mensagem padrão
     */
    public function enviarAgradecimento()
    {
        $this->remetente->receberAgradecimento($this);
    }
}