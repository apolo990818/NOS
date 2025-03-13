<?php

namespace App\Exports;

use App\Models\Producto;
use Maatwebsite\Excel\Concerns\FromCollection;

class SalientesExport implements FromCollection
{
    /**
     * Retorna la colección de productos de tipo "saliente".
     */
    public function collection()
    {
        return Producto::where('tipo', 'saliente')->get();
    }
}
