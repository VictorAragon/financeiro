<h1>Permissões</h1>

<div class="tabArea">
    <div class="tabItem activeTab">Grupo de Permissões</div>
    <div class="tabItem">Permissões</div>
</div>
<div class="tabContent">
    <div class="tabBody" style="display: block;">
        <div class="button"><a href="<?= BASE_URL;?>/permissions/add_group">Adicionar Grupos de Permissões</a></div>
        <table border="0" width="100%">
            <tr>
                <th>Nome do Grupo</th>
                <th>Ações</th>
                <th></th>
            </tr>
            <?php 
            foreach($permissions_groups_list AS $v) { ?>
                <tr>
                    <td><?=$v["name"];?></td>
                    <td width="50">
                        <div class="button button_small"><a href="<?= BASE_URL;?>/permissions/edit_group/<?= $v['id'];?>">Editar</div>
                    </td>
                    <td width="50">
                        <div class="button button_small"><a href="<?= BASE_URL;?>/permissions/delete_group/<?= $v['id'];?>" onclick="return confirm('Deseja realmente excluir?')">Excluir</div>
                    </td>
                </tr>
                <?php
            } ?>

        </table>
    </div>
    <div class="tabBody">
        <div class="button"><a href="<?= BASE_URL;?>/permissions/add">Adicionar Permissão</a></div>
        <table border="0" width="100%">
            <tr>
                <th>Nome Permissão</th>
                <th>Ações</th>
            </tr>
            <?php 
            foreach($permissions_list AS $v) { ?>
                <tr>
                    <td><?=$v["name"];?></td>
                    <td width="50">
                        <div class="button button_small"><a href="<?= BASE_URL;?>/permissions/delete/<?= $v['id'];?>" onclick="return confirm('Deseja realmente excluir?')">Excluir</div>
                    </td>
                </tr>
                <?php
            } ?>

        </table>
    </div>

</div>