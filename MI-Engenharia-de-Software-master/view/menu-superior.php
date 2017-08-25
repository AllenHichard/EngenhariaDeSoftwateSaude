<?php
/**
 * Created by PhpStorm.
 * User: dcandrade
 * Date: 4/2/16
 * Time: 7:05 PM
 */
require_once '../controller/Facade.php';
$facade = new Facade();
if (!isset($_SESSION['usuario']))
    session_start();

if (isset($_POST['login']) and $_POST['senha']) {
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $usuario = $facade->login($login, $senha);


    if ($usuario != null) {
        session_destroy();
        session_start();
        $_SESSION['usuario'] = $usuario;
        header("Location: home.php");
    } else {
        header("Location: home.php?login=false");
    }
    die();
} else if (isset($_GET['logout'])) {
    if (strcmp($_GET['logout'], 'true') == 0) {
        session_destroy();
        header("Location: home.php");
        die();
    }
}


?>

<div class="header">
    <div class="home-menu pure-menu pure-menu-horizontal pure-menu-fixed">
        <?php //TODO: mudar de home.php para index ?>
        <a class="pure-menu-heading texto-logo" href="home.php">Doa Ação!</a>
        <ul class="pure-menu-list">
            <li class="pure-menu-item"><a href="home.php#sobre" class="pure-menu-link">Sobre</a></li>

            <li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover">
                <a class="pure-menu-link">Campanhas</a>
                <ul class="pure-menu-children submenu ">
                    <li class="pure-menu-item">
                        <a href="campanhas.php?modo=recentes" class="pure-menu-link">Recentes</a>
                    </li>
                    <li class="pure-menu-item">
                        <a href="campanhas.php?modo=finalizando" class="pure-menu-link">Reta Final</a>
                    </li>
                    <li class="pure-menu-item">
                        <a href="campanhas.php?modo=finalizadas" class="pure-menu-link">Finalizadas</a>
                    </li>
                </ul>
            </li>

            <li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover">
                <a class="pure-menu-link">Categorias</a>
                <ul class="pure-menu-children submenu ">
                    <?php
                    $categorias = $facade->getNomesCategorias();
                    foreach ($categorias as $categoria) {
                        ?>
                        <li class="pure-menu-item">
                            <a href="campanhas.php?categoria=<?php echo $categoria ?>"
                               class="pure-menu-link"><?php echo $categoria ?></a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </li>
            <?php

            if (isset($_SESSION['usuario'])) {
                ?>
                <li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover">
                    <a href="#" class="pure-menu-link">Bem vindo, <?php echo $_SESSION['usuario']->getNome();; ?></a>
                    <ul class="pure-menu-children submenu ">
                        <li class="pure-menu-item">
                            <a href="gerencia.php" class="pure-menu-link">Meu Pefil</a>
                        </li>
                        <li class="pure-menu-item">
                            <a href="<?php echo $_SERVER['PHP_SELF'] . '?logout=true' ?>"
                               class="pure-menu-link">Logout</a>
                        </li>
                    </ul>
                </li>
                <?php
            } else { ?>

                <li class="pure-menu-item"><a href="#" data-toggle="modal" data-target="#modal-login"
                                              class="pure-menu-link ">Login/Cadastro</a></li>
                <?php
            }
            ?>
        </ul>
    </div>
</div>

<div id="modal-login" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Login no Doa Ação!</h4>
            </div>
            <div class="modal-body">
                <form class="pure-form pure-form-stacked" action="" method="post">
                    <fieldset>
                        <label for="login">Login</label>
                        <input name="login" id="login" type="text" placeholder="Digite seu login" required>

                        <label for="senha">Senha</label>
                        <input name="senha" id="senha" type="password" placeholder="Digite sua senha" required>

                        <button type="submit" class="pure-button pure-button-primary">Entrar</button>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                Não possui conta? <a href="cadastro.php"> Cadastre-se!</a>
            </div>
        </div>
    </div>
</div>

