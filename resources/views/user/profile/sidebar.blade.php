<div class="profile__info info-profile" data-da=".menu__body,991.98">
    <div class="info-profile__top">
        <div class="info-profile__user user-profile">
            <img src="{{ asset(auth()->user()->avatar ?? 'img/user.png') }}" alt="user" class="user-profile__img">
            <div class="user-profile__wrapp">
                <div class="user-profile__name">{{ auth()->user()->name }}</div>
                <div class="user-profile__role">User</div>
            </div>
        </div>
    </div>
    <div class="info-profile__points points-profile">
        <a href="{{ route('user.profile.reviews') }}" class="points-profile__item _icon-star-empty {{ request()->routeIs('user.profile.reviews') ? '_active' : '' }}">My Reviews</a>
        <a href="{{ route('user.profile.info') }}" class="points-profile__item _icon-cogs {{ request()->routeIs('user.profile.*') && !request()->routeIs('user.profile.reviews') && !request()->routeIs('user.profile.bugs') ? '_active' : '' }}">
            Settings
        </a>
        <ul>
            <li class="{{ request()->routeIs('user.profile.info') ? '_active' : '' }}"><a href="{{ route('user.profile.info') }}">Personal Information</a></li>
            <li class="{{ request()->routeIs('user.profile.alerts') ? '_active' : '' }}"><a href="{{ route('user.profile.alerts') }}">Notification Settings</a></li>
            <li class="{{ request()->routeIs('user.profile.accounts') ? '_active' : '' }}"><a href="{{ route('user.profile.accounts') }}">Connected Accounts</a></li>
            <li class="{{ request()->routeIs('user.profile.email') ? '_active' : '' }}"><a href="{{ route('user.profile.email') }}">Change Email</a></li>
            <li class="{{ request()->routeIs('user.profile.password') ? '_active' : '' }}"><a href="{{ route('user.profile.password') }}">Change Password</a></li>
        </ul>
        <a href="{{ route('user.profile.bugs') }}" class="points-profile__item _icon-bug {{ request()->routeIs('user.profile.bugs') ? '_active' : '' }}">Report Bug</a>
        <a href="{{ route('logout') }}" class="points-profile__item _icon-close" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</div>