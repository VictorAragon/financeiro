<h1>Adicionar Clientes</h1>

<?php if (isset($error_msg) && !empty($error_msg)) {
    echo "<div class='warn'>".$error_msg."</div>";
} ?>

<form method="POST">
    <label for="name">Nome</label><br/>
    <input type="text" name="name" required /><br/><br/>

    <label for="email">Email</label><br/>
    <input type="email" name="email" required /><br/><br/>

    <label for="phone">Telefone</label><br/>
    <input type="text" name="phone" /><br/><br/>

    <label for="stars">Classificação</label><br/>
    <select name="stars" id="stars">
        <option value="1">1 Estrela</option>
        <option value="2">2 Estrelas</option>
        <option value="3" selected="selected">3 Estrelas</option>
        <option value="4">4 Estrelas</option>
        <option value="5">5 Estrelas</option>
    </select><br/><br/>

    <label for="internal_obs">Observações Internas</label><br/>
    <textarea name="internal_obs" id="internal_obs"></textarea><br/><br/>

    <label for="addressZipcode">CEP</label><br/>
    <input type="text" name="addressZipcode" /><br/><br/>

    <label for="address">Endereço</label><br/>
    <input type="text" name="address" /><br/><br/>

    <label for="addressNumber">Número</label><br/>
    <input type="text" name="addressNumber" /><br/><br/>

    <label for="addressComplement">Complemento</label><br/>
    <input type="text" name="addressComplement" /><br/><br/>

    <label for="addressNeighborhood">Bairro</label><br/>
    <input type="text" name="addressNeighborhood" /><br/><br/>

    <label for="addressCity">Cidade</label><br/>
    <input type="text" name="addressCity" /><br/><br/>

    <label for="addressState">Estado</label><br/>
    <input type="text" name="addressState" /><br/><br/>

    <br/><br/>

    <input type="submit" value="Adicionar" />
</form>

<script type="text/javascript" src="<?=BASE_URL?>/assets/js/script_clients_add.js"></script>