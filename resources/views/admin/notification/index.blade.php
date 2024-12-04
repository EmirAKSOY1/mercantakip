@extends('layout.app')
@section('title', 'Bildirimler') 
@section('page', 'Bildirimler') 
@section('detail', ' bildirim oluşturun') 
@section('css')
<style>

.delete-button {
    
    color: rgb(0, 0, 0); /* Beyaz yazı rengi */
    border: none; /* Kenar yok */
    padding: 8px 12px; /* İçerik boşluğu */
    border-radius: 5px; /* Köşe yuvarlama */
    cursor: pointer; /* İmleç el */
}

.delete-button:hover {
    background-color: #d32f2f; /* Hover durumunda daha koyu kırmızı */
}
</style>

@endsection
@section('content') 
<div class="container">
<button type="button"  onclick="window.location='{{ route('notifications.create') }}'" class="btn btn-success">Yeni Bildirim Oluştur</button>

	<div class="row">
        @if($notification->isEmpty())
        <br>
        <h3 style="text-align: center;">Henüz hiç bildirim eklenmemiş</h3>
        @else
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Bildirim Id</th>
                <th scope="col">Bildirim Başlık</th>
                <th scope="col">Bildirim İçerik</th>
                <th scope="col">Oluşturan</th>
                <th scope="col">İşlemler</th>

              </tr>
            </thead>
            <tbody>
                @foreach ($notification as $not)
                <tr>
                    <th scope="row">{{ $not->id ?? '?' }}</th>
                    <th>{{Str::limit($not->title, 60, '...')}}</th>
                    <th>{{Str::limit($not->content, 60, '...')}}</th>
                    <th>{{$not->user->name}} {{$not->user->surname}}</th>
                    
                    <th>
                        <button type="button" class="btn" onclick="window.location='{{ route('notifications.edit', $not->id) }}'"><i class="fa-solid fa-pen-to-square"></i></button> 

                        <form action="{{ route('notifications.destroy',$not->id) }}" method="POST" style="display:inline;" class="delete-form">
                            @csrf
                            @method('DELETE')
                        <button type="submit" class="btn delete-button"><i class="fa-solid fa-trash"></i> Sil</button>
                        </form>
                    </th>
                </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pagination-wrapper">
        {{ $notification->links('pagination::bootstrap-4') }} 
        
    </div>
    <div class="text-center">
        <span>Toplam Kayıt: {{$notification->total()}}</span>
    </div>
    @endif
	</div>
</div>
@endsection
@section('js')
<script>

$('.delete-button').on('click', function(e) {
    e.preventDefault(); // Prevent the default button action

    const form = $(this).closest('.delete-form'); // Get the closest form

    Swal.fire({
        title: 'Silmek istediğinizden emin misiniz?',
        text: "Bu işlem geri alınamaz!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Evet, sil!'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit(); // Submit the form if confirmed
        }
    });
});

</script>
@endsection






