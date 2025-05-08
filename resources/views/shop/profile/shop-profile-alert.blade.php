@extends('layouts.app')

@section('title', 'Shop Notifications - Shop Profile')

@section('content')
<section class="profile">
    <div class="profile__container">
        <div class="profile__wrapp">
            @include('shop.profile.sidebar')
            <div class="profile__block">
                <h1 class="profile__title section-title">
                    Shop Notifications
                </h1>
                <p>
                    Here you can change notification settings
                </p>
                <form action="{{ route('shop.profile.alert.update') }}" method="POST">
                    @csrf
                    <div class="checkbox">
                        <input id="c_1" data-error="Error" class="checkbox__input" type="checkbox"
                            value="1" name="news_email" {{ $shopProfile->news_email ?? false ? 'checked' : '' }}>
                        <label for="c_1" class="checkbox__label"><span class="checkbox__text">Receive news notifications by email</span></label>
                    </div>
                    <div class="checkbox">
                        <input id="c_2" data-error="Error" class="checkbox__input" type="checkbox"
                            value="1" name="review_notifications" {{ $shopProfile->review_notifications ?? false ? 'checked' : '' }}>
                        <label for="c_2" class="checkbox__label"><span class="checkbox__text">Receive notifications about new reviews</span></label>
                    </div>
                    <div class="checkbox">
                        <input id="c_3" data-error="Error" class="checkbox__input" type="checkbox"
                            value="1" name="campaign_notifications" {{ $shopProfile->campaign_notifications ?? false ? 'checked' : '' }}>
                        <label for="c_3" class="checkbox__label"><span class="checkbox__text">Receive notifications about campaign status</span></label>
                    </div>
                    <button type="submit" class="btn">Save</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection