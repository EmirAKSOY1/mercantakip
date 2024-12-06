<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dış Sıcaklık Grafiği (ApexCharts)</title>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <style>
    .styled-button {
      background-color: #007bff;
      color: white;
      border: none;
      padding: 10px 20px;
      margin: 5px;
      cursor: pointer;
      border-radius: 5px;
    }
    .styled-button:hover {
      background-color: #0056b3;
    }
    .form-control {
      padding: 8px;
      width: 200px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <div>
    <label for="date-range">Tarih Aralığı Seçin:</label>
    <input class="form-control" type="text" id="date-range" class="flatpickr">
  </div>

  <div id="chart"></div>

  <!-- Flatpickr ve JQuery için gerekli scriptler -->
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/tr.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery"></script>

  <script>
    flatpickr("#date-range", {
        mode: "range",
        dateFormat: "Y-m-d",
        onChange: function(selectedDates, dateStr, instance) {
        if (selectedDates.length === 2) {
            let [startDate, endDate] = selectedDates;

            // StartDate ve EndDate'e bir gün ekle
            startDate.setDate(startDate.getDate() + 1);
            endDate.setDate(endDate.getDate() + 1);

            // Yeni tarihleri formatla (Y-m-d formatına dönüştür)
            const formattedStartDate = startDate.toISOString().split("T")[0];
            const formattedEndDate = endDate.toISOString().split("T")[0];

            console.log(`Başlangıç Tarihi: ${formattedStartDate}`);
            console.log(`Bitiş Tarihi: ${formattedEndDate}`);

            // Veriyi getir
            getData(formattedStartDate, formattedEndDate);
        }
    }
});

    function getData(startDate = '', endDate = '') {
        $.ajax({
            url: `/kumes/502/di-data`,
            method: 'GET',
            data: { start_date: startDate, end_date: endDate },
            success: function(response) {
                const labels = response.map(item => item.tarih); // Tarih sütunu olduğu gibi
                const data = response.map(item => item.di);

                chart.updateOptions({
                    xaxis: {
                        categories: labels, // Tarihleri string olarak kullan
                        type: 'datetime' // Datetime yerine category kullan
                    }
                });

                chart.updateSeries([{
                    name: "Dış Sıcaklık (°C)",
                    data: data
                }]);
            },
            error: function(error) {
                console.error("Veri çekme hatası:", error);
            }
        });
    }

    const chart = new ApexCharts(document.querySelector("#chart"), {
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
        align: 'center'
    },
    stroke: {
        width: 3,
        curve: 'smooth'
    }
});

    chart.render();

    // Tüm verileri başlat
    getData();
</script>

</body>
</html>
