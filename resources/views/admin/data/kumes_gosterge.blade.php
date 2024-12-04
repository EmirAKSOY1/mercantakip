@extends('layout.app')
@section('title', 'Entegreler') 
@section('page','Veri Gösterge') 
@section('detail', ' Kümesleri') 
@section('css')
    <style>
/* Tüm kartların yüksekliğini eşitle */
.card-body {
    min-height: 200px; /* Varsayılan minimum yükseklik */
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}



    </style>
@endsection
@section('content') 

<div class="container">
    <h2 class="text-center">{{$latestData->kumes->name}} Dashboard</h2>
    <h6 class="text-center">{{$latestData->tarih}}</h6>
    <h4 class="text-center">{{$latestdailyData->gu}}. GÜN</h4>

    <div class="row mt-5  mb-4 g-3">
        <!-- Dış Sıcaklık Kartı -->
        <div class="col-md-3">
            <div class="card text-center shadow">
                <div class="card-body">
                    
                    <canvas id="externalTempGauge"></canvas>
                    <p class="card-text">{{ $latestData->DI }} °C</p>
                </div>
            </div>
        </div>

        <!-- İç Sıcaklık Kartı -->
        <div class="col-md-3">
            <div class="card text-center shadow">
                <div class="card-body">
                    
                    <canvas id="internalTempGauge"></canvas>
                    <p class="card-text">{{ $latestData->ISI }} °C</p>
                </div>
            </div>
        </div>



        <!-- Nem Kartı -->
        <div class="col-md-3">
            <div class="card text-center shadow">
                <div class="card-body">
                    
                    <canvas id="humidityGauge"></canvas>
                    <p class="card-text">{{ $latestData->NE }} %</p>
                </div>
            </div>
        </div>
        
        <!-- CO2 Kartı -->
        <div class="col-md-3">
            <div class="card text-center shadow">
                <div class="card-body">
                    <canvas id="co2Gauge"></canvas>
                    <p class="card-text">{{ $latestData->CO }} ppm</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow">
                <div class="card-body silo">
                    <canvas id="s1"></canvas>
                    
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow">
                <div class="card-body silo">
                    <canvas id="s2"></canvas>
                    
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow">
                <div class="card-body">
                    <canvas id="su"></canvas>
                    <p class="card-text">{{ $latesthourlyData->st }} Lt</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow">
                <div class="card-body">
                    <canvas id="yem"></canvas>
                    <p class="card-text">{{ $latesthourlyData->yt }}Kg</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function adjustCardHeights() {
    let maxHeight = 0;

    // Tüm kartları kontrol ederek en yüksek değeri buluyoruz
    $('.card-body').each(function() {
        const height = $(this).outerHeight();
        if (height > maxHeight) maxHeight = height;
    });

    // Tüm kartlara maksimum yüksekliği ayarlıyoruz
    $('.card-body').css('min-height', maxHeight + 'px');
}

