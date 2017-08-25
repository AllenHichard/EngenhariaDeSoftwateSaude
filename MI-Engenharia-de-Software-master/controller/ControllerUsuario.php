<?php

/**
 * Created by PhpStorm.
 * User: Wanderson
 * Date: 3/17/16
 * Time: 10:13 PM
 */

/**
 * Created by PhpStorm.
 * User: Allen, Ana Jaíze, André, Antônio, Daniel, Wanderson
 * Date: 3/6/16
 * Time: 11:42 PM
 */

require_once '../model/usuario/usuario.php';
require_once '../util/bd/UsuarioDAL.php';

require_once '../model/others/Endereco.php';
require_once '../util/bd/EnderecoDAL.php';

require_once '../model/doacao/Doacao.php';
require_once '../util/bd/DoacaoDAL.php';

/**
 * Class ControllerUsuario - utilizada para interagir entre a view e o banco de dados, garantindo o fluxo de informações.
 */

class ControllerUsuario
{
    private $dal;

    public function __construct()
    {

    }

    /**
     * Método utilizado caso o usuário cancele uma doação efetuada.
     * @param $id
     * @return bool|mysqli_result
     */
    public function cancelarDoacao($id)
    {
        $this->dal = new DoacaoDAL();
        $resultado = $this->dal->deleteDoacao($id);
        $this->dal->fechar();

        return $resultado;
    }

    /**
     * Retorna todas as doações do usuário
     * @param $idUsuario
     * @return array
     */
    public function getDoacoesUsuario($idUsuario)
    {
        $this->dal = new UsuarioDAL();
        $doacoes = $this->dal->getDoacoesUsuario($idUsuario);
        $this->dal->fechar();

        return $doacoes;
    }

    /**
     * Registra todas as doações anônimas
     * @param $quantidade
     * @param $campanha
     */
    public function registroDeDoacaoAnonima($quantidade, $campanha)
    {
        $this->dal = new UsuarioDAL();
        $idPonto = $this->dal->registroDoacaoAnonima($quantidade, $campanha);
        $this->dal->fechar();
    }

    /**
     * Adiciona os pontos de coleta em usuário e vincula a campanha
     * @param $idCampanha
     * @param $cpfResponsavel
     */
    public function addPonto($idCampanha, $cpfResponsavel)
    {
        $this->dal = new UsuarioDAL();
        $idPonto = $this->dal->getIdPonto($cpfResponsavel);
        $this->dal->fechar();

        $this->dal = new PontoColetaDAL();
        $this->dal->setCampanha($idPonto, $idCampanha);
        $this->dal->fechar();
    }

    /**
     * PErmite o usuário a visualizar seus respectivos agradecimento
     * @param $idUsuario
     * @return array
     */
    public function visualizarAgradecimento($idUsuario)
    {
        $this->dal = new UsuarioDAL();
        $resultado = $this->dal->visualizarAgradecimento($idUsuario);
        $this->dal->fechar();

        return $resultado;
    }

    /**
     * PErmite usuário se cadastrar de forma rápida e pratica.
     * @param $nome
     * @param $email
     * @param $cpf
     * @return bool|mysqli_result
     */
    public function cadastroRapido($nome, $email, $cpf)
    {
        $this->dal = new UsuarioDAL();
        $resultado = $this->dal->cadastroRapido($nome, $email, $cpf);
        $this->dal->fechar();

        return $resultado;
    }

    /**
     * Realiza cadastro de um novo usuário no sistema
     * @param $nome
     * @param $telefone
     * @param $cpf
     * @param $email
     * @param $login
     * @param $senha
     * @param $endereco
     * @param $bairro
     * @param $categorias
     * @param $cidade
     * @param $estado
     * @param $cep
     * @param $genero
     */
    public function realizarCadastro($nome, $telefone, $cpf, $email, $login, $senha, $endereco, $bairro, $categorias, $cidade, $estado, $cep, $genero)
    {
        $endereco = new Endereco($endereco, $bairro, $cidade, $estado, $cep);
        $this->dal = new EnderecoDAL();
        $idEndereco = $this->dal->insertEndereco($endereco);
        $this->dal->fechar();

        $this->dal = new UsuarioDAL();

        $id = $this->dal->realizarCadastro($nome, $cpf, $email, $login, $senha, $categorias, $genero, $idEndereco, $telefone);

        $this->dal->addCategoriasInteresse($categorias, $id);

        $this->dal->fechar();
    }

    /**
     * Retorna true se conseguiu logar, false caso contrário
     * @param $login
     * @param $senha
     */
    public function efetuarLogin($login, $senha)
    {
        $dal = new UsuarioDAL();
        $resultado = $dal->login($login, $senha);
        $dal->fechar();

        return $resultado;
    }


    /**
     * Edita todas as informações do usuário, caso ele queira mudar algo que deficniu no seu cadastro
     * @param $nome
     * @param $email
     * @param $cidade
     * @param $estado
     * @param $bairro
     * @param $rua
     * @param $cep
     * @param $telefone
     * @param $cpf
     */
    public function editarPerfil($nome, $email, $cidade, $estado, $bairro, $rua, $cep, $telefone, $cpf)
    {
        $endereco = new Endereco($rua, $bairro, $cidade, $estado, $cep);
        $this->dal = new EnderecoDAL();
        $idEndereco = $this->dal->insertEndereco($endereco);
        $this->dal->fechar();

        $this->dal = new UsuarioDAL();
        $idUsuario = $this->dal->getIdUsuario($cpf);
        $this->dal->editarUsuario($idUsuario, $nome, $email, $idEndereco, $telefone, $cpf);
        $this->dal->fechar();
    }

