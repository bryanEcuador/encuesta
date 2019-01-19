<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Core\Modelos\RecursosCarrera;

class recursosCarreraExport implements FromView
{
    protected $year;
    /**
     * @return \Illuminate\Support\Collection
     */

    public function __construct($year)
    {
        $this->year = $year;
    }

    public function view() : View
    {
        return view('exports.recursoscarrera', [
            'datos' => RecursosCarrera::whereYear('fecha_creacion', $this->year)->get()
        ]);
    }
}
