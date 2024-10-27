<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class AttendanceExport implements FromArray
{
    protected $headers;
    protected $data;

    public function __construct(array $headers, array $data)
    {
        $this->headers = $headers;
        $this->data = $data;
    }

    public function array(): array
    {
        // Combina las cabeceras con los datos
        return array_merge([$this->headers], $this->data);
    }
}
