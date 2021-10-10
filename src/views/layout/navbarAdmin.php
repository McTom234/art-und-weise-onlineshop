<?php if (!isset($navbar_index)) $navbar_index = ""; ?>
<nav id="navbar">
    <div class="left">
        <a class="nav-button-home" href="/" <?php if ($navbar_index == "home") echo "data-active"; ?>>
            Art und Weise
        </a>
        <div class="dropdown">
            <a href="/admin/dashboard" <?php if (in_array($navbar_index, array("link 1", "link 2", "link 3"))) echo "data-active"; ?>>
                Dashboard
            </a>
            <div class="dropdown-content">
                <a href="/admin/orders" <?php if ($navbar_index == "link 1") echo "data-active"; ?>>Bestellungen</a>
                <a href="/admin/products" <?php if ($navbar_index == "link 2") echo "data-active"; ?>>Produkte</a>
                <a href="/admin/members" <?php if ($navbar_index == "link 3") echo "data-active"; ?>>Mitglieder</a>
                <a href="/" <?php if ($navbar_index == "link 4") echo "data-active"; ?>>Finanzen</a>
            </div>
        </div>
    </div>

    <div class="right">
        <?php if ($loggedIn): ?>
            <span class="navbar-text"> <?= $loggedIn->forename . ' ' . $loggedIn->surname ?></span>
            <a href="/logout">Abmelden</a>
        <?php else: ?>
            <a href="/login" <?php if ($navbar_index == "login") echo "data-active"; ?>>
                Anmelden
            </a>
            <a href="/registration" <?php if ($navbar_index == "registration") echo "data-active"; ?>>
                Registrieren
            </a>
        <?php endif; ?>
    </div>
    <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
</nav>

<script>
    function myFunction() {
        var x = document.getElementById("navbar");
        if (x.className === "navbar") {
            x.className += " responsive";
        } else {
            x.className = "navbar";
        }
    }
</script>



