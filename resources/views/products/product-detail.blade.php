@extends('layouts.app')

@section('title', $product->name ?? 'Product Detail')

@section('content')
<section class="product-detail">
    <div class="product-detail__container">
        <div class="product-detail__breadcrumbs">
            <a href="{{ route('home') }}">Home</a> &gt; 
            @if($product->category)
                <a href="{{ route('products', ['category' => $product->category->slug]) }}">{{ $product->category->name }}</a> &gt; 
            @endif
            <span>{{ $product->name ?? 'Product' }}</span>
        </div>
        
        <div class="product-detail__main">
            <div class="product-detail__gallery">
                <div class="product-detail__main-image">
                    <img src="{{ $product->image ?? asset('img/products/item-1.png') }}" alt="{{ $product->name ?? 'Product' }}">
                </div>
                @if(isset($product->additional_images) && count($product->additional_images) > 0)
                <div class="product-detail__thumbnails">
                    @foreach($product->additional_images as $image)
                    <div class="product-detail__thumbnail">
                        <img src="{{ $image }}" alt="{{ $product->name ?? 'Product' }}">
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
            
            <div class="product-detail__info">
                <h1 class="product-detail__title">{{ $product->name ?? 'Product Name' }}</h1>
                
                <div class="product-detail__specs">
                    @if($product->manufacturer)
                    <div class="product-detail__spec">
                        <span class="product-detail__spec-title">Manufacturer:</span>
                        <span class="product-detail__spec-value">{{ $product->manufacturer }}</span>
                    </div>
                    @endif
                    
                    @if($product->model)
                    <div class="product-detail__spec">
                        <span class="product-detail__spec-title">Model:</span>
                        <span class="product-detail__spec-value">{{ $product->model }}</span>
                    </div>
                    @endif
                    
                    @if($product->ean)
                    <div class="product-detail__spec">
                        <span class="product-detail__spec-title">EAN:</span>
                        <span class="product-detail__spec-value">{{ $product->ean }}</span>
                    </div>
                    @endif
                    
                    <div class="product-detail__spec">
                        <span class="product-detail__spec-title">Condition:</span>
                        <span class="product-detail__spec-value">{{ $product->used ? 'Used' : 'New' }}</span>
                    </div>
                </div>
                
                <div class="product-detail__description">
                    {{ $product->description ?? 'No description available.' }}
                </div>
            </div>
        </div>
        
        <div class="product-detail__price-comparison">
            <h2 class="product-detail__subtitle">Price Comparison</h2>
            
            <div class="product-detail__shops">
                @forelse($shops ?? [] as $shop)
                <div class="product-detail__shop">
                    <div class="product-detail__shop-logo">
                        <img src="{{ $shop->logo ?? asset('img/products/products-logo/item-1.jpg') }}" alt="{{ $shop->name ?? 'Shop' }}">
                    </div>
                    
                    <div class="product-detail__shop-info">
                        <div class="product-detail__shop-name">{{ $shop->name ?? 'Shop Name' }}</div>
                        <div class="product-detail__shop-rating">
                            <div class="rating">
                                <div class="rating__body">
                                    <div class="rating__active" style="width: {{ ($shop->rating ?? 0) * 20 }}%;"></div>
                                </div>
                            </div>
                            <span>{{ number_format($shop->rating ?? 0, 1) }} ({{ $shop->reviews_count ?? 0 }} reviews)</span>
                        </div>
                    </div>
                    
                    <div class="product-detail__shop-stock">
                        In Stock: {{ $shop->pivot->stock ?? 0 }}
                    </div>
                    
                    <div class="product-detail__shop-delivery">
                        <div class="product-detail__shop-delivery-price">
                            Delivery: {{ $shop->pivot->delivery_price ? '$'.number_format($shop->pivot->delivery_price, 2) : 'Contact shop' }}
                        </div>
                        <div class="product-detail__shop-delivery-time">
                            Estimated: {{ $shop->pivot->delivery_time ?? 'Contact shop' }}
                        </div>
                    </div>
                    
                    <div class="product-detail__shop-price">
                        @if($shop->pivot->sale_price && $shop->pivot->sale_price < $shop->pivot->price)
                            <div class="product-detail__shop-price-old">${{ number_format($shop->pivot->price, 2) }}</div>
                            <div class="product-detail__shop-price-current">${{ number_format($shop->pivot->sale_price, 2) }}</div>
                        @else
                            <div class="product-detail__shop-price-current">${{ number_format($shop->pivot->price ?? 0, 2) }}</div>
                        @endif
                    </div>
                    
                    <div class="product-detail__shop-actions">
                        <a href="{{ $shop->pivot->product_url ?? '#' }}" class="btn" target="_blank">Visit Shop</a>
                    </div>
                </div>
                @empty
                <div class="product-detail__no-shops">
                    No shops available for this product at the moment.
                </div>
                @endforelse
            </div>
        </div>
        
        <div class="product-detail__reviews">
            <h2 class="product-detail__subtitle">Product Reviews</h2>
            
            @if(auth()->check())
            <div class="product-detail__review-form">
                <h3>Write a Review</h3>
                <form action="{{ route('products.reviews.store', $product->id) }}" method="POST">
                    @csrf
                    <div class="rating-selector">
                        <span>Your Rating:</span>
                        <div class="rating-stars">
                            @for($i = 5; $i >= 1; $i--)
                            <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" required>
                            <label for="star{{ $i }}"></label>
                            @endfor
                        </div>
                    </div>
                    
                    <div class="input-wrapp">
                        <textarea name="review" class="input" placeholder="Your review" required></textarea>
                    </div>
                    
                    <button type="submit" class="btn">Submit Review</button>
                </form>
            </div>
            @endif
            
            <div class="product-detail__review-list">
                @forelse($reviews ?? [] as $review)
                <div class="product-detail__review">
                    <div class="product-detail__review-header">
                        <div class="product-detail__review-user">
                            <img src="{{ $review->user->avatar ?? asset('img/user.png') }}" alt="{{ $review->user->name ?? 'User' }}">
                            <span>{{ $review->user->name ?? 'User' }}</span>
                        </div>
                        <div class="product-detail__review-date">
                            {{ $review->created_at ? $review->created_at->format('M d, Y') : 'Date' }}
                        </div>
                    </div>
                    
                    <div class="product-detail__review-rating">
                        <div class="rating">
                            <div class="rating__body">
                                <div class="rating__active" style="width: {{ ($review->rating ?? 0) * 20 }}%;"></div>
                            </div>
                        </div>
                        <span>{{ $review->rating ?? 0 }}</span>
                    </div>
                    
                    <div class="product-detail__review-content">
                        {{ $review->content ?? 'No content' }}
                    </div>
                    
                    @if($review->shop_reply)
                    <div class="product-detail__review-reply">
                        <div class="product-detail__review-reply-header">
                            <strong>{{ $review->shop->name ?? 'Shop' }} replied:</strong>
                            <span>{{ $review->reply_date ? $review->reply_date->format('M d, Y') : 'Date' }}</span>
                        </div>
                        <div class="product-detail__review-reply-content">
                            {{ $review->shop_reply }}
                        </div>
                    </div>
                    @endif
                </div>
                @empty
                <div class="product-detail__no-reviews">
                    No reviews yet. Be the first to review this product!
                </div>
                @endforelse
            </div>
            
            @if(isset($reviews) && $reviews->hasPages())
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
        </div>
        
        <div class="product-detail__related">
            <h2 class="product-detail__subtitle">Related Products</h2>
            
            <div class="products__items">
                @forelse($relatedProducts ?? [] as $relatedProduct)
                <article class="products__item item-products">
                    <div class="item-products__main">
                        <a href="{{ route('products.show', $relatedProduct->id) }}" class="item-products__img">
                            <img src="{{ $relatedProduct->image ?? asset('img/products/item-1.png') }}" alt="{{ $relatedProduct->name ?? 'Product' }}">
                        </a>
                        <div class="item-products__wrapp">
                            <a href="{{ route('products.show', $relatedProduct->id) }}" class="item-products__title">{{ $relatedProduct->name ?? 'Product Name' }}</a>
                            <div class="item-products__location _icon-location">Tashkent, Uzbekistan</div>
                            <div class="item-products__price">
                                @if($relatedProduct->sale_price && $relatedProduct->sale_price < $relatedProduct->price)
                                    <span class="item-products__price-new">${{ number_format($relatedProduct->sale_price, 2) }}</span>
                                    <div class="item-products__price-old">${{ number_format($relatedProduct->price, 2) }}</div>
                                @else
                                    <span class="item-products__price-new">${{ number_format($relatedProduct->price ?? 0, 2) }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </article>
                @empty
                <div class="products__empty">
                    No related products found.
                </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection

@section('custom-css')
<style>
    .product-detail__container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px 15px;
    }
    
    .product-detail__breadcrumbs {
        margin-bottom: 20px;
        font-size: 14px;
    }
    
    .product-detail__breadcrumbs a {
        color: #666;
        text-decoration: none;
    }
    
    .product-detail__breadcrumbs a:hover {
        color: #333;
    }
    
    .product-detail__main {
        display: flex;
        margin-bottom: 40px;
    }
    
    .product-detail__gallery {
        width: 40%;
        margin-right: 30px;
    }
    
    .product-detail__main-image {
        margin-bottom: 10px;
        text-align: center;
        border: 1px solid #eee;
        padding: 10px;
    }
    
    .product-detail__main-image img {
        max-width: 100%;
        height: auto;
    }
    
    .product-detail__thumbnails {
        display: flex;
        flex-wrap: wrap;
    }
    
    .product-detail__thumbnail {
        width: 60px;
        height: 60px;
        margin-right: 10px;
        margin-bottom: 10px;
        border: 1px solid #eee;
        padding: 5px;
        cursor: pointer;
    }
    
    .product-detail__thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
    
    .product-detail__info {
        width: 60%;
    }
    
    .product-detail__title {
        font-size: 24px;
        margin-bottom: 20px;
    }
    
    .product-detail__specs {
        margin-bottom: 20px;
    }
    
    .product-detail__spec {
        margin-bottom: 10px;
    }
    
    .product-detail__spec-title {
        font-weight: bold;
        margin-right: 10px;
    }
    
    .product-detail__subtitle {
        font-size: 20px;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }
    
    .product-detail__description {
        margin-bottom: 20px;
        line-height: 1.6;
    }
    
    .product-detail__shops {
        margin-bottom: 40px;
    }
    
    .product-detail__shop {
        display: flex;
        align-items: center;
        padding: 15px;
        border: 1px solid #eee;
        margin-bottom: 15px;
        border-radius: 5px;
    }
    
    .product-detail__shop-logo {
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 20px;
    }
    
    .product-detail__shop-logo img {
        max-width: 100%;
        max-height: 100%;
    }
    
    .product-detail__shop-info {
        width: 25%;
        margin-right: 20px;
    }
    
    .product-detail__shop-name {
        font-weight: bold;
        margin-bottom: 5px;
    }
    
    .product-detail__shop-rating {
        display: flex;
        align-items: center;
    }
    
    .product-detail__shop-rating .rating {
        margin-right: 10px;
    }
    
    .product-detail__shop-stock {
        width: 15%;
        margin-right: 20px;
    }
    
    .product-detail__shop-delivery {
        width: 20%;
        margin-right: 20px;
    }
    
    .product-detail__shop-price {
        width: 15%;
        margin-right: 20px;
        text-align: right;
    }
    
    .product-detail__shop-price-old {
        text-decoration: line-through;
        color: #888;
        font-size: 14px;
    }
    
    .product-detail__shop-price-current {
        font-size: 18px;
        font-weight: bold;
        color: #e74c3c;
    }
    
    .product-detail__shop-actions {
        width: 15%;
        text-align: right;
    }
    
    .product-detail__review-form {
        margin-bottom: 30px;
        padding: 20px;
        background: #f9f9f9;
        border-radius: 5px;
    }
    
    .product-detail__review-form h3 {
        margin-bottom: 15px;
    }
    
    .rating-selector {
        margin-bottom: 15px;
        display: flex;
        align-items: center;
    }
    
    .rating-stars {
        display: flex;
        flex-direction: row-reverse;
        margin-left: 15px;
    }
    
    .rating-stars input {
        display: none;
    }
    
    .rating-stars label {
        cursor: pointer;
        width: 25px;
        height: 25px;
        background: url("{{ asset('img/star-empty.svg') }}") no-repeat;
        background-size: contain;
    }
    
    .rating-stars input:checked ~ label,
    .rating-stars label:hover,
    .rating-stars label:hover ~ label {
        background: url("{{ asset('img/star-full.svg') }}") no-repeat;
        background-size: contain;
    }
    
    .product-detail__review {
        margin-bottom: 20px;
        padding: 15px;
        border: 1px solid #eee;
        border-radius: 5px;
    }
    
    .product-detail__review-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }
    
    .product-detail__review-user {
        display: flex;
        align-items: center;
    }
    
    .product-detail__review-user img {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        margin-right: 10px;
    }
    
    .product-detail__review-rating {
        margin-bottom: 10px;
        display: flex;
        align-items: center;
    }
    
    .product-detail__review-rating .rating {
        margin-right: 10px;
    }
    
    .product-detail__review-content {
        margin-bottom: 15px;
        line-height: 1.6;
    }
    
    .product-detail__review-reply {
        background: #f9f9f9;
        padding: 10px 15px;
        border-left: 3px solid #3498db;
    }
    
    .product-detail__review-reply-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 5px;
        font-size: 14px;
    }
    
    .product-detail__related {
        margin-top: 40px;
    }
    
    .product-detail__no-shops,
    .product-detail__no-reviews,
    .products__empty {
        padding: 20px;
        text-align: center;
        background: #f9f9f9;
        border-radius: 5px;
    }
    
    @media (max-width: 991px) {
        .product-detail__main {
            flex-direction: column;
        }
        
        .product-detail__gallery,
        .product-detail__info {
            width: 100%;
            margin-right: 0;
        }
        
        .product-detail__gallery {
            margin-bottom: 30px;
        }
        
        .product-detail__shop {
            flex-wrap: wrap;
        }
        
        .product-detail__shop-logo {
            width: 60px;
            height: 60px;
        }
        
        .product-detail__shop-info {
            width: calc(100% - 80px);
            margin-right: 0;
            margin-bottom: 15px;
        }
        
        .product-detail__shop-stock,
        .product-detail__shop-delivery,
        .product-detail__shop-price {
            width: 33.33%;
            margin-right: 0;
            margin-bottom: 15px;
        }
        
        .product-detail__shop-actions {
            width: 100%;
            text-align: center;
        }
    }
    
    @media (max-width: 576px) {
        .product-detail__shop-stock,
        .product-detail__shop-delivery,
        .product-detail__shop-price {
            width: 100%;
            text-align: left;
            margin-bottom: 10px;
        }
        
        .product-detail__review-header {
            flex-direction: column;
        }
        
        .product-detail__review-user {
            margin-bottom: 5px;
        }
    }
</style>
@endsection