<h1>Compras</h1>

<div class="button"><a href="<?=BASE_URL;?>/purchases/add">Cadastrar Compra</a></div>

<table border="0" width="100%">
    <tr>
        <th>Nome Produto</th>
        <th>Data Compra</th>
        <th>Quantidade</th>
        <th>Valor Unitário</th>
        <th>Valor Total</th>
        <th>Ações</th>
        <th></th>
    </tr>
    <?php foreach($purchases_list AS $v) { ?>
        <tr>
            <td><?=$v['name'];?></td>
            <td><?=date('d/m/Y', strtotime($v['datePurchase']));?></td>
            <td><?=$v['quant'];?></td>
            <td><?=number_format($v['purchasePrice'], 2, ',', '.');?></td>
            <td><?=number_format(($v['purchasePrice']*$v['quant']), 2, ',', '.');?></td>
            <td width="50">
                <div class="button button_small"><a href="<?= BASE_URL;?>/purchases/edit/<?= $v['id'];?>">Editar</div>
            </td>
            <td width="50">
                <div class="button button_small"><a href="<?= BASE_URL;?>/purchases/delete/<?= $v['id'];?>" onclick="return confirm('Deseja realmente excluir?')">Excluir</div>
            </td>
        </tr>
        <?php
    } ?>
</table>