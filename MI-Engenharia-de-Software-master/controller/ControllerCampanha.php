<?php

/**
 * Created by PhpStorm.
 * User: Wanderson
 * Date: 3/17/16
 * Time: 8:44 PM
 */

/**
 * Created by PhpStorm.
 * User: Allen, Ana Jaíze, André, Antônio, Daniel, Wanderson
 * Date: 3/6/16
 * Time: 11:42 PM
 */

require_once '../model/campanha/Campanha.php';
require_once '../model/campanha/CampanhaItem.php';
require_once '../model/campanha/CampanhaTempo.php';
require_once '../model/campanha/CampanhaFinanceira.php';
require_once '../model/campanha/Campanha.php';
require_once '../model/doacao/Doacao.php';
require_once '../util/bd/CampanhaDAL.php';
require_once '../util/bd/CategoriaDAL.php';

/**
 * Class ControllerCampanha - utilizada para interagir entre a view e o banco de dados, garantindo o fluxo de informações.
 */

class ControllerCampanha
{
    private $dal;

    public function __construct()
    {

    }


    /**
     * Cria uma campanha
     * @param $criador
     * @param $tipo
     * @param $id
     * @return $campanha
     */
    public function criarCampanha($criador, $meta, $imagem, $descricao, $agradecimento, $titulo, $dataFim, $dataInicio, $categorias)
    {
        $campanha = new Campanha(Campanha::$CAMPANHA_ITEM, $criador);
        $campanha->setMeta($meta);
        $campanha->setImagem($imagem);
        $campanha->setDescricao($descricao);
        $campanha->setAgradecimento($agradecimento);
        $campanha->setTitulo($titulo);
        $campanha->setDataFIm($dataFim);
        $campanha->setDataInicio($dataInicio);
        $campanha->setCategorias($categorias);

        $this->dal = new CampanhaDAL();

        $resultado = $this->dal->salvarCampanha($campanha);

        $this->dal->fechar();
        return $resultado;
    }

    public function criarCampanhaFinanceira($criador, $meta, $imagem, $descricao, $agradecimento, $titulo, $dataFim, $dataInicio, $categorias, $valores, $paypal)
    {
        $campanha = new Campanha(Campanha::$CAMPANHA_FINANCEIRA, $criador);
        $campanha->setMeta($meta);
        $campanha->setImagem($imagem);
        $campanha->setDescricao($descricao);
        $campanha->setAgradecimento($agradecimento);
        $campanha->setTitulo($titulo);
        $campanha->setDataFIm($dataFim);
        $campanha->setDataInicio($dataInicio);
        $campanha->setCategorias($categorias);
        $campanha->addContaPaypal($paypal);
        $campanha->addFaixaValores($valores);

        $this->dal = new CampanhaDAL();

        $resultado = $this->dal->salvarCampanhaFinanceira($campanha);

        $this->dal->fechar();
        return $resultado;
    }

    /**
     * O método retorna uma campanha de um determinado tipo.
     * @param $tipo
     * @param $qtd
     * @param $inicio
     * @return array
     */
    public function getCampanhasTipo($tipo, $qtd, $inicio)
    {
        $this->dal = new CampanhaDAL();
        $campanhas = $this->dal->getCampanhasTipo($tipo, $qtd, $inicio);
        $this->dal->fechar();

        return $campanhas;
    }

    /**
     * Retorna a quantidade de Campanhas de um determinado tipo.
     * @param $tipo
     * @return int
     */
    public function getQtdCampanhasTipo($tipo)
    {
        $this->dal = new CampanhaDAL();
        $campanhas = $this->dal->getQtdCampanhasTipo($tipo);
        $this->dal->fechar();

        return $campanhas;
    }

    /**
     * Adiciona uma categoria a uma campanha
     * @param $idCampanha
     * @param $nomeCategoria
     */
    public function addCategoriaCampanha($idCampanha, $nomeCategoria)
    {
        $this->dal = new CategoriaDAL();
        $categoriaID = $this->dal->getIDCategoria($nomeCategoria);
        $this->dal->fechar();

        $this->dal = new CampanhaDAL();
        $this->dal->addCategoria($categoriaID, $idCampanha);
        $this->dal->fechar();
    }

