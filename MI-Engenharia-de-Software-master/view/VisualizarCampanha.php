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
    $campanha = $facade->getCampanha($_GET['id']);


} else if (isset($_GET['nome'])) {
    echo $_GET['nome'];
    $campanha = $facade->getCampanhaPorTitulo($_GET['nome']);

}
if (isset($_GET['doacao'])) {
    echo '<script>alert("Obrigado por sua doação! não se esqueça de entrega-la em um ponto de coleta.");</script>';
}
?>
<!-- Modal  de Doação-->
<div id="modal-doacao" class="modal fade modal-bg" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">
                    Doar para a Campanha '<?php echo $campanha->getTitulo() ?>'
                </h4>
            </div>
            <div class="modal-body">
                <?php if (isset($_SESSION['usuario'])) {
                    $valores = $facade->getValoresCampanha($campanha->getId());
                    if (count($valores) > 0) {
                        $valores = $facade->getValoresCampanha($campanha->getId()); ?>
                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                            <input type="hidden" name="cmd" value="_donations">
                            <input type="hidden" name="business" value="<?php echo $campanha->getContaPaypal() ?>">
                            <input type="hidden" name="lc" value="BR">
                            <input type="hidden" name="item_name" value="Contribuição para o Sitema Doa Acao">

                            <div class="selecao">
                                <?php foreach ($valores as $valor) { ?>
                                    <input type="radio" name="amount"
                                           value="<?php echo $valor ?>">R$<?php echo $valor ?>
                                    <br>
                                <?php } ?>
                            </div>

                            <input type="hidden" name="currency_code">
                            <input type="hidden" name="no_note" value="0">
                            <input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest">
                            <input type="image" src="https://www.paypalobjects.com/pt_BR/BR/i/btn/btn_donateCC_LG.gif"
                                   border="0" name="submit"
                                   alt="PayPal - A maneira fácil e segura de enviar pagamentos online!">

                            <img alt="" border="0" src="https://www.paypalobjects.com/pt_BR/i/scr/pixel.gif" width="1"
                                 height="1">
                        </form>

                        <?php
                    } else {
                        ?>
                        <form class="pure-form" method="post"
                              action="Doar.php?campanha=<?php echo $campanha->getId() ?>&usuario=<?php echo $_SESSION['usuario']->getId() ?>">
                            <fieldset class="pure-u-1">
                                <div class="pure-u-1">
                                    <?php if ($campanha->getTipo() == Campanha::$CAMPANHA_TEMPO) { ?>
                                        <label for="descricao">Como pretende ajudar? Quais sua disponibilidade?</label>
                                        <input type="text" name="descricao" id="descricao">
                                        <label for="quantidade">Quantidade</label>
                                        <input name="quantidade" type="number"
                                               placeholder="Insira a Quantidade de Horas">
                                    <?php } else { ?>

                                        <label for="descricao">Descreva brevemente o item.</label>
                                        <input type="text" name="descricao" id="descricao">
                                        <label for="quantidade">Quantidade</label>
                                        <input name="quantidade" type="number"
                                               placeholder="Insira a Quantidade">
                                    <?php } ?>
                                </div>
                                <button type="submit" class="pure-button pure-button-primary">Doar!
                                </button>
                            </fieldset>
                        </form>
                    <?php }
                } else { ?>
                    <form class="pure-form">
                        <fieldset class="pure-u-1">
                            <div class="pure-u-1">
                                <h2>Para doar, faça login.</h2>
                            </div>
                        </fieldset>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<div id="modal-contribuir" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Contribuir para o Doa Ação!</h4>
            </div>
            <div class="modal-body">
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_donations">
                    <input type="hidden" name="business" value="doaacaominerva@gmail.com">
                    <input type="hidden" name="lc" value="BR">
                    <input type="hidden" name="item_name" value="Contribuição para o Sitema Doa Acao">

                    <div class="selecao">
                        <input type="radio" name="amount" value="10">10R$<br>
                        <input type="radio" name="amount" value="20">20R$ <br>
                        <input type="radio" name="amount" value="50">50R$<br>
                        <input type="radio" name="amount" value="100">100R$<br>
                        <input type="radio" name="amount" value="200">200R$
                    </div>

                    <input type="hidden" name="currency_code">
                    <input type="hidden" name="no_note" value="0">
                    <input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest">
                    <input type="image" src="https://www.paypalobjects.com/pt_BR/BR/i/btn/btn_donateCC_LG.gif"
                           border="0" name="submit"
                           alt="PayPal - A maneira fácil e segura de enviar pagamentos online!">

                    <img alt="" border="0" src="https://www.paypalobjects.com/pt_BR/i/scr/pixel.gif" width="1"
                         height="1">
                </form>
            </div>
            <div class="modal-footer">
                <i>Obrigado!</i>
            </div>
        </div>
    </div>
</div>

<div class="content-wrapper-private content-wrapper-campanha conteudo">
    <div class="content wrapper-private">
        <h2 class="content-head is-center"><?php echo $campanha->getTitulo() ?></h2>
        <!-- Corpo da Página -->
        <figure>
            <img src="<?php $img = $campanha->getImagem();
            if (strlen($img) == 0) $img = "img/campanhas/perfil-padrao.png";
            echo $img; ?>"
                 class="pure-img pure-img-responsive img-1-3 is-center"
                 align="left" alt="Imagem da Campanha"/>
        </figure>
        <div align="left" class="pure-u-1-2 margem-1-2">
            <form class="pure-form pure-form-aligned head-last">
                <fieldset>
                    <div align="left" class="pure-u-1-2">
                        <label for="qtd">Doações
                            recebidas: <?php echo $facade->qdtDoacoes($campanha->getId()) ?></label>
                    </div>
                    <div align="left" class="pure-u-1-2">
                        <label for="meta">Meta: <?php echo $campanha->getMeta() ?></label>
                    </div>
                    <div align="left" class="pure-u-1-2">
                        <label for="inicio">Data Início: <?php echo $campanha->getDataInicio(); ?> </label>
                    </div>
                    <div align="left" class="pure-u-1-2">
                        <label for="final">Data Final: <?php echo $campanha->getDataFIm(); ?> </label>
                    </div>
                    <div align="left" class="pure-u-1-2">
                        <label for="criador">Criador: <?php echo $_SESSION['usuario']->getNome() ?></label>
                    </div>
                </fieldset>
            </form>
        </div>
        <div align="right" class="pure-u-1-2">
            <div class="pure-u-1-3">
                <button class="btn btn-primary btn-md pure-u-1-1" data-toggle="modal" data-target="#modal-doacao">
                    Doar
                </button>
            </div>

            <div class="pure-u-1-3">
                <button class="btn btn-danger btn-md pure-u-1-1" disabled>Denunciar</button>
            </div>
            <div class="pure-u-2-3 margem-top-1-2">
                <button class="btn btn-primary btn-md pure-u-1-1" data-toggle="modal" data-target="#modal-contribuir">
                    Contribuir com o Doa Ação!
                </button>
            </div>
        </div>


        <div align="left" class="pure-u-1-1">
            <form class="pure-form pure-form-aligned">
                <fieldset>
                    <div class="pure-u-1-1">
                        <h1>Descrição da Campanha</h1>
                        <?php echo $campanha->getDescricao(); ?>
                    </div>
                    <div class="is-center">
                        <br><br><br>
                        <p>
                            Compartilhe!
                        <div class="fb-send" data-width="59" data-height="20"
                             data-href="http://localhost/MI-Engenharia-de-Software/view/VisualizarCampanha.php?id=<?php echo $campanha->getId() ?>"></div>
                    </div>
                    </p>
                </fieldset>
            </form>
        </div>
        <div id="pontos-coleta pure-u-1-1">
            <?php $pontos = $facade->getPontos($campanha->getId()); ?>
            <h1>Pontos de Coleta</h1>
            <div align="left" class="pure-u-1-2">

            </div>
            <div align="left" class="pure-u-1-2">
                <?php foreach ($pontos as $ponto) {
                    echo '<p>' . $ponto->getEndereco()->getEndereco() . '</p>';
                    break;
                } ?>
            </div>
        </div>
    </div>


    <!-- Rodapé -->
    <?php include 'rodape.php' ?>


    <script>
        $(document).ready(function () {
            $('a[href^="#"]').on('click', function (e) {
                e.preventDefault();
                var target = this.hash;
                $target = $(target);
                $('html, body').stop().animate({
                    'scrollTop': $target.offset().top
                }, 900, 'swing', function () {
                    window.location.hash = target;
                });
            });
        });
    </script>
    <div id="fb-root"></div>
    <script>
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
</body>
</html>
