<?php

/**
 * Created by PhpStorm.
 * User: Wanderson
 * Date: 3/18/16
 * Time: 4:50 PM
 */
/**
 * Created by PhpStorm.
 * User: Allen, Ana Jaíze, André, Antônio, Daniel, Wanderson
 * Date: 3/6/16
 * Time: 11:42 PM
 */

require_once 'ControllerCampanha.php';
require_once 'ControllerUsuario.php';
require_once 'ControllerPonto.php';
require_once 'ControllerCategoria.php';
require_once '../util/bd/EnderecoDAL.php';
require_once '../model/others/Endereco.php';

/**
 * Class Facade - Classe de ligação principal entre a view e o banco de dados. Está contida nela todos os métodos
 * dos controllers de categoria, ponto, campanha e usuário.
 */

class Facade
{
    private $controllerCampanha;
    private $controllerUsuario;
    private $controllerPonto;
    private $controllerCategoria;


    /**
     * Facade constructor. O construtor a facade é utilizado para instanciar todos os controllers do sistema
     */
    public function __construct()
    {
        $this->controllerCampanha = new ControllerCampanha();
        $this->controllerUsuario = new ControllerUsuario();
        $this->controllerPonto = new ControllerPonto();
        $this->controllerCategoria = new ControllerCategoria();
    }

    // ----------------------------------------------------------------------------------------------------- //
    // ----------------------------------- Métodos da campanha ----------------------------------------------//
    // ----------------------------------------------------------------------------------------------------- //


    /**
     * Método utilizado para criar campanha ddo tipo ítem no sistema
     * @param $criador
     * @param $meta
     * @param $imagem
     * @param $descricao
     * @param $agradecimento
     * @param $titulo
     * @param $dataFim
     * @param $dataInicio
     * @param $categorias
     * @return mixed
     */
    public function criarCampanhaItem($criador, $meta, $imagem, $descricao, $agradecimento, $titulo, $dataFim, $dataInicio, $categorias)
    {
        return $this->controllerCampanha->criarCampanha($criador, $meta, $imagem, $descricao, $agradecimento, $titulo, $dataFim, $dataInicio, $categorias);
    }

    /**
     * Retorna as doações de um determinado usuário pelo seu id.
     *
     * @param $idUsuario
     * @return array
     */
    public function getDoacoesUsuario($idUsuario)
    {
        return $this->controllerUsuario->getDoacoesUsuario($idUsuario);
    }

    /**
     * Método para cancelar a doação.
     *
     * @param $id
     */
    public function cancelarDoacao($id)
    {
        $this->controllerUsuario->cancelarDoacao($id);
    }

    /**
     * Método que retorna a quantidade de doações de uma determinada campanha.
     *
     * @param $idCampanha
     * @return int
     */

    public function qdtDoacoes($idCampanha)
    {
        return $this->controllerCampanha->qtdDoacoesCampanha($idCampanha);
    }

    /**
     * Método que verifica se o login e a senha do usuário são válidos, se for retorna a página do usuário.
     *
     * @param $login
     * @param $senha
     * @return null|Usuario
     */

    public function login($login, $senha)
    {
        return $this->controllerUsuario->efetuarLogin($login, $senha);
    }

    /**
     * Método que adciona uma categoria para determinada campanha.
     *
     * @param $idCampanha
     * @param $nomeCategoria
     */

    public function addCategoriaCampanha($idCampanha, $nomeCategoria)
    {
        return $this->controllerCampanha->addCategoriaCampanha($idCampanha, $nomeCategoria);
    }

    /**
     * Retorna a campanha de um determinado tipo.
     *
     * @param $tipo
     * @param $qtd
     * @param $inicio
     * @return array
     */

    public function getCampanhasTipo($tipo, $qtd, $inicio)
    {
        return $this->controllerCampanha->getCampanhasTipo($tipo, $qtd, $inicio);
    }

    /**
     * Retorna a quantidade de campanhas de um determinado tipo.
     *
     * @param $tipo
     * @return int
     */

    public function getQtdCampanhasTipo($tipo)
    {
        return $this->controllerCampanha->getQtdCampanhasTipo($tipo);
    }

    /**
     * Método que encerra uma determinada campanha.
     *
     * @param $idCampanha
     */

    public function encerrarCampanha($idCampanha)
    {
        $this->controllerCampanha->encerrarCampanha($idCampanha);
    }

    /**
     * Retorna todos os nomes da categorias.
     *
     * @return array
     */

    public function getNomesCategorias()
    {
        return $this->controllerCategoria->getNomesCategorias();
    }

    /**
     * Retorna as campanhas que foram criadas mais recente.
     *
     * @param $quantidade
     * @param int $iniciando
     * @return array
     */

    public function getCampanhasMaisRecentes($quantidade, $iniciando = 0)
    {
        return $this->controllerCampanha->getCampanhasMaisRecentes($quantidade, $iniciando);
    }

