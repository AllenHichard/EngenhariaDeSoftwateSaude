<?php

/**
 * Created by PhpStorm.
 * User: Allen, Ana Jaíze, André, Antônio, Daniel, Wanderson
 * Date: 3/6/16
 * Time: 11:35 PM
 */


require_once 'DAL.php';
require_once 'UsuarioDAL.php';


/**
 * Class CampanhaDAL - Manipula as tabelas relacionadas a Campanha no banco de dados, contendo os principais métodos
 * de seleção, inserção, remoção, e alteração.
 */


class CampanhaDAL extends DAL
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * O método getIdCampanha recebe como parâmetro o titulo da campanha, o mesmo é utilizado para buscar o id
     * correspondente a ele.
     * @param $titulo
     * @return mixed
     */

    public function getIdCampanha($titulo)
    {
        $sql = "SELECT id FROM campanha WHERE titulo = '$titulo'";
        $resultado = $this->conexao->query($sql);
        $row = $resultado->fetch_array();

        return $row['id'];
    }

    /**
     * O método getValoresCampanha recebe como parâmetro o id da campanha, o mesmo é utilizado para buscar os valores da
     * Campanha correspondente a ele.
     * @param $id
     * @return array
     */
    public function getValoresCampanha($id)
    {
        $sql = "SELECT valor FROM valor_campanha WHERE id_campanha=$id";

        $resultado = $this->conexao->query($sql);
        $campanhas = array();

        while ($row = $resultado->fetch_array()) {
            array_push($campanhas, $row['valor']);
        }

        return $campanhas;
    }

    /**
     * O método getCampanhasRelacionadas recebe como parâmetro duas atributos, sendo eles: o id da campanha e a quantidade.
     * Com esses valores é feito a correlação pode meio da seleção entre campanhas de tipos similares.
     *
     * @param $idCampanha
     * @param $qtd
     * @return array
     */

    public function getCampanhasRelacionadas($idCampanha, $qtd)
    {
        $ids = $this->getIdsCampanhasRelacionadas($idCampanha, $qtd);
        $campanhas = array();
        foreach ($ids as $id) {
            array_push($campanhas, $this->getCampanha($id));
        }

        return $campanhas;
    }

    /**
     * O getIdsCampanhasRelacionadas é utilizada como método auxiliar do getCampanhasRelacionadas, para retornar
     * apenas os Ids de todas campanhas que pertecem ao mesmo grupo.
     * @param $idCampanha
     * @param $qtd
     * @return array
     */
    public function getIdsCampanhasRelacionadas($idCampanha, $qtd)
    {
        $id = $idCampanha;

        $sql = "SELECT id_campanha
              FROM categorias_campanha
              WHERE id_categoria
              IN(
                SELECT id_categoria
                FROM categorias_campanha
                WHERE id_campanha = " . $id . " AND ativa=FALSE)
              LIMIT " . $qtd;

        $resultado = $this->conexao->query($sql);
        $campanhas = array();

        while ($row = $resultado->fetch_array()) {
            array_push($campanhas, $row['id']);
        }

        return $campanhas;

    }

    /**
     * O método getCampanha recebe como parâmetro o id, sendo utilizado para retornas todas as campanhas relacionadas
     * a ele.
     * @param $id
     * @return Campanha
     */

    public function getCampanha($id)
    {
        $sql = "SELECT * FROM campanha WHERE id = " . $id;

        $row = $this->conexao->query($sql)->fetch_array();

        //$dal = new UsuarioDAL();
        //$usuario = $dal->getUsuario($row['id_criador']);
        //$dal->fechar();

        $campanha = new Campanha($row['tipo'], $row['id_criador'], $row['id'], $row['ativa']);
        $campanha->setAgradecimento($row['agradecimento_padrao']);
        $campanha->setDataFIm($row['fim']);
        $campanha->setDataInicio($row['inicio']);
        $campanha->setTitulo($row['titulo']);
        $campanha->setDescricao($row['descricao']);
        $campanha->setImagem($row['imagem']);
        $campanha->setMeta($row['meta']);

        return $campanha;

    }

    /**
     * O método getCampanhasTipo recebe como parametro o tipo da campanha utilizado para retornar as campanhas que pertecem
     * a um determinado tipo, verificando o inicio da mesma e sua quantidade.
     *
     * @param $tipo
     * @param $qtd
     * @param int $inicio
     * @return array
     */
    public function getCampanhasTipo($tipo, $qtd, $inicio = 0)
    {
        $sql = "SELECT campanha.id as id_campanha
                FROM campanha JOIN categorias_campanha ON campanha.id = categorias_campanha.id_campanha
                              JOIN categoria ON categorias_campanha.id_categoria = categoria.id
                WHERE categoria.nome = '$tipo'
                ORDER BY inicio ASC
                LIMIT $inicio, $qtd ";

        $resultado = $this->conexao->query($sql);
        $campanhas = array();

        while ($row = $resultado->fetch_array()) {
            array_push($campanhas, $this->getCampanha($row['id_campanha']));
        }

        return $campanhas;
    }

    /**
     * O mpetodo getQtdCampanhasTipo recebe como parâmetro o tipo da campanhas para retornar o quantidades de campanhas
     * que aquele tipo possue
     * @param $tipo
     * @return int
     */
    public function getQtdCampanhasTipo($tipo)
    {
        $sql = "SELECT campanha.id as id_campanha
                FROM campanha JOIN categorias_campanha ON campanha.id = categorias_campanha.id_campanha
                              JOIN categoria ON categorias_campanha.id_categoria = categoria.id
                WHERE categoria.nome = '$tipo'";

        return $this->conexao->query($sql)->num_rows;
    }

    /**
     * O método doar recebe uma doação para vincular a descrição, o id do doador e da campanha e a quantidade a ser
     * doada.
     * @param Doacao $doacao
     * @return bool|mysqli_result
     */
    public function doar(Doacao $doacao)
    {
        $descricao = "'" . $doacao->getDescricao() . "'";
        $doador = $doacao->getIdDoador();
        $campanha = $doacao->getIdCampanha();
        $quantidade = $doacao->getQuantidade();


        $sql = "INSERT INTO doacao (id_campanha, id_usuario_doador, descricao, quantidade)
                VALUES ($campanha, $doador, $descricao, $quantidade)";

        return $this->conexao->query($sql);
    }

    /**
     * O métodos getEmailDoadores recebe como parãmetro o idCampanha, para retornar os emails dos doadores
     * que efetuaram uma doação para o id da campanha passado.
     * @param $idCampanha
     * @return array
     */
    public function getEmailDoadores($idCampanha)
    {
        $sql = "SELECT email
                FROM usuario JOIN doacao ON usuario.id = doacao.id_usuario_doador
                WHERE id_campanha = $idCampanha";

        $resultado = $this->conexao->query($sql);
        $emails = array();

        while ($row = $resultado->fetch_array()) {
            array_push($emails, $row['email']);
        }

        return $emails;
    }

    /**
     * O método buscar Campanha recebe o termo como parãmetro que é o titulo da campanha e faz a seleção
     * retornando em ordem crescente as campanhas pelo inicio delas.
     * @param $termo
     * @return array
     */
    public function buscarCampanhas($termo)
    {
        $sql = "SELECT titulo FROM campanha WHERE titulo LIKE '%$termo%' ORDER BY inicio ASC";

        $resultado = $this->conexao->query($sql);
        $campanhas = array();

        while ($row = $resultado->fetch_array()) {
            array_push($campanhas, $row['titulo']);
        }

        return $campanhas;
    }

    /**
     * O método GetCampanhasDoUsuário recebe como parãmetro o Id do usuário, para retornar todas as campanhas
     * criadas por ele.
     * @param $idUsuario
     * @return array
     */
    public function getCampanhasDoUsuario($idUsuario){
        $sql = "SELECT id FROM campanha WHERE id_criador = ".$idUsuario;

        $resultado = $this->conexao->query($sql);
        $campanhas = array();

        while ($row = $resultado->fetch_array()) {
            $campanha = $this->getCampanha($row['id']);
            array_push($campanhas, $campanha);
        }

        return $campanhas;
    }

    /**
     * O método getNomeCampanha recebe como parâmetro o id da campanha, para retornar o nome vinculado
     * ao determinado id.
     * @param $id
     * @return mixed
     */
    public function getNomeCampanha($id){
        $sql = "SELECT titulo FROM campanha WHERE id = $id";

        $resultado = $this->conexao->query($sql)->fetch_array();

        return $resultado['titulo'];
    }

    /**
     * O método getNumDoaçõesCammpanha recebe como parametro o id, e retorna quantas doações foram efetuadas para
     * uma campanha
     * @param $id
     * @return int
     */
    public function getNumDoacoesCampanha($id){
        $sql = "SELECT * FROM doacao WHERE id_campanha = $id";
        return $this->conexao->query($sql)->num_rows;
    }

    /**
     * Envia agradecimento contendo remetente, mensagem, destinatário e doador.
     * @param $idRemetente
     * @param $idDestinatario
     * @param $mensagem
     * @param $idDoacao
     * @return bool|mysqli_result
     */

    public function enviarAgradecimento($idRemetente, $idDestinatario, $mensagem, $idDoacao){
        $sql = "INSERT INTO agradecimento (id_remetente, id_destinatario,mensagem, id_doacao) VALUES ($idRemetente, $idDestinatario, $mensagem, $idDoacao)";
        return $this->conexao->query($sql);
    }

    /**
     * Retornar as campanhas recém criada por qualquer usuário.
     * @param $quantidade
     * @param int $iniciando
     * @return array
     */
    public function getCampanhasMaisRecentes($quantidade, $iniciando=0)
    {
        $sql = "SELECT id FROM campanha WHERE ativa=TRUE ORDER BY inicio DESC LIMIT $iniciando, $quantidade";

        $resultado = $this->conexao->query($sql);
        $campanhas = array();
        while ($row = $resultado->fetch_array()) {
            $campanha = $this->getCampanha($row['id']);
            array_push($campanhas, $campanha);
        }

        return $campanhas;
    }

    /**
     * Retorna todas as campanhas finalizadas
     *
     * @param $quantidade
     * @param int $iniciando
     * @return array
     */
    public function getCampanhasFinalizando($quantidade, $iniciando=0){
        $sql = "SELECT id FROM campanha WHERE fim > CURDATE() AND ativa=TRUE ORDER BY fim DESC LIMIT " . $iniciando . ", " . $quantidade;

        $resultado = $this->conexao->query($sql);
        $campanhas = array();
        while ($row = $resultado->fetch_array()) {
            $campanha = $this->getCampanha($row['id']);
            array_push($campanhas, $campanha);
        }

        return $campanhas;
    }

    /**
     * Retorna todas as campanhas que tiveram seus objetivos alcançados
     * @param $quantidade
     * @param int $iniciando
     * @return array
     */
    public function getCampanhasCompletas($quantidade, $iniciando=0){
        $sql = "SELECT id FROM campanha WHERE fim < CURDATE() AND ativa=FALSE ORDER BY fim ASC LIMIT " . $iniciando . ", " . $quantidade;

        $resultado = $this->conexao->query($sql);
        $campanhas = array();
        while ($row = $resultado->fetch_array()) {
            $campanha = $this->getCampanha($row['id']);
            array_push($campanhas, $campanha);
        }

        return $campanhas;
    }

    /**
     * Retorna o numeros de campanhas completadas
     * @return int
     */
    public function getNumCampanhasCompletas(){
        $sql = "SELECT * FROM campanha WHERE fim < CURDATE() AND ativa=FALSE ";

        return $this->conexao->query($sql)->num_rows;
    }

    /**
     * Retorna o numero de campanhas recentes
     * @return int
     */
    public function getNumCampanhasRecentes(){

        return $this->getNumCampanhasFinalizando();
    }

    /**
     * Retorna o numero de campanhas finalizadas.
     * @return int
     */
    public function getNumCampanhasFinalizando(){
        $sql = "SELECT id FROM campanha WHERE fim < CURDATE()";

        return $this->conexao->query($sql)->num_rows;
    }


    /**
     * Retorna as categorias que uma determinada campanha se encaixa.
     * @param $idCampanha
     */
    public function getCategoriasCampanha($idCampanha)
    {
        $id = $idCampanha;

        $sql = "SELECT *
                FROM categoria
                WHERE id
                IN(
                  SELECT id_categoria
                  FROM categorias_campanha
                  WHERE id_campanha = " . $id . ")";

        $resultado = $this->conexao->query($sql);
        $campanhas = array();
        while ($row = $resultado->fetch_array()) {
            $campanha = new Categoria($row['id'], $row['nome'], $row['imagem']);
            array_push($campanhas, $campanha);
        }

    }

    /**
     * Retorna a quantidade de doações que uma campanha teve
     * @param $idCampanha
     * @return int
     */
    public function qtdDoacoesCampanha($idCampanha)
    {
        $sql = "SELECT id FROM doacao WHERE id_campanha = $idCampanha";

        return $this->conexao->query($sql)->num_rows;
    }

    /**
     * Salva uma campanha financeira assim que a mesma é criada no sistema
     * @param CampanhaFinanceira $campanhaFinanceira
     */

    public function salvarCampanhaFinanceira(Campanha $campanhaFinanceira)
    {
        $campanha = $this->salvarCampanha($campanhaFinanceira);
        $id = mysqli_insert_id($this->conexao);

        $valores = $campanhaFinanceira->getValores();

        foreach ($valores as $valor) {
            $sql = "INSERT INTO valor_campanha (id_campanha, valor) VALUES (" . $id . " ," . $valor . ")";
            $this->conexao->query($sql);
        }

        $paypal = $campanhaFinanceira->getContaPaypal();
        $sql = "UPDATE campanha SET paypal='$paypal' WHERE id=$id";
        $this->conexao->query($sql);

        return $campanha;
    }

    /**
     * Método utilizado para salvar campanha assim que a mesma é criada pelo uruário.
     * @param Campanha $campanha
     * @return mixed
     */
    public function salvarCampanha(Campanha $campanha)
    {   $titulo = "'". $campanha->getTitulo() ."'";
        $descricao  =  "'".$campanha->getDescricao()."'" ;
        $inicio  = "'". $campanha->getDataInicio() ."'";
        $fim =   "'". $campanha->getDataFIm() ."'";
        $agradecimento = "'".$campanha->getAgradecimento()."'";
        $imagem = "'". $campanha->getImagem() ."'";


        $sql = "INSERT INTO campanha
                (id_criador, inicio, fim, agradecimento_padrao, meta, tipo, imagem, descricao, titulo)
                VALUES (".$campanha->getCriador().", ".$inicio.", ".$fim.", ".$agradecimento.", ".$campanha->getMeta().", 1, ".$imagem.", ".$descricao.", ".$titulo.")";


        $this->conexao->query($sql);

        return $this->conexao->insert_id;

    }

    /**
     * ALtera o titulo da campanha.
     * @param $idCampanha
     * @param $titulo
     * @return bool|mysqli_result
     */

    public function atualizarTitulo($idCampanha, $titulo)
    {
        $titulo = "'" . $titulo . "'";
        $sql = "UPDATE campanha SET titulo = $titulo WHERE id = $idCampanha";
        return ($this->conexao->query($sql));
    }

    /**
     * O usuário pode determinar quando a campanha tornará visível para o usuário poder efetuar as doações.
     * @param $idCampanha
     * @param $dataInicio
     * @return bool|mysqli_result
     */
    public function atualizarDataInicio($idCampanha, $dataInicio)
    {
        $dataInicio = "'" . $dataInicio . "'";
        $sql = "UPDATE campanha SET inicio = " . $dataInicio . " WHERE id = " . $idCampanha;

        return ($this->conexao->query($sql));
    }

    /**
     * O método é utilizado para autalizar a data final da campanha, sendo que o usuário criador pode adiar ou atencipar
     * p fim dela.
     * @param $idCampanha
     * @param $dataFim
     * @return bool|mysqli_result
     */

    public function atualizarDataFim($idCampanha, $dataFim)
    {
        $dataFim = "'" . $dataFim . "'";
        $sql = "UPDATE campanha SET inicio = " . $dataFim . " WHERE id = " . $idCampanha;

        return ($this->conexao->query($sql));
    }

    /**
     * è buscado a campanha pelo id da mesma e setado a descrição para a nova mensagem passada por parâmetro.
     * @param $idCampanha
     * @param $descricao
     * @return bool|mysqli_result
     */
    public function atualizarDescricao($idCampanha, $descricao)
    {
        $descricao = "'" . $descricao . "'";
        $sql = "UPDATE campanha SET descricao = " . $descricao . " WHERE id = " . $idCampanha;

        return ($this->conexao->query($sql));
    }

    /**
     * Torna a campanha n]ao visível ao usuário, uma das opções é a utilização para encerrar uma campanha ativa.
     * @param $idCampanha
     * @return bool|mysqli_result
     */
    public function desativarCampanha($idCampanha){
        $sql = "UPDATE campanha SET ativa = FALSE where id = ".$idCampanha;
        // $sql = "DELETE FROM campanha WHERE id = $idCampanha";
        return ($this->conexao->query($sql));
    }

    /**
     * Torna a campanha visível para o usuário, podendo ele fazer doações para a mesma.
     * @param $idCampanha
     * @return bool|mysqli_result
     */

    public function ativarCampanha($idCampanha){
        $sql = "UPDATE campanha SET ativa = TRUE where id = ".$idCampanha;

        return ($this->conexao->query($sql));
    }

    /**
     * VIncula uma categoria a uma campanha.
     * @param $idCategoria
     * @param $idCampanha
     * @return bool|mysqli_result
     */

    public function addCategoria($idCategoria, $idCampanha)
    {
        $sql = "INSERT INTO categorias_campanha (id_campanha, id_categoria) VALUES (" . $idCampanha . ", " . $idCategoria . ")";

        return ($this->conexao->query($sql));
    }

    /**
     * Retorna os nomes das categoras.
     * @return array
     */

    public function getNomesCategorias(){
        $sql = "SELECT DISTINCT nome FROM categoria";
        $resultado = $this->conexao->query($sql);

        $categorias = array();
        while ($row = $resultado->fetch_array()) {
            $categoria = $row['nome'];
            array_push($categorias, $categoria);
        }

        return $categorias;
    }


}