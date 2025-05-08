@extends('adminlte::page')

@section('title', 'Shops')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Shops</h1>
        <a href="{{ route('admin.shops.create') }}" class="btn btn-primary">Add Shop</a>
    </div>
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
                        <th>Shop Name</th>
                        <th>User</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>XML Feed</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($shops as $shop)
                        <tr>
                            <td>{{ $shop->id }}</td>
                            <td>{{ $shop->shopProfile->shop_name ?? $shop->name }}</td>
                            <td>{{ $shop->name }}</td>
                            <td>{{ $shop->email }}</td>
                            <td>{{ $shop->shopProfile->contact_number ?? 'N/A' }}</td>
                            <td>
                                @if($shop->shopProfile && $shop->shopProfile->xml_link)
                                    <a href="{{ $shop->shopProfile->xml_link }}" target="_blank">View XML</a>
                                @else
                                    No XML
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.shops.edit', $shop->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.shops.destroy', $shop->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this shop?');" style="display: inline-block;">
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
                            <td colspan="7" class="text-center">No shops found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        {{ $shops->links() }}
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop