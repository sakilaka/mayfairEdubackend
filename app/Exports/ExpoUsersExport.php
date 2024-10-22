<?php

namespace App\Exports;

use App\Models\ExpoUser;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExpoUsersExport implements FromCollection
{
    protected $expoUser;

    public function __construct($expoUser)
    {
        $this->expoUser = $expoUser;
    }

    public function collection()
    {
        return $this->expoUser;
    }
}
