<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Slogan">
    <title>Doa Ação!</title>
    <link href='css/main.css' rel='stylesheet'>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">

    <!--[if lte IE 8]>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/grids-responsive-old-ie-min.css">
    <![endif]-->
    <!--[if gt IE 8]><!-->
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/grids-responsive-min.css">
    <!--<![endif]-->

    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">

    <!--[if lte IE 8]>
    <link rel="stylesheet" href="css/layouts/marketing-old-ie.css">
    <![endif]-->
    <!--[if gt IE 8]><!-->
    <link rel="stylesheet" href="css/layouts/marketing.css">
    <!--<![endif]-->
    <link rel="stylesheet" href="css/home.css">

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/rodape.css">

    <!-- jQuery library -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>

    <link href='https://fonts.googleapis.com/css?family=UnifrakturMaguntia' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Hammersmith+One' rel='stylesheet' type='text/css'>

    <!-- Latest compiled JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script src="js/odometer.js"></script>
    <link rel="stylesheet" href="css/odometer.css">
</head>
<body>

<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
ini_set('html_errors', 0);
?>

<?php
include 'menu-superior.php';
?>
<script>
    $(document).ready(function () {
        <?php
        if(isset($_GET['login'])){
        ?>
        alert("Login falhou, verifique seus dados");
        <?php
        }if(isset($_GET['cadastro'])){
        ?>
        alert("Cadastro feito com sucesso!")
        <?php
        }
        ?>
    })
</script>

?>

<script>
    $(function () {
        $("#busca").autocomplete({
            minLength: 1,
            source: "../controller/busca.php",
            select: function (event, ui) {
                window.location.href = 'VisualizarCampanha.php?nome=' + ui.item.value;
            }
        });
    });
</script>

<div class="splash-container">
    <div class="splash wrapper-home">
        <div class="wrapper">
            <div class="pure-u-1-3 logo-home">
                <img class="pure-img" src="img/logo.png">
            </div>
            <h1 class="pure-u-1-2 content-head titulo-home">
                Doa Ação!
            </h1>
        </div>
        <h1 class="splash-subhead texto-head">Posso ajudar campanhas com...</h1>
        <form class="pure-form" method="post" action="">
            <input id="busca" type="text" class="pure-input-rounded buscar">
        </form>
    </div>
</div>


