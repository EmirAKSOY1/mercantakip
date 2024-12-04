@extends('layout.app')
@section('title', 'Kümesler') 
@section('page', auth()->user()->roleUser->entegre->entegre_isim) 
@section('detail', ' Kümesleri') 
@section('css')

@section('content') 
<button type="button"  onclick="window.location='{{ route('manager_kumes.create') }}'" class="btn btn-success">Yeni Kümes Oluştur</button>
	<div class="row">
        @if($coops->isEmpty())
        <br>
        <h3 style="text-align: center;">Henüz hiç kümes eklenmemiş</h3>
        @else
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Kümes İsim</th>
                <th scope="col">Dış Isı</th>
                <th scope="col">İç Isı</th>
                <th scope="col">Nem</th>
                <th scope="col">Co2</th>
                <th scope="col">Tarih</th>
        
                <th scope="col">İşlemler</th>

              </tr>
            </thead>
            <tbody>
                @foreach ($coops as $coop)
                <tr>

                    <th>{{ $coop->name ?? '?' }}</th>
                    <th>{{ $coop->endkonData->first()->DI ?? '?' }}°C</th>
                    <th>{{ $coop->endkonData->first()->ISI ?? '?' }}°C</th>
                    <th>%{{ $coop->endkonData->first()->NE ?? '?' }}</th>
                    <th>{{ $coop->endkonData->first()->CO ?? '?' }}pPm</th>
                    <th>{{ $coop->endkonData->first()->tarih ?? '?' }}</th>
                    <th>
                        <button type="button" class="btn" onclick="window.location='{{ route('kumes.gosterge', $coop->id) }}'"><i class="fa-solid fa-gauge"></i></button> 
                        <button type="button" class="btn" onclick="window.location='{{ route('kumes.dashboard', $coop->id) }}'"><i class="fa-solid fa-chart-line"></i></button> 
                        <button type="button" class="btn" onclick="window.location='{{ route('generate-pdf',$coop->id) }}'"><i class="fa-solid fa-file-pdf"></i></button> 
                        <button type="button" class="btn" onclick="window.location='{{ route('export.endkon.data',$coop->id) }}'"><i class="fa-solid fa-file-excel"></i></button> 
                        <button type="button" class="btn" onclick="window.location='{{ route('manager_kumes.edit', $coop->id) }}'"><i class="fa-solid fa-pen-to-square"></i></button> 
                    </th>
                </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pagination-wrapper">
        {{ $coops->links('pagination::bootstrap-4') }} 
        
    </div>
    <div class="text-center">
        <span>Toplam Kayıt: {{$coops->total()}}</span>
    </div>
    @endif
	</div>

@endsection







