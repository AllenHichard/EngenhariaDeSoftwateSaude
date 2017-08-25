<?php
/**
 * Created by PhpStorm.
 * User: Wanderson
 * Date: 3/10/16
 * Time: 9:35 PM
 */

namespace usuario;
/**
 * Created by PhpStorm.
 * User: Allen, Ana Jaíze, André, Antônio, Daniel, Wanderson
 * Date: 3/6/16
 * Time: 11:42 PM
 */

class Denuncia
{
    private $idCampanha;
    private $motivo;
    private $respostaDoAdministrador;

    /**
     * Denuncia constructor.
     * @param $idaCampanha
     * @param $motivo
     */
    public function __construct($idaCampanha, $motivo)
    {
        $this->idCampanha = $idaCampanha;
        $this->motivo = $motivo;
    }

    /**
     * Método que deve ser utilizado por um ADM para responder sobre uma denúncia.
     * @param $respostaAdm
     */
    public function responderDenuncia($respostaAdm)
    {
        $this->respostaDoAdministrador = $respostaAdm;
    }

    /**
     * @return respostaDoAdministrador
     */
    public function getRespostaDoAdministrador()
    {
        return $this->respostaDoAdministrador;
    }
}