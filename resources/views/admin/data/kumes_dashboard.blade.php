@extends('layout.app') 
@section('title', 'Veriler') 
@section('page', 'Grafikler') 
@section('detail', '') 
@section('css')
<style>
    .styled-button {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        margin: 5px;
        border-radius: 8px; 
        transition: all 0.3s ease;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }

    .styled-button:hover {
        background-color: #45a049;
        box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.3);

    .styled-button:active {
        transform: scale(0.98);
    h3{
        color:#3c8dbc;
    }
</style>
@endsection
@section('content') 


<div class="container">

    <div class="ortak">
        <div style="text-align: center; margin-bottom: 20px;">
            <button class="styled-button" onclick="ortakupdatechart('hourly')" >Saatlik </button>
            <button class="styled-button" onclick="ortakupdatechart('daily')"  >Günlük  </button>
            <button class="styled-button" onclick="ortakupdatechart('weekly')" >Haftalık</button>
            <button class="styled-button" onclick="ortakupdatechart('monthly')">Aylık   </button>
        </div>
        
        <div style="width:80%;height:auto;">
            <canvas id="ortakchart"></canvas>
        </div>
    </div>
    <br>

    <div class="isi">
        <div style="text-align: center; margin-bottom: 20px;">
            <button class="styled-button" onclick="isiupdatechart('hourly')" >Saatlik </button>
            <button class="styled-button" onclick="isiupdatechart('daily')"  >Günlük  </button>
            <button class="styled-button" onclick="isiupdatechart('weekly')" >Haftalık</button>
            <button class="styled-button" onclick="isiupdatechart('monthly')">Aylık   </button>
        </div>
        
        <div style="width:80%;height:auto;">
            <canvas id="isichart"></canvas>
        </div>
    </div>
    <br>


    <div class="di">
        <div style="text-align: center; margin-bottom: 20px;">
            <button class="styled-button" onclick="diupdatechart('hourly')" >Saatlik </button>
            <button class="styled-button" onclick="diupdatechart('daily')"  >Günlük  </button>
            <button class="styled-button" onclick="diupdatechart('weekly')" >Haftalık</button>
            <button class="styled-button" onclick="diupdatechart('monthly')">Aylık   </button>
        </div>
        
        <div style="width:80%;height:auto;">
            <canvas id="dichart"></canvas>
        </div>
    </div>
    <br>
    
    <div class="nem">
        <div style="text-align: center; margin-bottom: 20px;">
            <button class="styled-button" onclick="nemupdatechart('hourly')" >Saatlik </button>
            <button class="styled-button" onclick="nemupdatechart('daily')"  >Günlük  </button>
            <button class="styled-button" onclick="nemupdatechart('weekly')" >Haftalık</button>
            <button class="styled-button" onclick="nemupdatechart('monthly')">Aylık   </button>
        </div>
        {{-- <h3>Nem Analizi(°)</h3> --}}
        <div style="width:80%;height:auto;">
            <canvas id="nemchart"></canvas>
        </div>
    </div>
    <br>

    <div class="co">
        <div style="text-align: center; margin-bottom: 20px;">
            <button class="styled-button" onclick="coupdatechart('hourly')" >Saatlik </button>
            <button class="styled-button" onclick="coupdatechart('daily')"  >Günlük  </button>
            <button class="styled-button" onclick="coupdatechart('weekly')" >Haftalık</button>
            <button class="styled-button" onclick="coupdatechart('monthly')">Aylık   </button>
        </div>
        {{-- <h3>Co2 Analizi(ppm)</h3> --}}
        <div style="width:80%;height:auto;">
            <canvas id="cochart"></canvas>
        </div>
    </div>
    <br>

    <div class="su">
        <div style="text-align: center; margin-bottom: 20px;">
            <button class="styled-button" onclick="waterupdatechart('hourly')">Saatlik</button>
            <button class="styled-button" onclick="waterupdatechart('daily')">Günlük</button>
            <button class="styled-button" onclick="waterupdatechart('weekly')">Haftalık</button>
            <button class="styled-button" onclick="waterupdatechart('monthly')">Aylık</button>
        </div>
        {{-- <h3>Su Tüketim Analizi(Lt)</h3> --}}
        <div style="width:80%;height:auto;">
            <canvas id="waterchart"></canvas>
        </div>
    </div>
    <br>
    <div class="yem">
        <div style="text-align: center; margin-bottom: 20px;">
            <button class="styled-button" onclick="foodupdatechart('hourly')" >Saatlik  </button>
            <button class="styled-button" onclick="foodupdatechart('daily')"  >Günlük   </button>
            <button class="styled-button" onclick="foodupdatechart('weekly')" >Haftalık </button>
            <button class="styled-button" onclick="foodupdatechart('monthly')">Aylık    </button>
        </div>
        <div style="width:80%;height:auto;">
            <canvas id="foodchart"></canvas>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
   let waterchart;
   let foodchart;
   let isichart;
   let dichart;
   let nemchart;
   let cochart;
   let ortakchart;

function ortakupdatechart(mode) {
    const kumesId = "{{ $id }}";
    const chartDataUrl = `{{ url('kumes') }}/${kumesId}/ortak-data`;
    
    $.ajax({
        url: chartDataUrl,
        method: 'GET',
        data: { mode: mode },
       success: function(response) {
            const labels = response.map(item => {
                if (mode === 'hourly') return item.hour;
                if (mode === 'daily') return item.date;
                if (mode === 'weekly') return `Hafta ${item.week}`;
                if (mode === 'monthly') return `Ay ${item.month}`;
            });
            const isidata = response.map(item => item.isi);
            const didata = response.map(item => item.di);
            const nemdata = response.map(item => item.ne);
            const codata = response.map(item => item.co/100);
            
            
            ortakchart.data.labels = labels;
            ortakchart.data.datasets[0].data = isidata;
            ortakchart.data.datasets[1].data = didata;
            ortakchart.data.datasets[2].data = nemdata;
            ortakchart.data.datasets[3].data = codata;
            ortakchart.update();
        },
        error: function(error) {
            console.log("Veri çekme hatası:", error);
        }
    });
}
function isiupdatechart(mode) {
    const kumesId = "{{ $id }}";
    const chartDataUrl = `{{ url('kumes') }}/${kumesId}/isi-data`;
    
    $.ajax({
        url: chartDataUrl,
        method: 'GET',
        data: { mode: mode },
       success: function(response) {
            console.log(response);
            const labels = response.map(item => {
                if (mode === 'hourly') return item.hour;
                if (mode === 'daily') return item.date;
                if (mode === 'weekly') return `Hafta ${item.week}`;
                if (mode === 'monthly') return `Ay ${item.month}`;
            });
            const data = response.map(item => item.isi);
            const sedata = response.map(item => item.se);
            
            
            isichart.data.labels = labels;
            isichart.data.datasets[0].data = data;
            isichart.data.datasets[1].data = sedata;
            isichart.update();
        },
        error: function(error) {
            console.log("Veri çekme hatası:", error);
        }
    });
}
function diupdatechart(mode) {
    const kumesId = "{{ $id }}";
    const chartDataUrl = `{{ url('kumes') }}/${kumesId}/di-data`;
    
    $.ajax({
        url: chartDataUrl,
        method: 'GET',
        data: { mode: mode },
       success: function(response) {
            console.log(response);
            const labels = response.map(item => {
                if (mode === 'hourly') return item.hour;
                if (mode === 'daily') return item.date;
                if (mode === 'weekly') return `Hafta ${item.week}`;
                if (mode === 'monthly') return `Ay ${item.month}`;
            });
            const data = response.map(item => item.di);
            
            
            dichart.data.labels = labels;
            dichart.data.datasets[0].data = data;
            dichart.update();
        },
        error: function(error) {
            console.log("Veri çekme hatası:", error);
        }
    });
}
function nemupdatechart(mode) {
    const kumesId = "{{ $id }}";
    const chartDataUrl = `{{ url('kumes') }}/${kumesId}/nem-data`;
    
    $.ajax({
        url: chartDataUrl,
        method: 'GET',
        data: { mode: mode },
       success: function(response) {
            console.log(response);
            const labels = response.map(item => {
                if (mode === 'hourly') return item.hour;
                if (mode === 'daily') return item.date;
                if (mode === 'weekly') return `Hafta ${item.week}`;
                if (mode === 'monthly') return `Ay ${item.month}`;
            });
            const data = response.map(item => item.ne);
            
            
            nemchart.data.labels = labels;
            nemchart.data.datasets[0].data = data;
            nemchart.update();
        },
        error: function(error) {
            console.log("Veri çekme hatası:", error);
        }
    });
}
function coupdatechart(mode) {
    const kumesId = "{{ $id }}";
    const chartDataUrl = `{{ url('kumes') }}/${kumesId}/co-data`;
    
    $.ajax({
        url: chartDataUrl,
        method: 'GET',
        data: { mode: mode },
       success: function(response) {
            console.log(response);
            const labels = response.map(item => {
                if (mode === 'hourly') return item.hour;
                if (mode === 'daily') return item.date;
                if (mode === 'weekly') return `Hafta ${item.week}`;
                if (mode === 'monthly') return `Ay ${item.month}`;
            });
            const data = response.map(item => item.co);
            
            
            cochart.data.labels = labels;
            cochart.data.datasets[0].data = data;
            cochart.update();
        },
        error: function(error) {
            console.log("Veri çekme hatası:", error);
        }
    });
}
function waterupdatechart(mode) {
    const kumesId = "{{ $id }}";
    const chartDataUrl = `{{ url('kumes') }}/${kumesId}/chart-data`;
    $.ajax({
        url: chartDataUrl,
        method: 'GET',
        data: { mode: mode },
       success: function(response) {
            console.log(response);
            const labels = response.map(item => {
                if (mode === 'hourly') return item.hour;
                if (mode === 'daily') return item.date;
                if (mode === 'weekly') return `Hafta ${item.week}`;
                if (mode === 'monthly') return `Ay ${item.month}`;
            });
            const data = response.map(item => item.st);

            waterchart.data.labels = labels;
            waterchart.data.datasets[0].data = data;
            waterchart.update();
        },
        error: function(error) {
            console.log("Veri çekme hatası:", error);
        }
    });
}


function foodupdatechart(mode) {
    const kumesId = "{{ $id }}";
    const foodchartDataUrl = `{{ url('kumes') }}/${kumesId}/food-data`;
    $.ajax({
        url: foodchartDataUrl,
        method: 'GET',
        data: { mode: mode },
       success: function(response) {
            console.log(response);
            const labels = response.map(item => {
                if (mode === 'hourly') return item.hour;
                if (mode === 'daily') return item.date;
                if (mode === 'weekly') return `Hafta ${item.week}`;
                if (mode === 'monthly') return `Ay ${item.month}`;
            });
            const data = response.map(item => item.yt);

            foodchart.data.labels = labels;
            foodchart.data.datasets[0].data = data;
            foodchart.update();
        },
        error: function(error) {
            console.log("Veri çekme hatası:", error);
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {
    const waterinitialLabels = [];
    const waterinitialData = [];

    const foodinitialLabels = [];
    const foodinitialData = [];

    const isiinitialLabels = [];
    const isiinitialData = [];
    const seinitialData = [];

    const ortakinitialLabels = [];
    const ortakisiinitialData = [];
    const ortakdiinitialData = [];
    const ortakneminitialData = [];
    const ortakcoinitialData = [];

    const diinitialLabels = [];
    const diinitialData = [];

    const neminitialLabels = [];
    const neminitialData = [];

    const coinitialLabels = [];
    const coinitialData = [];

    const isidata = {
        labels: ortakinitialLabels,
        datasets: [
            {
            label: 'İç Sıcaklık(°)',
            data: isiinitialData,
            borderColor: '#F8071B',
            backgroundColor: 'rgba(248, 7, 27, 0.4)',
            borderWidth: 2,
            fill: true,
            tension: 0.1
        },
        {
            label: 'Set Isı(°)',
            data: seinitialData,
            borderColor: '#00A8FF',
            backgroundColor: 'rgba(0,168,255,0.1)',
            borderWidth: 2,
            fill: true,
            tension: 0.1
        }
    ]
    };

    const ortakdata = {
        labels: ortakinitialLabels,
        datasets: [
            {
            label: 'İç Sıcaklık(°)',
            data: ortakisiinitialData,
            borderColor: '#e16d00',
            backgroundColor: 'rgba(225,109,0, 0.4)',
            borderWidth: 2,
            
            tension: 0.1
        },
        {
            label: 'Dış Sıcaklık(°)',
            data: ortakdiinitialData,
            borderColor: '#F8071B',
            backgroundColor: 'rgba(248, 7, 27, 0.4)',
            borderWidth: 2,
            
            tension: 0.1
        },
        {
            label: 'Nem(%)',
            data: ortakneminitialData,
            borderColor: '#00A8FF',
            backgroundColor: 'rgba(0,168,255,0.1)',
            borderWidth: 2,
            
            tension: 0.1
        },
        {
            label: 'Co2(Ppm)',
            data: ortakcoinitialData,
            borderColor: '#87fe01',
            backgroundColor: 'rgba(135,254,1, 0.2)',
            borderWidth: 2,
            
            tension: 0.1
        }
    ]
    };


    const nemdata = {
        labels: neminitialLabels,
        datasets: [{
            label: 'Nem(%)',
            data: neminitialData,
            borderColor: '#2cd3c4',
            backgroundColor: 'rgba(204, 229, 255, 0.2)',
            borderWidth: 2,
            fill: true,
            tension: 0.1
        }]
    };
    const codata = {
        labels: coinitialLabels,
        datasets: [{
            label: 'Co2(ppm)',
            data: coinitialData,
            borderColor: '#87fe01',
            backgroundColor: 'rgba(135,254,1, 0.2)',
            borderWidth: 2,
            fill: true,
            tension: 0.1
        }]
    };
    const didata = {
        labels: diinitialLabels,
        datasets: [{
            label: 'Dış Sıcaklık(°)',
            data: diinitialData,
            borderColor: '#F8071B',
            backgroundColor: 'rgba(248, 7, 27, 0.2)',
            borderWidth: 2,
            fill: true,
            tension: 0.1
        }]
    };
    const waterdata = {
        labels: waterinitialLabels,
        datasets: [{
            label: 'Su(Lt)',
            data: waterinitialData,
            borderColor: 'rgba(75, 192, 192, 1)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderWidth: 2,
            fill: true,
            tension: 0.4
        }]
    };
    const fooddata = {
        labels: foodinitialLabels,
        datasets: [{
            label: 'Yem(Kg)',
            data: foodinitialData,
            borderColor: 'rgba(245, 176, 65, 1)',
            backgroundColor: 'rgba(245, 176, 65, 0.2)',
            borderWidth: 2,
            fill: true,
            tension: 0.4
        }]
    };

    const isiconfig = {
        type: 'line',
        data: isidata,
        options: {
            responsive: true,
            animation: {
        duration: 1000, // 1 saniye süren animasyon
        easing: 'easeInOut' // Yumuşak bir geçiş animasyonu
    }
        }
    };

    const ortakconfig = {
        type: 'line',
        data: ortakdata,
        options: {
            responsive: true,
            animation: {
        duration: 1000, // 1 saniye süren animasyon
        easing: 'easeInOut' // Yumuşak bir geçiş animasyonu
    }
        }
    };

    const waterconfig = {
        type: 'line',
        data: waterdata,
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    };
    const nemconfig = {
        type: 'line',
        data: nemdata,
        options: {
            responsive: true,
            animation: {
        duration: 1000, // 1 saniye süren animasyon
        easing: 'easeInOut' // Yumuşak bir geçiş animasyonu
    },
            scales: {
                y: { min: 10 ,
                    max:100,
                    ticks: {
                stepSize: 10
            }
                }
            }
        }
    };
    const coconfig = {
        type: 'line',
        data: codata,
        options: {
            responsive: true,
            animation: {
        duration: 1000, // 1 saniye süren animasyon
        easing: 'easeInOut' // Yumuşak bir geçiş animasyonu
    },
            scales: {
                y: { min: 1000 ,
                    max:4000,
                    ticks: {
                stepSize: 500
            }
                }
            }
        }
    };
    const foodconfig = {
        type: 'line',
        data: fooddata,
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    };
    const diconfig = {
        type: 'line',
        data: didata,
        options: {
            responsive: true,
            animation: {
        duration: 1000, // 1 saniye süren animasyon
        easing: 'easeInOut' // Yumuşak bir geçiş animasyonu
    }
        }
    };
    waterchart = new Chart(document.getElementById('waterchart'),waterconfig );
    foodchart = new Chart(document.getElementById('foodchart'),foodconfig );
    isichart = new Chart(document.getElementById('isichart'),isiconfig );
    dichart = new Chart(document.getElementById('dichart'),diconfig );
    nemchart = new Chart(document.getElementById('nemchart'),nemconfig );
    cochart = new Chart(document.getElementById('cochart'),coconfig );
    ortakchart = new Chart(document.getElementById('ortakchart'),ortakconfig );

    waterupdatechart('hourly');
    foodupdatechart('hourly');
    isiupdatechart('hourly');
    diupdatechart('hourly');
    nemupdatechart('hourly');
    coupdatechart('hourly');
    ortakupdatechart('hourly');
});
</script>
@endsection
