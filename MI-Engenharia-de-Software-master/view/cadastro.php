<!DOCTYPE html>
<html lang="en">

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

<div class="content-wrapper-private conteudo">
    <div class="content wrapper-private">
        <h2 class="content-head is-center">Novo Usuário</h2>
        <!-- Corpo da Página -->
        <form action="IntegracaoCadastroUsuario.php" method="post" name="cad"
              class="pure-form pure-form-stacked pure-u-1">
            <fieldset>
                <div class="etapa1 pure-u-1-3">
                    <label for="nome">Nome</label>
                    <input type="text" name="txt_nome" id="nome" required>

                    <label for="cpf">CPF</label>
                    <input type="text" name="txt_cpf" id="cpf" maxlength="11" required>

                    <label for="email">Email</label>
                    <input type="text" name="txt_email" id="email" required>

                    <label for="login">Login</label>
                    <input type="text" name="login" id="login" required>

                    <label for="senha">Senha</label>
                    <input type="password" name="txt_senha" id="senha" required>

                    <label for="confsenha">Confirmar senha</label>
                    <input type="password" name="txt_confsenha" id="confsenha" required>


                </div>

                <div class="etapa2 pure-u-1-3 esquerda margem-formulario">
                    <label for="categoria">Categorias de Interesses</label>
                    <div class="categorias">
                        <div id="categorias" class="container-categorias container-fluid row-fluid">
                            <?php
                            $categorias = $facade->getNomesCategorias();

                            foreach ($categorias as $categoria) { ?>
                                <div class="span3 checkbox">
                                    <input id="<?php echo $categoria ?>" class="checkbox-inline"
                                           type="checkbox" name="categoria[]" value="<?php echo $categoria ?>">
                                    <label for="<?php echo $categoria ?>" class="pure-checkbox">
                                        <?php echo $categoria ?>
                                    </label>

                                </div>
                            <?php }
                            ?>
                        </div>
                    </div>


                    <input type="button" name="Termos de serviço" value="Termos de serviço" class="pure-button"
                           id="termos">
                </div>

                <div class="etapa3 pure-u-1-3 esquerda margem-formulario">
                    <script type="text/javascript">
                        window.onload = function () {
                            new dgCidadesEstados(document.getElementById('estado'), document.getElementById('cidade'), true);
                        }
                    </script>

                    <label for="estado">Estado</label>
                    <select id="estado" name="estado" required></select>
                    <label for="cidade">Cidade</label>
                    <select id="cidade" name="cidade" required></select>
                    <label for="cidade">Bairro</label>
                    <input type="text" id="bairro" name="bairro" required>
                    <label for="endereco">Endereço</label>
                    <input type="text" name="endereco" id="name" placeholder="Ex: Rua São Sebastião, Nº76" required>
                    <label for="CEP">CEP</label>
                    <input type="text" name="cep" id="cep" required>
                    <label for="telefone">Telefone</label>
                    <input type="tel" name="telefone" id="telefone" required>

                    <div class="genero">
                        <label for="male">Masculino</label>
                        <input id="male" type="radio" name="genero" value="m">
                        <label for="female">Feminino</label>
                        <input id="female" type="radio" name="genero" value="f">
                    </div>

                </div>

                <div class="botoes center-block is-center">
                    <div class="pure-u-1-4 ">
                        <a href="home.php">
                            <input type="button" name="Cancelar" value="cancelar" class="pure-button">
                        </a>
                    </div>
                    <div class="pure-u-1-4 ">
                        <input type="submit" name="Concluir" value="concluir" class="pure-button">
                    </div>
                </div>

            </fieldset>
        </form>

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
</body>
</html>