    /**
     * Retorna as campanhas criadas por determinado usuário.
     *
     * @param $id
     * @return array
     */

    public function getCampanhasUsuario($id)
    {
        return $this->controllerCampanha->getCampanhasUsuario($id);
    }

    /**
     * Retorna o quantidade de doações de uma determinada campanha.
     *
     * @param $id
     * @return int
     */

    public function getNumDoacoesCampanha($id)
    {
        return $this->controllerCampanha->getNumDoacoesCampanha($id);
    }

    /**
     * Retorna a quantidade de campanhas que foram finalizadas com sucesso.
     *
     * @return int
     */

    public function getNumCampanhasCompletas()
    {
        return $this->controllerCampanha->getNumCampanhasCompletas();
    }

    /**
     * Método que edita as informações de um determinado usuário.
     *
     * @param $idUsuario
     * @param $nome
     * @param $email
     * @param $telefone
     */

    public function editarUsuario($idUsuario, $nome, $email, $telefone)
    {
        $this->controllerUsuario->editarUsuario($idUsuario, $nome, $email, $telefone);
    }

    /**
     * Retorna a quantidade de campanhas finalizadas.
     *
     * @return int
     */

    public function getNumCampanhasFinalizando()
    {
        return $this->controllerCampanha->getNumCampanhasFinalizando();
    }

    /**
     * Retorna a quantidade de campanhas recentes.
     *
     * @return int
     *
     */

    public function getNumCampanhasRecentes()
    {
        return $this->controllerCampanha->getNumCampanhasRecentes();
    }

    /**
     * Retorna as campanhas que estão chegando ao fim do prazo.
     *
     * @param $quantidade
     * @param int $iniciando
     * @return array
     */

    public function getCampanhasFinalizando($quantidade, $iniciando = 0)
    {
        return $this->controllerCampanha->getCampanhasFinalizando($quantidade, $iniciando);
    }

    /**
     * Retorna as campanhas que foram finalizadas com sucesso.
     *
     * @param $quantidade
     * @param int $iniciando
     * @return array
     */

    public function getCampanhasCompletas($quantidade, $iniciando = 0)
    {
        return $this->controllerCampanha->getCampanhasCompletas($quantidade, $iniciando);
    }

    /**
     * Retorna as campanhas de um determinado título.
     *
     * @param $termo
     * @return array
     */

    public function buscarCampanhas($termo)
    {
        return $this->controllerCampanha->buscarCampanhas($termo);
    }

    /**
     * Retorna o ponto de coleta de determinado usuário.
     *
     * @param $id
     * @return null|PontoColeta
     */

    public function getPontoColetaUsuario($id)
    {
        return $this->controllerPonto->getPontoColeta($id);
    }

    /**
     * Método que cadastra o ponto de coleta.
     *
     * @param $idUsuario
     * @param $nome
     * @param $estado
     * @param $cidade
     * @param $bairro
     * @param $endereco
     * @param $cep
     * @param $telefone
     */

    public function cadastrarPontoColeta($idUsuario, $nome, $estado, $cidade, $bairro, $endereco, $cep, $telefone)
    {
        $this->controllerPonto->cadastrarPontoColeta($idUsuario, $nome, $estado, $cidade, $bairro, $endereco, $cep, $telefone);
    }

    /**
     * Retorna campanha por título.
     *
     * @param $titulo
     * @return Campanha
     */

    public function getCampanhaPorTitulo($titulo)
    {
        return $this->controllerCampanha->getCampanhaPorTitulo($titulo);
    }

    /**
     * O método cadastrarPontocampanha recebe dois parâmetros, sendo eles: o CPF do responsável e o id da campanha, desta forma
     * cria um vinculo entre o usuário que irá ser o ponto de coleta e a campanha correspondente a ela.
     *
     * @param $cpfResponsavel
     * @param $idCampanha
     */

    public function cadastrarPontoCampanha($cpfResponsavel, $idCampanha)
    {
        $this->controllerUsuario->addPonto($idCampanha, $cpfResponsavel);
    }

    /**
     * Retorna campanha por nome.
     *
     * @param $id
     * @return mixed
     */

    public function getNomeCampanha($id)
    {
        return $this->controllerCampanha->getNomeCampanha($id);
    }

    /**
     * Retorna o ponto de campanha de uma determinada campanha.
     *
     * @param $idCampanha
     * @return array
     */

    public function getPontosCampanha($idCampanha)
    {
        return $this->controllerPonto->getPontosCampanha($idCampanha);
    }

    /**
     * Retorna os pontos de coleta para ser visualizado de forma diferente em outra aba do sistema.
     * Esse método é similar ao getPontosCampanha, com o diferencial que um mostra as informações gerais do ponto
     * e outro apenas retorna as informações mais específicas para ser exibidos de forma diferentes.
     * @param $idCampanha
     * @return array
     */

