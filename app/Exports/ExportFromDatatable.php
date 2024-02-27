<?php
namespace App\Exports;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportFromDatatable implements FromCollection,WithHeadings
{
    protected $data;
    public $headers;

    public function __construct(array $data)
    {
        $this->data = $data;
        $this->headers = [];
    }

    public function collection()
    {
        return collect($this->data);
    }

    public function headings(): array
    {
        return $this->headers;
    }
    
}


