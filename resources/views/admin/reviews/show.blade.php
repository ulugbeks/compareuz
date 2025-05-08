@extends('adminlte::page')

@section('title', 'View Review')

@section('content_header')
    <h1>Review Details</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Review #{{ $review->id }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.reviews.edit', $review->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('admin.reviews.index') }}" class="btn btn-default btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>User</label>
                                <p><strong>{{ $review->user->name ?? 'N/A' }}</strong> ({{ $review->user->email ?? '' }})</p>
                            </div>
                            <div class="form-group">
                                <label>Product</label>
                                <p><strong>{{ $review->product->name ?? 'N/A' }}</strong></p>
                            </div>
                            <div class="form-group">
                                <label>Shop</label>
                                <p><strong>{{ $review->shop->shop_name ?? 'N/A' }}</strong></p>
                            </div>
                            <div class="form-group">
                                <label>Rating</label>
                                <p>
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating)
                                            <i class="fas fa-star text-warning"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                    ({{ $review->rating }}/5)
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <p>
                                    @if($review->status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif($review->status == 'approved')
                                        <span class="badge bg-success">Approved</span>
                                    @elseif($review->status == 'rejected')
                                        <span class="badge bg-danger">Rejected</span>
                                    @endif
                                </p>
                            </div>
                            <div class="form-group">
                                <label>Date</label>
                                <p>{{ $review->created_at->format('d M Y H:i') }}</p>
                            </div>
                            <div class="form-group">
                                <label>Admin Notes</label>
                                <p>{{ $review->admin_notes ?: 'No admin notes' }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h3 class="card-title">Review Content</h3>
                                </div>
                                <div class="card-body">
                                    {{ $review->content }}
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @if($review->shop_reply)
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-info">
                                    <h3 class="card-title">Shop Reply</h3>
                                    <div class="card-tools">
                                        <small>{{ $review->reply_date->format('d M Y H:i') }}</small>
                                    </div>
                                </div>
                                <div class="card-body">
                                    {{ $review->shop_reply }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop