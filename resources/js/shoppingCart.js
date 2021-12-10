window.setItem = async function (id, number = 1, additional = 1) {
    return new Promise((resolve, reject) => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", '/api/cart/set', true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                resolve(xhr.responseText);
            }
            else if (this.readyState > 399) {
                reject();
            }
        }
        xhr.send(`id=${id}&number=${number}&additional=${additional}`);
    });
}
