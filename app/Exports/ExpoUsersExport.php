<?php

namespace App\Exports;

use App\Models\ExpoUser;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExpoUsersExport implements FromCollection, WithHeadings
{
    protected $expoUser;
    protected $type;

    public function __construct($expoUser, $type)
    {
        $this->expoUser = $expoUser;
        $this->type = $type;
    }

    public function collection()
    {
        return $this->expoUser;
    }

    public function headings(): array
    {
        if ($this->type === 'main') {
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
        } elseif ($this->type === 'site') {
            return [
                'Ticket Number',
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
}
