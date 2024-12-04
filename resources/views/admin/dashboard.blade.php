@extends('layout.app')

@section('css') 
	<style>
    

        .blinking-marker {
            background-color: red;
            border-radius: 50%;
            width: 15px;
            height: 15px;
            animation: blink 1s infinite;
            box-shadow: 0 0 10px rgba(255, 0, 0, 0.5);
        }
		@keyframes blink{
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
		}


    @media (max-width:1600px) {/*Laptop*/
    .row {
        margin-bottom: 40px;
    }
    #map {
            height: 36vh;
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
@media (min-width: 1600px) {
    .row {
        margin-bottom: 40px;
    }
    #map {
            height: 28vh;
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
/*#last{
margin-top:15px;
}*/
	</style>
@endsection
@section('title', 'Ana Sayfa') 
@section('page', 'Ana Sayfa') 
@section('detail', 'İzleme Rapor Paneli') 

@section('content') 

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row" >
    <div class="col-xxl-8 mb-6 order-0">
      <div class="card">
        <div class="d-flex  row">
          <div class="col-m-9">
            <div class="card-body">
              <h6>Alarmlar</h6>
              <div id="map"></div>
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
                  <i class='bx bx-data'  style="font-size: 50px;"></i>
                </div>

              </div>
              <p class="mb-1">Toplam Veri</p>
              <h4 class="card-title mb-3">{{$data['data_count']}}</h4>
              
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-12 col-6 mb-6">
          <div class="card h-100">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between mb-4">
                <div class="avatar flex-shrink-0">
                  <img src="{{asset("storage/images/hen.png")}}" alt="paypal" class="rounded">
                </div>

              </div>
              <p class="mb-1">Toplam Hayvan</p>
              <h4 class="card-title mb-3">{{$data['animal_count']}}</h4>
              
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-12 col-6 mb-6">
          <div class="card h-100">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between mb-4">
                <div class="avatar flex-shrink-0">
                  <i class='bx bx-alarm-exclamation'  style="font-size: 50px;"></i>
                </div>

              </div>
              <p class="mb-1">Toplam Alarm</p>
              <h4 class="card-title mb-3">{{$data['alarm_count']}}</h4>
              
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-12 col-6 mb-6">
          <div class="card h-100">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between mb-4">
                <div class="avatar flex-shrink-0">
                  <i class='bx bx-user' style="font-size: 50px;"></i>
                </div>

              </div>
              <p class="mb-1">Toplam Kullanıcı</p>
              <h4 class="card-title mb-3">{{$data['user_count']}}</h4>
              
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Total Revenue -->
    <div class="col-12 col-xxl-8 order-2 order-md-3 order-xxl-2 mb-6">
      <div class="card" id="total_animal" >
        <div class="row row-bordered g-0">
          <canvas id="animalChart"></canvas>

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
                  <i class='bx bxs-factory'  style="font-size: 50px;"></i>
                </div>

              </div>
              <p class="mb-1">Toplam Entegre</p>
              <h4 class="card-title mb-3">{{$data['entegre_count']}}</h4>
              
            </div>
          </div>
        </div>
        <div class="col-6 mb-6">
          <div class="card h-100">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between mb-4">
                <div class="avatar flex-shrink-0">
                  <i class='bx bx-grid' style="font-size: 50px;" ></i>
                </div>

              </div>
              <p class="mb-1">Toplam Kümes</p>
              <h4 class="card-title mb-3">{{$data['kumes_count']}}</h4>
              
            </div>
          </div>
        </div>

        <div class="col-6 mb-6">
          <div class="card h-100">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between mb-4">
                <div class="avatar flex-shrink-0">
                  <i class='bx bx-git-pull-request' style="font-size: 50px;" ></i>
                </div>

              </div>
              <p class="mb-1">Toplam Talep</p>
              <h4 class="card-title mb-3">{{$data['request_count']}}</h4>
              
            </div>
          </div>
        </div>
        <div class="col-6 mb-6">
          <div class="card h-100">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between mb-4">
                <div class="avatar flex-shrink-0">
                  <i class='bx bx-question-mark' style="font-size: 50px;" ></i>
                </div>

              </div>
              <p class="mb-1">Bekleyen Talepler</p>
              <h4 class="card-title mb-3">{{$data['open_request_count']}}</h4>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <!-- Order Statistics -->
    <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-6">
      <div class="card h-100">
        <div class="card-header d-flex justify-content-between">
          <div class="card-title mb-0">
            <h5 class="mb-1 me-2">Talepler</h5>
            
          </div>

        </div>
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-6" style="position: relative;">
            <!-- Toplam Talep Kısmı -->
            <div class="d-flex flex-column align-items-center gap-1">
              <h3 class="mb-1">{{$data['request_count']}}</h3>
              <small>Toplam Talep</small>
            </div>
            
            <!-- Doughnut Grafik Kısmı -->
            <div style="min-height: 117.55px; width: 150px;"> <!-- Width ayarıyla grafiği yerleştiriyoruz -->
              <canvas id="myDoughnutChart"></canvas>
            </div>
          </div>
        
          <ul class="p-0 m-0">
            <li class="d-flex align-items-center mb-5">
              <div class="avatar flex-shrink-0 me-3">
                <span class="avatar-initial rounded bg-label-success"><i class='bx bx-check-shield'></i></span>
              </div>
              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                  <h6 class="mb-0">Cevaplandı</h6>
                </div>
                <div class="user-progress">
                  <h6 class="mb-0">{{$data['resolved_count']}}</h6>
                </div>
              </div>
            </li>
            <li class="d-flex align-items-center mb-5">
              <div class="avatar flex-shrink-0 me-3">
                <span class="avatar-initial rounded bg-label-primary"><i class='bx bx-question-mark'></i></span>
              </div>
              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                  <h6 class="mb-0">İnceleniyor</h6>
                </div>
                <div class="user-progress">
                  <h6 class="mb-0">{{$data['in_progress_count']}}</h6>
                </div>
              </div>
            </li>
            <li class="d-flex align-items-center mb-5">
              <div class="avatar flex-shrink-0 me-3">
                <span class="avatar-initial rounded bg-label-info"><i class='bx bx-git-pull-request' ></i></span>
              </div>
              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                  <h6 class="mb-0">Talep Oluşturuldu</h6>
                </div>
                <div class="user-progress">
                  <h6 class="mb-0">{{$data['open_count']}}</h6>
                </div>
              </div>
            </li>
          </ul>
        </div>
        </div>
        </div>
        
    <!--/ Order Statistics -->
  
    <!-- Expense Overview -->
    <div class="col-md-6 col-lg-4 order-1 mb-6">
      <div class="card h-100">
        <div class="card-body">
          <div class="tab-content p-0">
            <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel" style="position: relative;">
              <div class="d-flex mb-6">

                <div>
                  <h5 class="mb-0">Alarm Analizi</h5>

                </div>
              </div>
              <br>
              <br>
              <br>
              <br>
              <canvas id="alarmChart" width="300" height="300"></canvas>

            <div class="resize-triggers"><div class="expand-trigger"><div style="width: 338px; height: 383px;"></div></div><div class="contract-trigger"></div></div></div>
          </div>
        </div>
      </div>
    </div>
    <!--/ Expense Overview -->
  
    <!-- Transactions -->
    <div class="col-md-6 col-lg-4 order-2 mb-6" id="lastData">
      <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="card-title m-0 me-2">Son Veriler</h5>

        </div>
        <div class="card-body pt-4">
          <ul class="p-0 m-0">

            @foreach($latestData as $latest)
            <li class="d-flex align-items-center mb-6 mt-3" id="last">
              <div class="avatar flex-shrink-0 me-4">
                <i class="bx bx-data" style="width: 50px;"></i>
              </div>
              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                  <small class="d-block">{{$latest->kumes->entegre->entegre_isim}}</small>
                  <h6 class="fw-normal mb-0">{{$latest->kumes->name}}</h6>
                </div>
                <div class="user-progress d-flex align-items-center gap-2">
                  <h6 class="fw-normal mb-0">{{$latest->created_at}}</span>
                </div>
              </div>
            </li>
            @endforeach
           
          </ul>
        </div>
      </div>
    </div>
    <!--/ Transactions -->
  </div>
</div>
            
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://kit.fontawesome.com/dbfeb55d48.js" crossorigin="anonymous"></script>
<script>

    var map = L.map('map').setView([39.925533, 32.866287], 5);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 8,
        attribution: '© OpenStreetMap'
    }).addTo(map);
    var arizalar = @json($arizalar);
    arizalar.forEach(function(ariza) {
        if (ariza.kumes && ariza.kumes.latitude && ariza.kumes.longitude) {
            var marker = L.circleMarker([ariza.kumes.latitude, ariza.kumes.longitude], {
                color: "red",
                radius: 10,
                className: 'blinking-marker'
            }).addTo(map);
            
            marker.bindPopup("<b>Entegre:</b>"+ariza.kumes.entegre.entegre_isim+"<br><b>Kümes:</b>"+ariza.kumes.name+
			"<br><b>Arıza:</b> " + ariza.description + 
			"<br><b>Tarih:</b> " + ariza.date
		);
        }
    });
