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
});