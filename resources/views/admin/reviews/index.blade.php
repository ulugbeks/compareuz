@extends('adminlte::page')

@section('title', 'Reviews')

@section('content_header')
    <h1>Reviews</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">All Reviews</h3>
            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <select id="status-filter" class="form-control float-right">
                        <option value="">All statuses</option>
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap" id="reviews-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product</th>
                        <th>Shop</th>
                        <th>User</th>
                        <th>Rating</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reviews as $review)
                        <tr>
                            <td>{{ $review->id }}</td>
                            <td>{{ Str::limit($review->product->name ?? 'N/A', 30) }}</td>
                            <td>{{ $review->shop->shop_name ?? 'N/A' }}</td>
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
                            <td>{{ $review->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.reviews.show', $review->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.reviews.edit', $review->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this review?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No reviews found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            <div class="float-right">
                {{ $reviews->links() }}
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Reviews Statistics</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="far fa-star"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Reviews</span>
                            <span class="info-box-number">{{ $reviews->total() }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="fas fa-clock"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Pending Reviews</span>
                            <span class="info-box-number">{{ $reviews->where('status', 'pending')->count() }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="fas fa-check"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Approved Reviews</span>
                            <span class="info-box-number">{{ $reviews->where('status', 'approved')->count() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(function () {
            // Status filter functionality
            $('#status-filter').on('change', function() {
                var status = $(this).val();
                
                if (status === '') {
                    // Show all rows if no status is selected
                    $('#reviews-table tbody tr').show();
                } else {
                    // Hide all rows first
                    $('#reviews-table tbody tr').hide();
                    
                    // Show only rows with the selected status
                    $('#reviews-table tbody tr').each(function() {
                        var rowStatus = $(this).find('td:eq(5)').text().trim().toLowerCase();
                        if (rowStatus.indexOf(status.toLowerCase()) !== -1) {
                            $(this).show();
                        }
                    });
                }
            });
        });
    </script>
@stop