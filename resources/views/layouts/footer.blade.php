<footer>
    <span class="copyright">Schülerfirma Art & Weise &copy; 2021 - {{ \Carbon\Carbon::now()->year }}</span>
    <a href="#popup-privacy" class="no-text-decoration">Datenschutzerklärung</a>
    <a href="#popup-imprint" class="no-text-decoration">Impressum</a>
</footer>

<div id="popup-privacy" class="popup">
    <a href="#" class="popup"></a>
    <div class="popup-box">
        <a class="popup-cancel no-text-decoration" href="#">×</a>

        <div class="popup-title">Datenschutzerklärung</div>

        <div class="popup-content list">
            <p>Datenschutz ist schon wichtig....</p>
        </div>
    </div>
</div>
<div id="popup-imprint" class="popup">
    <a href="#" class="popup"></a>
    <div class="popup-box">
        <a class="popup-cancel no-text-decoration" href="#">×</a>

        <div class="popup-title">Impressum</div>

        <div class="popup-content list">
            <p>Vielleicht auch unser Copyright @j0bit???</p>
            <p>Seitendesign und Backend-Entwicklung:<br>&copy; Jonas Paul Pohlmann<br>&copy; Jonas Bellmann</p>
        </div>
    </div>
</div>

<script>
    const url = window.location.href.split('#');
    while (url.length >= 2 && url[url.length-1] !== "") {
        url.pop();
        window.location.href = url.join();
    }
</script>
