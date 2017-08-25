<?php
/**
 * Created by PhpStorm.
 * User: dcandrade
 * Date: 5/4/16
 * Time: 10:38 AM
 */
require 'menu-superior.php';
$doacao = $_POST['doacao'];
$id = $_GET['id'];

$facade->confirmarDoacao($doacao);
?>

<script>
    alert('Doação confirmada!');
    window.location = 'gerencia.php?editar=<?php echo $id?>'
</script>