    public function efetuarLogOut()

    {
    }


    public function punirUsuario($idAdministrador, $idUsuario)
    {
    }

    public function realizarDoacao($idCampanha, $doacao)
    {
    }

    public function visualizarAgradecimentos($idUsuario)
    {
    }

    public function contribuirComProjetoDoacao($valor)
    {
    }

    public function enviarConvitesDoacao($idCampanha, $idsUsuarios)
    {
    }

    public function visualizarHistorico()
    {
    }

    public function visualizarRelatorios()
    {
    }

    /**
     * Retorna True caso a conta seja deletada. Caso não seja, return False
     * @param $id
     * @param $senha
     * @return bool
     */
    public function excluirConta($id, $senha)
    {
        $this->dal = new UsuarioDAL();
        $senhaUsuario = $this->dal->getSenha($id);
        $this->dal->fechar();

        if ($senha == $senhaUsuario) {
            $this->dal->excluirConta($id);
            return true;
        } else {
            return false;
        }


    }

    public function importarContatos($usuarios)
    {
    }

    /*
     * Retorna array de usuários
     */
    public function buscarContatosRedeSocial($redeSocial, $token)
    {

    }

    /**
     * PErmite o usuário alterar sua senha
     * @param $idUsuario
     * @param $senhaAtual
     * @param $novaSenha
     * @param $repetirSenha
     */
    public function alterarSenha($idUsuario, $senhaAtual, $novaSenha, $repetirSenha)
    {
        $this->dal = new UsuarioDAL();
        $senha = $this->dal->getSenha($idUsuario);
        if ($senha == $senhaAtual && $novaSenha == $repetirSenha) {
            $this->dal->alterarSenha($idUsuario, $novaSenha);
        }
    }

    public function setEmail($endereco)
    {

    }

    /**
     * Adiciona categorias de interesses em usuário para futuras doações.
     * @param $categoria
     * @param $id
     */
    public function addInteresse($categoria, $id)
    {

        $this->dal = new UsuarioDAL();
        $this->dal->addCategoriasInteresse($categoria, $id);
        $this->dal->fechar();

    }

    /**
     * Permite editar o nome, email e telefone.
     * @param $idUsuario
     * @param $nome
     * @param $email
     * @param $telefone
     */
    public function editarUsuario($idUsuario, $nome, $email, $telefone)
    {
        $this->dal = new UsuarioDAL();
        $this->dal->editarUsuario($idUsuario, $nome, $email, $telefone);
        $this->dal->fechar();
    }

    /*
    public function detectarDoadores($categoria)
    {

        $doadores = array();
        $this->dal = new UsuarioDAL();
        $doadores = $this->dal->usuariosPorInteresse($categoria);

        foreach ($doadores as $value) {
            $nome = $this->dal->getUsuarioNome($value);
            $email = $this->dal->getUsuarioContato($value);

            $emailenviar = "doacaominerva@gmail.com";
            $destino = $email;
            $assunto = "Campanhas Que possam Interessar";

            // É necessário indicar que o formato do e-mail é html
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From: $nome <$email>';
            //$headers .= "Bcc: $EmailPadrao\r\n";


            $corpoEmail = "
    <style type='text/css'>
    body {
    margin:0px;
    font-family:Verdane;
    font-size:12px;
    color: #666666;
    }
    a{
    color: #666666;
    text-decoration: none;
    }
    a:hover {
    color: #FF0000;
    text-decoration: none;
    }
    </style>
    <html>
        <table width='510' border='1' cellpadding='1' cellspacing='1' bgcolor='#CCCCCC'>
            <tr>
              <td>
    <tr>
                 <td width='500'> Olá $nome  </td>
                 <h1> Olá,</h1>
                  <h1> Existem novas campanhas no nosso site que podem lhe interessar</h1>

                 <h3> Att Equipe DoaAção</h3>



          </tr>
        </table>
    </html>
    ";

            if (notificar($value)) {

                $enviaremail = mail($destino, $assunto, $corpoEmail, $headers);
                if ($enviaremail) {
                    $mgm = "E-MAIL ENVIADO COM SUCESSO! <br> O link será enviado para o e-mail fornecido no formulário";
                    echo " <meta http-equiv='refresh' content='10;URL=contato.php'>";
                } else {
                    $mgm = "ERRO AO ENVIAR E-MAIL!";
                    echo "";
                }


            }


        }


    }

*/
    public function notificar($id)
    {

        $this->dal = new UsuarioDAL();

        $tempo = $this->dal->getUsuarioNotificado($id);

        if (isset($tempo)) {
            date_default_timezone_set('America/Sao_Paulo');
            $date = date('d-m-Y');
            $partes = explode('/', $tempo);
            $dataNotificado = mktime(0, 0, 0, $partes[1], $partes[0], $partes[2]);

            $partes = explode('/', $date);
            $dataHoje = mktime(0, 0, 0, $partes[1], $partes[0], $partes[2]);
            $diferenca = $dataHoje - $dataNotificado;
            $dias = (int)floor($diferenca / (60 * 60 * 24));

            if ($dias >= 15) {

                return true;
            }

            return false;
        }


        return true;
    }


}