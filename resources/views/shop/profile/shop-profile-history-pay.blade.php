@extends('layouts.app')

@section('title', 'Payment History - Shop Profile')

@section('content')
<section class="profile">
    <div class="profile__container">
        <div class="profile__wrapp">
            @include('shop.profile.sidebar')
            <div class="profile__block">
                <h1 class="profile__title section-title">Payment History</h1>
                <p>Information about payment history</p>
                <div class="pay-table__wrapp">
                    <div class="profile__pay-table pay-table">
                        <div class="pay-table__row title">
                            <div class="pay-table__item">Invoice Number</div>
                            <div class="pay-table__item">Amount</div>
                            <div class="pay-table__item">Date</div>
                            <div class="pay-table__item">Payment Method</div>
                            <div class="pay-table__item">Status</div>
                        </div>
                        
                        @forelse($payments ?? [] as $payment)
                            <div class="pay-table__row">
                                <div class="pay-table__item">{{ $payment->invoice_number }}</div>
                                <div class="pay-table__item">${{ number_format($payment->amount, 2) }}</div>
                                <div class="pay-table__item">{{ $payment->created_at->format('d.m.Y') }}</div>
                                <div class="pay-table__item">{{ $payment->payment_method }}</div>
                                <div class="pay-table__item">{{ $payment->status }}</div>
                            </div>
                        @empty
                            <div class="pay-table__row">
                                <div class="pay-table__item" colspan="5" style="text-align: center;">No payment history yet</div>
                            </div>
                        @endforelse
                    </div>
                </div>
                
                @if(isset($payments) && $payments->hasPages())
                    <div class="pagination">
                        <button {{ $payments->onFirstPage() ? 'disabled' : '' }} type="button" class="pagination__arrow _icon-arrow-left" onclick="window.location='{{ $payments->previousPageUrl() }}'"></button>
                        <ul class="pagination__list">
                            @foreach(range(1, $payments->lastPage()) as $page)
                                @if($page == 1 || $page == $payments->lastPage() || abs($page - $payments->currentPage()) < 3)
                                    <li class="pagination__item">
                                        <a href="{{ $payments->url($page) }}" class="pagination__link {{ $page == $payments->currentPage() ? '_active' : '' }}">{{ $page }}</a>
                                    </li>
                                @elseif(abs($page - $payments->currentPage()) == 3)
                                    <li class="pagination__item">
                                        <span class="pagination__link">...</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                        <button {{ $payments->hasMorePages() ? '' : 'disabled' }} type="button" class="pagination__arrow _icon-arrow-right" onclick="window.location='{{ $payments->nextPageUrl() }}'"></button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection