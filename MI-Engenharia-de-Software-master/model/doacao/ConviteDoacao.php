<?php
/**
 * Created by PhpStorm.
 * User: dcandrade
 * Date: 3/6/16
 * Time: 11:21 PM
 */

namespace conviteDoacao;
/**
 * Created by PhpStorm.
 * User: Allen, Ana Jaíze, André, Antônio, Daniel, Wanderson
 * Date: 3/6/16
 * Time: 11:42 PM
 */

class ConviteDoacao
{
    private $remetente;
    private $destinatario;
    private $campanha;
    private $texto;

    public function __construct($remetente, $destinatario, $campanha, $texto)
    {
        $this->remetente = $remetente;
        $this->destinatario = $destinatario;
        $this->campanha = $campanha;
        $this->texto = $texto;
    }

    public function getRemetente()
    {
        return $this->remetente;
    }

    public function getDestinatario()
    {
        return $this->destinatario;
    }

    public function getCampanha()
    {
        return $this->campanha;
    }

    public function getTexto()
    {
        return $this->texto;
    }

}