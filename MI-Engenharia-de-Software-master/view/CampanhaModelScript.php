<!DOCTYPE html>
<html lang="en">

<?php
require_once '../controller/Facade.php';

include 'debug.php';
include 'cabecalho.php';
include 'menu-superior.php';
?>

<head>
    <meta charset="UTF-8">
    <title>Campanha Cadastrada com Sucesso</title>
</head>
<body>
<?php

/**
 * Created by PhpStorm.
 * User: allen
 * Date: 03/04/2016
 * Time: 22:04
 */
//Campanha Padrão
$nomeCampanha = $_POST['txtnome'];
$datainicio = $_POST['datainicio'];
$datafinal = $_POST['datafinal'];
$descricao = $_POST['descricao'];
$meta = $_POST['meta'];
$imagem = $_POST['imagem'];
$categorias = $_POST['categoria'];
$pontosColeta = explode(",", $_POST['pontoscoleta']);
$agradecimento = $_POST['agradecimento'];

//TODO: arrumar metodos de criação no controlle re fazer upload de img
$criador = $_SESSION['usuario']->getId();






switch($_GET['tipo']){
    case 'item':
      $campanha = $facade->criarCampanhaItem($criador, $meta, $imagem, $descricao, $agradecimento, $nomeCampanha, $datafinal, $datainicio, $categorias);
        break;
    case 'financeira':
        $conta_paypal = $_POST['paypal'];
        $faixa_valores = explode(",", $_POST['valores']);
        $campanha = $facade->criarCampanhaFinanceira($criador, $meta, $imagem, $descricao, $agradecimento, $nomeCampanha, $datafinal, $datainicio, $categorias, $faixa_valores, $conta_paypal);
        break;
    case 'tempo':
        $campanha = $facade->criarCampanhaItem($criador, $meta, $imagem, $descricao, $agradecimento, $nomeCampanha, $datafinal, $datainicio, $categorias);
        break;
}


foreach ($categorias as $categoria) {
    $facade->addCategoriaCampanha($campanha, $categoria);
    echo $categoria;
}



?>


</body>
</html>