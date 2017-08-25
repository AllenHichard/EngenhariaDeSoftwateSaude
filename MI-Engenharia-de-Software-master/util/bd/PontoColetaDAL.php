<?php
/**
 * Created by PhpStorm.
 * User: dcandrade
 * Date: 3/18/16
 * Time: 11:57 PM
 */

/**
 * Created by PhpStorm.
 * User: Allen, Ana Jaíze, André, Antônio, Daniel, Wanderson
 * Date: 3/6/16
 * Time: 11:35 PM
 */

/**
 * Class PontoColetaDAL A classe ponto de coleta é utilizada para manipular informações voltadas ao local da campanha,
 * ponto esse onde o usuário poderá levar o itém a ser doado.
 */
class PontoColetaDAL extends DAL
{
    /**
     * Retorna os pontos de coletas no qual o usuário se dispois a arrecadar os item doados.
     * @param $idUsuario
     * @return null|PontoColeta
     */
    public function getPontoColetaUsuario($idUsuario)
    {
        $sql = "SELECT ponto_coleta.id, ponto_coleta.id_campanha, ponto_coleta.id_endereco,ponto_coleta.telefone, ponto_coleta.nome
                FROM usuario JOIN ponto_coleta ON usuario.id_ponto_coleta = ponto_coleta.id
                WHERE usuario.id=$idUsuario";

        $resultado = $this->conexao->query($sql);
        $row = $resultado->fetch_array();
        if ($resultado->num_rows == 0) {
            return null;
        }

        return new PontoColeta($row['nome'], $row['id_endereco'], $row['telefone'], $row['id_campanha'], $row['id']);
    }

    public function addPontoColeta(PontoColeta $ponto, $endereco)
    {
        $endereco = "'" . $endereco . "'";
        $telefone = "'" . $ponto->getTelefone() . "'";
        $nome = "'" . $ponto->getNome() . "'";

        $sql = "INSERT INTO ponto_coleta (id_endereco, telefone,nome)
                  VALUES ($endereco, $telefone, $nome)";

        $this->conexao->query($sql);

        return $this->conexao->insert_id;
    }

    /**
     * Retorna todos os pontos de coletas de uma determinada campanha
     * @param $idCampanha
     * @return array
     */
    public function getPontosCampanha($idCampanha)
    {
        $sql = "SELECT ponto_coleta.nome AS nome_ponto, usuario.nome AS nome_usuario, ponto_coleta.id_endereco
        FROM usuario JOIN ponto_coleta
        ON usuario.id_ponto_coleta = ponto_coleta.id
        WHERE ponto_coleta.id_campanha = $idCampanha";

        $resultado = $this->conexao->query($sql);

        $pontos = array();
        while ($row = $resultado->fetch_array()) {
            $ponto['nome'] = $row['nome_ponto'];
            $ponto['responsavel'] = $row['nome_usuario'];
            $ponto['endereco'] = $row['id_endereco'];

            array_push($pontos, $ponto);
        }

        return $pontos;
    }

    /**
     * Retorna todos os pontos vinculados a uma campanha
     * @param $idCampanha
     * @return array
     */
    public function getPontos($idCampanha)
    {
        $sql = "SELECT DISTINCT id FROM ponto_coleta WHERE id_campanha=$idCampanha";

        $resultado = $this->conexao->query($sql);

        $pontos = array();
        while ($row = $resultado->fetch_array()) {
            $ponto = $this->getPontoColeta($row['id']);
            array_push($pontos, $ponto);
        }

        return $pontos;
    }

    /**
     * Retorna o ponto de coleta vinculado ao seu id
     * @param $idPontoColeta
     * @return PontoColeta
     */
    public function getPontoColeta($idPontoColeta)
    {
        $sql = "SELECT * FROM ponto_coleta WHERE id = " . $idPontoColeta;
        $resultado = $this->conexao->query($sql);

        $row = $resultado->fetch_array();
        return new PontoColeta($row['id'], $row['id_campanha'], $row['id_endereco'], $row['telefone']);
    }

    /**
     * Muda a campanha vinculada a um ponto de coleta
     * @param $idPonto
     * @param $idCampanha
     * @return bool|mysqli_result
     */
    public function setCampanha($idPonto, $idCampanha)
    {
        $sql = "UPDATE ponto_coleta SET id_campanha=$idCampanha WHERE id=$idPonto";

        return $this->conexao->query($sql);
    }

    public function getDoacoesCpf($cpf)
    {
        $sql = "SELECT * FROM doacao JOIN usuario ON doacao.id_usuario_doador = usuario.id
                WHERE cpf = $cpf AND confirmada=FALSE";

        $resultado = $this->conexao->query($sql);

        $pontos = array();
        while ($row = $resultado->fetch_array()) {
            $ponto = new Doacao($row['id_campanha'], $row['id_usuario_doador'], $row['quantidade'], $row['descricao'], $row['data'], $row['confirmada'], $row['doacao.id']);
            array_push($pontos, $ponto);
        }

        return $pontos;
    }

    public function confirmarDoacao($idDoacao)
    {
        $sql = "UPDATE doacao SET confirmada = TRUE WHERE id=$idDoacao";
        return $this->conexao->query($sql);
    }

    public function updatePontoColeta($idPontoColeta, $idEndereco)
    {
        //$sql = "UPDATE  SET id_endereco = " . $idEndereco . "WHERE id =" . $idPontoColeta;
    }

    public function updatePontoColetaCampanha($idPontoColeta, $idCampanha)
    {
        //$sql = "UPDATE  SET id_campanha = " . $idCampanha . "WHERE id =" . $idPontoColeta;
    }

    public function updatePontoColetaTelefone($idPontoColeta, $telefone)
    {
        //$sql = "UPDATE  SET telefone = " . $telefone . "WHERE id =" . $idPontoColeta;
    }

    public function deletePontoColeta($pontoColeta)
    {
        //$sql = "DElETE * FROM ponto_coleta WHERE id = " . $pontoColeta;
    }




}

