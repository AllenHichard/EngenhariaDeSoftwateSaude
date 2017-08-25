<?php
/**
 * Created by PhpStorm.
 * User: dcandrade
 * Date: 5/3/16
 * Time: 9:15 PM
 */
include 'menu-superior.php';

$nome = $_POST['txt_nome'];
$cpf = $_POST['txt_cpf'];
$email = $_POST['txt_email'];
$telefone = $_POST['telefone'];

$facade->editarUsuario($_SESSION['usuario']->getId(), $nome, $email, $telefone);
?>