@extends('layout.app')
@section('title', 'Kümesler') 
@section('page', auth()->user()->roleUser->entegre->entegre_isim) 
@section('detail', ' Alarmları') 
@section('content') 

	<div class="row">
        @if($arizadatas->isEmpty())
        <br>
        <h3 style="text-align: center;">Henüz hiç kümes eklenmemiş</h3>
        @else
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Alarm Id</th>
                <th scope="col">Kümes Adı</th>
                <th scope="col">Alarm Açıklaması</th>
                <th scope="col">Alarm Tarihi</th>
                <th scope="col">Alarm Gelme Tarihi</th>

              </tr>
            </thead>
            <tbody>
                @foreach ($arizadatas as $arizadata)
                <tr>
                    <td>{{$arizadata->id  ?? '-'}}</td>
                    <td>{{$arizadata->kumes->name  ?? '-'}}</td>
                    <td>{{$arizadata->description  ?? '-'}}</td>
                    <td>{{$arizadata->date ?? '-'}}</td>
                    <td>{{$arizadata->created_at ?? '-'}}</td>
                </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pagination-wrapper">
        {{ $arizadatas->links('pagination::bootstrap-4') }} 
        
    </div>
    <div class="text-center">
        <span>Toplam Kayıt: {{$arizadatas->total()}}</span>
    </div>
    @endif
	</div>

@endsection







