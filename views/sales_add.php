<h1>Cadastrar Venda</h1>

<?php if (isset($error_msg) && !empty($error_msg)) {
    echo "<div class='warn'>".$error_msg."</div>";
} ?>

<form method="POST">
    <div class="row">
        <div class="col-md-3">
            <label for="client_name">Nome Cliente</label><br/>
            <input type="hidden" name="client_id">
            <input type="text" name="client_name" id="client_name" data-type="search_clients" required />
        </div>
        <div class="col-md-4">
            <label for="client_email">E-mail Cliente</label><br/>
            <input type="text" name="client_email" id="client_email" />
        </div>
        <div class="col-md-1">
            <br/>
            <button class="client_add_button">+</button><br/><br/>
        </div>
        <div class="col-md-4"></div>
    </div>

    <div class="row mt-1">
        <div class="col-md-6">
            <label for="status">Status Venda</label>
            <select name="status" id="status">
                <option value="0">Aguardando Pgto.</option>
                <option value="1">Pago</option>
                <option value="2">Vencido</option>
            </select>
        </div>
        <div class="col-md-6">
            <label for="total_price">Total Venda</label>
            <input type="text" name="total_price">
        </div>
    </div>

    <br/><br/>

    <input type="submit" value="Cadastrar" />
</form>

<script type="text/javascript" src="<?=BASE_URL?>/assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?=BASE_URL?>/assets/js/script_sales_add.js"></script>