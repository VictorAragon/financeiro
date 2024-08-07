function selectClient(obj) {
    let id = $(obj).attr('data-id');
    let name = $(obj).html();
    let email = $(obj).attr('data-email');

    $('.searchresults').hide();
    $('#client_name').val(name);
    $('#client_name').attr('data-id', id);
    $('input[name=client_id]').val(id);
    $('#client_email').val(email);
    $('#client_email').attr('data-email', email);
}

function updateSubtotal(obj) {
    let quant = $(obj).val();
    if(quant <= '0') {
        $(obj).val(1);
        quant = 1;
    }

    let price = $(obj).attr('data-price');
    let subtotal = price * quant;

    $(obj).closest('tr').find('.subtotal').html('R$ '+subtotal);

    updateTotal();
}

function updateTotal() {
    let total = 0;

    for(let q=0;q<$('.p_quant').length;q++) {
        let quant = $('.p_quant').eq(q);
        let price = quant.attr('data-price');
        let subtotal = price * parseInt(quant.val());

        total += subtotal;
    }

    $('input[name=total_price').val(total);
}

function deleteProd(obj) {
    $(obj).closest('tr').remove();
}

function addProd(obj) {
    $('#add_prod').val('');
    let id = $(obj).attr('data-id');
    let name = $(obj).attr('data-name');
    let price = $(obj).attr('data-price');

    $('.searchresults').hide();

    if($('input[name="quant['+id+']"]').length == 0) {
        
        let tr = '<tr>'+
            '<td><a href="javascript:;" onclick="deleteProd(this)">X</a></td>'+
            '<td>'+name+'</td>'+
            '<td>'+
                '<input type="number" class="p_quant" name="quant['+id+']" data-price="'+price+'" onchange="updateSubtotal(this)" value="1"/>'+
            '</td>'+
            '<td>R$ '+price+'</td>'+
            '<td class="subtotal">R$ '+price.toLocaleString('pt-br', {minimumFractionDigits: 2})+'</td>'+
        '</tr>';

        $('#products_table').append(tr);
    }

    updateTotal();
}

$(function() {

    $('input[name=total_price]').mask('000.000.000.000.000.000.000,00', {reverse: true, placeholder:'0,00'});

    $('.client_add_button').on('click', function(e){
        e.preventDefault();

        let name = $('#client_name').val();
        let email = $('#client_email').val();

        if(name != '' && name.length >= 3 && email != '') {
            if(confirm('Gostaria de adicionar um cliente com o nome: '+name+' e email: '+email+'?')){
                $.ajax({
                    url: BASE_URL+'/ajax/add_client',
                    type: 'POST',
                    data: {name:name, email:email},
                    dataType: 'json',
                    success:function(json) {
                        $('.searchresults').hide();
                        $('#client_name').attr('data-id', json.id);
                        $('#client_email').attr('data-email', json.email);
                        $('input[name=client_id]').val(json.id);
                    }
                });

                return false;
            }
        }
    });

    $('#client_name').on('keyup', function() {
        let datatype = $(this).attr('data-type');
        let a = $(this).val();

        if(datatype != '') {
            $.ajax({
                url:BASE_URL+'/ajax/'+datatype,
                type:'GET',
                data:{a:a},
                dataType:'json',
                success:function(json){
                    if( $('.searchresults').length == 0 ) {
                        $('#client_name').after('<div class="searchresults"></div>');
                    }

                    $('.searchresults').css('left', $('#client_name').offset().left+'px');
                    $('.searchresults').css('top', $('#client_name').offset().top+$('#client_name').height()+3+'px');

                    let html = '';

                    for(let i in json) {
                        html += '<div class="si"><a href="javascript:;" onclick="selectClient(this)" data-id="'+json[i].id+'" data-email="'+json[i].email+'">'+json[i].name+'</a></div>';
                    }

                    $('.searchresults').html(html);
                    $('.searchresults').show();
                }
            });
        }
    });

    $('#add_prod').on('keyup', function() {
        let datatype = $(this).attr('data-type');
        let a = $(this).val();

        if(datatype != '') {
            $.ajax({
                url:BASE_URL+'/ajax/'+datatype,
                type:'GET',
                data:{a:a},
                dataType:'json',
                success:function(json){
                    if( $('.searchresults').length == 0 ) {
                        $('#add_prod').after('<div class="searchresults"></div>');
                    }

                    $('.searchresults').css('left', $('#add_prod').offset().left+'px');
                    $('.searchresults').css('top', $('#add_prod').offset().top+$('#add_prod').height()+3+'px');

                    let html = '';

                    for(let i in json) {
                        html += '<div class="si"><a href="javascript:;" onclick="addProd(this)" data-id="'+json[i].id+'" data-email="'+json[i].email+'" data-price="'+json[i].price+'" data-name="'+json[i].name+'">'+json[i].name+' - R$'+json[i].price+'</a></div>';
                    }

                    $('.searchresults').html(html);
                    $('.searchresults').show();
                }
            });
        }
    });
});