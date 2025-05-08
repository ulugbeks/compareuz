@extends('layouts.app')

@section('title', 'Connected Accounts - User Profile')

@section('content')
<section class="profile">
    <div class="profile__container">
        <div class="profile__wrapp">
            @include('user.profile.sidebar')
            <div class="profile__block">
                <h1 class="profile__title section-title">
                    Connected Social Media Accounts
                </h1>
                <p>
                    Accounts will be automatically connected when logging in with the same email
                </p>
                <div class="profile__accounts">
                    <div class="profile__account account-profile">
                        <div class="account-profile__icon _icon-envelop"></div>
                        <div class="account-profile__wrapp">
                            <div class="account-profile__title">
                                Email - active
                            </div>
                            <div class="account-profile__subtitle">Login using email and password</div>
                        </div>
                    </div>
                    <div class="profile__account account-profile _not-active">
                        <div class="account-profile__icon _icon-facebook"></div>
                        <div class="account-profile__wrapp">
                            <div class="account-profile__title">
                                Facebook - not added
                            </div>
                            <div class="account-profile__subtitle">Login using Facebook account</div>
                        </div>
                    </div>
                    <div class="profile__account account-profile _not-active">
                        <div class="account-profile__icon _icon-google"></div>
                        <div class="account-profile__wrapp">
                            <div class="account-profile__title">
                                Google - not added
                            </div>
                            <div class="account-profile__subtitle">Login using Google account</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection