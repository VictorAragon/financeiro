<h1>Editar Cliente</h1>

<?php if (isset($error_msg) && !empty($error_msg)) {
    echo "<div class='warn'>".$error_msg."</div>";
} ?>

<form method="POST">
    <label for="name">Nome</label><br/>
    <input type="text" name="name" value="<?=$client_info['name'];?>" required /><br/><br/>

    <label for="email">Email</label><br/>
    <input type="email" name="email" value="<?=$client_info['email'];?>" required /><br/><br/>

    <label for="phone">Telefone</label><br/>
    <input type="text" name="phone" value="<?=$client_info['phone'];?>" /><br/><br/>

    <label for="stars">Classificação</label><br/>
    <select name="stars" id="stars">
        <option value="1" <?=($client_info['stars'] == 1)? 'selected="selected"':'';?>>1 Estrela</option>
        <option value="2" <?=($client_info['stars'] == 2)? 'selected="selected"':'';?>>2 Estrelas</option>
        <option value="3" <?=($client_info['stars'] == 3)? 'selected="selected"':'';?>>3 Estrelas</option>
        <option value="4" <?=($client_info['stars'] == 4)? 'selected="selected"':'';?>>4 Estrelas</option>
        <option value="5" <?=($client_info['stars'] == 5)? 'selected="selected"':'';?>>5 Estrelas</option>
    </select><br/><br/>

    <label for="internal_obs">Observações Internas</label><br/>
    <textarea name="internal_obs" id="internal_obs"><?=$client_info['internal_obs'];?></textarea><br/><br/>

    <label for="addressZipcode">CEP</label><br/>
    <input type="text" name="addressZipcode" value="<?=$client_info['addressZipcode'];?>" /><br/><br/>

    <label for="address">Endereço</label><br/>
    <input type="text" name="address" value="<?=$client_info['address'];?>" /><br/><br/>

    <label for="addressNumber">Número</label><br/>
    <input type="text" name="addressNumber" value="<?=$client_info['addressNumber'];?>" /><br/><br/>

    <label for="addressComplement">Complemento</label><br/>
    <input type="text" name="addressComplement" value="<?=$client_info['addressComplement'];?>" /><br/><br/>

    <label for="addressNeighborhood">Bairro</label><br/>
    <input type="text" name="addressNeighborhood" value="<?=$client_info['addressNeighborhood'];?>" /><br/><br/>

    <label for="addressCity">Cidade</label><br/>
    <input type="text" name="addressCity" value="<?=$client_info['addressCity'];?>" /><br/><br/>

    <label for="addressState">Estado</label><br/>
    <input type="text" name="addressState" value="<?=$client_info['addressState'];?>" /><br/><br/>

    <br/><br/>

    <input type="submit" value="Editar" />
</form>

<script type="text/javascript" src="<?=BASE_URL?>/assets/js/script_clients_add.js"></script>