function setCookies(cookieName, cookieObject, expireDays = 30) {

    let cookieString = JSON.stringify(cookieObject);

    let day = new Date();
    day.setTime(day.getTime() + (expireDays * 24 * 60 * 60 * 1000));

    document.cookie = `${cookieName}=${cookieString}; expires=${day}; path=/;`
}

function getCookies(cookieName) {
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