    /**
     * Retorna todas a campanhas que contpem um título específico
     * @param $titulo
     * @return Campanha
     */
    public function getCampanhaPorTitulo($titulo)
    {
        $this->dal = new CampanhaDAL();
        $id = $this->dal->getIdCampanha($titulo);
        $campanha = $this->dal->getCampanha($id);
        $this->dal->fechar();

        return $campanha;
    }

    /**
     * Avisa caso alguma campanha tenha sido alterada.
     * @param $idCampanha
     */
    public function avisarAlteracaoCampanha($idCampanha)
    {
        $this->dal = new CampanhaDAL();
        $campanha = $this->dal->getCampanha($idCampanha);
        $emails = $this->dal->getEmailDoadores($idCampanha);
        $this->dal->fechar();

        //TODO: rever link do texto
        $assunto = "[Doa Ação] Aviso de Alteração de Campanha";
        $texto = "A campanha" . $campanha->getTitulo() . "foi alterada. Veja mais em LINK";

        foreach ($emails as $email) {
            mail($email, $assunto, $texto);
        }
    }

    /**
     * Método usado pelo usuário para efetuar uma doação para uma campanha.
     * @param $quantidade
     * @param $usuario
     * @param $campanha
     * @param $descricao
     * @return bool|mysqli_result
     */
    public function doar($quantidade, $usuario, $campanha, $descricao)
    {
        $doacao = new Doacao($campanha, $usuario, $quantidade, $descricao);
        $this->dal = new CampanhaDAL();
        $resultado = $this->dal->doar($doacao);
        $this->dal->fechar();

        return $resultado;
    }

    /**
     * Retorna uma campanha pelo id.
     * @param $id
     * @return Campanha
     */
    public function getCampanha($id)
    {

        $this->dal = new CampanhaDAL();
        $campanha = $this->dal->getCampanha($id);
        $this->dal->fechar();

        return $campanha;
    }

    public function encerrarCampanha($idCampanha)
    {
        $this->dal = new CampanhaDAL();
        $campanha = $this->dal->desativarCampanha($idCampanha);
        $this->dal->fechar();
    }

    /**
     * O criador da campanha usa o método enviar agradecimento quando qualquer usuário do sistema
     * efetua uma doação.
     * @param $agradecimento
     * @param $usuario
     * @return void
     */
    public function enviarAgradecimentos($idRemetente, $idDestinatario, $mensagem, $idDoacao)
    {
        $this->dal = new CampanhaDAL();
        $$this->dal->enviarAgradecimento($idRemetente, $idDestinatario, $mensagem, $idDoacao);
        $this->dal->fechar();
    }

    /**
     * Retorna todas as campanhas de um usuário
     * @param $id
     * @return array
     */
    public function getCampanhasUsuario($id)
    {
        $this->dal = new CampanhaDAL();
        $campanhas = $this->dal->getCampanhasDoUsuario($id);
        $this->dal->fechar();
        return $campanhas;
    }

    /**
     * Busca todas as campanhas com um determinado (termo) título
     * @param $termo
     * @return array
     */
    public function buscarCampanhas($termo)
    {
        $this->dal = new CampanhaDAL();
        $campanhas = $this->dal->buscarCampanhas($termo);
        $this->dal->fechar();
        return $campanhas;
    }

    /**
     * Retorna todas as campanhas completas, levanco em consideração a quantidade e inicio.
     * @param $quantidade
     * @param $iniciando
     * @return array
     */
    public function getCampanhasCompletas($quantidade, $iniciando)
    {
        $this->dal = new CampanhaDAL();
        $campanhas = $this->dal->getCampanhasCompletas($quantidade, $iniciando);
        $this->dal->fechar();
        return $campanhas;
    }

    /**
     * Retorna a quantidade de doações que uma campanha teve
     * @param $idCampanha
     * @return int
     */
    public function qtdDoacoesCampanha($idCampanha)
    {
        $this->dal = new CampanhaDAL();
        $campanhas = $this->dal->qtdDoacoesCampanha($idCampanha);
        $this->dal->fechar();
        return $campanhas;
    }

    /**
     * Retorna todos os valores de uma campanha
     * @param $idCampanha
     * @return array
     */
    public function getValoresCampanha($idCampanha)
    {
        $this->dal = new CampanhaDAL();
        $campanhas = $this->dal->getValoresCampanha($idCampanha);
        $this->dal->fechar();
        return $campanhas;
    }

