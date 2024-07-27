$('input[name=addressZipcode]').on('blur', function() {
    let cep = $(this).val();

    $.ajax({
        url:'https://api.postmon.com.br/v1/cep/'+cep,
        type:'GET',
        dataType:'json',
        success:function(json) {
            if(typeof json.logradouro != 'undefined') {
                $('input[name=address]').val(json.logradouro);
                $('input[name=addressNeighborhood]').val(json.bairro);
                $('input[name=addressCity]').val(json.cidade);
                $('input[name=addressState]').val(json.estado);
                $('input[name=addressNumber]').focus();
            }
        }
    })
});