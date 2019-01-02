<?php
/**
 * Created by PhpStorm.
 * User: bryan
 * Date: 2/1/2019
 * Time: 17:39
 */

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\User;


class graficosExport implements FromView
{
    public function view(): View
    {
        return view('exports.graficos.prueba', [
            'users' => User::all()
        ]);
    }
}