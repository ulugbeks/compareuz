@extends('adminlte::page')

@section('title', 'Edit Review')

@section('content_header')
    <h1>Edit Review</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Review Details</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>User</label>
                        <p>{{ $review->user->name ?? 'N/A' }}</p>
                    </div>
                    <div class="form-group">
                        <label>Product</label>
                        <p>{{ $review->product->name ?? 'N/A' }}</p>
                    </div>
                    <div class="form-group">
                        <label>Shop</label>
                        <p>{{ $review->shop->shop_name ?? 'N/A' }}</p>
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
                        </p>
                    </div>
                    <div class="form-group">
                        <label>Review Content</label>
                        <p>{{ $review->content }}</p>
                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <p>{{ $review->created_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Moderation</h3>
                </div>
                <form action="{{ route('admin.reviews.update', $review->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="pending" {{ $review->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ $review->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ $review->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="admin_notes">Admin Notes</label>
                            <textarea name="admin_notes" id="admin_notes" class="form-control" rows="5">{{ $review->admin_notes }}</textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update Review</button>
                        <a href="{{ route('admin.reviews.index') }}" class="btn btn-default float-right">Cancel</a>
                    </div>
                </form>
            </div>
            
            @if($review->shop_reply)
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Shop Reply</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Reply Date</label>
                            <p>{{ $review->reply_date->format('d M Y H:i') }}</p>
                        </div>
                        <div class="form-group">
                            <label>Reply Content</label>
                            <p>{{ $review->shop_reply }}</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@stop