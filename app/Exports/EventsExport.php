<?php

namespace App\Exports;

use App\Models\RegisterEvent;
use Maatwebsite\Excel\Concerns\FromCollection;

class EventsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return RegisterEvent::all();
    }
}