    public function getPontos($idCampanha)
    {
        return $this->controllerPonto->getPontos($idCampanha);
    }

    /**
     * Método que envia os agradecimentos por doação.
     *
     * @param $idRemetente
     * @param $idDestinatario
     * @param $mensagem
     * @param $idDoacao
     */
    public function EnviarAgradecimentos($idRemetente, $idDestinatario, $mensagem, $idDoacao)
    {
        return $this->controllerCampanha->EnviarAgradecimentos($idRemetente, $idDestinatario, $mensagem, $idDoacao);
    }

    /**
     * Método que altera a data de uma determinada campanha.
     *
     * @param $idCampanha
     * @param $dataInicio
     * @param $dataFim
     * @return mixed
     */

    public function alterarDataCampanha($idCampanha, $dataInicio, $dataFim)
    {
        return $this->controllerCampanha->alterarCampanha($idCampanha, $dataInicio, $dataFim);
    }

    /**
     * Método que altera a data de uma determinada campanha.
     *
     * @param $idCampanha
     * @param $dataInicio
     * @param $dataFim
     * @return mixed
     */

    public function alterarCampanha($idCampanha, $dataInicio, $dataFim)
    {
        return $this->controllerCampanha->alterarCampanha($idCampanha, $dataInicio, $dataFim);
    }

    /**
     * Retorna a campanha pelo ID.
     *
     * @param $id
     * @return Campanha
     */

    public function getCampanha($id)
    {
        return $this->controllerCampanha->getCampanha($id);
    }

    /**
     * Método que atualiza o título da campanha.
     *
     * @param $id
     * @param $titulo
     * @return bool|mysqli_result
     */

    public function atualizarTituloCampanha($id, $titulo)
    {
        return $this->controllerCampanha->atualizarTituloCampanha($id, $titulo);
    }

    /**
     * Método que atualiza a data de início de uma determinada campanha.
     *
     * @param $id
     * @param $dataInicio
     * @return bool|mysqli_result
     */

    public function atualizarInicioCampanha($id, $dataInicio)
    {
        return $this->controllerCampanha->atualizarInicioCampanha($id, $dataInicio);
    }

    /**
     * Método que atualiza a data para finalizar uma determinada campanha.
     *
     * @param $id
     * @param $dataFim
     * @return bool|mysqli_result
     */

    public function atualizarFimCampanha($id, $dataFim)
    {
        return $this->controllerCampanha->atualizarFimCampanha($id, $dataFim);
    }

    /**
     * Método que atualiza a descrição da campanha.
     *
     * @param $id
     * @param $descricao
     * @return bool|mysqli_result
     */

    public function atualizarDescricaoCampanha($id, $descricao)
    {
        return $this->controllerCampanha->atualizarDescricaoCampanha($id, $descricao);
    }

    /**
     * Método que busca determinada campanha pelo ID.
     *
     * @param $id
     * @return $campanha
     */
    public function buscarCampanha($idCampanha)
    {
        return $this->controllerCampanha->buscarCampanha($idCampanha);
    }

    /**
     * Método que trata uma denuncia de campanha.
     *
     * @param $idCampanha
     * @return void
     */
    public function denunciarCampanha($idCampanha)
    {
        return $this->controllerCampanha->denunciarCampanha($idCampanha);
    }

    /**
     * Método que envia aviso informando de uma alteração em uma campanha.
     */

    public function enviarAvisoAlteracaoCampanha()
    {
        return $this->controllerCampanha->enviarAvisoAlteracaoCampanha();
    }

    /**
     * Método que retorna campanhas similares pelo tipo.
     *
     * @param $tipo
     */
    public function recomendarCampanhasSimilares($tipo)
    {
        return $this->controllerCampanha->recomendarCampanhasSimilares($tipo);
    }

    /**
     * Método que altera a data de uma determinada campanha.
     *
     * @param $idCampanha
     * @param $dataInicio
     * @param $dataFim
     * @return mixed
     */


    public function enviarAgradecimento($idCampanha, $idUsuario)
    {
        return $this->controllerCampanha->enviarAgradecimentos($idCampanha, $idUsuario);
    }

    // ----------------------------------------------------------------------------------------------------- //
    // ----------------------------------- Métodos do usuário -----------------------------------------------//
    // ----------------------------------------------------------------------------------------------------- //


    /**
     * Método alternativo para cadastro no sistema
     * @param $nome
     * @param $email
     * @param $cpf
     * @return bool|mysqli_result
     */
    public function cadastroRapido($nome, $email, $cpf)
    {
        return $this->controllerUsuario->cadastroRapido($nome, $email, $cpf);
    }

    /**
     *
     * cadastra o usuário no sistema
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
        return $this->controllerUsuario->realizarCadastro($nome, $telefone, $cpf, $email, $login, $senha, $endereco, $bairro, $categorias, $cidade, $estado, $cep, $genero);
    }


    /**
     * Permite alterar a senha do usuário, caso o mesmo esqueça ou queira alterar por motivos pessoais
     *
     * @param $idUsuario
     * @param $senhaAtual
     * @param $novaSenha
     * @param $repetirSenha
     */
    public function alterarSenha($idUsuario, $senhaAtual, $novaSenha, $repetirSenha)
    {
        return $this->controllerUsuario->alterarSenha($idUsuario, $senhaAtual, $novaSenha, $repetirSenha);
    }

    /**
     * Retorna todos os valores da campanha
     *
     * @param $idCampanha
     * @return array
     */
    public function getValoresCampanha($idCampanha)
    {
        return $this->controllerCampanha->getValoresCampanha($idCampanha);
    }

    /**
     * Permite ao usuário mudar o email de cadastro
     * @param $endereco
     */
    public function setEmail($endereco)
    {
        return $this->controllerUsuario->setEmail($endereco);
    }

    /**
     * Permite ao usuário excluir sua conta do sistema.
     *
     * @param $id
     * @param $senha
     * @return bool
     */
    public function excluirConta($id, $senha)
    {
        return $this->controllerUsuario->excluirConta($id, $senha);
    }

    /**
     * Permite aos usuários visualizarem seus agradecimentos, agradecimentos esse que o mesmo recebe quando
     * efetua uma doação para uma determinada campanha
     * @param $idUsuario
     * @return array
     */
    public function visualizarAgradecimento($idUsuario)
    {
        return $this->controllerUsuario->visualizarAgradecimento($idUsuario);
    }
    // ----------------------------------------------------------------------------------------------------- //
    // ----------------------------------- Métodos da doação ------------------------------------------------//
    // ----------------------------------------------------------------------------------------------------- //

    /**
     *
     * Permite a doação para uma campanha
     * @param $quantidade
     * @param $usuario
     * @param $campanha
     * @param $descricao
     * @return bool|mysqli_result
     */
    public function doar($quantidade, $usuario, $campanha, $descricao)
    {
        return $this->controllerCampanha->doar($quantidade, $usuario, $campanha, $descricao);
    }

    /**
     * Identifica todos os postos para ser concluido a doação
     * @return mixed
     */
    public function identificarPostosDeDoacao()
    {
        return $this->controllerDoacao->identificarPostosDeDoacao();
    }

    /**
     * Permite ao usuário efetuar uma doação sem se identificar, caso a doação seja online e financeira, o usuário
     *terá que se identificar.
     * @param $quantidade
     * @param $campanha
     */

    public function registroDeDoacaoAnonima($quantidade, $campanha)
    {
        return $this->controllerUsuario->registroDeDoacaoAnonima($quantidade, $campanha);

    }

    /**
     * Permite ao usuário criar campanhas do tipo financeira
     * @param $criador
     * @param $meta
     * @param $imagem
     * @param $descricao
     * @param $agradecimento
     * @param $titulo
     * @param $dataFim
     * @param $dataInicio
     * @param $categorias
     * @param $valores
     * @param $paypal
     */
    public function criarCampanhaFinanceira($criador, $meta, $imagem, $descricao, $agradecimento, $titulo, $dataFim, $dataInicio, $categorias, $valores, $paypal)
    {
        return $this->controllerCampanha->criarCampanhaFinanceira($criador, $meta, $imagem, $descricao, $agradecimento, $titulo, $dataFim, $dataInicio, $categorias, $valores, $paypal);
    }

    // ----------------------------------------------------------------------------------------------------- //
    // ----------------------------------- Métodos do ponto de coleta ------------------------------------------------//
    // ----------------------------------------------------------------------------------------------------- //

    /**
     * Método do posto de coleta para confirma o recebimento de um ítem doado, confirmando a doação do usuário.
     * @param $idDoacao
     */
    public function confirmarDoacao($idDoacao)
    {
        $this->controllerPonto->confirmarDoacao($idDoacao);
    }

    /**
     * Retorna as doações efetuadas de um determinado cpf
     * @param $cpf
     * @return array
     */
    public function getDoacoesCpf($cpf)
    {
        return $this->controllerPonto->getDoacoesCpf($cpf);
    }

    /**
     * Adiciona os interesses para possiveis doações de um determinado usuário.
     * @param $categoria
     * @param $id
     */
    public function addInteresse($categoria, $id) {
        return $this->controllerUsuario->addInteresse($categoria,$id);
    }


    /**
     * detecta os doadores para um tipo de categoria.
     * @param $categoria
     * @return mixed
     */
    public function detectarDoadores($categoria){
        return $this->controllerUsuario->detectarDoadores($categoria);
    }
}