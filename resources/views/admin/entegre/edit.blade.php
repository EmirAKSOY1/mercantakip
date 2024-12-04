@extends('layout.app')
@section('title', 'Entegre') 
@section('page', 'Entegre') 
@section('detail', 'Düzenle') 
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
        <form action="{{ route('entegreler.update',$entegre->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Kullanıcı Adı</label>
                <input type="text" class="form-control" name="entegre_isim" id="exampleFormControlInput1" value="{{$entegre->entegre_isim}}">
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Entegre Güncelle</button>
        </form>
	</div>

@endsection







