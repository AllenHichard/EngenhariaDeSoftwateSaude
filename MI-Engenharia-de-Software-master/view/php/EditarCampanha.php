<div class="pure-u-1-1">
    <div class="pure-u-1-3">
        <h3>Editar Campanha</h3>
        <h5>Deixe em branco os campos que não deseje alterar</h5>
        <form class="pure-form pure-form-aligned" method="post"
              action="atualizarCampanha.php?id=<?php echo $campanha->getId() ?>">
            <fieldset>
                <label for="name">Editar Título</label>
                <input id="name" type="text" placeholder="<?php echo $campanha->getTitulo() ?>" name="titulo">
                <label for="descricao">Alterar Descrição</label>
                    <textarea id="descricao" class="pure-u-1-1" rows="4" name="descricao"
                              placeholder="<?php echo $campanha->getDescricao() ?>"></textarea>

                <label for="inicio">Alterar Data Início</label>
                <input id="inicio" type="date" name="inicio" placeholder="<?php echo $campanha->getDataInicio() ?>">

                <label for="final">Alterar Data Final</label>
                <input id="final" type="date" name="fim" placeholder="<?php echo $campanha->getDataFIm() ?>">
                <button type="submit" class="pure-button pure-button-primary">Salvar Alterações</button>

                <?php if (isset($_GET['finalizado'])) echo '<h4>Alterações salvas!</h4>' ?>
            </fieldset>
        </form>
        <form action="cancelarCampanha.php" method="get">
            <input hidden type="text" name="id" placeholder="<?php echo $_GET['editar'] ?>">
            <button type="submit" class="btn btn-primary btn-danger" id="cancelar-campanha" disabled>
                Encerrar Campanha
            </button>
        </form>
    </div>

    <div class="pure-u-1-3 esquerda">
        <h3>Pontos de Coleta</h3>
        <table class="pure-table">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Responsável</th>
                <th>Endereço</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $pontos = $facade->getPontosCampanha($campanha->getId());
            foreach ($pontos as $ponto) {
                ?>
                <tr>
                    <td><?php echo $ponto['nome'] ?></td>
                    <td><?php echo $ponto['responsavel'] ?></td>
                    <td><?php $ponto['endereco'] //TODO: get endereco
                        ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <form class="pure-form" method="post" action="atualizarCampanha.php?id=<?php echo $campanha->getId() ?>">
            <fieldset>
                <label for="responsavel">Adicionar novo Ponto de Coleta</label>
                <input type="text" id="responsavel" placeholder="Digite o CPF do responsável" name="responsavel">
                <button type="submit" class="pure-button pure-button-primary">Adicionar</button>
            </fieldset>
        </form>
    </div>
</div>