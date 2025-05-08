@extends('adminlte::page')

@section('title', 'XML Feeds')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>XML Feeds</h1>
        <a href="{{ route('admin.xml-feeds.create') }}" class="btn btn-primary">Add XML Feed</a>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Shop</th>
                        <th>URL</th>
                        <th>Status</th>
                        <th>Last Processed</th>
                        <th>Products</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($xmlFeeds as $feed)
                        <tr>
                            <td>{{ $feed->id }}</td>
                            <td>{{ $feed->shop->shop_name ?? ($feed->shop->user->name ?? 'N/A') }}</td>
                            <td>
                                <a href="{{ $feed->url }}" target="_blank">{{ Str::limit($feed->url, 30) }}</a>
                            </td>
                            <td>
                                @if($feed->is_active)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $feed->last_processed ? $feed->last_processed->format('d M Y H:i') : 'Never' }}</td>
                            <td>
                                <span class="badge badge-primary">{{ $feed->products_count }}</span>
                                @if($feed->error_count > 0)
                                    <span class="badge badge-danger">{{ $feed->error_count }} errors</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <form action="{{ route('admin.xml-feeds.process', $feed->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="fas fa-sync"></i> Process
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.xml-feeds.edit', $feed->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.xml-feeds.destroy', $feed->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this XML feed?');" style="display: inline-block;">
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
                            <td colspan="7" class="text-center">No XML feeds found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        {{ $xmlFeeds->links() }}
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop