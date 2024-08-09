<h1>Detalhes da Venda</h1>

<strong>Nome do Cliente:</strong><br/>
<?= $sales_info['info']['client_name']; ?><br/><br/>

<strong>Data da Venda:</strong><br/>
<?= date('d/m/Y', strtotime($sales_info['info']['dateSale'])); ?><br/><br/>

<strong>Total da Venda:</strong><br/>
<?= "R$ ".number_format($sales_info['info']['totalPrice'],2,',','.'); ?><br/><br/>

<strong>Status da Venda:</strong><br/>
<?php if($permission_edit) { ?>
    <form method='POST'>
        <select name='statusVenda'>
            <?php foreach($statusName AS $k => $v) { ?>
                <option value="<?=$k;?>" <?php echo ($k == $sales_info['info']['status'])? 'selected="selected"':''; ?>><?=$v;?></value>
                <?php 
            } ?>
        </select><br/><br/>
        <input type="submit" value="Salvar" />
    </form>
    <?php 
} else {
    echo $statusName[$sales_info['info']['status']]."<br/>";
} ?>


<hr />

<table border="0" width="100%">
    <tr>
        <th>Nome do Produto</th>
        <th>Quantidade</th>
        <th>Preço Unit.</th>
        <th>Total</th>
    </tr>
    <?php 
    $total_venda = 0;
    foreach($sales_info['products'] AS $v) { 
        $total_venda = $total_venda + ($v['salePrice']*$v['quant']); ?>
        <tr>
            <td><?= $v['name'];?></td>
            <td><?= $v['quant'];?></td>
            <td><?= "R$ ".number_format($v['salePrice'],2,',','.');?></td>
            <td><?= "R$ ".number_format(($v['salePrice']*$v['quant']),2,',','.');?></td>
        </tr>
        <?php
    } ?>
    <tr>
        <td colspan="3" style="text-align: right; font-weight: bold;">Total</td>
        <td style="font-weight: bold;"><?= number_format($total_venda,2,',','.'); ?></td>
    </tr>

</table>