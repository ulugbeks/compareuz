@extends('layouts.app')

@section('title', 'Page Not Found')

@section('content')
<section class="error-page">
    <div class="error-page__container">
        <div class="error-page__content">
            <h1 class="error-page__code">404</h1>
            <h2 class="error-page__title">Page Not Found</h2>
            <p class="error-page__message">The page you are looking for does not exist or has been moved.</p>
            <a href="{{ route('home') }}" class="btn error-page__btn">Go to Homepage</a>
        </div>
    </div>
</section>
@endsection

@section('custom-css')
<style>
    .error-page {
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .error-page__container {
        max-width: 600px;
        margin: 0 auto;
        padding: 40px 15px;
        text-align: center;
    }
    
    .error-page__code {
        font-size: 120px;
        font-weight: 700;
        color: #3498db;
        margin-bottom: 0;
        line-height: 1;
    }
    
    .error-page__title {
        font-size: 32px;
        margin-bottom: 20px;
    }
    
    .error-page__message {
        font-size: 18px;
        margin-bottom: 30px;
        color: #666;
    }
    
    .error-page__btn {
        font-size: 18px;
        padding: 12px 30px;
    }
</style>
@endsection