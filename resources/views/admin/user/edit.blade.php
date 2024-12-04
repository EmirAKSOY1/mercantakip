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
        
        <form action="{{ route('user.update',$user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Kullanıcı Adı</label>
                <input type="text" class="form-control" name="name" id="exampleFormControlInput1" value="{{$user->name}}">
            </div>
            <br>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Kullanıcı Soyadı</label>
                <input type="text" class="form-control" name="surname" id="exampleFormControlInput1" value="{{$user->surname}}">
            </div>
            <br>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Kullanıcı Mail</label>
                <input type="email" class="form-control" name="email" id="exampleFormControlInput1" value="{{$user->email}}" >
            </div>
            <br>
            <div class="mb-3">
                <label for="entegre_id">Entegre Seçin:</label>
                <select class="form-control"  name="entegre_id" id="entegre_id" required>
                    <option value="">Seçiniz</option>
                    @foreach($entegreler as $entegre)
                    <option value="{{ $entegre->id }}" {{ $user->roleUser->entegre->id == $entegre->id ? 'selected' : '' }}>
                        {{ $entegre->entegre_isim }}
                    </option>
                    @endforeach
                </select>
            </div>
            <br>
            <div class="mb-3">
                <label for="role_id">Rol Seçin:</label>
                <select class="form-control" name="role_id" id="role_id" required>
                    <option value="">Seçiniz</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ $user->roles->first()->id == $role->id ? 'selected' : '' }}>
                            {{ $role->role_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <br>

            <button type="submit" class="btn btn-primary">Kullanıcıyı Kaydet</button>
        </form>
	</div>

@endsection







