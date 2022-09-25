function setItem(product_id: string, product_count: number = 1, additional:boolean = false): Promise<any> {
    return axios.post('/api/cart/set', {
        id: product_id,
        number: product_count,
        additional: additional
    }).then(response => {
        // navbar
        const cart = JSON.parse(response.data);
        let count = 0;
        for (const cartObject in cart) {
            count += Number(cart[cartObject]);
        }

        document.getElementById('navbar-cart-counter')!.innerHTML = ' '+String(count);
        return response;
    })
}
window.setItem = setItem;
