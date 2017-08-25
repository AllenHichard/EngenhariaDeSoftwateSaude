<?php

/**
 * Created by PhpStorm.
 * User: dcandrade
 * Date: 3/6/16
 * Time: 11:34 PM
 */

/**
 * Created by PhpStorm.
 * User: Allen, Ana Jaíze, André, Antônio, Daniel, Wanderson
 * Date: 3/6/16
 * Time: 11:35 PM
 */

require_once 'EnderecoDAL.php';

/**
 * Class UsuarioDAL - Classe responsável por fazer a manipulações de tdos os usuários cadastrados no sistema.
 */
class UsuarioDAL extends DAL
{

    /**
     * Método responsável por realziar o cadastro de um novo usuário no sistema.
     * @param $nome
     * @param $cpf
     * @param $email
     * @param $login
     * @param $senha
     * @param $categorias
     * @param $genero
     * @param $idEndereco
     * @param $telefone
     * @return mixed
     */
    public function realizarCadastro($nome, $cpf, $email, $login, $senha, $categorias, $genero, $idEndereco, $telefone)
    {
        $nome = "'" . $nome . "'";
        $login = "'" . $login . "'";
        $email = "'" . $email . "'";
        $cpf = "'" . $cpf . "'";
        $senha = "'" . $senha . "'";
        $genero = "'" . $genero . "'";
        $telefone = "'" . $telefone . "'";


        $sql = "INSERT INTO usuario (nome, email, cpf, login, senha, endereco, telefone, genero) VALUE ($nome, $email, $cpf, $login, $senha, $idEndereco, $telefone, $genero)";

        $this->conexao->query($sql);

        $id = $this->conexao->insert_id;
        echo $this->conexao->error;

        return $id;

    }

    /**
     * Método utilizado para registrar uma doação caso o usuário não queira ou não possa
     * se identificar, caso seja doação financeira, o mesmo não pdoerá fazer online.
     * @param $quantidade
     * @param $campanha
     * @return bool|mysqli_result
     */
    public function registroDoacaoAnonima($quantidade, $campanha)
    {
        $sql = "INSERT INTO doacao (id_campanha, confirmada, quantidade) VALUES ($campanha, TRUE, $quantidade)";

        return $this->conexao->query($sql);
    }

    /**
     * O usuário tem uma forma alternativa de se cadastrar no sistema, caso o mesmo não tenha tempo para informar todos
     * os dados, o mesmo poderá se cadastrar de uma forma mais rápida e simples.
     * @param $nome
     * @param $email
     * @param $cpf
     * @return bool|mysqli_result
     */

    public function cadastroRapido($nome, $email, $cpf)
    {
        $nome = "'" . $nome . "'";
        $email = "'" . $email . "'";
        $cpf = "'" . $cpf . "'";

        $sql = "INSERT INTO usuario (nome, email, cpf) VALUES ($nome, $email, $cpf)";

        return $this->conexao->query($sql);
    }

    /**
     * Retorna todas as doações do usuário
     * @param $idUsuario
     * @return array
     */
    public function getDoacoesUsuario($idUsuario)
    {
        $sql = "SELECT id, id_campanha, confirmada, data, quantidade, descricao  FROM doacao WHERE id_usuario_doador=$idUsuario";

        $resultado = $this->conexao->query($sql);
        $doacoes = array();


        while ($row = $resultado->fetch_array()) {
            $doacao = new Doacao($row['id_campanha'], null, $row['quantidade'], $row['descricao'], $row['data'], $row['confirmada'], $row['id']);
            array_push($doacoes, $doacao);
        }

        return $doacoes;
    }


    /**
     * Permite edirar o nome, email e telefone do usuário.
     * Edita informações pessoas
     * @param $idUsuario
     * @param $nome
     * @param $email
     * @param $telefone
     */
    public function editarUsuario($idUsuario, $nome, $email, $telefone)
    {

        $nome = "'" . $nome . "'";
        $email = "'" . $email . "'";
        $telefone = "'" . $telefone . "'";

        $sql = "UPDATE usuario SET email = $email WHERE id=$idUsuario";
        $this->conexao->query($sql);
        $sql = "UPDATE usuario SET telefone = $telefone WHERE id=$idUsuario";
        $this->conexao->query($sql);
        //$sql = "UPDATE usuario SET endereco = $idEndereco WHERE id=$idUsuario";
        //$this->conexao->query($sql);
        $sql = "UPDATE usuario SET nome = $nome WHERE id=$idUsuario";
        $this->conexao->query($sql);

    }

