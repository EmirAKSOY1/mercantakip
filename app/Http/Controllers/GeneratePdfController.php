<?php

namespace App\Http\Controllers;

use App\Models\Kumes;
use Illuminate\Http\Request;
use PDF;
class GeneratePdfController extends Controller
{
    /*public function generatePDF()
    {
        $data = [
            'title' => 'Fatura',
            'date' => date('m/d/Y'),
            'content' => 'Bu bir örnek faturadır.',
        ];
    
        $pdf = PDF::loadView('myPDF', $data);
        
    
        return $pdf->stream('fatura.pdf');
    }*/
    public function generatePDF($id)
    {
        $coop =Kumes::findOrFail($id);
        // PDF dosyasını oluştur
        $data = [
            'title' => 'Fatura',
            'content' => 'Bu bir örnek faturadır.',
            'coop' =>$coop
            //'graphic' => $graphicPath
        ];

        // PDF dosyasını oluştur
        $pdf = PDF::loadView('myPDF', $data);

        // PDF dosyasını indirmek için gönder
        return $pdf->stream('fatura.pdf');
    }
    public function generateReport()
    {
        // Grafik resmi için dosya yolu
        $filename = public_path('grafik.png');
        
        // Grafik boyutları
        $width = 400;
        $height = 300;

        // Yeni bir resim oluştur
        $image = imagecreatetruecolor($width, $height);

        // Renkler
        $bgColor = imagecolorallocate($image, 255, 255, 255);
        $barColor = imagecolorallocate($image, 0, 128, 255);

        // Arkaplanı beyaz yap
        imagefill($image, 0, 0, $bgColor);

        // Grafik çubuğunu çiz
        $barWidth = 50;
        $values = [50, 100, 150, 200, 250];
        $x = 50;
        foreach ($values as $value) {
            imagefilledrectangle($image, $x, $height - $value, $x + $barWidth, $height, $barColor);
            $x += $barWidth + 20; // Çubuklar arasına mesafe koy
        }

        // Grafiği kaydet
        imagepng($image, $filename);
        imagedestroy($image);

        // PDF oluşturma fonksiyonu çağır
        return $this->generatePDF($filename);
    }
}
