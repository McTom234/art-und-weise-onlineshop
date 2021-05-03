function addToBasket(id, count){
    var basket
    var cookies = $.cookie('cookies');
    var cookiesObject;
    if(cookies != null){
        cookiesObject = JSON.parse(cookies);
    }else {
        cookiesObject = {
            basket: []
        }
    }
    cookiesObject.basket.push([id, count]);
    $.cookie('cookies', JSON.stringify(cookiesObject));
}

function getBasket(){
    $.post('../basket/', {basket: $.cookie('cookies')});
    var cookies = JSON.parse($.cookie('cookies'));
    return cookies.basket;
}

$(function() {


    onstart = true;
    isScroll = false;

    $(window).scroll(function(e) {
        if ($(this).scrollTop() < $(this).height() / 10 * 9) {
            if (!isScroll && onstart) {
                isScroll = true;

                $('.navbar').removeClass('fixed-top');
                $('.navbar_placeholder').hide();

                $('body,html').animate({
                    scrollTop: $(this).height() / 10 * 9,
                }, 5);

                setTimeout(function() {
                    isScroll = false;
                    onstart = false;
                }, 600);
            }
        }
        if ($(this).scrollTop() == 0) {
            onstart = true;
        }


    });



    $('.button_more').click(function() {
        if (!isScroll) {
            isScroll = true;
            $('body,html').animate({
                scrollTop: $(window).height() / 10 * 9,
            }, 5);
            onstart = false;
            isScroll = false;
        }

    });


});