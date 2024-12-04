<?php

namespace App\Exports;

use App\Models\EndkonData;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class EndkonDataExport implements FromCollection, WithHeadings, WithTitle
{

    protected $kumesId;

    // Constructor ile KUMES_ID'yi al
    public function __construct($kumesId)
    {
        $this->kumesId = $kumesId;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return EndkonData::where('KUMES_ID', $this->kumesId)
        ->select(['SN', 'ISI', 'DI', 'SE', 'NE', 'CO', 'TARIH', 'CREATED_AT'])
        ->get();
    }
    public function headings(): array
    {
        return [
            'Seri Numarası',
            'Isı',
            'Dış Isı',
            'Set Isı',
            'Nem',
            'Co2',
            'Tarih',
            'Gelme Tarihi(GMT+3)'
        ];
    }
    public function title(): string
    {
        return 'Endkon Data';
    }
}
