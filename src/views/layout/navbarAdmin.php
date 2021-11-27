<?php if (!isset($navbar_index)) $navbar_index = ""; ?>
<nav id="navbar">
    <a class="nav-button-home" href="<?php echo $navbar_index == "home" ? "/" : "/admin/dashboard" ?>" <?php if ($navbar_index == "home") echo "data-active"; ?>>Art und Weise</a>

    <input type="checkbox" id="checkbox_toggle">
    <label for="checkbox_toggle" class="align-right">&#9776;</label>

    <div class="navbar-container">
        <div>
            <div class="dropdown">
                <?php
                $products_array = array("home", "orders", "products");
                ?>
                <b <?php if (in_array($navbar_index, $products_array)) echo "data-active"; ?> data-responsive>Dashboard</b>
                <a href="/admin/dashboard" <?php if (in_array($navbar_index, $products_array)) echo "data-active"; ?> data-screenFull>Dashboard</a>

                <div class="dropdown-content">
                    <a href="/admin/orders" <?php if ($navbar_index == "orders") echo "data-active"; ?>>Bestellungen</a>

                    <a href="/admin/products" <?php if ($navbar_index == "products") echo "data-active"; ?>>Produkte</a>

                    <a href="/admin/dashboard" <?php if ($navbar_index == "home") echo "data-active"; ?> data-responsive>Zum Dashboard</a>
                </div>
            </div>
        </div>

        <div class="align-right">
            <?php if ($loggedIn): ?>
                <span class="navbar-text"> <?= $loggedIn->forename . ' ' . $loggedIn->surname ?></span>
                <?php echo $navbar_index == "home" ?  : '<a href="/">Zur Webseite</a>'; ?>
                <a href="/logout">Abmelden</a>
            <?php else: header("Location: /login"); endif; ?>
        </div>
    </div>
</nav>



