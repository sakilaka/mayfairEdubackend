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
                'Expo Title',
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

    public function map($expoUser): array
    {
        if ($this->type === 'main') {
            return [
                $expoUser->ticket_no,
                $expoUser->expo_id,
                $expoUser->expo_title,
                $expoUser->email,
                $expoUser->first_name,
                $expoUser->last_name,
                $expoUser->nationality,
                $expoUser->sex,
                $expoUser->dob,
                $expoUser->phone,
                $expoUser->profession,
                $expoUser->institution,
                $expoUser->program,
                $expoUser->degree,
            ];
        } elseif ($this->type === 'site') {
            return [
                $expoUser->ticket_no,
                $expoUser->email,
                $expoUser->first_name,
                $expoUser->last_name,
                $expoUser->nationality,
                $expoUser->sex,
                $expoUser->dob,
                $expoUser->phone,
                $expoUser->profession,
                $expoUser->institution,
                $expoUser->program,
                $expoUser->degree,
            ];
        }
    }
}
