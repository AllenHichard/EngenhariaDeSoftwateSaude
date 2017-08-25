<!DOCTYPE html>
<html lang="pt-br">

<!-- Cabecalho-->
<?php
require_once '../controller/Facade.php';
include 'debug.php';
include 'cabecalho.php';
?>
<script type="text/javascript" src="http://cidades-estados-js.googlecode.com/files/cidades-estados-v0.2.js"></script>

<body>

<!-- Menu superior -->
<?php include 'menu-superior.php'; ?>

<?php
if (!isset($_SESSION['usuario'])) {
    //TODO: mudar location de redirecionamento
    //header("Location: home.php");
    exit();
}

if (isset($_GET['editar'])) {
    $campanha = $facade->getCampanha($_GET['editar']);
}

if (isset($_GET['cadastroCampanha'])) {
    echo '<script>alert("Campanha criada com sucesso!")</script>';
}
?>
<div class="content-wrapper-private conteudo">
    <div class="content wrapper-private">

        <!-- Corpo da Página -->
        <div class="tab-content conteudo-pagina">
            <div id="perfil"
                 class="tab-pane fade <?php if (!isset($_GET['cadastroPonto']) && !isset($_GET['editar'])) echo 'in active"' ?>">
                <h3>Meu Perfil</h3>
                <?php include 'PerfilUsuario.php' ?>
            </div>
            <div id="minhas-campanhas" class="tab-pane fade">
                <h3>Minhas Campanhas</h3>

                <table class="pure-table is-center">
                    <thead>
                    <tr>
                        <th>Título</th>
                        <th>Tipo</th>
                        <th>Ativa?</th>
                        <th>Meta</th>
                        <th>Doações</th>
                        <th>Início</th>
                        <th>Fim</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    $campanhas = $facade->getCampanhasUsuario($_SESSION['usuario']->getId());

                    foreach ($campanhas as $campanha) {
                        ?>

                        <tr>
                            <td>
                                <?php if ($campanha->isAtiva()){ ?>
                                <a href="gerencia.php?editar=<?php echo $campanha->getId(); ?>">
                                    <?php
                                    } else {
                                        echo '<a>';
                                    }
                                    ?>
                                    <?php echo $campanha->getTitulo(); ?>
                                </a>
                            </td>
                            <td><?php echo $campanha->getTipo(); ?></td>
                            <td><?php echo $campanha->isAtiva() ? 'Sim' : 'Não'; ?></td>
                            <td><?php echo $campanha->getMeta(); ?></td>
                            <td><?php echo $facade->getNumDoacoesCampanha($campanha->getId()); ?></td>
                            <td><?php echo $campanha->getDataInicio(); ?></td>
                            <td><?php echo $campanha->getDataFim(); ?></td>
                        </tr>

                    <?php } ?>

                    </tbody>
                </table>
            </div>

            <div id="editar-campanha" class="tab-pane fade<?php if (isset($_GET['editar'])) echo 'in active' ?>">
                <?php
                if (isset($_GET['editar']) && $facade->getCampanha($_GET['editar'])->getCriador() == $_SESSION['usuario']->getId())
                    include 'php/EditarCampanha.php';
                else
                    echo 'Sem permissões suficientes para editar a campanha';
                ?>
            </div>

            <!-- Início criar nova campanha tempo-->
            <div id="nova-campanha-itens" class="tab-pane fade">
                <h3>Criar Nova Campanha de Itens</h3>
                <form class="pure-form pure-form-stacket" method="post" name="cad"
                      action="CampanhaModelScript.php?tipo=item">
                    <fieldset>
                        <?php include 'php/formulario-padrao-campanha.php' ?>
            </div>
            <div class="pure-control-group is-center">
                <button type="submit" class="pure-button pure-button-primary" name="Concluir"
                        value="Concluir">Cadastrar Campanha
                </button>
            </div>
            </fieldset>
            </form>
        </div>
        <!-- Fim criar nova campanha itens-->
        <!-- Inicio criar nova campanha financeira-->
        <div id="nova-campanha-financeira" class="tab-pane fade">
            <h3>Criar nova Campanha Financeira</h3>
            <form class="pure-form pure-form-stacket" method="post" name="cad"
                  action="CampanhaModelScript.php?tipo=financeira">
                <fieldset>
                    <?php include 'php/formulario-padrao-campanha.php' ?>
                    <div class="pure-control-group">
                        <label for="name">Valores Aceitos</label>
                        <input id="paypal" type="text" placeholder="Ex: 10,20,30" name="valores">
                        <label for="name">Conta do PayPal</label>
                        <input id="paypal" type="text" placeholder="" name="paypal">
                    </div>
        </div>
        <div class="pure-control-group is-center">
            <button type="submit" class="pure-button pure-button-primary" name="Concluir"
                    value="Concluir">Cadastrar Campanha
            </button>
        </div>
        </fieldset>
        </form>
    </div>
    <!-- Fim criar nova campanha financeira-->
    <!-- Inicio criar nova campanha tempo-->
    <div id="nova-campanha-tempo" class="tab-pane fade">
        <h3>Criar Nova Campanha de Tempo</h3>
        <form class="pure-form pure-form-stacket" method="post" name="cad"
              action="CampanhaModelScript.php?tipo=item">
            <fieldset>
                <?php include 'php/formulario-padrao-campanha.php' ?>
    </div>
    <div class="pure-control-group is-center">
        <button type="submit" class="pure-button pure-button-primary" name="Concluir"
                value="Concluir">Cadastrar Campanha
        </button>
    </div>
    </fieldset>
    </form>
