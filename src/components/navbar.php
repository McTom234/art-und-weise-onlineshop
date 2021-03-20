<nav class="navbar navbar-light navbar-expand-md d-xxl-flex navigation-clean-button">
    <div class="container">
        <a class="navbar-brand" href="#">Art &amp; Weise</a>
        <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1">
            <span class="visually-hidden">Toggle navigation</span>
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Start</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown">Dropdown</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Karten</a>
                        <a class="dropdown-item" href="#">Lesezeichen</a>
                        <a class="dropdown-item" href="#">Kategorie 3</a>
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link" href="#">Hintergrund</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Über uns</a></li>
            </ul>
            <form class="d-flex">
                <?php
                    if ($loggedIn) {
                        echo '<span class="navbar-text">'.$loggedIn['forename'].' '.$loggedIn['surname'].'</span>';
                        echo '<a class="nav-link" href="logout">Abmelden</a>';
                        echo '<button>Warenkorb</button>';
                    }
                    else {
                        echo '<a class="nav-link" href="login">Anmelden</a>
                                <a class="nav-link" href="regristration">Registrieren</a>
                                <button>Warenkorb</button>';
                    }
                ?>
            </form>
        </div>
    </div>
</nav>