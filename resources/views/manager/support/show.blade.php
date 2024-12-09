@extends('layout.app')
@section('title', 'Destek Talepleri') 
@section('page', auth()->user()->roleUser->entegre->entegre_isim) 
@section('detail', 'Talep Detayları') 
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
<style>
    .support-request-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        border-radius: 8px;
        background-color: #f9f9f9;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .support-request-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .support-request-header h2 {
        font-size: 24px;
        color: #333;
    }

    .support-request-details {
        margin-bottom: 20px;
    }

    .support-request-details h4 {
        font-size: 18px;
        color: #555;
    }

    .support-request-details p {
        font-size: 16px;
        color: #666;
    }

    .image-gallery {
        display: flex;
        flex-wrap: wrap;
        margin-top: 20px;
    }

    .image-gallery img {
        width: 100px;
        height: auto;
        margin-right: 10px;
        border-radius: 4px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
    }

    .response-section {
        margin-top: 20px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        background-color: #e9ffe9;
    }

    .response-section p {
        margin: 5px 0;
    }
</style>
@endsection

@section('content') 
<div class="support-request-container">
    <div class="support-request-header">
        <h2>{{ $supportRequest->id }} Numaralı Talebiniz Hakkında</h2>
    </div>
    
    <div class="support-request-details">
        <p><strong>Talep Başlığı:</strong> {{ $supportRequest->title }}</p>
        <p><strong>Talep İçeriği:</strong> {{ $supportRequest->description }}</p>
        <p><strong>Talep Durumu:</strong> 
            @if ($supportRequest->status === 'open')
                Talep oluşturuldu
            @elseif ($supportRequest->status === 'in_progress')
                İnceleniyor
            @elseif ($supportRequest->status === 'resolved')
                Cevaplandı
            @endif
        </p>
        <p><strong>Talep Oluşturma Tarihi:</strong> {{ $supportRequest->created_at->format('d/m/Y H:i') }}</p>
        
        @if($supportRequest->response)
            <div class="response-section">
                <p><strong>Cevap:</strong> {{ $supportRequest->response }}</p>
                <p><strong>Cevaplanma Tarihi:</strong> {{ $supportRequest->updated_at->format('d/m/Y H:i') }}</p>
                <p><strong>Cevaplayan:</strong> {{ $supportRequest->responder->name }}</p>
            </div>
        @endif
    </div>
    
    @if($supportRequest->images)
    <h3>Yüklenen Görseller</h3>
    <div class="image-gallery">
        @foreach($supportRequest->images as $image)
        <a href="{{ asset('storage/'.$image) }}" data-lightbox="gallery" data-title="Tam Ekran Resim">
            <img src="{{ asset('storage/'.$image) }}" alt="Support Image" style="width: 200px; height: auto; margin-right: 10px;">
        </a>
        @endforeach
    </div>
@endif
</div>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
@endsection
