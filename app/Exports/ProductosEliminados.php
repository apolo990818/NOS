<?php

namespace App\Exports;

use App\Models\Producto;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

class ProductosEliminados implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $fechaDesde;
    protected $fechaHasta;

    /**
     * Constructor que recibe los filtros de fecha.
     *
     * @param string|null $fechaDesde Fecha inicial en formato 'Y-m-d'
     * @param string|null $fechaHasta Fecha final en formato 'Y-m-d'
     */

    public function __construct($fechaDesde = null, $fechaHasta = null)
    {
        $this->fechaDesde = $fechaDesde;
        $this->fechaHasta = $fechaHasta;
    }
    public function collection()
{
    $query = Producto::withTrashed()
    ->select('nombre', 'descripcion', 'deleted_at')
    ->whereNotNull('deleted_at');


    if ($this->fechaDesde && $this->fechaHasta) {
        $query->whereBetween('created_at', [$this->fechaDesde, $this->fechaHasta]);
    } elseif ($this->fechaDesde) {
        $query->where('created_at', '>=', $this->fechaDesde);
    } elseif ($this->fechaHasta) {
        $query->where('created_at', '<=', $this->fechaHasta);
    }

    return $query->get();
}


    public function map($producto): array
    {
        // Formateamos la fecha del campo created_Ad
        $fechaFormateada = $producto->created_Ad
            ? Carbon::parse($producto->created_Ad)->format('d/m/Y')
            : '';

        return [
            $producto->nombre,
            $producto->descripcion,
            $fechaFormateada,
            $producto->precio,
            $producto->stock,
        ];
    }
    public function headings(): array
    {
        return [
            'Nombre',
            'Descripción',
            'Fecha de eliminacion'
        ];
    }
}
