<?php

/**
 * Created by PhpStorm.
 * User: dcandrade
 * Date: 3/6/16
 * Time: 10:11 PM
 */
/**
 * Created by PhpStorm.
 * User: Allen, Ana Jaíze, André, Antônio, Daniel, Wanderson
 * Date: 3/6/16
 * Time: 11:42 PM
 */
class Usuario
{
    private $nome;
    private $email;

    private $cpf;
    private $imagem;
    private $endereco;
    private $telefone;
    private $tokenFacebook;
    private $tokenGooglePlus;

    private $login;
    private $senha;



    public function __construct($nome, $email, $cpf, $telefone, $id = null, $imagem = null, $tokenFB = null, $tokenG = null, $administrador = false)
    {
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->email = $email;
        $this->imagem = $imagem;
        $this->telefone = $telefone;
        $this->id = $id;
        $this->tokenFacebook = $tokenFB;
        $this->tokenGooglePlus = $tokenG;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function alterarSenha($senha){
        $this->senha = $senha;

    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function getEndereco()
    {
        $dal = new EnderecoDAL();
        $endereco = $dal->getEndereco($this->endereco);
        $dal->fechar();

        return $endereco;
    }

    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

    public function setPontosColeta(array $pontosColeta)
    {
        $this->meusPontosColeta = $pontosColeta;
    }


    public function enviarConvite($usuarios, $campanha, $mensagem)
    {
        foreach ($usuarios as $usuario) {
            $convite = new ConviteDoacao(this, $usuario, $campanha);
            $usuario->receberConvite($convite);
        }
        // não iriamos buscar na tabelas de usuários?
    }

    public function encerrarCampanha($idCampanha)
    {
        // chamar método de remove do sql para tirar a campanha da tabela
    }

    public function intencaoDoarCampanha($idCampanha)
    {

    }

    public function adicionarCampanhaPostoDoacao($idCampanha)
    {

    }

    public function historicoDoacao()
    {

    }

    public function contribuirProjeto($valor)
    {

    }

    public function relatoriosConvitesEfetuados($idCampanha)
    {

    }

    public function relatoriosDoacoesIncompletas($idCampanha)
    {

    }

    public function doacoesConfirmadas($idCampanha)
    {

    }

    public function cancelarDoacao($idDoacao)
    {

    }

    public function meusConvites()
    {

    }

    public function minhasDoacoesConfirmadas()
    {

    }

    public function minhasDoacoesIncompletas()
    {

    }

    public function denunciarCampanha($idCampanha, $motivo)
    {

    }

    public function excluirConta()
    {

    }

    public function importarContatosRedeSocial($redeSocial)
    {

    }

    public function cadastrarEndereco($rua, $numeroCasa, $bairro, $cidade)
    {
        $this->endereco = new Endereco($rua, $numeroCasa, $bairro, $cidade);
    }

    public function receberConvite($convite)
    {
        array_push($this->convites, $convite);
    }

    public function receberAgradecimento($agradecimento)
    {
        array_push($this->agradecimentos, $agradecimento);
    }


}