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
        return EndkonData::where('KUMES_ID', $this->kumesId)->get();
    }
    public function headings(): array
    {
        return [
            'id',
            'SN',
            'ISI',
            'DI',
            'SE',
            'NE',
            'CO',
            'tarih',
            'KUMES_ID'
        ];
    }
    public function title(): string
    {
        return 'Endkon Data';
    }
}
