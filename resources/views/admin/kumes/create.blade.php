@extends('layout.app')
@section('title', 'Kümes') 
@section('page', 'Kümes') 
@section('detail', 'Yeni Kümes') 
@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<style>
    .alert-dismissible {
        position: relative;
    }
    .close {
        position: absolute;
        right: 1rem;
        top: 0.5rem;
        color: inherit; 
        font-size: 1.25rem;
        opacity: 0.5; 
    }
</style>
@endsection
@section('content') 

	<div class="container">
        
        <form action="{{ route('kumes.store') }}" method="POST">
            @csrf
            <input type="hidden" name="entegre_id" value="{{$id}}">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Kümes Adı</label>
                <input type="text" class="form-control" name="name" id="exampleFormControlInput1">
            </div>
            <br>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Cihaz Seri No</label>
                <input type="text" class="form-control" name="sn" id="exampleFormControlInput1" placeholder="Eğer değer girilmezse otomatik atanır">
            </div>
            <br>
            <div id="map" style="height: 400px;"></div>

            <!-- Latitude ve Longitude Alanları (Gizli) -->
            <input type="hidden" id="latitude"  name="latitude">
            <input type="hidden" id="longitude" name="longitude">
            <br>
            <button type="submit" class="btn btn-primary">Kümesi Kaydet</button>
        </form>
	</div>

@endsection

@section('js')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    // Haritayı Başlat
    var map = L.map('map').setView([39.9334, 32.8597], 6); // Başlangıç konumu (Türkiye merkez)

    // Harita katmanı ekleme
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
    }).addTo(map);

    // Tıklama işaretçisini tanımla
    var marker;

    // Haritaya tıklama işlevi ekle
    map.on('click', function(e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;

        // Daha önce işaretçi varsa kaldır
        if (marker) {
            map.removeLayer(marker);
        }

        // Yeni işaretçi oluştur ve ekle
        marker = L.marker([lat, lng]).addTo(map);

        // Gizli alanları güncelle
        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;
    });
</script>

@endsection





