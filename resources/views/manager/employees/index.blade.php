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

<button type="button"  onclick="window.location='{{ route('manager_employees.create') }}'" class="btn btn-success">Yeni Kullanıcı Ekle</button>
	<div class="row">
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Kullanıcı Id</th>
                <th scope="col">İsim</th>
                <th scope="col">Soyisim</th>
                <th scope="col">Rol</th>
                <th scope="col">İşlemler</th>

              </tr>
            </thead>
            <tbody>
                @foreach ($employees as $user)
                <tr>
                    <th scope="row">{{ $user->id ?? '?' }}</th>
                    <th>{{ $user->name ?? '?' }}</th>
                    <th>{{ $user->surname ?? '?'}}</th>
                    <th>{{ $user->roles->first()->role_name }}</th>
                    <th>
                        <button type="button" class="btn" onclick="window.location='{{ route('manager_employees.edit', $user->id) }}'"><i class="fa-solid fa-pen-to-square"></i></button> 
                        <form action="{{ route('manager_employees.destroy', $user->id) }}" method="POST" style="display:inline;" class="delete-form">
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






