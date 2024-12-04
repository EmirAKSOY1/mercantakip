@extends('layout.app')
@section('title', 'Kümes') 
@section('page', 'Kümes') 
@section('detail', 'Yeni Kümes') 
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
        
        <form action="{{ route('notifications.update',$notification->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Bildirim Başlığı</label>
                <input type="text" class="form-control" name="title" id="exampleFormControlInput1" value="{{$notification->title}}">
            </div>
            <br>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Bildirim İçeriği</label>
                <textarea type="textarea" class="form-control" name="content" id="exampleFormControlInput1">{{$notification->content}}</textarea>
            </div>

            <br>
            <button type="submit" class="btn btn-primary">Bildirim Güncelle</button>
        </form>
	</div>

@endsection