</script>

<script>
  const talep = document.getElementById('myDoughnutChart').getContext('2d');

  const myDoughnutChart = new Chart(talep, {
      type: 'doughnut',
      data: {
          labels: ['Oluşturuldu', 'İnceleniyor', 'Cevaplandı'],
          datasets: [{
              label: 'Talep Detayları',
              data: [
                  {{ $data['open_count'] ?? 0 }},
                  {{ $data['in_progress_count'] ?? 0 }},
                  {{ $data['resolved_count'] ?? 0 }}
              ],
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)'
              ],
              borderColor: [
                  'rgba(255, 99, 132, 1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)'
              ],
              borderWidth: 1
          }]
      },
      options: {
          responsive: true,
          plugins: {
              legend: {
                  position: 'top',
              },
              tooltip: {
                  enabled: true
              }
          }
      }
  });
</script>
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
            max:40
                  
              }
          }
      }
  });
</script>
<script>
  // Controller'dan gelen veriyi alıyoruz
  const chartData = @json($chartData);

  const ctx_animal = document.getElementById('animalChart').getContext('2d');
  new Chart(ctx_animal, {
      type: 'bar', // Sütun grafiği
      data: {
          labels: chartData.labels, // Tarihler
          datasets: [{
              label: 'Toplam Hayvan Sayısı',
              data: chartData.data, // Hayvan sayıları
              backgroundColor: 'rgba(54, 162, 235, 0.5)', // Çubuk rengi
              borderColor: 'rgba(54, 162, 235, 1)', // Çubuk kenar rengi
              borderWidth: 1
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
                      text: 'Toplam Hayvan Sayısı'
                  },
                  beginAtZero: true 
              }
          }
      }
  });
</script>
@endsection