    /**
     * Retorna os numeros de doadoes de uma campanha
     * @param $id
     * @return int
     */
    public function getNumDoacoesCampanha($id)
    {
        $this->dal = new CampanhaDAL();
        $quantidade = $this->dal->getNumDoacoesCampanha($id);
        $this->dal->fechar();
        return $quantidade;
    }

    /**
     * Retorna o número de campanhas completas.
     * @return int
     */
    public function getNumCampanhasCompletas()
    {
        $this->dal = new CampanhaDAL();
        $quantidade = $this->dal->getNumCampanhasCompletas();
        $this->dal->fechar();
        return $quantidade;
    }

    /**
     * Retorna o numero de campanhas finalizadas
     * @return int
     */
    public function getNumCampanhasFinalizando()
    {
        $this->dal = new CampanhaDAL();
        $quantidade = $this->dal->getNumCampanhasFinalizando();
        $this->dal->fechar();
        return $quantidade;
    }

    /**
     * Retorna o numero de campanhas recem criadas.
     * @return int
     */
    public function getNumCampanhasRecentes()
    {
        $this->dal = new CampanhaDAL();
        $quantidade = $this->dal->getNumCampanhasRecentes();
        $this->dal->fechar();
        return $quantidade;
    }

    /**
     * Retorna todas as campanhas finalizadas
     * @param $quantidade
     * @param $iniciando
     * @return array
     */
    public function getCampanhasFinalizando($quantidade, $iniciando)
    {
        $this->dal = new CampanhaDAL();
        $quantidade = $this->dal->getCampanhasFinalizando($quantidade, $iniciando);
        $this->dal->fechar();
        return $quantidade;
    }

    /**
     * Retorna o nome da campanha pelo seu id
     * @param $id
     * @return mixed
     */
    public function getNomeCampanha($id)
    {
        $this->dal = new CampanhaDAL();
        $quantidade = $this->dal->getNomeCampanha($id);
        $this->dal->fechar();
        return $quantidade;
    }


    /**
     * Atualiza o titulo de uma campanha
     * @param $id
     * @param $titulo
     * @return bool|mysqli_result
     */
    public function atualizarTituloCampanha($id, $titulo)
    {
        $this->dal = new CampanhaDAL();
        $resultado = $this->dal->atualizarTitulo($id, $titulo);
        $this->dal->fechar();
        return $resultado;
    }

    /**
     * Atualiza o inicio de uma campanha.
     * @param $id
     * @param $dataInicio
     * @return bool|mysqli_result
     */
    public function atualizarInicioCampanha($id, $dataInicio)
    {
        $this->dal = new CampanhaDAL();
        $resultado = $this->dal->atualizarDataInicio($id, $dataInicio);
        $this->dal->fechar();
        return $resultado;
    }

    /**
     * Atualiza o final da campanha, podendo alterar a data antencipado-a ou atraando-a
     * @param $id
     * @param $dataFim
     * @return bool|mysqli_result
     */
    public function atualizarFimCampanha($id, $dataFim)
    {
        $this->dal = new CampanhaDAL();
        $resultado = $this->dal->atualizarDataFim($id, $dataFim);
        $this->dal->fechar();
        return $resultado;
    }

    /**
     * Altera a descrição da campanha
     * @param $id
     * @param $descricao
     * @return bool|mysqli_result
     */
    public function atualizarDescricaoCampanha($id, $descricao)
    {
        $this->dal = new CampanhaDAL();
        $resultado = $this->dal->atualizarDescricao($id, $descricao);
        $this->dal->fechar();
        return $resultado;
    }

    /**
     * Retorna as campanhas mais recentes
     * @param $quantidade
     * @param $iniciando
     * @return array
     */
    public function getCampanhasMaisRecentes($quantidade, $iniciando)
    {
        $this->dal = new CampanhaDAL();
        $campanhas = $this->dal->getCampanhasMaisRecentes($quantidade, $iniciando);
        $this->dal->fechar();

        return $campanhas;
    }


    /**
     * @param $idCampanha
     * @return void
     */
    public function denunciarCampanha($idCampanha)
    {
    }

    public function enviarAvisoAlteracaoCampanha()
    {
    }

    /**
     * @param $tipo
     */
    public function recomendarCampanhasSimilares($tipo)
    {
    }

}