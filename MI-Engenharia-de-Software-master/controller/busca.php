<?php
/**
 * Created by PhpStorm.
 * User: dcandrade
 * Date: 4/1/16
 * Time: 1:59 AM
 */

/**
 * Created by PhpStorm.
 * User: Allen, Ana Jaíze, André, Antônio, Daniel, Wanderson
 * Date: 3/6/16
 * Time: 11:42 PM
 */

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
ini_set('html_errors', 0);

require_once "Facade.php";

$facade = new Facade();

$termoDeBusca = $_GET['term'];

$campanhas = $facade->buscarCampanhas($termoDeBusca);

echo json_encode($campanhas);

?>