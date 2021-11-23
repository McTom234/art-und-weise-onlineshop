<?php if (!isset($navbar_index)) $navbar_index = ""; ?>
<nav id="navbar">
    <a class="nav-button-home" href="/" <?php if ($navbar_index == "home") echo "data-active"; ?>>Art und Weise</a>

    <input type="checkbox" id="checkbox_toggle">
    <label for="checkbox_toggle" class="align-right">&#9776;</label>

    <div class="navbar-container">
        <div>
            <div class="dropdown">
                <b <?php if ($navbar_index == "products") echo "data-active"; ?> data-responsive>Produkte</b>
                <a href="/products" <?php if ($navbar_index == "products") echo "data-active"; ?> data-screenFull>Produkte</a>

                <div class="dropdown-content">
                    <?php
                    if (isset($categories)) {
                        foreach ($categories as $category):
                            ?>
                            <a href="/products?c=<?= $category->category_ID ?>" <?php if ($navbar_index == "link 1") echo "data-active"; ?>><?= $category->name ?></a>
                        <?php
                        endforeach;
                    }
                    ?>
                    <a href="/products" <?php if ($navbar_index == "products") echo "data-active"; ?> data-responsive>Alle Produkte</a>
                </div>
            </div>

            <a href="/about" <?php if ($navbar_index == "about") echo "data-active"; ?>>Über uns</a>
        </div>

        <div class="align-right">
            <?php if ($loggedIn): ?>
                <span class="navbar-text"> <?= $loggedIn->forename . ' ' . $loggedIn->surname ?></span>

                <?php if ($loggedIn->member): ?>
                    <a href="/admin">Administration</a>
                <?php endif; ?>

                <a href="/logout">Abmelden</a>
            <?php else: ?>
                <a href="/login" <?php if ($navbar_index == "login") echo "data-active"; ?>>Anmelden</a>

                <a href="/registration" <?php if ($navbar_index == "registration") echo "data-active"; ?>>Registrieren</a>
            <?php endif; ?>

            <a class="nav-button-shopping-cart" href="/shopping-cart"
                <?php if ($navbar_index == "shopping-cart") echo "data-active"; ?>
            >
                Warenkorb
                <?php
                if (isset($shoppingCartProductCount)) {
                    if ($shoppingCartProductCount > 0) {
                        echo $shoppingCartProductCount;
                    }
                }
                ?>
            </a>
        </div>
    </div>
</nav>



