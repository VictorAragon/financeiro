<h1>Adicionar Usuário</h1>

<?php if (isset($error_msg) && !empty($error_msg)) {
    echo "<div class='warn'>".$error_msg."</div>";
} ?>

<form method="POST">
    <label for="email">E-mail do Usuário</label><br/>
    <input type="email" name="email" required /><br/><br/>

    <label for="password">Senha do Usuário</label><br/>
    <input type="password" name="password" required /><br/><br/>

    <label for="group">Grupo de Permissões</label><br/>
    <select name="group" id="group" required>
        <?php
        foreach($group_list AS $v) { ?>
            <option value="<?=$v['id'];?>"><?=$v['name'];?></option>
            <?php
        } ?>
    </select><br/><br/>

    <input type="submit" value="Adicionar" />
</form>