// Sayfa yüklendiğinde ve pencere yeniden boyutlandığında çalıştır
$(document).ready(adjustCardHeights);
$(window).resize(adjustCardHeights);

    // Dış Sıcaklık Gauge Grafiği
    new Chart(document.getElementById('externalTempGauge'), {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [{{ $latestData->DI }}, 50 - {{ $latestData->DI }}],
                backgroundColor: ['rgba(75, 192, 192, 0.7)', 'rgba(200, 200, 200, 0.2)'],
            }]
        },
        options: {
            rotation: -90,
            circumference: 180,
            plugins: {
                title: { display: true, text: 'Dış Sıcaklık' }
            }
        }
    });

    // İç Sıcaklık Gauge Grafiği
    new Chart(document.getElementById('internalTempGauge'), {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [{{ $latestData->ISI }}, 50 - {{ $latestData->ISI }}],
                backgroundColor: ['rgba(255, 99, 132, 0.7)', 'rgba(200, 200, 200, 0.2)'],
            }]
        },
        options: {
            rotation: -90,
            circumference: 180,
            plugins: {
                title: { display: true, text: 'İç Sıcaklık' }
            }
        }
    });

    new Chart(document.getElementById('se'), {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [{{ $latestData->SE }}, 50 - {{ $latestData->SE }}],
                backgroundColor: ['#acff00', 'rgba(200, 200, 200, 0.2)'],
            }]
        },
        options: {
            rotation: -90,
            circumference: 180,
            plugins: {
                title: { display: true, text: 'Isı Set' }
            }
        }
    });

    // Nem Gauge Grafiği
    new Chart(document.getElementById('humidityGauge'), {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [{{ $latestData->NE }}, 100 - {{ $latestData->NE }}],
                backgroundColor: ['rgba(54, 162, 235, 0.7)', 'rgba(200, 200, 200, 0.2)'],
            }]
        },
        options: {
            rotation: -90,
            circumference: 180,
            plugins: {
                title: { display: true, text: 'Nem' }
            }
        }
    });

    // CO2 Gauge Grafiği
    new Chart(document.getElementById('co2Gauge'), {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [{{ $latestData->CO }}, 1000 - {{ $latestData->CO }}],
                backgroundColor: ['#5f5b6a', 'rgba(200, 200, 200, 0.2)'],
            }]
        },
        options: {
            rotation: -90,
            circumference: 180,
            plugins: {
                title: { display: true, text: 'CO2' }
            }
        }
    });
    // Silo-1 Vertical Gauge
    new Chart(document.getElementById('s1'), {
    type: 'bar',
    data: {
        labels: ['Silo-2'],
        datasets: [{
            label: 'Silo-2',
            data: [{{ $latestdailyData->s1 }}],
            backgroundColor: '#ff00d8',
            borderRadius: 10,
        }]
    },
    options: {
        indexAxis: 'x', // Set to 'y' for vertical progress
        scales: {
            x: {
                display: false, // Hide x-axis for a cleaner look
                max: 50, // Sets the max value to 100 for percentage scaling
            },
            y: {
                beginAtZero: true,
                max: 100, // Ensures the bar fills up to a maximum of 100%
                ticks: {
                    display: false, // Hide y-axis labels
                }
            }
        },
        plugins: {
            legend: { display: false },
            title: { display: true, text: 'Silo-1' }
        },
        responsive: true,
        maintainAspectRatio: false,
    }
});

    // Silo-2 Vertical Gauge
    new Chart(document.getElementById('s2'), {
        type: 'bar',
        data: {
            labels: ['Silo-2'],
            datasets: [{
                label: 'Silo-2',
                data: [{{ $latestdailyData->s2 }}],
                backgroundColor: '#00FF27',
                borderRadius: 10,
            }]
        },
        options: {
            indexAxis: 'x', // Set to 'y' for vertical progress
            scales: {
                x: {
                    display: false, // Hide x-axis for a cleaner look
                    max: 100, // Sets the max value to 100 for percentage scaling
                },
                y: {
                    beginAtZero: true,
                    max: 100, // Ensures the bar fills up to a maximum of 100%
                    ticks: {
                        display: false, // Hide y-axis labels
                    }
                }
            },
            plugins: {
                legend: { display: false },
                title: { display: true, text: 'Silo-2' }
            },
            responsive: true,
            maintainAspectRatio: false,
        }
    });

    // Su Tüketim Gauge Grafiği
    new Chart(document.getElementById('su'), {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [{{ $latesthourlyData->st }}, 100 - {{ $latesthourlyData->st }}],
                backgroundColor: ['#0300ff', 'rgba(200, 200, 200, 0.2)'],
            }]
        },
        options: {
            rotation: -90,
            circumference: 180,
            plugins: {
                title: { display: true, text: 'Su Tüketimi' }
            }
        }
    });

        // Su Tüketim Gauge Grafiği
        new Chart(document.getElementById('yem'), {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [{{ $latesthourlyData->yt }}, 100 - {{ $latesthourlyData->yt }}],
                backgroundColor: ['#fc8803', 'rgba(200, 200, 200, 0.2)'],
            }]
        },
        options: {
            rotation: -90,
            circumference: 180,
            plugins: {
                title: { display: true, text: 'Yem Tüketimi' }
            }
        }
    });
</script>
@endsection







