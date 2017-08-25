<?php
/**
 * Created by PhpStorm.
 * User: dcandrade
 * Date: 3/18/16
 * Time: 11:56 PM
 */

/**
 * Created by PhpStorm.
 * User: Allen, Ana Jaíze, André, Antônio, Daniel, Wanderson
 * Date: 3/6/16
 * Time: 11:35 PM
 */

require_once 'DAL.php';


/**
 * Class DoacaoDAL - A classe doação Dal lida com a tabela de doação do sistema.
 */
class DoacaoDAL extends DAL
{
    /*
        public function getDoacoesItens($idCampanha)
        {
            $sqlDoacao = "SELECT * FROM doacao WHERE id_campanha = " . $idCampanha;
            $sqlItensDoacao = "SELECT (Item.id, Item.id_categoria, Item.quantidade) FROM item JOIN item_doacao JOIN doacao WHERE id_campanha = " . $idCampanha;

            $rowDoacao = $this->conexao->query($sqlDoacao)->fetch_array();
            $resultadoItens = $this->conexao->query($sqlItensDoacao);
            $itens = array();

            while ($row = $resultadoItens->fetch_array()) {
                $item = new ItemDoacao($row['id'], $row['id_categoria'], $row['quantidade']);
                array_push($itens, $item);
            }

            return $itens;
        }

        public function getDoacoesFinanceiras($idCampanha)
        {
            if ($this->getCampanha($idCampanha)->getTipo() == Campanha::$CAMPANHA_FINANCEIRA) {
                //TODO: Fazer group by na quere para evitar repetiçõa
                $doacoes = array();
                $sql = "SELECT * FROM doacao
                        JOIN valores_doacao
                        ON (doacao.id=valores_doacao.id_doacao)
                        WHERE doacao.tipo_doacao = " . \Campanha::$CAMPANHA_FINANCEIRA;

                $resultado = $this->conexao->query($sql);
                $doacoes = array();

                while ($row = $resultado->fetch_array()) {
                    $sqlCpf = 'SELECT cpf FROM usuario WHERE id = ' . $row['id_usuario_doador'];
                    $cpf = $this->conexao->query($sqlCpf)->fetch_array()['cpf'];
                    $doacao = new DoacaoValor($cpf, row['data'], row['valor'], row['id_campanha'], $row['confirmada']);
                    array_push($doacoes, $doacao);
                }

                return $doacoes;
            }
        }

        public function getDoacoesTempo($idCampanha)
        {
            if ($this->getCampanha($idCampanha)->getTipo() == \Campanha::$CAMPANHA_TEMPO) {
                $sql = "SELECT * FROM doacao
                        JOIN dias_doacao
                        ON (doacao.id=dias_doacao.id_doacao)
                        WHERE doacao.tipo_doacao = " . \Campanha::$CAMPANHA_TEMPO;

                $resultado = $this->conexao->query($sql);
                $doacoes = array();

                while ($row = $resultado->fetch_array()) {
                    $sqlCpf = 'SELECT cpf FROM usuario WHERE id = ' . $row['id_usuario_doador'];
                    $cpf = $this->conexao->query($sqlCpf)->fetch_array()['cpf'];
                    $doacao = new DoacaoTempo($cpf, $row['data'], $row['inicio'], $row['fim'], $row['id_campanha'], $row['confirmada']);
                    array($doacoes, $doacao);
                }

                return $doacoes;
            }
        }


        //-------------------------------------------------------------------------------------------------------------------------------------//
        //--------------------------------------------------------Inserir Doacões -------------------------------------------------------------//
        //-------------------------------------------------------------------------------------------------------------------------------------//

        public function insertDoacaoTempo($doacao, $dia)
        {
            $sql = "INSERT INTO doacao (id_campanha, id_usuario_doador, tipo_doacao, data) VALUES (" . $doacao->getIdCampanha() . ", " .
                $doacao->getIdUsuarioDoador() . ", " . 3 . ", " . $doacao->getData() . ")";
            if ($this->conexao->query($sql) === TRUE) {
                $last_id = $this->conexao->insert_id;
                "INSERT INTO dias_doacao (id_doacao, dia) VALUES ($last_id , $dia)";

            } else {
                echo "Error: ";
            }

            $this->conexao->close();

            return $this->conexao->query($sql);


        }


        public function insertDoacaoFinanceiro($doacao, $valor)
        {
            $sql = "INSERT INTO doacao (id_campanha, id_usuario_doador, tipo_doacao, data) VALUES (" . $doacao->getIdCampanha() . ", " .
                $doacao->getIdUsuarioDoador() . ", " . 2 . ", " . $doacao->getData() . ")";
            if ($this->conexao->query($sql) === TRUE) {
                $last_id = $this->conexao->insert_id;
                "INSERT INTO valores_doacao (id_doacao, valor) VALUES ($last_id , $valor)";

            } else {
                echo "Error: ";
            }

            $this->conexao->close();

            return $this->conexao->query($sql);
        }


        public function insertDoacaoItem($doacao, $id_item)
        {
            $sql = "INSERT INTO doacao (id_campanha, id_usuario_doador, tipo_doacao, data) VALUES (" . $doacao->getIdCampanha() . ", " .
                $doacao->getIdUsuarioDoador() . ", " . 1 . ", " . $doacao->getData() . ")";

            if ($this->conexao->query($sql) === TRUE) {
                $last_id = $this->conexao->insert_id;
                "INSERT INTO item_doacao (id_doacao, id_item) VALUES ($last_id , $id_item)";

            } else {
                echo "Error: ";
            }

            $this->conexao->close();

            return $this->conexao->query($sql);
        }




        //-------------------------------------------------------------------------------------------------------------------------------------//
        //--------------------------------------------------------deletar Doacões -------------------------------------------------------------//
        //-------------------------------------------------------------------------------------------------------------------------------------//
    */

    /**
     * O getDoacoes retorna todas as doações.
     * @return bool|mysqli_result
     */
    public function getDoacoes()
    {

        $sql = "SELECT idCampanha,idDoador,confirmada,data FROM doacao";

        $resultado = $this->conexao->query($sql);


        return $resultado;
    }


    /**
     * Deleta uma determinada doação.
     * @param $idDoacao
     * @return bool|mysqli_result
     */
    public function deleteDoacao($idDoacao)
    {
        $sql = "DELETE FROM doacao WHERE id = $idDoacao";

        return $this->conexao->query($sql);
    }

    //-------------------------------------------------------------------------------------------------------------------------------------//
    //--------------------------------------------------------Alterar Data da Doacões -------------------------------------------------------------//
    //-------------------------------------------------------------------------------------------------------------------------------------//

    /**
     * Muda a data de uma determinada doação.
     * @param $idDoacao
     * @param $data
     */
    public function updateDoacao($idDoacao, $data)
    {
        $sql = "UPDATE doacao SET data =  '$data' WHERE id = $idDoacao";
    }


}
