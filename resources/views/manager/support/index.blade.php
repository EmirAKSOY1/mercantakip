@extends('layout.app')
@section('title', 'Destek Talepleri') 
@section('page', auth()->user()->roleUser->entegre->entegre_isim) 
@section('detail', ' Talep') 
@section('content') 

	<div class="row">
        <button type="button"  onclick="window.location='{{ route('manager_support.create') }}'" class="btn btn-success">Yeni Talep Oluştur</button>
        @if($supportRequests->isEmpty())
        <br>
        <h3 style="text-align: center;">Henüz hiç talep oluşturmamışsınız</h3>
        @else
        <h3 style="text-align: center;">Destek Talepleriniz</h3>
        <br>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Talep Id</th>
                    <th scope="col">Talep Adı</th>
                    <th scope="col">Talep Açıklaması</th>
                    <th scope="col">Talep Oluşturulma Tarihi</th>
                    <th scope="col">Talep Durumu</th>
                    <th scope="col">Yanıtlayan</th>
                    <th scope="col">Yanıtlama Tarihi</th>
                    <th scope="col">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($supportRequests as $supportRequest)
                <tr>
                    <td>{{$supportRequest->id  ?? '-'}}</td>
                    <td>{{$supportRequest->title   ?? '-'}}</td>
                    <td>{{$supportRequest->description  ?? '-'}}</td>
                    <td>{{$supportRequest->created_at->format('d-m-Y') ?? '-'}}</td>
                    <td>
                        @if($supportRequest->status === 'open')
                            Talep Oluşturuldu
                        @elseif($supportRequest->status === 'in_progress')
                            İnceleniyor
                        @elseif($supportRequest->status === 'resolved')
                            Cevaplandı
                        @endif
                    </td>
                    <th>{{ $supportRequest->responder->name ?? '--'}}</th>
                    @if($supportRequest->status === 'open')
                        <th>--</th>
                    @else
                        <th>{{$supportRequest->updated_at->format('d/m/Y H:i')  ?? '--'}}</th>
                    @endif
                    
                    <th>
                        <button type="button" class="btn" onclick="window.location='{{ route('manager_support.show', $supportRequest->id) }}'"><i class="fa-solid fa-eye"></i></button> 
                    </th>
                </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pagination-wrapper">
        {{ $supportRequests->links('pagination::bootstrap-4') }} 
        
    </div>
    <div class="text-center">
        <span>Toplam Kayıt: {{$supportRequests->total()}}</span>
    </div>
    @endif
	</div>

@endsection







