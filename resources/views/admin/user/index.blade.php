@extends('layout.app')
@section('title', 'Kullanıcılar') 
@section('page', 'Kullanıcı') 
@section('detail', 'Bilgileri') 
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
<button type="button"  onclick="window.location='{{ route('user.create') }}'" class="btn btn-success">Yeni Kullanıcı Ekle</button>
	<div class="row">
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Kullanıcı Id</th>
                <th scope="col">İsim</th>
                <th scope="col">Entegre</th>
                <th scope="col">Rol</th>
                <th scope="col">İşlemler</th>

              </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $user->id ?? '?' }}</th>
                    <th>{{ $user->name ?? '?' }} {{ $user->surname ?? '?' }}</th>
                    <th>{{ $user->roleUser->entegre->entegre_isim}}</th>
                    <th>{{ $user->roles->first()->role_name }}</th>
                    <th>
                        <button type="button" class="btn" onclick="window.location='{{ route('user.edit', $user->id) }}'"><i class="fa-solid fa-pen-to-square"></i></button> 
                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline;" class="delete-form">
                            @csrf
                            @method('DELETE')
                        <button type="submit" class="btn delete-button"><i class="fa-solid fa-trash"></i> Sil</button>
                        </form>
                        
                    </th>
                </tr>
        @endforeach
        </tbody>
    </table>
	</div>
    <div class="pagination-wrapper">
    {{ $users->links('pagination::bootstrap-4') }}
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


/*
   $('.delete-button').on('click', function(e) {
    e.preventDefault(); // Sayfanın yeniden yüklenmesini önle

    const url = $(this).data('url'); // Butona tıklanan elemanın data-url'ini al

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
            // DELETE isteği gönder
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}' // CSRF token gönder
                },
                success: function(response) {
                    // Başarı mesajını göster
                    Swal.fire(
                        'Silindi!',
                        'Kullanıcı başarıyla silindi.',
                        'success'
                    ).then(() => {
                        location.reload(); // Sayfayı yeniden yükle
                    });
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    Swal.fire(
                        'Hata!',
                        'Bir hata oluştu: ',
                        'error'
                    );
                }
            });
        }
    });
});
*/

</script>
@endsection






