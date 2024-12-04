@extends('layout.app')
@section('title', 'Ana Sayfa') 
@section('page', 'Ana Sayfa') 
@section('detail', 'İzleme Rapor Paneli') 
@section('css')
<style>
    h3{
        color:rgba(25, 110, 121, 0.88);
    }

    @media (max-width:1600px) {/*Laptop*/
    .row {
        margin-bottom: 40px;
    }
    .container,
.container-fluid,
.container-sm,
.container-md,
.container-lg,
.container-xl,
.container-xxl {
    padding-right: 0rem;
    padding-left: 0.5rem;
  }
    #map {
            height: 53vh;
            width:100%;
            
            z-index: 1;
        }
        .table{
            width:80%;
        }
    .col-6 {
        margin-bottom: 30px;
    }
    #total_animal{
      height: 405px;
    }
    /* #alarmChart{
        margin: 50px;
    } */

  }
@media (min-width: 1600px) {
    .row {
        margin-bottom: 40px;
    }
    #map {
            height: 41vh;
            width:100%;
            
            z-index: 1;
        }

    .col-6 {
        margin-bottom: 30px;
    }
    #total_animal{
      height: 385px;
    }
}
@media (max-width: 1200px) {/*Telefon*/
  #map {
            height: 50vh;
            width:40vh%;
            z-index: 1;
            margin-bottom: 40px;
        }
        .order-0{
          margin-bottom: 40px;
        }
        .row{
          width:28rem;
        }
        #animalChart{
          width: 400px;
        }
        .g-0{
          height: 200px;
        }
        #total_animal{
          height: 250px;
          margin-bottom: 40px;
        }
        #lastData{
          margin-top:30px;
        }

}
</style>
@endsection
@section('content') 



