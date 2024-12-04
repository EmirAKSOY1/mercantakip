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
        
        <form action="{{ route('user.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Kullanıcı Adı</label>
                <input type="text" class="form-control" name="name" id="exampleFormControlInput1">
            </div>
            <br>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Kullanıcı Soyadı</label>
                <input type="text" class="form-control" name="surname" id="exampleFormControlInput1" ">
            </div>
            <br>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Kullanıcı Mail</label>
                <input type="email" class="form-control" name="mail" id="exampleFormControlInput1" >
            </div>
            <br>
            <div class="mb-3">
                <label for="role_id">Rol Seçin:</label>
                <select class="form-control"  name="role_id" id="role_id" required>
                    <option value="">Seçiniz</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                    @endforeach
                </select>
            </div>
            <br>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Kullanıcı Şifre</label>
                <input type="password" class="form-control" name="pass" id="exampleFormControlInput1" >
            </div>
            <br>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Kullanıcı Şifre Onay</label>
                <input type="password" class="form-control" name="pass_verify" id="exampleFormControlInput1">
            </div>
            <br>

            <button type="submit" class="btn btn-primary">Kullanıcıyı Kaydet</button>
        </form>
	</div>

@endsection







