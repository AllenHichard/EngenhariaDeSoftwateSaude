<?php
/**
 * Created by PhpStorm.
 * User: Wanderson
 * Date: 01/04/16
 * Time: 09:00
 */
include 'menu-superior.php';
include 'debug.php';


$nome = $_POST['txt_nome'];
$cpf = $_POST['txt_cpf'];
$email = $_POST['txt_email'];
$login = $_POST['login'];
$senha = $_POST['txt_senha'];
$confirmarSenha = $_POST['txt_confsenha'];

$categorias = array();

if (isset($_POST['categoria'])) {
$categorias = $_POST['categoria'];
}

$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$bairro = $_POST['bairro'];
$endereco = $_POST['endereco'];
$cep = $_POST['cep'];
$telefone = $_POST['telefone'];

$genero = $_POST['genero'];



$facade->realizarCadastro($nome, $telefone, $cpf, $email, $login, $senha, $endereco, $bairro, $categorias, $cidade, $estado, $cep, $genero);

?>

<script>
    window.location = "home.php?cadastro=true";
</script>
