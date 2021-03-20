function addToBasket(id, count){
    var basket = JSON.parse($.cookie('basket'));
    basket.push([id, count]);
    $.cookie('basket', JSON.stringify(basket));
}

function getBasket(){
    $.post('../basket/', {basket: $.cookie('basket')});
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