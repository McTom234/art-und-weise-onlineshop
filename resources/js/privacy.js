class Privacy {

    accept() {
        const expire = new Date();
        expire.setTime(expire.getTime()+ 2592000000);
        document.cookie = 'privacyClaimer='+expire.getTime()+'; expires='+expire.toUTCString()+'; path=/;';
        this.closeHint();
    }

    check() {
        let cName = "privacyClaimer=";
        let cArray = decodeURIComponent(document.cookie).split(';');
        for(let i = 0; i <cArray.length; i++) {
            let c = cArray[i];
            while (c.charAt(0) === ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(cName) === 0) {
                try {
                    const oldExpire = new Date(c.substring(name.length, c.length));
                    if (oldExpire.getTime() >= new Date().getTime()) return true;
                } catch (e) {
                }
            }
        }
        return false;
    }

    printHint() {
        const hint = document.getElementById('cookie-privacy-claimer');
        hint.classList.add('visible');
    }

    closeHint() {
        const hint = document.getElementById('cookie-privacy-claimer');
        hint.classList.remove('visible');
    }
}

window.privacy = new Privacy();

if (!privacy.check()) privacy.printHint();
