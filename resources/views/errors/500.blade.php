@extends('layouts.app')

@section('title', 'Server Error')

@section('content')
<section class="error-page">
    <div class="error-page__container">
        <div class="error-page__content">
            <h1 class="error-page__code">500</h1>
            <h2 class="error-page__title">Server Error</h2>
            <p class="error-page__message">Something went wrong on our servers. We're working to fix the issue.</p>
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
        color: #e74c3c;
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