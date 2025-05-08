<div class="profile__info info-profile" data-da=".menu__body,991.98">
    <div class="info-profile__top">
        <div class="info-profile__user user-profile shop">
            <img src="{{ asset(auth()->user()->avatar ?? 'img/user.png') }}" alt="user" class="user-profile__img">
            <div class="user-profile__wrapp">
                <div class="user-profile__name">{{ auth()->user()->name }}</div>
                <div class="user-profile__role">Shop</div>
            </div>
        </div>
        <div class="info-profile__money">{{ number_format($shopProfile->balance ?? 0, 2) }} $</div>
        <button type="button" class="btn info-profile__btn" data-popup="#add-balance">Add</button>
    </div>
    <div class="info-profile__points points-profile">
        <a href="{{ route('shop.profile.campaigns') }}"
            class="points-profile__item _icon-bullhorn {{ request()->routeIs('shop.profile.campaigns*') ? '_active' : '' }}">Campaigns</a>
        <ul>
            <li class="{{ request()->routeIs('shop.profile.campaigns') && !request()->routeIs('shop.profile.campaigns.banner') && !request()->routeIs('shop.profile.campaigns.elements') ? '_active' : '' }}">
                <a href="{{ route('shop.profile.campaigns') }}">Select campaign</a>
            </li>
            <li class="{{ request()->routeIs('shop.profile.history-pay') ? '_active' : '' }}">
                <a href="{{ route('shop.profile.history-pay') }}">Payment history</a>
            </li>
        </ul>
        <a href="{{ route('shop.profile.reviews') }}" class="points-profile__item _icon-star-empty {{ request()->routeIs('shop.profile.reviews') ? '_active' : '' }}">My Reviews</a>
        <a href="{{ route('shop.profile.info') }}" class="points-profile__item _icon-cogs {{ (request()->routeIs('shop.profile.info') || request()->routeIs('shop.profile.alert') || request()->routeIs('shop.profile.email') || request()->routeIs('shop.profile.password')) ? '_active' : '' }}">
            Settings
        </a>
        <ul>
            <li class="{{ request()->routeIs('shop.profile.info') ? '_active' : '' }}"><a href="{{ route('shop.profile.info') }}">Shop Information</a></li>
            <li class="{{ request()->routeIs('shop.profile.alert') ? '_active' : '' }}"><a href="{{ route('shop.profile.alert') }}">Shop Notifications</a></li>
            <li class="{{ request()->routeIs('shop.profile.email') ? '_active' : '' }}"><a href="{{ route('shop.profile.email') }}">Change Email</a></li>
            <li class="{{ request()->routeIs('shop.profile.password') ? '_active' : '' }}"><a href="{{ route('shop.profile.password') }}">Change Password</a></li>
        </ul>
        <a href="{{ route('shop.profile.bugs') }}" class="points-profile__item _icon-bug {{ request()->routeIs('shop.profile.bugs') ? '_active' : '' }}">Report Bug</a>
        <a href="{{ route('logout') }}" class="points-profile__item _icon-close" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</div>