</div>
<!-- Fim criar nova campanha tempo-->

<div id="doacoes" class="tab-pane fade">
    <h3>Doações Realizadas</h3>
    <table class="pure-table">
        <thead>
        <tr>
            <th>Campanha</th>
            <th>Confirmada?</th>
            <th>Data</th>
            <th>Quantidade</th>
            <th>Descriçãoo</th>
            <th>Cancelar</th>
        </tr>
        </thead>

        <tbody>
        <?php
        $doacoes = $facade->getDoacoesUsuario($_SESSION['usuario']->getId());

        foreach ($doacoes as $doacao) {
            ?>
            <tr>
                <td><?php echo $facade->getNomeCampanha($doacao->getIdCampanha()); ?></td>
                <td><?php if ($doacao->isConfirmada()) {
                        echo 'Sim';
                    } else echo 'Não' ?></td>
                <td><?php echo $doacao->getData() ?></td>
                <td><?php echo $doacao->getQuantidade() ?></td>
                <td><?php echo $doacao->getDescricao() ?></td>
                <td>
                    <?php
                    if (!$doacao->isConfirmada()) {
                        ?>
                        <button id="cancelar">Cancelar</button>
                        <?php
                    } else {
                        ?>
                        Doação Concluída
                        <?php
                    }
                    ?>

                </td>
            </tr>
            <script>
                $("#cancelar").click(function () {
                    $.ajax({
                        url: 'cancelarDoacao.php',
                        type: "POST",
                        data: {id:<?php echo json_encode($doacao->getId())?>}
                    }).done(function (msg) {
                        alert("Doação cancelada!");
                        location.reload();
                    })
                });
            </script>
        <?php } ?>
    </table>
</div>

<div id="ponto-coleta" class="tab-pane fade <?php if (isset($_GET['cadastroPonto'])) echo '"in active"' ?>">
    <?php include 'tela-ponto-coleta.php' ?>
</div>


</div>

<div class="menu-lateral">
    <ul class="nav nav-pills nav-stacked">
        <li <?php if (!isset($_GET['cadastroPonto']) && !isset($_GET['editar'])) echo 'class="active"' ?>><a
                data-toggle="pill"
                href="#perfil">Perfil</a></li>
        <li class="<?php if (isset($_GET['editar'])) echo 'active' ?>"><a data-toggle="pill" href="#minhas-campanhas">Minhas
                Campanhas</a></li>
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Nova Campanha
                <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li>
                    <a data-toggle="pill" href="#nova-campanha-itens">
                        Campanha de Itens
                    </a>
                </li>
                <li>
                    <a data-toggle="pill" href="#nova-campanha-financeira">
                        Campanha Financeira
                    </a>
                </li>
                <li>
                    <a data-toggle="pill" href="#nova-campanha-tempo">
                        Campanha de Tempo
                    </a>
                </li>
            </ul>
        </li>

        <li><a data-toggle="pill" href="#doacoes">Doações</a></li>
        <li <?php if (isset($_GET['cadastroPonto'])) echo 'class="active"' ?>>
            <a data-toggle="pill" href="#ponto-coleta">Ponto de Coleta</a>
        </li>
    </ul>
</div>

</div>

<!-- Rodapé -->
<?php include 'rodape.php' ?>
</div>
</body>
</html>
