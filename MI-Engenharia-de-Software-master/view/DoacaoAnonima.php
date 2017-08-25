<?php
/**
 * Created by PhpStorm.
 * User: dcandrade
 * Date: 4/15/16
 * Time: 4:49 AM
 */

include 'debug.php';
include "menu-superior.php";

$id = $_GET['id'];
$quantidade = $_POST['quantidade'];

$facade->registroDeDoacaoAnonima($quantidade, $id);

?>