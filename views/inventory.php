<h1>Estoque</h1>

<?php if ($edit_permission) { ?>
    <div class="button"><a href="<?= BASE_URL;?>/inventory/add">Adicionar Produto</a></div>
<?php } ?>

<input type="text" id="busca" data-type="search_inventory" />

<table border="0" width="100%">
    <tr>
        <th>Nome</th>
        <th>Preço</th>
        <th>Quantidade</th>
        <th>Quant. Mínima</th>
        <th>Ações</th>
        <th></th>
    </tr>
    <?php foreach($inventory_list AS $v) {
        $bgColor = "";
        if($v['minQuant'] > $v['quant']) {
            $bgColor = "background-color: #cb7575; color: #fff;";
        } ?>
        <tr>
            <td style="<?=$bgColor;?>"><?=$v['name'];?></td>
            <td style="<?=$bgColor;?>"><?=number_format($v['price'],2,',','.');?></td>
            <td style="width: 50px; text-align: center;<?=$bgColor;?>"><?=$v['quant'];?></td>
            <td style="width: 120px; text-align: center;<?=$bgColor;?>"><?=$v['minQuant'];?></td>
            <td width="50" style="<?=$bgColor;?>">
                <div class="button button_small"><a href="<?= BASE_URL;?>/inventory/edit/<?= $v['id'];?>">Editar</div>
            </td>
            <td width="50" style="<?=$bgColor;?>">
                <div class="button button_small"><a href="<?= BASE_URL;?>/inventory/delete/<?= $v['id'];?>" onclick="return confirm('Deseja realmente excluir?')">Excluir</div>
            </td>
        </tr>
        <?php
    } ?>
</table>