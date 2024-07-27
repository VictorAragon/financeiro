<h1>Clientes</h1>

<?php if ($edit_permission) { ?>
    <div class="button"><a href="<?= BASE_URL;?>/clients/add">Adicionar Cliente</a></div>
<?php } ?>

<input type="text" id="busca" data-type="search_clients" />

<table border="0" width="100%">
    <tr>
        <th>Nome</th>
        <th>Telefone</th>
        <th>Cidade</th>
        <th>Nota</th>
        <th>Ações</th>
        <th></th>
    </tr>
    <?php 
    foreach($clients_list AS $v) { ?>
        <tr>
            <td><?=$v["name"];?></td>
            <td><?=$v["phone"];?></td>
            <td><?=$v["addressCity"];?></td>
            <td><?=$v["stars"];?></td>
            <?php if ($edit_permission) { ?>
                <td width="50">
                    <div class="button button_small"><a href="<?= BASE_URL;?>/clients/edit/<?= $v['id'];?>">Editar</div>
                </td>
                <td width="50">
                    <div class="button button_small"><a href="<?= BASE_URL;?>/clients/delete/<?= $v['id'];?>" onclick="return confirm('Deseja realmente excluir?')">Excluir</div>
                </td>
            <?php } else { ?>
                <td width="10"></td>
                <td width="140">
                    <div class="button button_small"><a href="<?= BASE_URL;?>/clients/view_more/<?= $v['id'];?>">Ver Detalhes</div>
                </td>
                <?php
            } ?>
        </tr>
        <?php
    } ?>

</table>

<div class="pagination">
    <?php
    for($q=1; $q<=$p_count; $q++) { ?>
        <div class="pag_item <?=($q == $p)? 'pag_ativo':'';?>"><a href="<?=BASE_URL."/clients?p=".$q;?>"><?= $q;?></a></div>
        <?php
    } ?>
    <div style="clear: both;"></div>
</div>