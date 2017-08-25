<?php

include 'menu-superior.php';
include 'debug.php';

if (!empty($_POST['form1'])) {
    $idCampanha = $_GET['id'];
    $cpf = $_POST['CPF'];
    $facade->confirmarDoacao($idCampanha, $cpf);
}

if (!empty($_POST['form2'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cpf = $_POST['CPF'];
    $facade->cadastroRapido($nome, $cpf, $email);
}

if (!empty($_POST['form3'])) {
    $qtd = $_POST['quantidade'];
    $facade->registroDeDoacaoAnonima();
}





