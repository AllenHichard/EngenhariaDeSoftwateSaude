<?php
/**
 * Created by PhpStorm.
 * User: dcandrade
 * Date: 4/4/16
 * Time: 12:09 PM
 */

?>


<div class="pure-u-1-3">
    <div class="pure-control-group">
        <label for="name">Nome da Campanha</label>
        <input id="name" type="text" placeholder="Nome da Campanha" name="txtnome">
    </div>
    <div class="pure-control-group">
        <label for="datainicio">Informar Data de Início</label>
        <input id="datainicio" type="date" name="datainicio">
    </div>
    <div class="pure-control-group">
        <label for="datafinal">Informar Data de Final</label>
        <input id="datafinal" type="date" name="datafinal">
    </div>
    <div class="pure-control-group">
        <label for="descrever">Descrever Campanha</label>
        <textarea id="descrever" class="pure-u-1-1" rows="5" name="descricao"
                  placeholder="Limite de 5000 caracteres"></textarea>
    </div>

</div>
<div class="pure-u-1-2 margem-formulario">
    <!-- Coisas específicas do tipo da Campanha -->
    <div class="pure-u-1-2">
        <label for="meta">Meta (Dias para Tempo, R$ para Financeira)</label>
        <input id="meta" class type="number" placeholder="" name="meta">
    </div>
    <div class="pure-u-1-2 esquerda margem-formulario">
        <label for="imagem">Imagem da Campanha</label>
        <input id="imagem" type="file" name="imagem">
    </div>
    <div class=" pure-u-1-2">
        <label for="categorias">Selecione as Categorias</label>
        <div id="categorias" class="container-categorias container-fluid row-fluid">
            <?php
            $categorias = $facade->getNomesCategorias();

            foreach ($categorias as $categoria) { ?>
                <div class="span3 checkbox">
                    <input id="<?php echo $categoria ?>" class="estilo-checkbox"
                           type="checkbox" name="categoria[]" value="<?php echo $categoria ?>">
                    <label for="<?php echo $categoria ?>" class="pure-checkbox">
                        <?php echo $categoria ?>
                    </label>

                    <?php
                    //$facade->detectarDoadores($categoria);
                    ?>
                </div>
            <?php }
            ?>
        </div>

    </div>
    <div class="pure-u-1-2 esquerda">
        <label for="agradecimento">Agradecimento Padrão</label>
                             <textarea id="agradecimento" class="pure-u-1-1" rows="4" name="agradecimento"
                                       placeholder="Limite de 1000 caracteres"></textarea>

    </div>


