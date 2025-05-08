@extends('adminlte::page')

@section('title', 'Campaigns')

@section('content_header')
    <h1>Campaigns</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Shop</th>
                        <th>Type</th>
                        <th>Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($campaigns as $campaign)
                        <tr>
                            <td>{{ $campaign->id }}</td>
                            <td>{{ $campaign->shop->shop_name ?? $campaign->shop->user->name ?? 'N/A' }}</td>
                            <td>{{ ucfirst($campaign->type) }}</td>
                            <td>{{ $campaign->name }}</td>
                            <td>{{ $campaign->start_date ? $campaign->start_date->format('d M Y') : 'N/A' }}</td>
                            <td>{{ $campaign->end_date ? $campaign->end_date->format('d M Y') : 'N/A' }}</td>
                            <td>
                                @if($campaign->status == 'pending')
                                    <span class="badge badge-warning">Pending</span>
                                @elseif($campaign->status == 'active')
                                    <span class="badge badge-success">Active</span>
                                @elseif($campaign->status == 'rejected')
                                    <span class="badge badge-danger">Rejected</span>
                                @elseif($campaign->status == 'completed')
                                    <span class="badge badge-secondary">Completed</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.campaigns.edit', $campaign->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.campaigns.destroy', $campaign->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this campaign?');" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No campaigns found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        {{ $campaigns->links() }}
    </div>
@stop