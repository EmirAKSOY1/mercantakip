@extends('layout.app')
@section('title', 'Destek Talepleri') 
@section('page', 'Kullanıcı Destek') 
@section('detail', ' Talepleri') 
@section('content') 
<div class="container">
	<div class="row">
        @if($supportRequests->isEmpty())
        <br>
        <h3 style="text-align: center;">Henüz hiç talep oluşturulmamış</h3>
        @else
        <h3 style="text-align: center;">Destek Talepleri</h3>
        <br>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Talep Id</th>
                    <th scope="col">Talep Başlığı</th>
                    <th scope="col">Talep Açıklaması</th>
                    <th scope="col">Talep Oluşturulma Tarihi</th>
                    <th scope="col">Talep Durumu</th>
                    <th scope="col">Talep Oluşturan</th>
                    <th scope="col">Yanıtlayan Kişi</th>
                    <th scope="col">Son İşlem</th>
                    <th scope="col">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($supportRequests as $supportRequest)
                <tr>
                    <td>{{$supportRequest->id  ?? '-'}}</td>
                    <td>{{ Str::limit($supportRequest->title, 10, '...') ?? '-' }}</td>
                    <td>{{ Str::limit($supportRequest->description, 10, '...') ?? '-' }}</td>
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
                    <th>{{ $supportRequest->requester->name ?? '-' }} {{ $supportRequest->requester->surname ?? '-' }}</th>
                    <th>{{ $supportRequest->responder->name ?? '-' }} {{ $supportRequest->responder->surname ?? '-' }}</th>

                    @if($supportRequest->status === 'open')
                        <th>--</th>
                    @else
                        <th>{{$supportRequest->updated_at->format('d/m/Y H:i')  ?? '--'}}</th>
                    @endif
                    
                    <th>
                        <button type="button" class="btn" onclick="window.location='{{ route('admin_support.show', $supportRequest->id) }}'"><i class="fa-solid fa-eye"></i></button> 
                        @if ($supportRequest->status != 'resolved')
                            <button type="button" class="btn" data-toggle="modal" data-target="#responseModal"><i class="fa-solid fa-reply"></i></button> 
                        @endif
                        
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

    <!--Burasını Yanıtlama modalı için ekledim buraya ifelse koy eğer zaten yanıtlandıysa açılmasın burası  -->
    <div class="modal fade" id="responseModal" tabindex="-1" role="dialog" aria-labelledby="responseModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="responseModalLabel">Cevap Yaz</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="responseForm" action="{{ route('admin_support.update', $supportRequest->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="response">Cevabınız:</label>
                            <textarea class="form-control" id="response" name="response" rows="4" required></textarea>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    <button type="submit" class="btn btn-primary" id="submitResponse">Kaydet</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    </div>
@endsection






