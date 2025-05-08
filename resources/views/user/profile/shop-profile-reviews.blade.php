@extends('layouts.app')

@section('title', 'Shop Reviews - Shop Profile')

@section('content')
<section class="profile">
    <div class="profile__container">
        <div class="profile__wrapp">
            @include('shop.profile.sidebar')
            <div class="profile__block">
                <h1 class="profile__title section-title">Shop Reviews</h1>
                <p>Here you can see reviews of your shop</p>
                
                @if(count($reviews ?? []) > 0)
                    <div class="shop-reviews">
                        @foreach($reviews as $review)
                            <div class="shop-review">
                                <div class="shop-review__header">
                                    <div class="shop-review__user">
                                        <img src="{{ asset($review->user->avatar ?? 'img/user.png') }}" alt="User">
                                        <span>{{ $review->user->name }}</span>
                                    </div>
                                    <div class="shop-review__date">
                                        {{ $review->created_at->format('d.m.Y') }}
                                    </div>
                                </div>
                                <div class="shop-review__product">
                                    <a href="{{ route('products.show', $review->product_id) }}">{{ $review->product->name }}</a>
                                </div>
                                <div class="shop-review__rating">
                                    <div class="rating">
                                        <div class="rating__active" style="width: {{ $review->rating * 20 }}%;"></div>
                                    </div>
                                    <span>{{ $review->rating }}</span>
                                </div>
                                <div class="shop-review__content">
                                    {{ $review->content }}
                                </div>
                                @if($review->reply)
                                    <div class="shop-review__reply">
                                        <div class="shop-review__reply-header">
                                            <strong>Your Reply:</strong>
                                            <span>{{ $review->reply_date->format('d.m.Y') }}</span>
                                        </div>
                                        <div class="shop-review__reply-content">
                                            {{ $review->reply }}
                                        </div>
                                    </div>
                                @else
                                    <div class="shop-review__reply-form">
                                        <form action="{{ route('shop.reviews.reply', $review->id) }}" method="POST">
                                            @csrf
                                            <textarea name="reply" class="input" placeholder="Reply to this review" required></textarea>
                                            <button type="submit" class="btn btn-sm">Reply</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    
                    @if($reviews->hasPages())
                        <div class="pagination">
                            <button {{ $reviews->onFirstPage() ? 'disabled' : '' }} type="button" class="pagination__arrow _icon-arrow-left" onclick="window.location='{{ $reviews->previousPageUrl() }}'"></button>
                            <ul class="pagination__list">
                                @foreach(range(1, $reviews->lastPage()) as $page)
                                    @if($page == 1 || $page == $reviews->lastPage() || abs($page - $reviews->currentPage()) < 3)
                                        <li class="pagination__item">
                                            <a href="{{ $reviews->url($page) }}" class="pagination__link {{ $page == $reviews->currentPage() ? '_active' : '' }}">{{ $page }}</a>
                                        </li>
                                    @elseif(abs($page - $reviews->currentPage()) == 3)
                                        <li class="pagination__item">
                                            <span class="pagination__link">...</span>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                            <button {{ $reviews->hasMorePages() ? '' : 'disabled' }} type="button" class="pagination__arrow _icon-arrow-right" onclick="window.location='{{ $reviews->nextPageUrl() }}'"></button>
                        </div>
                    @endif
                @else
                    <div class="shop-reviews-empty">
                        <p>Your shop doesn't have any reviews yet.</p>
                        <p>Reviews will appear here when customers leave them.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

@section('custom-css')
<style>
    .shop-reviews {
        margin-top: 20px;
    }
    .shop-review {
        border: 1px solid #eee;
        border-radius: 5px;
        padding: 15px;
        margin-bottom: 20px;
    }
    .shop-review__header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }
    .shop-review__user {
        display: flex;
        align-items: center;
    }
    .shop-review__user img {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        margin-right: 10px;
    }
    .shop-review__product {
        margin-bottom: 10px;
    }
    .shop-review__product a {
        font-weight: bold;
        color: #333;
    }
    .shop-review__rating {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }
    .shop-review__rating .rating {
        margin-right: 10px;
    }
    .shop-review__content {
        margin-bottom: 15px;
    }
    .shop-review__reply {
        background: #f9f9f9;
        padding: 10px;
        border-left: 3px solid #3498db;
        margin-top: 10px;
    }
    .shop-review__reply-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 5px;
    }
    .shop-review__reply-form {
        margin-top: 10px;
    }
    .shop-review__reply-form textarea {
        margin-bottom: 10px;
    }
    .shop-reviews-empty {
        padding: 30px;
        text-align: center;
        background: #f9f9f9;
        border-radius: 5px;
    }
    .btn-sm {
        padding: 5px 15px;
        font-size: 14px;
    }
    
    @media (max-width: 767px) {
        .shop-review__header {
            flex-direction: column;
        }
        .shop-review__user,
        .shop-review__date {
            margin-bottom: 5px;
        }
    }
</style>
@endsection