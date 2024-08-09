<h1>Vendas</h1>

<div class="button"><a href="<?=BASE_URL;?>/sales/add">Cadastrar Venda</a></div>

<table border="0" width="100%">
    <tr>
        <th>Nome Cliente</th>
        <th>Data Venda</th>
        <th>Status</th>
        <th>Valor Total</th>
        <th>Ações</th>
    </tr>
    <?php foreach($sales_list AS $v) { ?>
        <tr>
            <td><?=$v['clientName'];?></td>
            <td><?=date('d/m/Y', strtotime($v['dateSale']));?></td>
            <td><?=$statusName[$v['status']];?></td>
            <td><?=number_format($v['totalPrice'], 2, ',', '.');?></td>
            <td width="145">
                <div class="button button_small"><a href="<?= BASE_URL;?>/sales/edit/<?= $v['id'];?>">Mais Detalhes</div>
            </td>
        </tr>
        <?php
    } ?>
</table>