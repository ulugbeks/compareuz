@extends('layouts.app')

@section('title', 'Report Bug - User Profile')

@section('content')
<section class="profile">
    <div class="profile__container">
        <div class="profile__wrapp">
            @include('user.profile.sidebar')
            <div class="profile__block">
                <h1 class="profile__title section-title">Report Bug</h1>
                <p>Here you can report a bug to the administration</p>
                <form action="{{ route('user.profile.bugs.submit') }}" method="POST">
                    @csrf
                    <textarea name="description" class="input @error('description') is-invalid @enderror"
                        placeholder="Describe the bug in as much detail as possible" rows="6" required></textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <button type="submit" class="btn">Send</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection