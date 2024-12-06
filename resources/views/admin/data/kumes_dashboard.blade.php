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
    }
    .styled-button:active {
        transform: scale(0.98);
    }
    .form-control{
        display:inline-block;
        width:40%;
    }
</style>

@endsection
<script src="https://cdn.jsdelivr.net/npm/jquery"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">



@section('content') 
   

            <div style="text-align: center;">
                <input class="form-control" type="text" id="ortak-range"  placeholder="Tarih Aralığı Seçin">
            </div>
            <br>
            <br>
            <br>
            <div id="ortak-chart" ></div>

        <hr>

            <br>
            <br>
            <br>
            <div style="text-align: center;">
                <input class="form-control" type="text" id="isi-range"  placeholder="Tarih Aralığı Seçin">
            </div>
            <br>
            <br>
            <br>
            <div id="isi-chart"></div>

            <hr>

            <br>
            <br>
            <br>
            <div style="text-align: center;">
                <input class="form-control" type="text" id="di-range"  placeholder="Tarih Aralığı Seçin">
            </div>
            <br>
            <br>
            <br>
            <div id="di-chart"></div>

        <hr>
        <br>
        <br>
        <br>
        <div style="text-align: center;">
            <input class="form-control" type="text" id="co-range"  placeholder="Tarih Aralığı Seçin">
        </div>
        <br>
        <br>
        <br>
        <div id="co-chart"></div>
        <hr>

        <br>
        <br>
        <br>
        <div style="text-align: center;">
            <input class="form-control" type="text" id="nem-range"  placeholder="Tarih Aralığı Seçin">
        </div>
        <br>
        <br>
        <br>
        <div id="nem-chart"></div>
        <hr>

        <br>
        <br>
        <br>
        <div style="text-align: center;">
            <input class="form-control" type="text" id="st-range"  placeholder="Tarih Aralığı Seçin">
        </div>
        <br>
        <br>
        <br>
        <div id="st-chart"></div>
        <hr>

        <br>
        <br>
        <br>
        <div style="text-align: center;">
            <input class="form-control" type="text" id="yt-range"  placeholder="Tarih Aralığı Seçin">
        </div>
        <br>
        <br>
        <br>
        <div id="yt-chart"></div>
        <hr>
 

@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/tr.js"></script>

<script>
    /*Flatpickr Başlangıcı*/

    flatpickr("#ortak-range", {
        mode: "range",
        dateFormat: "Y-m-d",
        locale:"tr",
        onChange: function(selectedDates, dateStr, instance) {
        if (selectedDates.length === 2) {
            let [startDate, endDate] = selectedDates;
            
            
            startDate.setDate(startDate.getDate() + 1);
            endDate.setDate(endDate.getDate() + 1);

            const formattedStartDate = startDate.toISOString().split("T")[0];
            const formattedEndDate = endDate.toISOString().split("T")[0];

            ortakData(formattedStartDate, formattedEndDate);
        }
    }
});

        flatpickr("#isi-range", {
        mode: "range",
        dateFormat: "Y-m-d",
        locale:"tr",
        onChange: function(selectedDates, dateStr, instance) {
        if (selectedDates.length === 2) {
            let [startDate, endDate] = selectedDates;
            
            
            startDate.setDate(startDate.getDate() + 1);
            endDate.setDate(endDate.getDate() + 1);

            const formattedStartDate = startDate.toISOString().split("T")[0];
            const formattedEndDate = endDate.toISOString().split("T")[0];

            isiData(formattedStartDate, formattedEndDate);
        }
            }
        });
flatpickr("#di-range", {
        mode: "range",
        dateFormat: "Y-m-d",
        locale:"tr",
        onChange: function(selectedDates, dateStr, instance) {
        if (selectedDates.length === 2) {
            let [startDate, endDate] = selectedDates;
            
            
            startDate.setDate(startDate.getDate() + 1);
            endDate.setDate(endDate.getDate() + 1);

            const formattedStartDate = startDate.toISOString().split("T")[0];
            const formattedEndDate = endDate.toISOString().split("T")[0];

            diData(formattedStartDate, formattedEndDate);
        }
    }
});

flatpickr("#co-range", {
        mode: "range",
        dateFormat: "Y-m-d",
        locale:"tr",
        onChange: function(selectedDates, dateStr, instance) {
        if (selectedDates.length === 2) {
            let [startDate, endDate] = selectedDates;
            
            
            startDate.setDate(startDate.getDate() + 1);
            endDate.setDate(endDate.getDate() + 1);

            const formattedStartDate = startDate.toISOString().split("T")[0];
            const formattedEndDate = endDate.toISOString().split("T")[0];

            coData(formattedStartDate, formattedEndDate);
        }
    }
});


flatpickr("#nem-range", {
        mode: "range",
        dateFormat: "Y-m-d",
        locale:"tr",
        onChange: function(selectedDates, dateStr, instance) {
        if (selectedDates.length === 2) {
            let [startDate, endDate] = selectedDates;
            
            
            startDate.setDate(startDate.getDate() + 1);
            endDate.setDate(endDate.getDate() + 1);

            const formattedStartDate = startDate.toISOString().split("T")[0];
            const formattedEndDate = endDate.toISOString().split("T")[0];

            nemData(formattedStartDate, formattedEndDate);
        }
    }
});

flatpickr("#st-range", {
        mode: "range",
        dateFormat: "Y-m-d",
        locale:"tr",
        onChange: function(selectedDates, dateStr, instance) {
        if (selectedDates.length === 2) {
            let [startDate, endDate] = selectedDates;
            
            
            startDate.setDate(startDate.getDate() + 1);
            endDate.setDate(endDate.getDate() + 1);

            const formattedStartDate = startDate.toISOString().split("T")[0];
            const formattedEndDate = endDate.toISOString().split("T")[0];

            stData(formattedStartDate, formattedEndDate);
        }
    }
});

flatpickr("#yt-range", {
        mode: "range",
        dateFormat: "Y-m-d",
        locale:"tr",
        onChange: function(selectedDates, dateStr, instance) {
        if (selectedDates.length === 2) {
            let [startDate, endDate] = selectedDates;
            
            
            startDate.setDate(startDate.getDate() + 1);
            endDate.setDate(endDate.getDate() + 1);

            const formattedStartDate = startDate.toISOString().split("T")[0];
            const formattedEndDate = endDate.toISOString().split("T")[0];

            ytData(formattedStartDate, formattedEndDate);
        }
    }
});
/*Flatpickr Bitişi*/

/*Ajax fomksiyonları başlangıcı*/


function ortakData(startDate = '', endDate = '') {
    const kumesId = "{{ $id }}";
        $.ajax({
            url: `/kumes/${kumesId}/ortak-data`,
            method: 'GET',
            data: { start_date: startDate, end_date: endDate },
            success: function(response) {
                const labels = response.map(item => item.tarih);
                const data = response.map(item => item.isi);
                const datadi = response.map(item => item.di);
                const datanem = response.map(item => item.ne);
                //console.log(response);
                ortakChart.updateOptions({
                    xaxis: {
                        categories: labels,
                        type: 'datetime'
                    }
                });

                ortakChart.updateSeries([{
                    name: "ısı Sıcaklık (°C)",
                    data: data
                },{
                    name: 'Dış Sıcaklık (°C)',
                    data: datadi
                },{
                    name: 'Nem(%)',
                    data: datanem
                }]);
            },
            error: function(error) {
                console.error("Veri çekme hatası:", error);
            }
        });
    }

    function isiData(startDate = '', endDate = '') {
    const kumesId = "{{ $id }}";
        $.ajax({
            url: `/kumes/${kumesId}/isi-data`,
            method: 'GET',
            data: { start_date: startDate, end_date: endDate },
            success: function(response) {
                const labels = response.map(item => item.tarih);
                const data = response.map(item => item.isi);
                const datase = response.map(item => item.se);
                //console.log(response);
                isiChart.updateOptions({
                    xaxis: {
                        categories: labels,
                        type: 'datetime'
                    }
                });

                isiChart.updateSeries([{
                    name: "ısı Sıcaklık (°C)",
                    data: data
                },{
                    name: 'Set Isı (°C)',
                    data: datase
                }]);
            },
            error: function(error) {
                console.error("Veri çekme hatası:", error);
            }
        });
    }
    function diData(startDate = '', endDate = '') {
    const kumesId = "{{ $id }}";
        $.ajax({
            url: `/kumes/${kumesId}/di-data`,
            method: 'GET',
            data: { start_date: startDate, end_date: endDate },
            success: function(response) {
                const labels = response.map(item => item.tarih);
                const data = response.map(item => item.di);
                //console.log(response);
                diChart.updateOptions({
                    xaxis: {
                        categories: labels,
                        type: 'datetime'
                    }
                });

                diChart.updateSeries([{
                    name: "Dış Sıcaklık (°C)",
                    data: data
                }]);
            },
            error: function(error) {
                console.error("Veri çekme hatası:", error);
            }
        });
    }
    function coData(startDate = '', endDate = '') {
    const kumesId = "{{ $id }}";
        $.ajax({
            url: `/kumes/${kumesId}/co-data`,
            method: 'GET',
            data: { start_date: startDate, end_date: endDate },
            success: function(response) {
                const labels = response.map(item => item.tarih);
                const data = response.map(item => item.co);
                //console.log(response);
                coChart.updateOptions({
                    xaxis: {
                        categories: labels,
                        type: 'datetime'
                    }
                });

                coChart.updateSeries([{
                    name: "Co2(pPM)",
                    data: data
                }]);
            },
            error: function(error) {
                console.error("Veri çekme hatası:", error);
            }
        });
    }

    function nemData(startDate = '', endDate = '') {
    const kumesId = "{{ $id }}";
        $.ajax({
            url: `/kumes/${kumesId}/nem-data`,
            method: 'GET',
            data: { start_date: startDate, end_date: endDate },
            success: function(response) {
                const labels = response.map(item => item.tarih);
                const data = response.map(item => item.ne);
                //console.log(response);
                nemChart.updateOptions({
                    xaxis: {
                        categories: labels,
                        type: 'datetime'
                    }
                });

                nemChart.updateSeries([{
                    name: "Nem(%)",
                    data: data
                }]);
            },
            error: function(error) {
                console.error("Veri çekme hatası:", error);
            }
        });
    }

    function stData(startDate = '', endDate = '') {
    const kumesId = "{{ $id }}";
        $.ajax({
            url: `/kumes/${kumesId}/st-data`,
            method: 'GET',
            data: { start_date: startDate, end_date: endDate },
            success: function(response) {
                const labels = response.map(item => item.created_at);
                const data = response.map(item => item.st);
                //console.log(response);
                stChart.updateOptions({
                    xaxis: {
                        categories: labels,
                        type: 'datetime'
                    }
                });

                stChart.updateSeries([{
                    name: "Su Tüketimi(Lt)",
                    data: data
                }]);
            },
            error: function(error) {
                console.error("Veri çekme hatası:", error);
            }
        });
    }

    function ytData(startDate = '', endDate = '') {
    const kumesId = "{{ $id }}";
        $.ajax({
            url: `/kumes/${kumesId}/yt-data`,
            method: 'GET',
            data: { start_date: startDate, end_date: endDate },
            success: function(response) {
                const labels = response.map(item => item.created_at);
                const data = response.map(item => item.yt);
                //console.log(response);
                ytChart.updateOptions({
                    xaxis: {
                        categories: labels,
                        type: 'datetime'
                    }
                });

                ytChart.updateSeries([{
                    name: "Yem Tüketimi(Kg)",
                    data: data
                }]);
            },
            error: function(error) {
                console.error("Veri çekme hatası:", error);
            }
        });
    }
    /*Ajax fomksiyonları Bitişi*/

    /*Chart Config*/






    const ortakChart = new ApexCharts(document.querySelector("#ortak-chart"), {
    chart: {
        type: 'line',
        height: 350
    },
    series: [{
        name: 'İç Sıcaklık (°C)',
        data: [] // Başlangıçta boş
    }],
    xaxis: {
        type: 'datetime',
        categories: [],
        labels: {
            formatter: function(value) {
                const date = new Date(value);
                return date.toLocaleString('tr-TR', {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit',
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                });
            }
        }
    },
    title: {
    text: 'Ortak Grafik',
    align: 'center',
    style: {
        fontSize: '16px',  // Başlık yazı boyutu
        fontWeight: 'bold',  // Başlık kalınlık
        color: '#0056b3'  // Başlık rengi
    }
},
    stroke: {
        width: 3,
        curve: 'smooth'
    }
});


    const isiChart = new ApexCharts(document.querySelector("#isi-chart"), {
    chart: {
        type: 'line',
        height: 350
    },
    series: [{
        name: 'İç Sıcaklık (°C)',
        data: [] // Başlangıçta boş
    }],
    xaxis: {
        type: 'datetime',
        categories: [],
        labels: {
            formatter: function(value) {
                const date = new Date(value);
                return date.toLocaleString('tr-TR', {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit',
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                });
            }
        }
    },
    title: {
    text: 'İç Sıcaklık Grafiği',
    align: 'center',
    style: {
        fontSize: '16px',  // Başlık yazı boyutu
        fontWeight: 'bold',  // Başlık kalınlık
        color: '#0056b3'  // Başlık rengi
    }
},
    stroke: {
        width: 3,
        curve: 'smooth'
    }
});
const diChart = new ApexCharts(document.querySelector("#di-chart"), {
    chart: {
        type: 'line',
        height: 350
    },
    series: [{
        name: 'Dış Sıcaklık (°C)',
        data: [] // Başlangıçta boş
    }],
    xaxis: {
        type: 'datetime',
        categories: [],
        labels: {
            formatter: function(value) {
                const date = new Date(value);
                return date.toLocaleString('tr-TR', {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit',
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                });
            }
        }
    },
    title: {
    text: 'Dış Sıcaklık Grafiği',
    align: 'center',
    style: {
        fontSize: '16px',  // Başlık yazı boyutu
        fontWeight: 'bold',  // Başlık kalınlık
        color: '#0056b3'  // Başlık rengi
    }
},
    stroke: {
        width: 3,
        curve: 'smooth'
    }
});

const coChart = new ApexCharts(document.querySelector("#co-chart"), {
    chart: {
        type: 'line',
        height: 350
    },
    series: [{
        name: 'Co2(ppm)',
        data: [] // Başlangıçta boş
    }],
    xaxis: {
        type: 'datetime',
        categories: [],
        labels: {
            formatter: function(value) {
                const date = new Date(value);
                return date.toLocaleString('tr-TR', {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit',
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                });
            }
        }
    },
    title: {
    text: 'Co2 Grafiği',
    align: 'center',
    style: {
        fontSize: '16px',  // Başlık yazı boyutu
        fontWeight: 'bold',  // Başlık kalınlık
        color: '#0056b3'  // Başlık rengi
    }
},
    stroke: {
        width: 3,
        curve: 'smooth'
    }
});


const nemChart = new ApexCharts(document.querySelector("#nem-chart"), {
    chart: {
        type: 'line',
        height: 350
    },
    series: [{
        name: 'Nem(%)',
        data: [] // Başlangıçta boş
    }],
    xaxis: {
        type: 'datetime',
        categories: [],
        labels: {
            formatter: function(value) {
                const date = new Date(value);
                return date.toLocaleString('tr-TR', {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit',
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                });
            }
        }
    },
    title: {
    text: 'Nem Grafiği',
    align: 'center',
    style: {
        fontSize: '16px',  // Başlık yazı boyutu
        fontWeight: 'bold',  // Başlık kalınlık
        color: '#0056b3'  // Başlık rengi
    }
},
    stroke: {
        width: 3,
        curve: 'smooth'
    }
});

const stChart = new ApexCharts(document.querySelector("#st-chart"), {
    chart: {
        type: 'line',
        height: 350
    },
    series: [{
        name: 'Su Tüketimi(Lt)',
        data: [] // Başlangıçta boş
    }],
    xaxis: {
        type: 'datetime',
        categories: [],
        labels: {
            formatter: function(value) {
                const date = new Date(value);
                return date.toLocaleString('tr-TR', {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit',
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                });
            }
        }
    },
    title: {
    text: 'Su Tüketim Grafiği Grafiği',
    align: 'center',
    style: {
        fontSize: '16px',  // Başlık yazı boyutu
        fontWeight: 'bold',  // Başlık kalınlık
        color: '#0056b3'  // Başlık rengi
    }
},
    stroke: {
        width: 3,
        curve: 'smooth'
    }
});

const ytChart = new ApexCharts(document.querySelector("#yt-chart"), {
    chart: {
        type: 'line',
        height: 350
    },
    series: [{
        name: 'Yem Tüketimi(Kg)',
        data: [] // Başlangıçta boş
    }],
    xaxis: {
        type: 'datetime',
        categories: [],
        labels: {
            formatter: function(value) {
                const date = new Date(value);
                return date.toLocaleString('tr-TR', {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit',
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                });
            }
        }
    },
    title: {
    text: 'Yem Tüketim Grafiği',
    align: 'center',
    style: {
        fontSize: '16px',  // Başlık yazı boyutu
        fontWeight: 'bold',  // Başlık kalınlık
        color: '#0056b3'  // Başlık rengi
    }
},
    stroke: {
        width: 3,
        curve: 'smooth'
    }
});
/*Chart Config*/

    isiChart.render();
    diChart.render();
    coChart.render();
    nemChart.render();
    stChart.render();
    ytChart.render();
    ortakChart.render();

    isiData();
    diData();
    coData();
    nemData();
    stData();
    ytData();
    ortakData();
</script>
@endsection
