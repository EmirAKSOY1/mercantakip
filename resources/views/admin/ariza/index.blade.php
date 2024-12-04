@extends('layout.app')
@section('title', 'Arızalar') 
@section('page', 'Arızalar') 
@section('detail', '') 
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
    <form method="GET" action="{{ route('ariza.index') }}" class="mb-4">
        <label for="entegre_id">Entegre Seçin:</label>
        <select name="entegre_id" id="entegre_id" class="form-control">
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
                <th scope="col">Arıza Id</th>
                <th scope="col">Kümes</th>
                <th scope="col">Açıklama</th>
                <th scope="col">Tarih</th>
                <th scope="col">Gelme Tarihi</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($arizalar as $ariza)
                <tr>
                    <td>{{$ariza->id  ?? '-'}}</td>
                    <th scope="row">                    
                        <a href="{{ route('endkon_data.show', $ariza->kumes->id) }}">
                            {{ $ariza->kumes->name ?? '?' }}
                        </a>
                    </th>
                    <td>{{$ariza->description  ?? '-'}}</td>
                    <td>{{$ariza->date  ?? '-'}}</td>
                    <td>{{$ariza->created_at  ?? '-'}}</td>

                </tr>
        @endforeach
        </tbody>
    </table>
	</div>
    <div class="pagination-wrapper">
        {{$arizalar->appends(request()->except('page'))->links('pagination::bootstrap-4') }} 
    </div>
    <div class="text-center">
        <span>Toplam Kayıt: {{$arizalar->total()}}</span>
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







