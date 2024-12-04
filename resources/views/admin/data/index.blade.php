@extends('layout.app')
@section('title', 'Veriler') 
@section('page', 'Veriler') 
@section('detail', 'Son Gelen Veriler') 
@section('css')
<style>
    .pagination-wrapper {
    display: flex;
    justify-content: center; /* Ortalamak için */
    margin-top: 20px; /* Üstüne biraz boşluk bırakmak isterseniz */
}

.pagination {
    list-style-type: none;
}

</style>

@endsection
@section('content')
<div class="container">
<div class="form-group">
    <form method="GET" action="{{ route('endkon_data.index') }}" class="mb-4">
        <label for="entegre_id">Entegre Seçin:</label>
        <select name="entegre_id" id="entegre_id" class="form-control" onchange="this.form.submit()">
            <option value="">Tüm Entegreler</option>
            @foreach ($entegreler as $entegre)
                <option value="{{ $entegre->id }}" {{ request('entegre_id') == $entegre->id ? 'selected' : '' }}>
                    {{ $entegre->entegre_isim }}
                </option>
            @endforeach
        </select>
    </form>
    
</div>
	<div class="row">
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Kümes</th>
                <th scope="col">Dış Isı</th>
                <th scope="col">Isı</th>
                <th scope="col">Nem</th>
                <th scope="col">Co2</th>
                <th scope="col">Tarih</th>

                <th scope="col">
                    <a href="{{ route('endkon_data.index', array_merge(request()->all(), ['sort_by' => 'created_at', 'order' => request('order') == 'asc' ? 'desc' : 'asc'])) }}">
                        G. Tarih 
                        @if(request('sort_by') == 'created_at')
                            <span class="sort-arrow">{{ request('order') == 'asc' ? '↓' : '↑' }}</span>
                        @else
                            <span class="sort-arrow">↑↓</span>
                        @endif
                    </a>
                </th>
              </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                <tr>
                    <th scope="row">                    
                        <a href="{{ route('endkon_data.show', $data->kumes->id) }}">
                            {{ $data->kumes->name ?? '?' }}
                        </a>
                    </th>
                    <td>{{$data->DI  ?? '-'}}°C</td>
                    <td>{{$data->ISI ?? '-'}}°C</td>
                    <td>%{{$data->NE ?? '-'}}</td>
                    <td>{{$data->CO  ?? '-'}}ppm</td>
                    
                    <td>{{$data->tarih ?? '-'}}</td>
                    <td>{{$data->created_at ?? '-'}}</td>
                </tr>
        @endforeach
        </tbody>
    </table>
	</div>
    <div class="pagination-wrapper">
        {{ $datas->appends(request()->except('page'))->links('pagination::bootstrap-4') }} 
    </div>
    
<div class="text-center">
    <span>Toplam Kayıt: {{$datas->total()}}</span>
</div>
</div> 
@endsection
@section('js')
<script>
    document.getElementById('entegre_id').addEventListener('change', function() {
        this.form.submit();
    });
</script>


@endsection







