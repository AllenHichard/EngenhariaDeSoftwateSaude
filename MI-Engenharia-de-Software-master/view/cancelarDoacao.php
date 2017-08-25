<?php
/**
 * Created by PhpStorm.
 * User: dcandrade
 * Date: 4/20/16
 * Time: 12:28 AM
 */
include 'menu-superior.php';

$id = $_POST['id'];

$facade->cancelarDoacao($id);

?>