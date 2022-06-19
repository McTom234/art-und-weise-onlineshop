function setItem(product_id: number, product_count: number = 1, additional:boolean = false): Promise<any> {
    return axios.post('/api/cart/set', {
        id: product_id,
        number: product_count,
        additional: additional
    })
}
window.setItem = setItem;
