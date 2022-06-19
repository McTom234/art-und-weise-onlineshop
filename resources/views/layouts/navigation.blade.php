{{--{{ dd(request()->route()) }}--}}

<nav id="navbar">
    <a class="nav-button-home" href="{{ route('index') }}" {{ !request()->routeIs('index') ? : "data-active" }}>Art und Weise</a>

    <input type="checkbox" id="checkbox_toggle">
    <label for="checkbox_toggle" class="align-right">&#9776;</label>

    <div class="navbar-container">
        <div>
            <div class="dropdown">
                <b {{ !request()->routeIs('products.*') ? : "data-active" }} data-responsive>Produkte</b>
                <a href="{{ route('products.index') }}" {{ !request()->routeIs('products.*') ? : "data-active" }} data-screenFull>Produkte</a>

                <div class="dropdown-content">
                        @foreach (\App\Models\Category::all() as $category)
                            @php /** @var \App\Models\Category $category */ @endphp
                            <a href="{{ route('products.category', $category->id) }}" {{ !request()->routeIs('products.category') ? : request()->route()->parameters['category']->id != $category->id ? : "data-active" }}>{{ $category->name }}</a>
                        @endforeach

                        <a href="{{ route('products.index') }}" {{ !request()->routeIs('index') ? : "data-active" }} data-responsive>Alle Produkte</a>
                </div>
            </div>

            <a href="{{ route('about') }}" {{ !request()->routeIs('about') ? : "data-active" }}>Über uns</a>
        </div>
        <div class="align-right">
            @auth
                <span class="navbar-text">{{ Auth::user()->forename }} {{ Auth::user()->surname }}</span>
                <form method="post" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Abmelden</button>
                </form>
            @endauth

            @guest
                <a href="{{ route('login') }}" {{ !request()->routeIs('login') ? : "data-active" }}>Anmelden</a>
                <a href="{{ route('register') }}" {{ !request()->routeIs('register') ? : "data-active" }}>Registrieren</a>
            @endguest

            <a class="nav-button-shopping-cart" href="{{ route('cart') }}" {{ !request()->routeIs('cart') ? : "data-active" }}>Warenkorb<span id="navbar-cart-counter">{{ $cartCount }}</span></a>
        </div>
    </div>
</nav>



