<!DOCTYPE html>
<html lang="en">

<!-- Cabecalho-->
<?php
include 'debug.php';
include 'cabecalho.php';
?>

<body>

<!-- Menu superior -->
<?php
include 'menu-superior.php';
?>

<div class="content-wrapper conteudo">
    <div class="content ">
        <h2 class="content-head is-center titulo-publico">
            <?php
            if(isset($_GET['modo'])) {
                $modo = $_GET['modo'];
            } else if (!isset($_GET['categoria'])) {
                $modo = 'recentes';
            } else {
                $modo = 'categoria';
            }
            $inicio = 1;
            $qtdMostrar = 8;
            $quantidade = 0;
            if(isset($_GET['inicio'])){
                $inicio =  $_GET['inicio'];
            }
            if (strcmp($modo, 'recentes') == 0) {
                echo 'Campanhas Recentes';
                $campanhas = $facade->getCampanhasMaisRecentes($qtdMostrar,($inicio-1)*$qtdMostrar);
                $quantidade = $facade->getNumCampanhasRecentes();
            } else if (strcmp($modo, 'finalizando') == 0) {
                echo 'Campanhas Na reta final';
                $campanhas = $facade->getCampanhasFinalizando($qtdMostrar, ($inicio-1)*$qtdMostrar);
                $quantidade =$facade->getNumCampanhasFinalizando();
            } else if (strcmp($modo, 'finalizadas') == 0) {
                echo 'Campanhas Finalizadas';
                $campanhas = $facade->getCampanhasCompletas($qtdMostrar, ($inicio-1)*$qtdMostrar);
                $quantidade = $facade->getNumCampanhasCompletas();
            }
            if (isset($_GET['categoria'])) {
                echo 'Campanhas da Categoria ' . $_GET['categoria'];
                $campanhas = $facade->getCampanhasTipo($_GET['categoria'], $qtdMostrar, ($inicio - 1) * $qtdMostrar);
                $quantidade = $facade->getQtdCampanhasTipo($_GET['categoria']);
            }
            $paginas = $quantidade/$qtdMostrar;
            if($quantidade%$qtdMostrar > 0){
                $paginas+=1;
            }
            ?>
        </h2>
        <!-- Corpo da Página -->


        <div class="content">
            <div class="pure-g">

                <?php

                foreach ($campanhas as $campanha) {
                    echo '<div class="l-box pure-u-1-4 pure-u-md-1-2 pure-u-lg-1-4 is-center">';
                    echo '<h3 class="content-subhead">';
                    $img = $campanha->getImagem();
                    if (strlen($img) == 0) $img = "img/campanhas/perfil-padrao.png";
                    echo ' <img class="pure-img-responsive" alt="' . $campanha->getTitulo() . '" width="200" src="' . $img . '">';
                    echo '<p><a href="VisualizarCampanha.php?id=' . $campanha->getId() . '">';
                    echo $campanha->getTitulo();
                    echo '</a></p>';
                    echo '</h3>';
                    echo '<p>' . $campanha->getDescricao() . '</p>';
                    echo '</div>';
                }
                ?>

            </div>

        </div>

    </div>

    <nav class="is-center">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="<?php echo $_SERVER['PHP_SELF'].'?inicio='. ($inicio>1? $inicio-1:$inicio) .'&modo=' . $modo ?>" aria-label="Previous">
                    <span aria-hidden="true">Anterior</span>
                    <span class="sr-only">Anterior</span>
                </a>
            </li>
            <?php
                for($i = 1; $i<$paginas; $i++) {
                    ?>
                    <li class="page-item <?php if($inicio==$i) echo'active'?>">
                        <a class="page-link" href="<?php echo $_SERVER['PHP_SELF'].'?inicio='.$i .'&modo=' . $modo ?>">
                            <?php echo $i ?>
                        </a>
                    </li>

                    <?php
                }
            ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo $_SERVER['PHP_SELF'].'?inicio='. ($inicio<$paginas-1? $inicio+1:$inicio) .'&modo=' . $modo ?>" aria-label="Próxima">
                    <span aria-hidden="true">Próxima</span>
                    <span class="sr-only">Próxima</span>
                </a>
            </li>
        </ul>
    </nav>

    <?php include 'rodape.php' ?>
</div>
<!-- Rodapé -->


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
</body>
</html>
