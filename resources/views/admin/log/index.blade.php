@extends('layout.app')
@section('title', 'Log Kayıtları') 
@section('page', 'Log Kayıtları') 
@section('detail', 'Kullanıcı Aktiviteleri') 
@section('css')
<style>
    .pagination-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 20px; 
}

.pagination {
    list-style-type: none;
}

</style>

@endsection
@section('content') 
<div class="container">
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Kullanıcı Adı</label>
        <form method="GET" action="{{ route('admin_log.index') }}" class="mb-3">
            <div class="input-group">
                <input 
                    type="text" 
                    class="form-control" 
                    name="user_name" 
                    id="exampleFormControlInput1" 
                    value="{{ request('user_name') }}" 
                    placeholder="Kullanıcı Adı Ara">
                <button class="btn btn-primary" type="submit">Ara</button>
            </div>
        </form>
    </div>
	<div class="row">
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">id</th>
                <th scope="col">Ip</th>
                <th scope="col">İşlem</th>
                <th scope="col">Kullanıcı</th>
                
                <th scope="col">
                    <a href="{{ route('admin_log.index', array_merge(request()->all(), ['sort_by' => 'date', 'order' => request('order') == 'asc' ? 'desc' : 'asc'])) }}">
                        Tarih 
                        @if(request('sort_by') == 'date')
                            <span class="sort-arrow">{{ request('order') == 'asc' ? '↓' : '↑' }}</span>
                        @else
                            <span class="sort-arrow">↑↓</span>
                        @endif
                    </a>
                </th>
              </tr>
            </thead>
            <tbody>
                @foreach ($logs as $log)
                <tr>
                    <td>{{$log->id  ?? '-'}}</td>
                    <td>{{$log->ip ?? '-'}}</td>
                    <td>{{$log->action ?? '-'}}</td>
                    <td>{{$log->user->name ?? '-'}} {{$log->user->surname ?? '-'}}</td>
                    
                    <td>{{$log->date ?? '-'}}</td>
                </tr>
        @endforeach
        </tbody>
    </table>
	</div>
    <div class="pagination-wrapper">
        {{ $logs->appends(request()->except('page'))->links('pagination::bootstrap-4') }} 
    </div>
    
<div class="text-center">
    <span>Toplam Kayıt: {{$logs->total()}}</span>
</div>
</div>
@endsection








