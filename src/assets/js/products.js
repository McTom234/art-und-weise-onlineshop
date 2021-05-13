let row = 0;

function fetchProducts(number){
    let http = new XMLHttpRequest();
    let url = './fetchProducts';
    let params = `row=${row}&number=${number}`;
    http.open('POST', url, true);

    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    http.onreadystatechange = function() {
        if(http.readyState === 4 && http.status === 200) {
            let productsList = document.getElementById('productsList');
            productsList.innerHTML += http.responseText;
        }
    };
    http.send(params);

    row += number;
}

for(let i = 0; i < 3; i++){
    fetchProducts(3);
}

$(window).scroll(function() {
    if($(window).scrollTop() > $(document).height() - $(window).height() * 2) {
        for(let i = 0; i < 3; i++){
            fetchProducts(3);
        }
    }
});