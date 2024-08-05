<h1>Editar Produto</h1>

<?php if (isset($error_msg) && !empty($error_msg)) {
    echo "<div class='warn'>".$error_msg."</div>";
} ?>

<form method="POST">
    <label for="name">Nome</label><br/>
    <input type="text" name="name" value="<?=$inventory_info['name'];?>" required /><br/><br/>

    <label for="price">Preço</label><br/>
    <input type="text" name="price" value="<?=number_format($inventory_info['price'],2,',','.');?>" required /><br/><br/>

    <label for="quant">Quantidade</label><br/>
    <input type="number" name="quant" value="<?=$inventory_info['quant'];?>" required /><br/><br/>

    <label for="minQuant">Quantidade Mínima</label><br/>
    <input type="number" name="minQuant" value="<?=$inventory_info['minQuant'];?>" required /><br/><br/>

    <br/><br/>

    <input type="submit" value="Editar" />
</form>

<script type="text/javascript" src="<?=BASE_URL?>/assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?=BASE_URL?>/assets/js/script_inventory_add.js"></script>