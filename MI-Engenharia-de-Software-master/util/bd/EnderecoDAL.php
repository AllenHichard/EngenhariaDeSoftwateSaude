<?php
/**
 * Created by PhpStorm.
 * User: dcandrade
 * Date: 3/15/16
 * Time: 9:45 PM
 */
/**
 * Created by PhpStorm.
 * User: Allen, Ana Jaíze, André, Antônio, Daniel, Wanderson
 * Date: 3/6/16
 * Time: 11:35 PM
 */

/**
 * Class EnderecoDAL - Utilizado para manupular termos voltado aos endereços do sistema
 */
class EnderecoDAL extends DAL
{


    /**
     * Retorna o endereco vinculado ao id.
     * @param $idEndereco
     * @return Endereco
     */
    public function getEndereco($idEndereco)
    {
        $sql = "SELECT * FROM endereco WHERE id = " . $idEndereco;

        $resultado = $this->conexao->query($sql);

        $row = $resultado->fetch_array();

        return new Endereco($row['rua'], $row['bairro'], $row['cidade'], $row['estado'], $row['cep']);
    }

    /**
     * Insere um novo endereço no sistema
     * @param Endereco $endereco
     * @return mixed
     */
    public function insertEndereco(Endereco $endereco)
    {
        $rua = "'" . $endereco->getRua() . "'";
        $bairro = "'" . $endereco->getBairro() . "'";
        $cidade = "'" . $endereco->getCidade() . "'";
        $estado = "'" . $endereco->getEstado() . "'";
        $cep = "'" . $endereco->getCep() . "'";

        $sql = "INSERT INTO endereco (rua, bairro, cidade, estado, cep) VALUES (" . $rua . ", " . $bairro . ", " . $cidade . ", " . $estado . ", " . $cep . ")";

        $this->conexao->query($sql);

        return $this->conexao->insert_id;
    }


    /**
     * Deleta todas as doações vinculado ao id do endereço
     * @param $idEndereco
     */
    public function deleteDoacao($idEndereco)
    {
        $sql = "DElETE * FROM doacao WHERE id = " . $idEndereco;
    }


    /**
     * Muda o endereço para que a doação possa ser efetuada com sucesso.
     * @param $idEndereco
     * @param $rua
     * @param $numero_casa
     * @param $bairro
     * @param $cidade
     * @param $cep
     */
    public function updateDoacao($idEndereco, $rua, $numero_casa, $bairro, $cidade, $cep)
    {
        $sql = "UPDATE doacao SET rua = " . $rua . ", numero_casa =" . $numero_casa . ", bairro =" . $bairro .
            ", cidade =" . $cidade . ", cep =" . $cep . " WHERE id =" . $idEndereco;
    }






}




