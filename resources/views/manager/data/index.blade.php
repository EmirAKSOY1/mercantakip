@extends('layout.app')
@section('title', 'Kümesler') 
@section('page', auth()->user()->roleUser->entegre->entegre_isim) 
@section('detail', ' Verileri') 
@section('content') 

	<div class="row">
        @if($datas->isEmpty())
        <br>
        <h3 style="text-align: center;">Henüz Hiç Veri Yokş</h3>
        @else
        <h3>Son Veriler</h3>
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Kümes</th>
                <th scope="col">Dış Isı</th>
                <th scope="col">Isı</th>
                <th scope="col">Nem</th>
                <th scope="col">Co2</th>
                <th scope="col">Tarih</th>
    
              </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                <tr>
                    <td>{{$data->kumes->name  ?? '-'}}</td>
                    <td>{{$data->DI  ?? '-'}}°C</td>
                    <td>{{$data->ISI ?? '-'}}°C</td>
                    <td>%{{$data->NE ?? '-'}}</td>
                    <td>{{$data->CO  ?? '-'}}ppm</td>
                    <td>{{$data->tarih ?? '-'}}</td>
                </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pagination-wrapper">
        {{ $datas->links('pagination::bootstrap-4') }} 
        
    </div>
    <div class="text-center">
        <span>Toplam Kayıt: {{$datas->total()}}</span>
    </div>
    @endif
	</div>

@endsection







