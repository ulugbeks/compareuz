@extends('layouts.app')

@section('title', 'Change Password - User Profile')

@section('content')
<section class="profile">
    <div class="profile__container">
        <div class="profile__wrapp">
            @include('user.profile.sidebar')
            <div class="profile__block">
                <h1 class="profile__title section-title">Change Password</h1>
                <p>Here you can change your password</p>
                <form action="{{ route('user.profile.password.update') }}" method="POST">
                    @csrf
                    <div class="input-wrapp">
                        <div class="input-password">
                            <input autocomplete="off" type="password" name="current_password" data-error="Error!"
                                placeholder="Old password" class="input @error('current_password') is-invalid @enderror" data-required>
                            <button class="form__viewpass input-viewpass _icon-view" type="button"></button>
                            @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="input-wrapp">
                        <div class="input-password">
                            <input autocomplete="off" type="password" name="password" data-error="Error!"
                                placeholder="New password" class="input @error('password') is-invalid @enderror" data-required>
                            <button class="form__viewpass input-viewpass _icon-view" type="button"></button>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="input-wrapp">
                        <div class="input-password">
                            <input autocomplete="off" type="password" name="password_confirmation" data-error="Error!"
                                placeholder="Confirm new password" class="input" data-required>
                            <button class="form__viewpass input-viewpass _icon-view" type="button"></button>
                        </div>
                    </div>
                    <button type="submit" class="btn">Send</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection