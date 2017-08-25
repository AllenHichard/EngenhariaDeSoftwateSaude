<?php
/**
 * Created by PhpStorm.
 * User: dcandrade
 * Date: 4/10/16
 * Time: 5:53 PM
 */
include 'debug.php';
include 'menu-superior.php';

$nome = $_POST['nome'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$bairro = $_POST['bairro'];
$endereco = $_POST['endereco'];
$cep = $_POST['cep'];
$telefone = $_POST['telefone'];
$id = $_SESSION['usuario']->getId();

$facade->cadastrarPontoColeta($id, $nome, $estado, $cidade, $bairro, $endereco, $cep, $telefone);


?>

<script>
    window.location = "gerencia.php?cadastroPonto=sucesso";
</script>
