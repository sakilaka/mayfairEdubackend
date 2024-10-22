<?php

namespace App\Exports;

use App\Models\ExpoUser;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExpoUsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ExpoUser::all();
    }
}
