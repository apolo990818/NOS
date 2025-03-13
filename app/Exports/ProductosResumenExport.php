<?php

namespace App\Exports;

use App\Models\Producto;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class ProductosResumenExport implements FromCollection, WithMapping, WithStrictNullComparison
{
    protected $fechaInicio;
    protected $fechaFin;

    public function __construct($fechaInicio, $fechaFin)
    {
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
    }

    public function collection()
{
    return collect([
        Producto::selectRaw('COUNT(id) as total_productos, SUM(stock) as total_existencias, SUM(precio * stock) as total_valor')
            ->first()
    ]);
}

public function map($row): array
{
    return [
        $row->total_productos ?? 0,
        $row->total_existencias ?? 0,
        $row->total_valor ?? 0,
    ];
}

public function headings(): array
    {
        return [
            'Cantidad de productos',
            'Unidades existentes',
            'Valor total '
        ];
    }

}