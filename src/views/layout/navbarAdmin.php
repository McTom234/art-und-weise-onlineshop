<?php if (!isset($navbar_index)) $navbar_index = ""; ?>
<nav id="navbar">
    <a class="nav-button-home" href="/" <?php if ($navbar_index == "home") echo "data-active"; ?>>Art und Weise</a>

    <input type="checkbox" id="checkbox_toggle">
    <label for="checkbox_toggle" class="align-right">&#9776;</label>

    <div class="navbar-container">
        <div>
            <div class="dropdown">
                <a href="/admin/dashboard" <?php if (in_array($navbar_index, array("link 1", "link 2", "link 3"))) echo "data-active"; ?>>Dashboard</a>

                <div class="dropdown-content">
                    <a href="/admin/orders" <?php if ($navbar_index == "link 1") echo "data-active"; ?>>Bestellungen</a>

                    <a href="/admin/products" <?php if ($navbar_index == "link 2") echo "data-active"; ?>>Produkte</a>

                    <a href="/admin/members" <?php if ($navbar_index == "link 3") echo "data-active"; ?>>Mitglieder</a>

                    <a href="/" <?php if ($navbar_index == "link 4") echo "data-active"; ?>>Finanzen</a>
                </div>
            </div>
        </div>

        <div class="align-right">
            <?php if ($loggedIn): ?>
                <span class="navbar-text"> <?= $loggedIn->forename . ' ' . $loggedIn->surname ?></span>

                <a href="/logout">Abmelden</a>
            <?php else: die("Login required"); endif; ?>
        </div>
    </div>
</nav>



