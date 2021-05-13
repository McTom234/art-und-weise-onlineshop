<div class="navbar" id="navbar">
    <div class="left">
        <a href="/">Art und Weise</a>
        <div class="dropdown">
            <button class="dropbtn">Products
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="/">Link 1</a>
                <a href="/">Link 2</a>
                <a href="/">Link 3</a>
            </div>
        </div>
    </div>

    <div class="right">
        <?php if($loggedIn) { ?>
            <span class="navbar-text"> <?= $loggedIn->forename . ' ' . $loggedIn->surname ?></span>
            <a href="/logout">Abmelden</a>
            <a href="/shopping-cart">
                <button>Warenkorb</button>
            </a>
        <?php } else { ?>
            <a href="/login">Anmelden</a>
            <a href="/registration">Registrieren</a>
            <a class="nav-button" href="/shopping-cart">Warenkorb</a>
        <?php } ?>
    </div>
    <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
</div>

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



