@extends('layout.app')
@section('title', 'Veriler') 
@section('page', 'Veriler') 
@section('detail', 'Son Gelen Veriler') 
@section('css')
<style>
    .pagination-wrapper {
    display: flex;
    justify-content: center; /* Ortalamak için */
    margin-top: 20px; /* Üstüne biraz boşluk bırakmak isterseniz */
}

.pagination {
    list-style-type: none;
}

</style>

@endsection
@section('content') 
<h1>{{$datas->first()->kumes->entegre->entegre_isim}} Veriler</h1>
	<div class="row">
        <table class="table table-striped">
            <thead>
              <tr>
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
                    <td>{{$data->DI  ?? '-'}}°C</td>
                    <td>{{$data->ISI ?? '-'}}°C</td>
                    <td>%{{$data->NE ?? '-'}}</td>
                    <td>{{$data->CO  ?? '-'}}ppm</td>

                    <td>{{$data->tarih ?? '-'}}</td>
                </tr>
        @endforeach
        </tbody>
    </table>
	</div>
    <div class="pagination-wrapper">
    {{ $datas->links('pagination::bootstrap-4') }} 
    
</div>
@endsection







