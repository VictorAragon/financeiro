<h1>Usuários</h1>

<div class="button"><a href="<?= BASE_URL;?>/users/add">Adicionar Usuário</a></div>
<table border="0" width="100%">
    <tr>
        <th>id</th>
        <th>E-mail</th>
        <th>Grupo de Permissões</th>
        <th>Ações</th>
        <th></th>
    </tr>
    <?php 
    foreach($users_list AS $v) { ?>
        <tr>
            <td width="40"><?=$v["id"];?></td>
            <td><?=$v["email"];?></td>
            <td width="200"><?=$v["name"];?></td>
            <td width="50">
                <div class="button button_small"><a href="<?= BASE_URL;?>/users/edit/<?= $v['id'];?>">Editar</div>
            </td>
            <td width="50">
                <div class="button button_small"><a href="<?= BASE_URL;?>/users/delete/<?= $v['id'];?>" onclick="return confirm('Deseja realmente excluir?')">Excluir</div>
            </td>
        </tr>
        <?php
    } ?>

</table>