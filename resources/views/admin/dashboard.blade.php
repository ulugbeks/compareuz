@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $usersCount ?? 0 }}</h3>
                    <p>Users</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ route('admin.users.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $shopsCount ?? 0 }}</h3>
                    <p>Shops</p>
                </div>
                <div class="icon">
                    <i class="fas fa-store"></i>
                </div>
                <a href="{{ route('admin.shops.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $productsCount ?? 0 }}</h3>
                    <p>Products</p>
                </div>
                <div class="icon">
                    <i class="fas fa-box"></i>
                </div>
                <a href="{{ route('admin.products.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $campaignsCount ?? 0 }}</h3>
                    <p>Campaigns</p>
                </div>
                <div class="icon">
                    <i class="fas fa-bullhorn"></i>
                </div>
                <a href="{{ route('admin.campaigns.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $categoriesCount ?? 0 }}</h3>
                    <p>Categories</p>
                </div>
                <div class="icon">
                    <i class="fas fa-folder"></i>
                </div>
                <a href="{{ route('admin.categories.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>{{ $reviewsCount ?? 0 }}</h3>
                    <p>Reviews</p>
                </div>
                <div class="icon">
                    <i class="fas fa-star"></i>
                </div>
                <a href="{{ route('admin.reviews.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <div class="small-box" style="background-color: #17a2b8; color: white;">
                <div class="inner">
                    <h3>{{ $pendingReviewsCount ?? 0 }}</h3>
                    <p>Pending Reviews</p>
                </div>
                <div class="icon">
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <a href="{{ route('admin.reviews.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <div class="small-box" style="background-color: #dc3545; color: white;">
                <div class="inner">
                    <h3>{{ $bugsCount ?? 0 }}</h3>
                    <p>New Bug Reports</p>
                </div>
                <div class="icon">
                    <i class="fas fa-bug"></i>
                </div>
                <a href="{{ route('admin.bugs.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-users mr-1"></i>
                        Latest Registered Users
                    </h3>
                </div>
                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Registered</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestUsers ?? [] as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at->format('d M Y') }}</td>
                                    <td>
                                        @if($user->role == 'user')
                                            <span class="badge bg-info">User</span>
                                        @elseif($user->role == 'shop')
                                            <span class="badge bg-success">Shop</span>
                                        @elseif($user->role == 'admin')
                                            <span class="badge bg-danger">Admin</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No users found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-bullhorn mr-1"></i>
                        Pending Campaigns
                    </h3>
                </div>
                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Shop</th>
                                <th>Type</th>
                                <th>Start Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pendingCampaigns ?? [] as $campaign)
                                <tr>
                                    <td>{{ $campaign->shop->shop_name ?? 'N/A' }}</td>
                                    <td>
                                        @if($campaign->type == 'banner')
                                            <span class="badge bg-info">Banner</span>
                                        @elseif($campaign->type == 'elements')
                                            <span class="badge bg-success">Elements</span>
                                        @endif
                                    </td>
                                    <td>{{ $campaign->start_date->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.campaigns.edit', $campaign->id) }}" class="btn btn-xs btn-primary">
                                            <i class="fas fa-edit"></i> Review
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No pending campaigns</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-rss mr-1"></i>
                        Latest XML Feed Imports
                    </h3>
                </div>
                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Shop</th>
                                <th>Products</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestImports ?? [] as $import)
                                <tr>
                                    <td>{{ $import->shop->shop_name }}</td>
                                    <td>{{ $import->products_count }}</td>
                                    <td>
                                        @if($import->error_message)
                                            <span class="badge bg-danger">Error</span>
                                        @else
                                            <span class="badge bg-success">Success</span>
                                        @endif
                                    </td>
                                    <td>{{ $import->updated_at->format('d M Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No imports found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-star mr-1"></i>
                        Latest Reviews
                    </h3>
                </div>
                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>User</th>
                                <th>Rating</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestReviews ?? [] as $review)
                                <tr>
                                    <td>{{ Str::limit($review->product->name ?? 'N/A', 30) }}</td>
                                    <td>{{ $review->user->name ?? 'N/A' }}</td>
                                    <td>
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review->rating)
                                                <i class="fas fa-star text-warning"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                    </td>
                                    <td>
                                        @if($review->status == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif($review->status == 'approved')
                                            <span class="badge bg-success">Approved</span>
                                        @elseif($review->status == 'rejected')
                                            <span class="badge bg-danger">Rejected</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No reviews found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .small-box .icon {
            font-size: 70px;
            top: 5px;
        }
    </style>
@stop

@section('js')
    <script>
        $(function() {
            // Initialize DataTables if needed
            // $('.data-table').DataTable();
            
            // Console message for debugging
            console.log('Admin dashboard loaded!');
        });
    </script>
@stop