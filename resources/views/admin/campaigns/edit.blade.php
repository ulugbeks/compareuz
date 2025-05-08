@extends('adminlte::page')

@section('title', 'Edit Campaign')

@section('content_header')
    <h1>Edit Campaign</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.campaigns.update', $campaign->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Shop</label>
                            <input type="text" class="form-control" value="{{ $campaign->shop->shop_name ?? $campaign->shop->user->name ?? 'N/A' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Campaign Type</label>
                            <input type="text" class="form-control" value="{{ ucfirst($campaign->type) }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Campaign Name</label>
                            <input type="text" class="form-control" value="{{ $campaign->name }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Start Date</label>
                            <input type="text" class="form-control" value="{{ $campaign->start_date ? $campaign->start_date->format('d M Y') : 'N/A' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>End Date</label>
                            <input type="text" class="form-control" value="{{ $campaign->end_date ? $campaign->end_date->format('d M Y') : 'N/A' }}" readonly>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                <option value="pending" {{ old('status', $campaign->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="active" {{ old('status', $campaign->status) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="rejected" {{ old('status', $campaign->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                <option value="completed" {{ old('status', $campaign->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="admin_notes">Admin Notes</label>
                            <textarea name="admin_notes" id="admin_notes" class="form-control @error('admin_notes') is-invalid @enderror" rows="5">{{ old('admin_notes', $campaign->admin_notes) }}</textarea>
                            @error('admin_notes')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        @if($campaign->type == 'banner' && $campaign->banner_image)
                            <div class="form-group">
                                <label>Banner Image</label>
                                <div>
                                    <img src="{{ asset($campaign->banner_image) }}" alt="Banner" style="max-width: 300px;">
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update Campaign</button>
                <a href="{{ route('admin.campaigns.index') }}" class="btn btn-default">Cancel</a>
            </form>
        </div>
    </div>
@stop