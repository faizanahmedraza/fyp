<?php

namespace App\Exports;

use App\Models\RegisterIntern;
use Maatwebsite\Excel\Concerns\FromCollection;

class InternsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return RegisterIntern::all();
    }
}
