<?php
/**
 * Created by PhpStorm.
 * User: dcandrade
 * Date: 4/12/16
 * Time: 2:38 PM
 */

include 'debug.php';
include 'menu-superior.php';

$nome = $_POST['nome'];
$email = $_POST['email'];
$cpf = $_POST['cpf'];

echo $facade->cadastroRapido($nome, $email, $cpf);

?>