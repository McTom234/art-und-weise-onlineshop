@php
    if(!isset($categories)){
        $categories = \App\Models\Category::all();
    }
@endphp

<nav id="navbar">
    <a class="nav-button-home" href="/" {{$index != "home" ?: "data-active"}}>Art und Weise</a>

    <input type="checkbox" id="checkbox_toggle">
    <label for="checkbox_toggle" class="align-right">&#9776;</label>

    <div class="navbar-container">
        <div>
            <div class="dropdown">
                <b {{$index != "products" ?: "data-active"}} data-responsive>Produkte</b>
                <a href="{{url("/products")}}" {{$index != "products" ?: "data-active"}} data-screenFull>Produkte</a>

                <div class="dropdown-content">
                        @foreach ($categories as $category)
                            <a href="{{url("/products/{$category->id}")}}" {{$index != $category->id ?: "data-active"}}>{{$category->name}}</a>
                        @endforeach

                        <a href="{{url("/products")}}" {{$index != "products" ?: "data-active"}} data-responsive>Alle Produkte</a>
                </div>
            </div>

            <a href="{{route('about')}}" {{$index != "about" ?: "data-active"}}>Über uns</a>
        </div>
        <div class="align-right">
            @auth
                <span class="navbar-text">{{Auth::user()->forename}} {{Auth::user()->surname}}</span>
                <form method="post" action="{{route('logout')}}">
                    @csrf
                    <button>Abmelden</button>
                </form>
            @endauth

            @guest
                <a href="{{url('/login')}}" {{$index != "login" ?: "data-active"}}>Anmelden</a>
                <a href="{{url('/register')}}" {{$index != "register" ?: "data-active"}}>Registrieren</a>
            @endguest

            @php
                $cartCount = 0;
                if (isset($_COOKIE['cart'])) {
                    $cart = json_decode($_COOKIE['cart'], true);
                    foreach ($cart as $product_id => $number) {
                        $cartCount += $number;
                    }
                    $cartCount = ' '.$cartCount;
                } else {
                    $cartCount = '';
                }
            @endphp
            <a class="nav-button-shopping-cart"
               href="{{route('cart')}}" {{$index != "cart" ?: "data-active"}}>Warenkorb{{$cartCount}}</a>
        </div>
    </div>
</nav>



