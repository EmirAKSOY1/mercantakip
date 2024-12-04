@extends('layout.app')
@section('title', 'Kullanıcı') 
@section('page', 'Hesabım') 
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
        
        <form action="{{ route('myaccount.update',auth()->user()->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Kullanıcı Adı</label>
                <input type="text" class="form-control" name="name" id="exampleFormControlInput1" value="{{ auth()->user()->name }}">
            </div>
            <br>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Kullanıcı Soyadı</label>
                <input type="text" class="form-control" name="surname" id="exampleFormControlInput1" value="{{auth()->user()->surname}}">
            </div>
            <br>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Kullanıcı Mail</label>
                <input type="email" class="form-control" name="email" id="exampleFormControlInput1" value="{{auth()->user()->email}}" >
            </div>
            <br>
            <div class="mb-3">
                <label for="entegre_id">Eski Şifre</label>
                <input type="password" class="form-control" name="current_password" id="exampleFormControlInput1">
            </div>
            <br>
            <div class="mb-3">
                <div class="mb-3">
                    <label for="entegre_id">Yeni Şifre</label>
                    <input type="password" class="form-control" name="new_password" id="exampleFormControlInput1">
                </div>
            </div>
            <br>
            <div class="mb-3">
                <div class="mb-3">
                    <label for="entegre_id">Yeni Şifre Onay</label>
                    <input type="password" class="form-control" name="new_password_confirmation" id="exampleFormControlInput1">
                </div>
            </div>

            <br>

            <button type="submit" class="btn btn-primary">Kullanıcıyı Kaydet</button>
        </form>
	</div>

@endsection







