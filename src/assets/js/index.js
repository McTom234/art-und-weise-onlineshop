$(function() {
    let animate = false;
    if ($(this).scrollTop() === 0) animate = true;
    $(window).scroll(() => {
        if (animate && $(this).scrollTop() < $(this).height() / 10) {
            window.location.href = "#navbar";
            animate = false;
        }
        if ($(this).scrollTop() === 0) animate = true;
    });
});

console.log("test")