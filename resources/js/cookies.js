window.getCookies = function (cookieName) {
    const name = cookieName + '=';
    const decodedCookie = decodeURIComponent(document.cookie);
    const cookieStrings = decodedCookie.split(';');

    for (let i = 0; i < cookieStrings.length; i++) {
        let string = cookieStrings[i];
        while (string.charAt(0) === ' ') {
            string = string.substring(1);
        }
        if (string.indexOf(name) === 0) {
            return JSON.parse(string.substring(name.length, string.length));
        }
    }
    return null;
}
