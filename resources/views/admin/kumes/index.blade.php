@extends('layout.app')
@section('title', 'Entegreler') 
@section('page', $entegre->entegre_isim) 
@section('detail', ' Kümesleri') 
@section('css')
<style>

.delete-button {
    
    
    border: none; 
    border-radius: 5px; 
    cursor: pointer;
}

.delete-button:hover {
    background-color: #d32f2fa3;
}
@media (max-width:1600px) {
    #seri{
        margin:-5px;
    }
}
</style>

@endsection
@section('content') 

<button type="button"  onclick="window.location='{{ route('kumes.create',$entegre->id) }}'" class="btn btn-success">Yeni Kümes Ekle</button>

	
        @if($entegre->coops->isEmpty())
        <br>
        <h3 style="text-align: center;">Henüz hiç kümes eklenmemiş</h3>
        @else
        
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Kümes</th>
                <th scope="col">Sn</th>
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
                @foreach ($entegre->coops as $coop)
                <tr>
                    <th>
                        <a href="{{ route('endkon_data.show', $coop->id) }}" >
                            {{ $coop->name ?? '-' }}
                        </a>
                    </th>
                    <th>{{$coop->id}}</th>
                    
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
                    
                    <th>
                        <button type="button" id="seri" class="btn" onclick="window.location='{{ route('kumes.gosterge', $coop->id) }}'"><i class="fa-solid fa-gauge"></i></button> 
                        <button type="button" id="seri" class="btn" onclick="window.location='{{ route('kumes.dashboard', $coop->id) }}'"><i class="fa-solid fa-chart-line"></i></button> 
                      


                        <div class="btn-group">
                            <button type="button" id="seri" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-file-export"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <button type="button" class="btn" onclick="window.location='{{ route('generate-pdf',$coop->id) }}'">
                                        <i class="fa-solid fa-file-pdf"></i>(Pdf)
                                    </button>
                                </li>
                                <li>
                                    <button type="button" id="seri" class="btn" onclick="window.location='{{ route('export.endkon.data',$coop->id) }}'">
                                        <i class="fa-solid fa-file-excel"></i> (Excel)
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <!-- Dropdown Menü -->
                        <div class="btn-group">
                            <button type="button" class="btn dropdown-toggle" id="seri" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <button class="dropdown-item" id="seri" onclick="window.location='{{ route('kumes.edit', $coop->id) }}'">
                                        <i class="fa-solid fa-pen-to-square"></i> Düzenle
                                    </button>
                                </li>
                                <li>
                                    <form action="{{ route('kumes.destroy', $coop->id) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item delete-button">
                                            <i class="fa-solid fa-trash"></i> Sil
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </th>
                    
                </tr>
        @endforeach
        </tbody>
    </table>
    @endif
	
	

@endsection
@section('js')
<script>

$('.delete-button').on('click', function(e) {
    e.preventDefault(); 
    const form = $(this).closest('.delete-form'); 
    Swal.fire({
        title: 'Silmek istediğinizden emin misiniz?',
        text: "Bu işlem geri alınamaz ve tüm veriler silinir!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Evet, sil!',
        cancelButtonText: 'İptal'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
});

</script>
@endsection






