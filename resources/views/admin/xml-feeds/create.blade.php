@extends('adminlte::page')

@section('title', 'Create XML Feed')

@section('content_header')
    <h1>Create XML Feed</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.xml-feeds.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="shop_id">Shop</label>
                    <select name="shop_id" id="shop_id" class="form-control @error('shop_id') is-invalid @enderror" required>
                        <option value="">Select Shop</option>
                        @foreach($shops as $shop)
                            <option value="{{ $shop->id }}" {{ old('shop_id') == $shop->id ? 'selected' : '' }}>
                                {{ $shop->shop_name ?? $shop->user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('shop_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="url">XML Feed URL</label>
                    <input type="url" name="url" id="url" class="form-control @error('url') is-invalid @enderror" value="{{ old('url') }}" required>
                    @error('url')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="is_active">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                        Active
                    </label>
                </div>

                <button type="submit" class="btn btn-primary">Create XML Feed</button>
                <a href="{{ route('admin.xml-feeds.index') }}" class="btn btn-default">Cancel</a>
            </form>
        </div>
    </div>
@stop