    /**
     * Adiciona um novo ponto de coleta
     * @param $idUsuario
     * @param $idPonto
     */
    public function addPontoColeta($idUsuario, $idPonto)
    {
        $sql = "UPDATE usuario SET id_ponto_coleta=$idPonto WHERE id=$idUsuario";

        $this->conexao->query($sql);
    }

    /**
     * Adiciona o novo agradecimento para o usuário criador de campanha
     * @param $agradecimento
     * @param $idUsuario
     * @return bool|mysqli_result
     */
    public function addAgradecimento($agradecimento, $idUsuario){
        $sql = "UPDATE usuario SET agradecimentos=$agradecimento WHERE id=$idUsuario";

        return $this->conexao->query($sql);
    }

    /**
     * Retorna os pontos de coleta pelo cpf do usuário
     * @param $cpfUsuario
     * @return mixed
     */
    public function getIdPonto($cpfUsuario)
    {
        $sql = "SELECT id_ponto_coleta FROM usuario WHERE cpf = $cpfUsuario LIMIT 1";

        $resultado = $this->conexao->query($sql)->fetch_array();

        return $resultado['id_ponto_coleta'];
    }

    /**
     * Adiciona Categorias de interesses para futuras doações de um usuário.
     * @param $categorias
     * @param $idUsuario
     */
    public function addCategoriasInteresse($categorias, $idUsuario)
    {
        foreach ($categorias as $categoria) {
            $idCategoria = $this->getIDCategoria($categoria);
            $sql = "INSERT INTO categoria_interesse_usuario (id_categoria, id_usuario) VALUES ($idCategoria, $idUsuario)";
            $this->conexao->query($sql);
        }
    }

    /**
     * Retorna o id da categoria pelo seu nome.
     * @param $nomeCategoria
     * @return mixed
     */
    public function getIDCategoria($nomeCategoria)
    {
        $nomeCategoria = "'" . $nomeCategoria . "'";
        $sql = "SELECT id FROM categoria WHERE nome = $nomeCategoria";

        $resultado = $this->conexao->query($sql)->fetch_array();

        return $resultado['id'];
    }

    /**
     * Esse método é essencial para que o usuário pós cadastrado possa efetuar login no sistema.
     * @param $login
     * @param $senha
     * @return null|Usuario
     */
    public function login($login, $senha)
    {
        $sql = "SELECT id FROM usuario WHERE login = '$login' AND senha = '$senha'";
        $resultado = $this->conexao->query($sql);

        if ($resultado->num_rows == 1) {
            $row = $resultado->fetch_array();
            return $this->getUsuario($row['id']);

        } else {
            return null;
        }
    }

    /**
     * Retorna o usuário pelo id
     * @param $id
     * @return Usuario
     */
    public function getUsuario($id)
    {
        $sql = "SELECT * FROM usuario WHERE id = " . $id;
        $resultado = $this->conexao->query($sql);
        $row = $resultado->fetch_array();

        $usuario = new Usuario($row['nome'], $row['email'], $row['cpf'],$row['telefone'], $row['id'], $row['imagem'],
            $row['token_facebook'], $row['token_google_plus'], $row['administrador']);

        $usuario->setEndereco($row['endereco']);
        $usuario->setLogin($row['login']);
        return $usuario; //Set em minhas campanhas e etc?
    }

    /**
     * Retorna o usuário pelo CPF
     * @param $cpf
     * @return Usuario
     */
    public function getUsuarioCPF($cpf)
    {
        $sql = "SELECT * FROM usuario WHERE cpf = " . $cpf;
        $resultado = $this->conexao->query($sql);
        $row = $resultado->fetch_array();

        $usuario = new Usuario($row['nome'], $row['email'], $row['cpf'],$row['telefone'], $row['id'], $row['imagem'],
            $row['token_facebook'], $row['token_google_plus'], $row['administrador']);

        return $usuario; //Set em minhas campanhas e etc?
    }

    /**
     * Retorna os contados do usuário pelo id.
     * @param $id
     * @return mixed
     */
    public function getUsuarioContato($id)
    {
        $sql = "SELECT * FROM usuario WHERE id = " . $id;
        $resultado = $this->conexao->query($sql);
        $row = $resultado->fetch_array();

        $usuario = new Usuario($row['nome'], $row['email'], $row['cpf'],$row['telefone'], $row['id'], $row['imagem'],
            $row['token_facebook'], $row['token_google_plus'], $row['administrador']);

        return $usuario['email']; //Set em minhas campanhas e etc?
    }


    /**
     * Exclui a conta do usuário do sistema.
     * @param $id
     */
    public function excluirConta($id)
    {
        $sql = "DElETE * FROM usuario WHERE id = " . $id;
        $this->conexao->query($sql);
    }


    /**
     * Retorna o id do usuário pelo cpf.
     * @param $cpf
     * @return mixed
     */
    public function getIdUsuario($cpf){
        $sql = "SELECT * FROM usuario WHERE cpf=".$cpf;
        $resultado = $this->conexao->query($sql);
        $row = $resultado->fetch_array();

        return $row['id'];
    }


    /**
     * Retorna o cpf pelo id do usuário
     * @param $idUsuario
     * @return mixed
     */
    public function getCPF($idUsuario){
        $sql = "SELECT * FROM usuario WHERE id=".$idUsuario;
        $resultado = $this->conexao->query($sql);
        $row = $resultado->fetch_array();

        return $row['CPF'];
    }

    /**
     * Retorna a senha do usuário
     * @param $idUsuario
     * @return mixed
     */
    public function getSenha($idUsuario){

        $sql = "SELECT * FROM usuario WHERE id=".$idUsuario;
        $resultado = $this->conexao->query($sql);
        $row = $resultado->fetch_array();

        return $row['senha'];
    }


    /**
     * Altera a senha de um determinado usuário
     * @param $idUsuario
     * @param $senha
     */
    public function alterarSenha($idUsuario, $senha)
    {
        $sql = "UPDATE usuario  SET senha = $senha WHERE id =$idUsuario";
        $this->conexao->query($sql);

    }


    /**
     * O usuário pode visualizar seus agradecimentos recebidos por criadores de campanha.
     * @param $idUsuario
     * @return array
     */
    public function visualizarAgradecimento($idUsuario){

        $sql = "SELECT mensagem FROM agradecimento WHERE id=".$idUsuario;
        $resultado = $this->conexao->query($sql);
        $agradecimentos = array();


        while ($row = $resultado->fetch_array()) {
            $agradecimento = new agradecimento($row['id_remetente'], null, $row['id_destinatario'], $row['mensagem'], $row['id_doacao']);
            array_push($agradecimentos, $agradecimento);
        }
        return $agradecimentos;









    }

    public function usuariosPorInteresse($idCategoria){

        /*
        $sql = "SELECT id_usuario FROM categoria_interesse_usuario WHERE id_categoria=$idCategoria";
        $resultado =  $this->conexao->query($sql);
        $usuarios = array();

        while ($row = $resultado->fetch_array()) {
            array_push($usuarios, $row['id_usuario']);
        }
        return $usuarios;


    */

    }

    /**
     * Retorna o nome do usuário pelo id
     * @param $id
     * @return mixed
     */
    public function getUsuarioNome($id)
    {
        $sql = "SELECT * FROM usuario WHERE id = " . $id;
        $resultado = $this->conexao->query($sql);
        $row = $resultado->fetch_array();

        $usuario = new Usuario($row['nome'], $row['email'], $row['cpf'],$row['telefone'], $row['id'], $row['imagem'],
            $row['token_facebook'], $row['token_google_plus'], $row['administrador']);

        return $usuario['nome']; //Set em minhas campanhas e etc?
    }


    /**
     * Retorna as notificações do usuário pelo id
     * @param $id
     * @return mixed
     */
    public function getUsuarioNotificado($id)
    {
        $sql = "SELECT * FROM usuario WHERE id = " . $id;
        $resultado = $this->conexao->query($sql);
        $row = $resultado->fetch_array();

        $usuario = new Usuario($row['nome'], $row['email'], $row['cpf'],$row['telefone'], $row['id'], $row['imagem'],
            $row['token_facebook'], $row['token_google_plus'], $row['administrador']);

        return $usuario['nome']; //Set em minhas campanhas e etc?
    }



}