@extends('layouts.app')

@section('title', 'User Profile - Personal Information')

@section('content')
<section class="profile">
    <div class="profile__container">
        <div class="profile__wrapp">
            @include('user.profile.sidebar')
            <div class="profile__block">
                <h1 class="profile__title section-title">
                    Personal Information
                </h1>
                <p>
                    Here you can change your basic profile information
                </p>
                <form action="{{ route('user.profile.info.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="input-wrapp">
                        <input autocomplete="off" type="text" name="first_name" data-error="Error!"
                            placeholder="First name" class="input" value="{{ auth()->user()->first_name ?? '' }}" required>
                    </div>
                    <div class="input-wrapp">
                        <input autocomplete="off" type="text" name="last_name" data-error="Error!"
                            placeholder="Last name" class="input" value="{{ auth()->user()->last_name ?? '' }}" required>
                    </div>
                    <div class="input-wrapp">
                        <input autocomplete="off" type="text" name="username" data-error="Error!"
                            placeholder="Username" class="input" value="{{ auth()->user()->name }}" required>
                    </div>
                    <div class="input-wrapp">
                        <input autocomplete="off" type="tel" name="phone" data-error="Error!"
                            placeholder="Phone" class="input" value="{{ auth()->user()->phone ?? '' }}">
                    </div>
                    <div class="input-wrapp">
                        <textarea name="description" class="input" placeholder="Profile description">{{ auth()->user()->description ?? '' }}</textarea>
                    </div>
                    <div class="profile__gender gender-profile">
                        <div class="gender-profile__title">Gender</div>
                        <div class="gender-profile__items">
                            <div class="gender-profile__item {{ (auth()->user()->gender ?? '') == 'male' ? '_active' : '' }}">
                                <input type="radio" name="gender" value="male" {{ (auth()->user()->gender ?? '') == 'male' ? 'checked' : '' }}>
                                Male
                            </div>
                            <div class="gender-profile__item {{ (auth()->user()->gender ?? '') == 'female' ? '_active' : '' }}">
                                <input type="radio" name="gender" value="female" {{ (auth()->user()->gender ?? '') == 'female' ? 'checked' : '' }}>
                                Female
                            </div>
                        </div>
                    </div>
                    <div class="form-file">
                        <input id="formImage" accept=".jpg, .png, .pdf, .gif" autocomplete="off" type="file"
                            name="photo" class="form-file__input">
                        <button class="info-profile__btn input">Photo</button>
                        <ul id="formPrew" class="form-file__prew">
                            @if(auth()->user()->avatar)
                                <li><img src="{{ asset(auth()->user()->avatar) }}" alt=""></li>
                            @endif
                        </ul>
                    </div>
                    <button type="submit" class="btn">Save</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection