@extends('layout.app')
@section('title', 'Entegreler') 
@section('page', 'Entegreler') 
@section('detail', 'Yeni Entegre') 
@section('css')

<style>
    .alert-dismissible {
        position: relative;
    }
    .close {
        position: absolute;
        right: 1rem;
        top: 0.5rem;
        color: inherit; /* Uyumlu renk */
        font-size: 1.25rem; /* İsteğe bağlı: daha büyük çarpı */
        opacity: 0.5; /* Çarpı için saydamlık */
    }
</style>
@endsection
@section('content') 

	<div class="container">
        
        <form action="{{ route('entegreler.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Entegre Adı</label>
                <input type="text" class="form-control" name="entegre" id="exampleFormControlInput1">
              </div>
              <br>
            <!-- Diğer form alanları buraya eklenebilir -->

            <button type="submit" class="btn btn-primary">Kaydet</button>
        </form>
	</div>

@endsection







