@extends('layout.app')
@section('title', 'Ana Sayfa') 
@section('page', 'Ana Sayfa') 
@section('detail', 'İzleme Rapor Paneli') 
@section('css')
<style>
h3{
    color:rgba(25, 110, 121, 0.88);
}
@media (max-width:1600px) {/*Laptop*/
    .container{
        padding-right: 9.625rem;
        padding-left: 5.625rem;
    }

}
</style>
@endsection
@section('content') 


<div class="row">
    <div class="card">
        @if($entegre->coops->isEmpty())
        <br>
        <h3 style="text-align: center;">Henüz hiç kümes eklenmemiş</h3>
        @else
    <br>
    <h3>Kümesler</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Kümes</th>
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
            </tr>
        </thead>
        <tbody>
            @foreach ($entegre->coops as $coop)
            <tr>
                <th>
                    <a href="{{ route('endkon_data.show', $coop->id) }}" >
                        {{ $coop->name ?? '-' }}
                    </a>
                </th>
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
            </tr>
        @endforeach
        </tbody>
    </table>
    @endif
    </div>
</div>
<br>
<br>
<br>
<div class="row">
    <div class="card">
        @if($arizadatas->isEmpty())
        <br>
        <h3 style="text-align: center;">Henüz hiç Alarm eklenmemiş</h3>
        @else
        <br>
        <h3>Son Alarmlar</h3>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Alarm Id</th>
                <th scope="col">Kümes Adı</th>
                <th scope="col">Alarm Açıklaması</th>
                <th scope="col">Alarm Tarihi</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($arizadatas as $arizadata)
                    <tr>
                        <td>{{$arizadata->id  ?? '-'}}</td>
                        <td>{{$arizadata->kumes->name  ?? '-'}}</td>
                        <td>{{$arizadata->description  ?? '-'}}</td>
                        <td>{{$arizadata->date ?? '-'}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endif
        <br>
        <br>
    </div>
</div>
<br>


@endsection



