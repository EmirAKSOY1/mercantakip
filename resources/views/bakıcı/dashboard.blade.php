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
.btn{
    padding: 0;
    margin-right:25px;
}
.table > :not(caption) > * > * {
  padding: 0.8rem;
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
                <th scope="col">İşlemler</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data)
            <tr>
                <th>
                    <a href="{{ route('endkon_data.show', $data->id) }}" >
                        {{ $data->name ?? '-' }}
                    </a>
                </th>
                <th>{{ $data->endkonData->first()->DI ?? '-' }}°C</th>
                <th>{{ $data->endkonData->first()->ISI ?? '-' }}°C</th>
                <th>%{{ $data->endkonData->first()->NE ?? '-' }}</th>
                <th>{{ $data->endkonData->first()->CO ?? '-' }}pPm</th>
                <th>{{ $data->dailyData->first()->s1 ?? '-' }}</th>
                <th>{{ $data->dailyData->first()->s2 ?? '-' }}</th>
                <th>{{ $data->hourlyData->first()->st ?? '-' }} <span>Lt</span></th>
                <th>{{ $data->hourlyData->first()->yt ?? '-' }} Kg</th>
                <th>{{ $data->dailyData->first()->os ?? '-' }}</th>
                <th>{{ $data->endkonData->first()->tarih ?? '-' }}</th>
                <th>
                    <button type="button" class="btn" onclick="window.location='{{ route('kumes.gosterge', $data->id) }}'"><i class="fa-solid fa-gauge"></i></button> 
                    <button type="button" class="btn" onclick="window.location='{{ route('kumes.dashboard', $data->id) }}'"><i class="fa-solid fa-chart-line"></i></button> 
                    <div class="btn-group">
                        <button type="button" id="seri" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-file-export"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <button type="button" class="btn" onclick="window.location='{{ route('generate-pdf',$data->id) }}'">
                                    <i class="fa-solid fa-file-pdf"></i>(Pdf)
                                </button>
                            </li>
                            <li>
                                <button type="button" id="seri" class="btn" onclick="window.location='{{ route('export.endkon.data',$data->id) }}'">
                                    <i class="fa-solid fa-file-excel"></i> (Excel)
                                </button>
                            </li>
                        </ul>
                    </div>
                </th>
            </tr>
        @endforeach
        </tbody>
    </table>
    
    <div class="pagination-wrapper">
        {{$datas->links('pagination::bootstrap-4') }} 
        
    </div>
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



