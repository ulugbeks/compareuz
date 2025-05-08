@extends('layouts.app')

@section('title', 'Change Email - User Profile')

@section('content')
<section class="profile">
    <div class="profile__container">
        <div class="profile__wrapp">
            @include('user.profile.sidebar')
            <div class="profile__block">
                <h1 class="profile__title section-title">Change Email</h1>
                <p>Here you can change your email address</p>
                <form action="{{ route('user.profile.email.update') }}" method="POST">
                    @csrf
                    <div class="input-wrapp">
                        <input autocomplete="off" type="text" name="old_email" data-error="Error!"
                            placeholder="Old Email" class="input @error('old_email') is-invalid @enderror" value="{{ auth()->user()->email }}"
                            data-required="email" readonly>
                        @error('old_email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-wrapp">
                        <input autocomplete="off" type="text" name="new_email" data-error="Error!"
                            placeholder="New Email" class="input @error('new_email') is-invalid @enderror" data-required="email">
                        @error('new_email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-wrapp">
                        <div class="input-password">
                            <input autocomplete="off" type="password" name="password" data-error="Error!"
                                placeholder="Password" class="input @error('password') is-invalid @enderror" data-required>
                            <button class="form__viewpass input-viewpass _icon-view" type="button"></button>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn">Send</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection