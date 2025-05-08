@extends('layouts.app')

@section('title', 'Notification Settings - User Profile')

@section('content')
<section class="profile">
    <div class="profile__container">
        <div class="profile__wrapp">
            @include('user.profile.sidebar')
            <div class="profile__block">
                <h1 class="profile__title section-title">
                    Notification Settings
                </h1>
                <p>
                    Here you can change your notification settings
                </p>
                <form action="{{ route('user.profile.alerts.update') }}" method="POST">
                    @csrf
                    <div class="checkbox">
                        <input id="c_1" data-error="Error" class="checkbox__input" type="checkbox"
                            value="1" name="news_email" {{ auth()->user()->news_email ? 'checked' : '' }}>
                        <label for="c_1" class="checkbox__label"><span class="checkbox__text">Receive news notifications by email</span></label>
                    </div>
                    <div class="checkbox">
                        <input id="c_2" data-error="Error" class="checkbox__input" type="checkbox"
                            value="1" name="price_alerts" {{ auth()->user()->price_alerts ? 'checked' : '' }}>
                        <label for="c_2" class="checkbox__label"><span class="checkbox__text">Receive price alerts for followed products</span></label>
                    </div>
                    <div class="checkbox">
                        <input id="c_3" data-error="Error" class="checkbox__input" type="checkbox"
                            value="1" name="review_notifications" {{ auth()->user()->review_notifications ? 'checked' : '' }}>
                        <label for="c_3" class="checkbox__label"><span class="checkbox__text">Receive notifications about replies to my reviews</span></label>
                    </div>
                    <button type="submit" class="btn">Save</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection