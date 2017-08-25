<?php
/**
 * Created by PhpStorm.
 * User: Wanderson
 * Date: 10/04/16
 * Time: 19:50
 */

include 'menu-superior.php';
include 'debug.php';



if(isset($_POST['botaoNome'])) {
    $nome = $_POST['nome'];
    $endereco = $_SESSION['usuario']->getEndereco();
    $facade->editarperfil($nome, $_SESSION['usuario']->getEmail(), $endereco->getCidade(), $endereco->getEstado(),
        $endereco->getBairro(), $endereco->getRua(), $endereco->getCep(), $_SESSION['usuario']->getTelefone(),
        $_SESSION['usuario']->getCpf());
}

if(isset($_POST['botaoEmail'])) {
    $email = $_POST['email'];
    $endereco = $_SESSION['usuario']->getEndereco();
    $facade->editarperfil($_SESSION['usuario']->getNome(), $email, $endereco->getCidade(), $endereco->getEstado(),
        $endereco->getBairro(), $endereco->getRua(), $endereco->getCep(), $_SESSION['usuario']->getTelefone(),
        $_SESSION['usuario']->getCpf());
}

if(isset($_POST['botaoSenha'])) {
    $senhaAtual = $_POST['senhaAtual'];
    $senhaNova = $_POST['senhaNova'];
    $confirmarSenha = $_POST['confirmarSenha'];
    $facade->alterarSenha($_SESSION['usuario']->getId(), $senhaAtual, $senhaNova, $confirmarSenha);

}


if(isset($_POST['botaoTelefone'])) {
    $telefone = $_POST['telefone'];
    $endereco = $_SESSION['usuario']->getEndereco();
    $facade->editarperfil($_SESSION['usuario']->getNome(), $_SESSION['usuario']->getEmail(), $endereco->getCidade(), $endereco->getEstado(),
        $endereco->getBairro(), $endereco->getRua(), $endereco->getCep(), $telefone,
        $_SESSION['usuario']->getCpf());
}


if(isset($_POST['botaoNome'])) {
    $estado = $_POST['estado'];
    $cidade = $_POST['cidade'];
    $bairro = $_POST['bairro'];
    $rua = $_POST['rua'];
    $cep = $_POST['cep'];
    $facade->editarperfil($_SESSION['usuario']->getNome(), $_SESSION['usuario']->getEmail(), $cidade, $estado,
        $bairro, $rua, $cep, $_SESSION['usuario']->getTelefone(), $_SESSION['usuario']->getCpf());
}

if(isset($_POST['botaoExcluir'])) {
    $senha = $_POST['excluir'];
    $facade->excluirConta($_SESSION['usuario']->getId(), $senha);
}







//$facade->editarperfil($email, $cidade, $estado, $bairro, $rua, $cep, $telefone, $cpf);