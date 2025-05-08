@extends('layouts.app')

@section('title', 'Registration - Price Comparison')

@section('content')
<section class="registration">
    <div class="registration__container">
        <h1 class="registration__title section-title">Registration</h1>
        <div data-tabs class="tabs">
            <nav data-tabs-titles class="tabs__navigation">
                <button type="submit" class="tabs__title _tab-active">For users</button>
                <button type="submit" class="tabs__title">For business users</button>
            </nav>
            <div data-tabs-body class="tabs__content">
                <div class="tabs__body">
                    <form class="form" method="POST" action="{{ route('register') }}">
                        @csrf
                        <input type="hidden" name="role" value="user">
                        <div class="input-wrapp">
                            <input autocomplete="off" type="text" name="first_name" data-error="Error!"
                                placeholder="First name" class="input @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" required>
                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-wrapp">
                            <input autocomplete="off" type="text" name="last_name" data-error="Error!"
                                placeholder="Last name" class="input @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" required>
                            @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-wrapp">
                            <input autocomplete="off" type="text" name="name" data-error="Error!"
                                placeholder="Username" class="input @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-wrapp">
                            <div class="input-password">
                                <input autocomplete="off" type="password" name="password" data-error="Error!"
                                    placeholder="Password" class="input @error('password') is-invalid @enderror" required>
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
                                    placeholder="Confirm password" class="input" required>
                                <button class="form__viewpass input-viewpass _icon-view" type="button"></button>
                            </div>
                        </div>
                        <div class="input-wrapp">
                            <input autocomplete="off" type="email" name="email" data-error="Error!"
                                placeholder="Email" class="input @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-wrapp">
                            <input autocomplete="off" type="tel" name="phone" data-error="Error!"
                                placeholder="Phone" class="input @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn popup__button">Send</button>
                    </form>
                </div>
                <div class="tabs__body">
                    <form class="form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="role" value="shop">
                        <div class="input-wrapp">
                            <input autocomplete="off" type="text" name="company_name" data-error="Error!"
                                placeholder="Company name" class="input @error('company_name') is-invalid @enderror" value="{{ old('company_name') }}" required>
                            @error('company_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-wrapp">
                            <input autocomplete="off" type="text" name="address" data-error="Error!"
                                placeholder="Company address" class="input @error('address') is-invalid @enderror" value="{{ old('address') }}" required>
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-wrapp">
                            <input autocomplete="off" type="text" name="city_state" data-error="Error!"
                                placeholder="City, state" class="input @error('city_state') is-invalid @enderror" value="{{ old('city_state') }}" required>
                            @error('city_state')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-wrapp">
                            <input autocomplete="off" type="email" name="email" data-error="Error!"
                                placeholder="Email" class="input @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-wrapp">
                            <input autocomplete="off" type="tel" name="phone" data-error="Error!"
                                placeholder="Phone" class="input @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-wrapp">
                            <input autocomplete="off" type="text" name="owner_name" data-error="Error!"
                                placeholder="Owner or personal" class="input @error('owner_name') is-invalid @enderror" value="{{ old('owner_name') }}" required>
                            @error('owner_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-wrapp">
                            <input autocomplete="off" type="password" name="password" data-error="Error!"
                                placeholder="Password" class="input @error('password') is-invalid @enderror" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-wrapp">
                            <input autocomplete="off" type="password" name="password_confirmation" data-error="Error!"
                                placeholder="Confirm password" class="input" required>
                        </div>
                        <div class="form-file">
                            <input id="formImage" accept=".jpg, .png, .pdf, .gif" autocomplete="off"
                                type="file" name="certificate" class="form-file__input @error('certificate') is-invalid @enderror" multiple>
                            <button class="info-profile__btn input">Certificate</button>
                            <ul id="formPrew" class="form-file__prew"></ul>
                            @error('certificate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn popup__button">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection