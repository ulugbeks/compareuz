<header id="header" class="header @auth user-logged @endauth">
    <div class="header__container">
        <a href="{{ route('home') }}" class="header__logo">
            <img src="{{ asset('img/logo.png') }}" alt="logo">
        </a>
        <div class="header__wrapp">
            @guest
                <button class="header__login _icon-user" data-popup="#login">
                    Login / Signup
                </button>
            @else
                <a href="{{ auth()->user()->role == 'shop' ? route('shop.profile.reviews') : route('user.profile.reviews') }}" class="header__user user-header">
                    <img src="{{ asset(auth()->user()->avatar ?? 'img/user.png') }}" alt="user" class="user-header__img">
                    <div class="user-header__name">{{ auth()->user()->name }}</div>
                </a>
            @endguest
            <div class="header__menu menu">
                <button type="button" class="menu__icon icon-menu"><span></span></button>
                <nav class="menu__body">
                </nav>
            </div>
        </div>
    </div>
</header>