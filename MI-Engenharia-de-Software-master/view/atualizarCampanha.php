<?php
/**
 * Created by PhpStorm.
 * User: dcandrade
 * Date: 4/12/16
 * Time: 12:24 PM
 */
include 'menu-superior.php';
include 'debug.php';

$id = $_GET['id'];

$alterado = false;

if (isset($_POST['titulo'])) {
    $facade->atualizarTituloCampanha($id, $_POST['titulo']);
    $alterado = true;
}

if (isset($_POST['inicio'])) {
    $facade->atualizarInicioCampanha($id, $_POST['inicio']);
    $alterado = true;
}

if (isset($_POST['fim'])) {
    $facade->atualizarFimCampanha($id, $_POST['fim']);
    $alterado = true;

}

if (isset($_POST['descricao'])) {
    $facade->atualizarDescricaoCampanha($id, $_POST['descricao']);
    $alterado = true;

}

if (isset($_POST['responsavel'])) {
    $facade->cadastrarPontoCampanha($_POST['responsavel'], $id);
    $alterado = true;
}

if ($alterado) {
    $facade->enviarAvisoAlteracaoCampanha($id);
}


?>
<script>
    window.location = "gerencia.php?editar=<?php echo $id ?>&finalizado=true";
</script>
