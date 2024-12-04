<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Rapor Analizi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
<link rel="shortcut icon" href="https://www.endkon.com/images/favicon.png">
    <style>
        .page-break {
            page-break-after: always;
        }
        body {
            font-family:  "Open Sans", sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            padding: 20px;
        }

        table {
            width: 100%;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        .header-table {
            width: 100%;
        }

        .header-table td {
            padding: 5px;
        }

        .left {
            width: 20%;
            text-align: left;
        }
        body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }
        .center {
            width: 60%;
            text-align: center;
        }

        .right {
            width: 30%;
            text-align: right;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
        }

        .subtitle {
            font-size: 18px;
            margin: 5px 0;
        }

        .date-time {
            font-size: 14px;
        }

        img {
            max-width: 100px;
            height: auto;
        }
        
        body { font-family: Arial, sans-serif; }
        h1, h2 { color: #333; }
        .section { margin-top: 20px; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { padding: 10px; border: 1px solid #ddd; text-align: center; }
        .table th { background-color: #f2f2f2; }
        .summary-box { padding: 15px; background: #e8f5e9; border: 1px solid #c8e6c9; margin-bottom: 10px; }

    </style>
</head>
<body>
    <div class="container">
        <!-- Header Table -->
        <table class="header-table">
            <tr>
                <!-- Sol tarafta resim -->
                <td class="left">
                    <img src="data:image/png;base64,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" alt="Logo">
                </td>

                <!-- Ortada başlıklar -->
                <td class="center">
                    <div class="title">{{$coop->entegre->entegre_isim}}</div>
                    <div class="subtitle">{{$coop->name}}</div>
                    <div class="subtitle">Analiz Raporlari</div>
                </td>

                <!-- Sağda basım tarihi ve isim -->
                <td class="right">
                    <p class="date-time"><b>Basim Tarihi: {{ date('d/m/Y H:i:s') }}</b></p>
                    <p<b>Olusturan:{{ auth()->user()->name }} {{ auth()->user()->surname }}</b></p>
                    <small><b>Kümes Id:{{$coop->id}}</b></small>
                </td>
            </tr>
        </table>

        <hr>

    </div>
    <h3 style="text-align: center;">Analizler</h3>
    <div class="section">
        <h2>Özet Veriler</h2>
        <div class="summary-box">
            <p><strong>Çalisan Sayisi:</strong>10</p>
        </div>
        <div class="summary-box">
            <p><strong>En Eski Veri:</strong>09.10.2024 14:50</p>
        </div>
        <div class="summary-box">
            <p><strong>Kümes Kapasitesi:</strong>1500</p>
        </div>
        <div class="summary-box">
            <p><strong>Gün:</strong>65</p>
        </div>
        <div class="summary-box">
            <p><strong>En az ölüm:</strong>12.11.2024 14:50</p>
        </div>
        <div class="summary-box">
            <p><strong>En fazla ölüm:</strong>06.11.2024 14:50</p>
        </div>

    </div>
    <div class="page-break"></div>

    <div class="section">
        <h2>Analiz Verileri</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Mevcut Hayvan</th>
                    <th>Ortalama Ölüm</th>
                    <th>Ortalama Ölüm O.</th>
                    <th>Ortalama Yem Tüketimi (kg)</th>
                    <th>Ortalama Su Tüketimi (L)</th>
                    

                </tr>
            </thead>
            <tbody>
                
                    <tr>
                        <td>50</td>
                        <td>50 Adet</td>
                        <td>%50</td>
                        <td>50</td>
                        <td>50</td>

                    </tr>
                
            </tbody>

            <thead>
                <tr>
                    <th>Ortalama iç Sicaklik (°C)</th>
                    <th>Ortalama Dis Sicaklik (°C)</th>
                    <th>Ortalama Nem (%)</th>
                    <th>Ortalama CO2 (PPM)</th>
                    <th>Ortalama Ne</th>
                    
                </tr>
            </thead>
            <tbody>
                
                    <tr>
                        <td>50</td>
                        <td>50 </td>
                        <td>50</td>
                        <td>50</td>
                        <td>50</td>

                    </tr>
                
            </tbody>
        </table>
    </div>

    

</body>
</html>