<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <div class="col-xxl-8 mb-6 order-0">
        <div class="card" id="map">
          <div class="d-flex  row">
            <div class="col-m-9">
              <div class="card-body">
                <h6>Kümesler</h6>
                @if($datas->isEmpty())
                <br>
                <h3 style="text-align: center;">Henüz Hiç Veri Yok</h3>
            @else
                <br>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Kümes</th>
                            <th scope="col">D. Isı</th>
                            <th scope="col">İç Isı</th>
                            <th scope="col">Nem</th>
                            <th scope="col">Co2</th>
                            <th scope="col">S1</th>
                            <th scope="col">S2</th>
                            <th scope="col">Su</th>
                            <th scope="col">Yem</th>
                            <th scope="col">Ölüm</th>
                            <th scope="col">Tarih</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                            <tr>
                                <td>{{$data->name  ?? '-'}}</td>
                                <th>{{ $data->endkonData->first()->DI ?? '-' }}°C</th>
                                <th>{{ $data->endkonData->first()->ISI ?? '-' }}°C</th>
                                <th>%{{ $data->endkonData->first()->NE ?? '-' }}</th>
                                <th>{{ $data->endkonData->first()->CO ?? '-' }}pPm</th>
                                <th>{{ $data->dailyData->first()->s1 ?? '-' }}</th>
                                <th>{{ $data->dailyData->first()->s2 ?? '-' }}</th>
                                <th>{{ $data->hourlyData->first()->st ?? '-' }} <span>Lt</span></th>
                                <th>{{ $data->hourlyData->first()->yt ?? '-' }} Kg</th>
                                <th>{{ $data->dailyData->first()->os ?? '-' }}</th>
                                <th>{{ $data->endkonData->first()->tarih ?? '-' }}</th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination-wrapper">
                    {{ $datas->links('pagination::bootstrap-4') }} 
                    
                </div>
            @endif
              </div>
            </div>
  
          </div>
        </div>
      </div>
      
      <div class="col-lg-4 col-md-4 order-1">
        <div class="row">
  
          <div class="col-lg-6 col-md-12 col-6 mb-6">
            <div class="card h-100">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between mb-4">
                  <div class="avatar flex-shrink-0">
                    <i class="bx bx-data" style="font-size: 50px;"></i>
                  </div>
  
                </div>
                <p class="mb-1">Toplam Veri</p>
                <h4 class="card-title mb-3">{{$detail['data_count']}}</h4>
                
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-12 col-6 mb-6">
            <div class="card h-100">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between mb-4">
                  <div class="avatar flex-shrink-0">
                    <img src="http://endkon.com.tr/storage/images/hen.png" alt="paypal" class="rounded">
                  </div>
  
                </div>
                <p class="mb-1">Toplam Hayvan</p>
                <h4 class="card-title mb-3">{{$detail['animal_count']}}</h4>
                
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-12 col-6 mb-6">
            <div class="card h-100">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between mb-4">
                  <div class="avatar flex-shrink-0">
                    <i class="bx bx-alarm-exclamation" style="font-size: 50px;"></i>
                  </div>
  
                </div>
                <p class="mb-1">Son Ölüm Sayısı</p>
                <h4 class="card-title mb-3">{{$detail['total_death']}}</h4>
                
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-12 col-6 mb-6">
            <div class="card h-100">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between mb-4">
                  <div class="avatar flex-shrink-0">
                    <i class="bx bx-user" style="font-size: 50px;"></i>
                  </div>
  
                </div>
                <p class="mb-1">Toplam Çalışan</p>
                <h4 class="card-title mb-3">{{$detail['total_employess']}}</h4>
                
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Total Revenue -->
      <div class="col-12 col-xxl-8 order-2 order-md-3 order-xxl-2 mb-6">
        <div class="card" id="total_animal">
          <div class="row row-bordered g-0">
            <canvas id="alarmChart" width="900" height="380"></canvas>
  
          </div>
        </div>
      </div>
      <!--/ Total Revenue -->
      <div class="col-12 col-md-8 col-lg-12 col-xxl-4 order-3 order-md-2">
        <div class="row" id="row">
          <div class="col-6 mb-6">
            <div class="card h-100">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between mb-4">
                  <div class="avatar flex-shrink-0">
                    <i class="bx bxs-factory" style="font-size: 50px;"></i>
                  </div>
  
                </div>
                <p class="mb-1">Toplam Alarm</p>
                <h4 class="card-title mb-3">{{$detail['total_alarms']}}</h4>
                
              </div>
            </div>
          </div>
          <div class="col-6 mb-6">
            <div class="card h-100">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between mb-4">
                  <div class="avatar flex-shrink-0">
                    <i class="bx bx-grid" style="font-size: 50px;"></i>
                  </div>
  
                </div>
                <p class="mb-1">Bugünkü Alarm Sayısı</p>
                <h4 class="card-title mb-3">{{$detail['today_alarm']}}</h4>
                
              </div>
            </div>
          </div>
  
          <div class="col-6 mb-6">
            <div class="card h-100">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between mb-4">
                  <div class="avatar flex-shrink-0">
                    <i class="bx bx-git-pull-request" style="font-size: 50px;"></i>
                  </div>
  
                </div>
                <p class="mb-1">Oluşturulan Talep</p>
                <h4 class="card-title mb-3">{{ is_numeric($detail['total_request']) ? $detail['total_request'] : 0 }}</h4>
                
              </div>
            </div>
          </div>
          <div class="col-6 mb-6">
            <div class="card h-100">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between mb-4">
                  <div class="avatar flex-shrink-0">
                    <i class="bx bxs-factory" style="font-size: 50px;"></i>
                  </div>
  
                </div>
                <p class="mb-1">Toplam Kümes</p>
                <h4 class="card-title mb-3">{{$detail['total_coop']}}</h4>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>



</div>


@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const alarmChartData = @json($alarmChartData);
        const labels = Object.keys(alarmChartData);
        const data = Object.values(alarmChartData);
        const ctx_alarm = document.getElementById('alarmChart').getContext('2d');
        new Chart(ctx_alarm, {
            type: 'line', 
            data: {
                labels: labels,
                datasets: [{
                    label: 'Son 7 Günün Alarm Sayıları',
                    data: data,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    tooltip: {
                        enabled: true
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Tarih'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Alarm Sayısı'
                        },
                        beginAtZero: true,
                        ticks: {
                      stepSize: 1 // Y ekseninde 1 birimlik artış sağlar
                  },
                  max:20
                        
                    }
                }
            }
        });
      </script>
@endsection



