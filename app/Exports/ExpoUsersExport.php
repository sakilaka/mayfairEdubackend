<?php

namespace App\Exports;

use App\Models\ExpoUser;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExpoUsersExport implements FromCollection, WithHeadings
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

    public function headings(): array
    {
        return [
            'Ticket Number',
            'Expo ID',
            'Email',
            'First Name',
            'Last Name',
            'Nationality',
            'Sex',
            'Date of Birth',
            'Phone',
            'Profession',
            'Institution',
            'Program',
            'Degree',
        ];
    }
}
