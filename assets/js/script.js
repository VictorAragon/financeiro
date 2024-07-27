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
    });

    $('#busca').on('keyup', function() {
        let datatype = $(this).attr('data-type');
        let q = $(this).val();

        if(datatype != '') {
            $.ajax({
                url:BASE_URL+'/ajax/'+datatype,
                type:'GET',
                data:{q:q},
                dataType:'json',
                success:function(json){
                    if( $('.seachresults').length == 0 ) {
                        $('#busca').after('<div class="searchresults"></div>');
                    }


                }
            });
        }
    });

});