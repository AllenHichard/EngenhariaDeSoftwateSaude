<?php
/**
 * Created by PhpStorm.
 * User: dcandrade
 * Date: 5/6/16
 * Time: 1:31 AM
 */
include "menu-superior.php";
echo var_dump($_GET);
$facade->encerrarCampanha($_GET['id']);
?>


