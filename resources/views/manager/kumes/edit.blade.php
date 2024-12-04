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
mercanam radyoka
	<div class="container">
        
        <form action="{{ route('manager_kumes.update',$kumes->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="entegre_id" value="{{$kumes->id}}">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Kümes Adı</label>
                <input type="text" class="form-control" name="name" id="exampleFormControlInput1" value="{{$kumes->name}}">
            </div>
            <br>
            <div id="map" style="height: 400px;"></div>

            <!-- Latitude ve Longitude Alanları (Gizli) -->
            <input type="hidden" id="latitude"  name="latitude"  value="{{ $kumes->latitude }}">
            <input type="hidden" id="longitude" name="longitude" value="{{ $kumes->longitude }}">
            <br>
            <button type="submit" class="btn btn-primary">Kümes Güncelle</button>
        </form>
	</div>

@endsection

@section('js')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    // Haritayı Başlat (mevcut enlem ve boylam ile)
    var lat = {{ $kumes->latitude }};
    var lng = {{ $kumes->longitude }};
    var map = L.map('map').setView([lat, lng], 10);

    // Harita katmanı ekleme
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
    }).addTo(map);

    // Mevcut konum için işaretçi
    var marker = L.marker([lat, lng], { draggable: true }).addTo(map);

    // İşaretçi sürüklendiğinde enlem ve boylamı güncelle
    marker.on('dragend', function(e) {
        var newLatLng = marker.getLatLng();
        document.getElementById('latitude').value = newLatLng.lat;
        document.getElementById('longitude').value = newLatLng.lng;
    });
</script>

@endsection





