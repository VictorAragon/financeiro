$(function(){
    $('.tabItem').on('click', function(){
        $('.activeTab').removeClass('activeTab');
        $(this).addClass('activeTab');

        var item = $('.activeTab').index();
        $('.tabBody').hide();
        $('.tabBody').eq(item).show();

    });

    $('#busca').on('focus', function() {
        $(this).animate({
            width: '350px'
        }, 'fast');
    });

    $('#busca').on('blur', function() {
        if($(this).val() == '') {
            $(this).animate({
                width: '100px'
            }, 'fast');
        }

        setTimeout(function() {
            $('.searchresults').hide();
        }, 300);
    });

    $('#busca').on('keyup', function() {
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
                        $('#busca').after('<div class="searchresults"></div>');
                    }

                    $('.searchresults').css('left', $('#busca').offset().left+'px');
                    $('.searchresults').css('top', $('#busca').offset().top+$('#busca').height()+3+'px');

                    let html = '';

                    for(let i in json) {
                        html += '<div class="si"><a href="'+json[i].link+'">'+json[i].name+'</a></div>';
                    }

                    $('.searchresults').html(html);
                    $('.searchresults').show();
                }
            });
        }
    });

});