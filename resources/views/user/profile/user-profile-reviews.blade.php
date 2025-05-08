@extends('layouts.app')

@section('title', 'My Reviews - User Profile')

@section('content')
<section class="profile">
    <div class="profile__container">
        <div class="profile__wrapp">
            @include('user.profile.sidebar')
            <div class="profile__block">
                <h1 class="profile__title section-title">My Reviews</h1>
                <p>Here you can see your reviews</p>
                
                @if(count($reviews ?? []) > 0)
                    <div class="profile__reviews">
                        @foreach($reviews as $review)
                            <div class="profile__review review-item">
                                <div class="review-item__header">
                                    <div class="review-item__product">
                                        <a href="{{ route('products.show', $review->product_id) }}">{{ $review->product->name }}</a>
                                    </div>
                                    <div class="review-item__shop">
                                        <span>Shop:</span> {{ $review->shop->shop_name }}
                                    </div>
                                    <div class="review-item__date">
                                        {{ $review->created_at->format('d.m.Y') }}
                                    </div>
                                </div>
                                <div class="review-item__rating">
                                    <div class="rating">
                                        <div class="rating__active" style="width: {{ $review->rating * 20 }}%;"></div>
                                    </div>
                                    <span>{{ $review->rating }}</span>
                                </div>
                                <div class="review-item__content">
                                    {{ $review->content }}
                                </div>
                                <div class="review-item__actions">
                                    <a href="#" class="review-item__edit">Edit</a>
                                    <a href="#" class="review-item__delete">Delete</a>
                                </div>
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
                    <div class="profile__reviews-empty">
                        <p>You haven't written any reviews yet.</p>
                        <p>Share your experience by reviewing products you've purchased!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

@section('custom-css')
<style>
    .profile__reviews {
        margin-top: 20px;
    }
    .review-item {
        border: 1px solid #eee;
        border-radius: 5px;
        padding: 15px;
        margin-bottom: 20px;
    }
    .review-item__header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }
    .review-item__product a {
        font-weight: bold;
        color: #333;
    }
    .review-item__rating {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }
    .review-item__rating .rating {
        margin-right: 10px;
    }
    .review-item__content {
        margin-bottom: 10px;
    }
    .review-item__actions {
        display: flex;
        justify-content: flex-end;
    }
    .review-item__edit, 
    .review-item__delete {
        margin-left: 15px;
        color: #3498db;
    }
    .review-item__delete {
        color: #e74c3c;
    }
    .profile__reviews-empty {
        padding: 30px;
        text-align: center;
        background: #f9f9f9;
        border-radius: 5px;
    }
    
    @media (max-width: 767px) {
        .review-item__header {
            flex-direction: column;
        }
        .review-item__product,
        .review-item__shop,
        .review-item__date {
            margin-bottom: 5px;
        }
    }
</style>
@endsection