<?php if (isset($_POST['cpf'])) { ?>
    <div id="modal-confirmar" class="modal show" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button onclick=" $('.modal').removeClass('show');" type="button" class="close"
                            data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Doações do usuário</h4>
                </div>
                <div class="modal-body">
                    <form action="confirmarDoacao.php?id=<?php echo $_GET['id'] ?>" method="post" target="_top">
                        <div class="selecao">
                            <?php $doacoes = $facade->getDoacoesCpf($_POST['cpf']);
                            foreach ($doacoes as $doacao) {
                                ?>
                                <input type="radio" name="doacao" value="<?php echo $doacao->getId() ?>">
                                <?php echo $facade->getNomeCampanha($doacao->getId()) . ", " .
                                    $doacao->getDescricao() . ". Quantidade = " . $doacao->getQuantidade() ?><br>
                            <?php } ?>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <i>Obrigado!</i>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>

<?php
$id = $_SESSION['usuario']->getId();
if ($facade->getPontoColetaUsuario($id) == null) {
    $ponto = $facade->getPontoColetaUsuario($id);
    ?>
    <h3>Criar Novo Ponto de Coleta</h3>
    <script type="text/javascript">
        window.onload = function () {
            new dgCidadesEstados(document.getElementById('estado'), document.getElementById('cidade'), true);
        }
    </script>
    <form class="pure-form pure-form-stacked pure-u-1-2" action="cadastro-ponto-coleta.php" method="post">
        <fieldset>
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome">
            <label for="estado">Estado</label>
            <select id="estado" class="pure-u-1" name="estado"></select>
            <label for="cidade" class="pure-u-1">Cidade</label>
            <select id="cidade" name="cidade"></select>
            <label for="bairro">Bairro</label>
            <input type="text" id="bairro" name="bairro" required>
            <label for="endereco">Endereço</label>
            <input type="text" name="endereco" id="name" placeholder="Ex: Rua São Sebastião, Nº76" required>
            <label for="cep">CEP</label>
            <input type="text" name="cep" id="cep" required>
            <label for="telefone">Telefone</label>
            <input type="tel" name="telefone" id="telefone" required>
            <button type="submit" class="pure-button pure-button-primary" name="Concluir">
                Cadastrar Ponto de Coleta
            </button>
        </fieldset>
    </form>

<?php } else if ($facade->getPontoColetaUsuario($id)->getIdCampanha() == null) { ?>
    <h4>Para continuar, alguma campanha deve indicar este ponto de coleta</h4>

<?php } else {
    $ponto = $facade->getPontoColetaUsuario($id);
    ?>

    <h3>Ponto de Coleta: <?php echo $ponto->getNome() ?></h3>
    <h4>Campanha: <?php echo $facade->getNomeCampanha($ponto->getIdCampanha()) ?></h4>
    <div class="pure-u-1">
        <div class="pure-u-1-3">
            <h4>Confirmar Doação</h4>
            <form class="pure-form pure-form-aligned" method="post" action=""
                  name="form2">
                <fieldset>
                    <label for="textname">CPF do Doador </label>
                    <input id="nome" type="text" name="cpf" placeholder="Insira o CPF">
                    <button type="submit" class="pure-button pure-button-primary pure-u-1">Buscar Doação</button>
                </fieldset>
            </form>
            <h4>Doação Anônima</h4>
            <form class="pure-form pure-form-aligned" method="post" action="IntegracaoCadastroUsuario.php?id=<?php echo
            $ponto->getIdCampanha() ?>"
                  name="form2">
                <fieldset>
                    <!-- TODO: especificar unidades de doação -->
                    <label for="textname">Quantidade recebida</label>
                    <input id="nome" type="number" name="meta" placeholder="Insira a Quantidade">
                    <button type="submit" class="pure-button pure-button-primary pure-u-1">Confirmar</button>
                </fieldset>
            </form>
        </div>
        <div class="pure-u-1-3 esquerda">
            <h4>Cadastro Rápido de Doador</h4>
            <form class="pure-form pure-form-aligned" method="post" action="ScriptCadastroRapido.php"
                  name="form2">
                <fieldset>
                    <label for="textname">Nome </label>
                    <input id="nome" type="text" name="nome" placeholder="Insira o nome" required>
                    <label for="email">E-mail </label>
                    <input id="email" type="email" name="email" placeholder="nome@servidor.com" required>
                    <label for="CPF">CPF </label>
                    <input id="CPF" type="text" name="cpf" maxlength="11" placeholder="Insira o CPF" required>
                    <button type="submit" class="pure-button pure-button-primary pure-u-1">Cadastrar</button>
                </fieldset>
            </form>
        </div>
    </div>
<?php } ?>