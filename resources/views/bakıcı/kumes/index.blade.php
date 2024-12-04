@extends('layout.app')
@section('title', 'Kümesler') 
@section('page', auth()->user()->roleUser->entegre->entegre_isim) 
@section('detail', ' Kümesleri') 
@section('content') 

	<div class="row">
        @if($coops->isEmpty())
        <br>
        <h3 style="text-align: center;">Henüz hiç kümes eklenmemiş</h3>
        @else
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Kümes</th>
                <th scope="col">SN</th>
                <th scope="col">Dış Isı</th>
                <th scope="col">İç Isı</th>
                <th scope="col">Nem</th>
                <th scope="col">Co2</th>
                <th scope="col">S1</th>
                <th scope="col">S2</th>
                <th scope="col">Su</th>
                <th scope="col">Yem</th>
                <th scope="col">Ölüm</th>
                <th scope="col">Tarih</th>
                <th scope="col">İşlemler</th>

              </tr>
            </thead>
            <tbody>
                @foreach ($coops as $coop)
                <tr>
                    <th>{{ $coop->name  }}</th>
                    <th>{{ $coop->id  }}</th>
                    <th>{{ $coop->endkonData->last()->DI ?? '-' }}°C</th>
                    <th>{{ $coop->endkonData->last()->ISI ?? '-' }}°C</th>
                    <th>%{{ $coop->endkonData->last()->NE ?? '-' }}</th>
                    <th>{{ $coop->endkonData->last()->CO ?? '-' }}pPm</th>
                    <th>{{ $coop->dailyData->last()->s1 ?? '-' }}</th>
                    <th>{{ $coop->dailyData->last()->s2 ?? '-' }}</th>
                    <th>{{ $coop->hourlyData->last()->st ?? '-' }} Lt</th>
                    <th>{{ $coop->hourlyData->last()->yt ?? '-' }} Kg</th>
                    <th>{{ $coop->dailyData->last()->os ?? '-' }}</th>
                    <th>{{ $coop->endkonData->last()->tarih ?? '-' }}</th>
                    <th>
                        <button type="button" class="btn" onclick="window.location='{{ route('kumes.gosterge', $coop->id) }}'"><i class="fa-solid fa-gauge"></i></button> 
                        <button type="button" class="btn" onclick="window.location='{{ route('kumes.dashboard', $coop->id) }}'"><i class="fa-solid fa-chart-line"></i></button> 
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







