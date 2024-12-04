@extends('layout.app')
@section('title', 'Kullanıcı') 
@section('page', 'Kullanıcı') 
@section('detail', 'Yeni Kullanıcı') 
@section('css')

<style>
    .alert-dismissible {
        position: relative;
    }
    .close {
        position: absolute;
        right: 1rem;
        top: 0.5rem;
        color: inherit; 
        font-size: 1.25rem;
        opacity: 0.5; 
    }
</style>
@endsection
@section('content') 
<div class="container">
    <h1>Yeni Destek Talebi Oluştur</h1>

    <!-- Başarılı mesaj -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('manager_support.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">Talep Başlığı</label>
            <input type="text" class="form-control" id="title" name="title" required value="{{ old('title') }}">
            @error('title')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group mt-3">
            <label for="description">Açıklama</label>
            <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
            @error('description')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group mt-3">
            <label for="images">Resim Ekle (Birden Fazla)</label>
            <input type="file" class="form-control" id="images" name="images[]" multiple>
            @error('images')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            @error('images.*')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3">Talep Oluştur</button>
    </form>
</div>

@endsection







