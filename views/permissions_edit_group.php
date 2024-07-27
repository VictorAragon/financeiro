<h1>Editar Grupos de Permissões</h1>

<form method="POST">
    <label for="name">Nome do Grupo</label><br/>
    <input type="text" name="name" value="<?=$group_info['name'];?>" /><br/><br/>

    <label>Permissões</label><br/>
    <?php foreach($permissions_list AS $v) { ?>
        <div class="p_item">
            <input type="checkbox" name="permissions[]" value="<?=$v['id'];?>" id="p_<?=$v['id'];?>" <?= (in_array($v['id'], $group_info['params']))? 'checked="checked"':'';?> />
            <label for="p_<?=$v["id"];?>"><?=$v["name"];?></label>
        </div>
        <?php
    } ?>
    <br /><br />
    <input type="submit" value="Editar" />
</form>