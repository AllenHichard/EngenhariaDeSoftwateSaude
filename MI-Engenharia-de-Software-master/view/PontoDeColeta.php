<!DOCTYPE html>
<html lang="en">

<!-- Cabecalho-->
<?php
require_once '../controller/Facade.php';
include 'debug.php';
include 'cabecalho.php';
?>

<body>
<!-- Menu superior -->
<?php include 'menu-superior.php'; ?>
<?php
if (isset($_GET['id'])) {
    $ponto = $facade->getPontoColetaUsuario($_GET['id']);

}
?>


<body>

<!-- Menu superior -->
<?php include 'menu-superior.php'; ?>

<div class="content-wrapper-private conteudo">
    <div class="content wrapper-private">

        <!-- Corpo da Página -->
        <div class="tab-content conteudo-pagina">
            <div id="home" class="tab-pane fade in active">
                <h2 align="center">Administrar Ponto de Coleta</h2>
                <h3 class="content-head is-center"><?php echo $ponto->getNome()?></h3>
                <div align="center" class="pure-u-1-1">
                <div align="center" class="pure-u-1-2">

                        <form class="pure-form pure-form-aligned" method="post" action="IntegracaoPontoDeColeta?id=<?php echo
                        $ponto->getId() ?>"
                    <fieldset> name="form1">


                                <div class="pure-u-1-2">
                                    <label for="textname">Confirmar doação </label>
                                    <input id="CPF" type="text" name="meta" maxlength="11" placeholder="Insira o CPF do doador" ">
                                </div>


                                <div align="center" class="pure-u-1-1">
                                    <div  class="pure-u-1-2">
                                        <button type="submit" class="pure-button pure-button-primary">Cancelar</button>
                                        <button type="submit" class="pure-button pure-button-primary">Confirmar</button>
                                    </div>
                                </div>

                            </fieldset>
                        </form>




                </div>
                </div>


        </div>

            <div id="menu1" class="tab-pane fade">
                <h3>Cadastro rapido</h3>

                <div align="left" class="pure-u-1-1">
                <div align="left" class="pure-u-1-2">

                <form class="pure-form pure-form-aligned" method="post" action="IntegracaoCadastroUsuario.php" name="form2" >
                    <fieldset>

                <div class="pure-u-1-2">

                </div>

                <div class="pure-u-1-2">

                </div>

                <div class="pure-u-1-2">

                </div>

                        <div align="left" class="pure-u-1-1">
                            <div  class="pure-u-1-2">
                                <button type="submit" class="pure-button pure-button-primary">Cancelar</button>
                                <button type="submit" class="pure-button pure-button-primary">Confirmar</button>
                            </div>
                        </div>


                  </fieldset>
                </form>

                </div>
                </div>


            </div>


            <div id="menu2" class="tab-pane fade">
                <h3>Doação anônima</h3>

                <form class="pure-form pure-form-aligned" method="post" action="IntegracaoCadastroUsuario.php" name="form3">
                    <fieldset>

                <div class="pure-u-1-4">
                    <label for="textname">Itens doados </label>
                    <input id="quantidade" type="text" name="meta" placeholder="Insira a quantidade" ">
                </div>

                        <div align="left" class="pure-u-1-1">
                            <div  class="pure-u-1-2">
                                <button type="submit" class="pure-button pure-button-primary">Cancelar</button>
                                <button type="submit" class="pure-button pure-button-primary">Confirmar</button>
                            </div>
                        </div>


                    </fieldset>
                </form>




            </div>
        </div>

        <div class="menu-lateral">
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a data-toggle="pill" href="#home">Home</a></li>
                <li><a data-toggle="pill" href="#menu1">Cadastro rápido</a></li>
                <li><a data-toggle="pill" href="#menu2">Doação Anônima</a></li>
            </ul>
        </div>

    </div>

    <!-- Rodapé -->
    <?php include 'rodape.php' ?>
</div>


<script>
    $(document).ready(function(){
        $('a[href^="#"]').on('click',function (e) {
            e.preventDefault();
            var target = this.hash;
            $target = $(target);
            $('html, body').stop().animate({
                'scrollTop':  $target.offset().top
            }, 900, 'swing', function () {
                window.location.hash = target;
            });
        });
    });
</script>
</body>
</html>
<?php
