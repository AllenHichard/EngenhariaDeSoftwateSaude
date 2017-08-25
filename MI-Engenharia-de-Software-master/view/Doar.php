<?php
/**
 * Created by PhpStorm.
 * User: dcandrade
 * Date: 4/13/16
 * Time: 12:12 AM
 */

include 'debug.php';
include 'menu-superior.php';

$usuario = $_GET['usuario'];
$campanha = $_GET['campanha'];
$quantidade = $_POST['quantidade'];
$descricao = $_POST['descricao'];

$facade->doar($quantidade, $usuario, $campanha, $descricao);


?>
<script>
    window.location = "VisualizarCampanha.php?id=<?php echo $campanha?>&doacao=true";
</script>