<div class="content-wrapper home-padding">
    <div class="content">
        <h2 class="content-head is-center">Novas Campanhas</h2>
        <div class="pure-g">


            <?php
            $campanhas = $facade->getCampanhasMaisRecentes(4);

            foreach ($campanhas as $campanha) {
                ?>
                <div class="l-box pure-u-1 pure-u-md-1-2 pure-u-lg-1-4 is-center">
                    <h3 class="content-subhead">
                        <img class="imagem-home-campanha" alt="<?php echo $campanha->getTitulo() ?>"
                             src="<?php $img = $campanha->getImagem();
                             if (strlen($img) == 0) $img = "img/campanhas/perfil-padrao.png";
                             echo $img; ?>">
                        <p>
                            <a href="VisualizarCampanha.php?id=<?php echo $campanha->getId() ?>">
                                <?php echo $campanha->getTitulo(); ?>
                            </a>
                        </p>
                    </h3>
                    <p><?php echo $campanha->getDescricao() ?></p>
                </div>
                <?php
            }
            ?>


        </div>
    </div>

    <div class="ribbon l-box-lrg pure-g">
        <div class="pure-u-1 pure-u-md-1-2 pure-u-lg-3-5">
            <h2 class="content-head content-head-ribbon">Doar é mais que caridade!</h2>
            <p>
                O ato de doar é bem mais do que simples caridade, é um ato de amor ao próximo.
                Doando aquele item que não tem mais "utilidade", você preserva a natureza (evitando
                o descarte indevido) e além disso ajuda aquele que realmente necessita.
            </p>
        </div>
        <div class="l-box-lrg is-center pure-u-1 pure-u-md-1-2 pure-u-lg-2-5">
            <img class="pure-img-responsive" alt="Doar é mais que caridade!" width="200"
                 src="img/home/painel-doacao.png">
        </div>
    </div>

    <div class="content">
        <h2 class="content-head is-center">Campanhas completadas com sucesso</h2>

        <div class="pure-g">

            <?php
            $campanhas = $facade->getCampanhasCompletas(4);

            foreach ($campanhas as $campanha) {
                ?>
                <div class="l-box pure-u-1 pure-u-md-1-2 pure-u-lg-1-4 is-center">
                    <h3 class="content-subhead">
                        <img class="imagem-home-campanha" alt="<?php echo $campanha->getTitulo() ?>"
                             src="<?php $img = $campanha->getImagem();
                             if (strlen($img) == 0) $img = "img/campanhas/perfil-padrao.png";
                             echo $img; ?>">
                        <p>
                            <a href="VisualizarCampanha.php?id=<?php echo $campanha->getId() ?>">
                                <?php echo $campanha->getTitulo(); ?>
                            </a>
                        </p>
                    </h3>
                    <p><?php echo $campanha->getDescricao() ?></p>
                </div>
                <?php
            }
            ?>

        </div>
    </div>

    <div class="ribbon l-box-lrg pure-g">
        <div class="l-box-lrg is-center pure-u-1 pure-u-md-1-2 pure-u-lg-2-5">
            <div class="odometer contador" id="odometer">
                0
            </div>
        </div>
        <div class="pure-u-1 pure-u-md-1-2 pure-u-lg-3-5">
            <h2 class="content-head content-head-ribbon">
                Campanhas concluídas com sucesso!
            </h2>
            <p>
                Nós já conseguimos ajudar bastante gente e conseguimos ver o resultado disso.
                Contribua com as campanhas, ajude-nos a melhorar esse número e faça a vida de alguém melhor!
            </p>
        </div>
    </div>

    <div id="sobre" class="content">
        <h2 class="content-head is-center">Sobre o Doa Ação</h2>
        <div class="pure-g">
            <div class="l-box-lrg pure-u-1 pure-u-md-2-5">
                <form class="pure-form pure-form-stacked" action="php/contato.php" method="get">
                    <fieldset>
                        <label for="nome">Seu Nome</label>
                        <input name="nome" id="nome" type="text" placeholder="Nome" required>

                        <label for="email">Seu Email</label>
                        <input name="email" id="email" type="email" placeholder="Email" required>


                        <textarea name="mensagem" class="pure-input-1" placeholder="Sua mensagem" required></textarea>

                        <button type="submit" class="pure-button">Enviar</button>
                    </fieldset>
                </form>
            </div>

            <div class="l-box-lrg pure-u-1 pure-u-md-3-5">
                <h4>Sobre o Doa Ação!</h4>
                <p>
                    O sistema Doa Ação! foi desenvolvido pela empresa Minerva Software
                    com o propósito de gerenciar campanhas de doação. Aqui você pode
                    criar campanhas em benefício de uma causa ou contribuir naquelas
                    que já existentem.
                </p>
                <h4>Nossa motivação</h4>
                <p class="texto-home">
                    A principal regra da vida diz que é preciso dar, para receber.
                    Não importa se é amor, saúde ou dinheiro. Dê amor, para receber amor.
                    Dê equilíbrio a si mesmo, para receber uma saúde equilibrada.
                    Ofereça algo de valor aos outros, para receber sua recompensa.
                </p>
                <p>
                    Autor Desconhecido
                </p>
            </div>
        </div>

    </div>

    <div class="footer rodape l-box is-center">
        "A caridade é o único tesouro que se aumenta ao dividi-lo." Cesare Cantú
        <br>
        <br>
        <img class="pure-img-responsive" alt="File Icons" width="200" src="img/logo_minerva_sem_fundo.png">
        <p class="is-center">
        <h1 class="minerva-nome">minerva</h1>
        <h1 class="minerva-subnome">software</h1>
        </p>
    </div>

</div>

<script>
    $(window).scroll(function () {
        var hT = $('.odometer').first().offset().top,
            hH = $('.odometer').first().outerHeight(),
            wH = $(window).height(),
            wS = $(this).scrollTop();
        if (wS > (hT + hH - wH)) {
            setTimeout(function () {
                odometer.innerHTML = <?php echo json_encode($facade->getNumCampanhasCompletas()); ?>;
            }, 1000);
        }
    });

    $(document).ready(function () {
        $('a[href^="#"]').on('click', function (e) {
            e.preventDefault();
            var target = this.hash;
            $target = $(target);
            $('html, body').stop().animate({
                'scrollTop': $target.offset().top //no need of parseInt here
            }, 900, 'swing', function () {
                window.location.hash = target;
            });
        });
    });
</script>
</body>
</html>
