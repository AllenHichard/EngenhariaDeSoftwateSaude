<?php
$usuario = $_SESSION['usuario'];
?>
<form action="IntegracaoCadastroUsuario.php" method="post" name="cad"
      class="pure-form pure-form-stacked pure-u-1">
    <fieldset>
        <div class="etapa1 pure-u-1-3">
            <label for="nome">Nome</label>
            <input type="text" placeholder="<?php echo $usuario->getNome(); ?>" disabled>

            <label for="cpf">CPF</label>
            <input type="text" placeholder="<?php echo $usuario->getCpf() ?>" disabled>

            <label for="email">Email</label>
            <input type="text" placeholder="<?php echo $usuario->getEmail() ?>" disabled>

            <label for="login">Login</label>
            <input type="text" placeholder="<?php echo $usuario->getLogin() ?>" disabled>

            <label for="senha">Senha</label>
            <input type="password" name="txt_senha" id="senha" required>
        </div>

        <div class="etapa2 pure-u-1-3 esquerda margem-formulario">
            <label for="categoria">Categorias de Interesses</label>
            <div class="categorias">
                <div id="categorias" class="container-categorias container-fluid row-fluid">
                    <?php
                    $categorias = $facade->getNomesCategorias();
                    ?>

                    <?php
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
            <select id="estado" name="estado" placeholder="<?php $usuario->getEndereco()->getEstado() ?>"></select>
            <label for="cidade">Cidade</label>
            <select id="cidade" name="cidade" placeholder="<?php $usuario->getEndereco()->getCidade() ?>"></select>
            <label for="cidade">Bairro</label>
            <input type="text" id="bairro" name="bairro" placeholder="<?php $usuario->getEndereco()->getBairro() ?>">
            <label for="endereco">Endereço</label>
            <input type="text" name="endereco" id="name" placeholder="<?php $usuario->getEndereco()->getRua() ?>">
            <label for="CEP">CEP</label>
            <input type="text" name="cep" id="cep" placeholder="<?php $usuario->getEndereco()->getCep() ?>">
            <label for="telefone">Telefone</label>
            <input type="tel" name="telefone" id="telefone" placeholder="<?php echo $usuario->getTelefone() ?>">


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