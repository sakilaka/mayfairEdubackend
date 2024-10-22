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
        $this->type = $type; // Store the type to decide headings
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
                'Expo Title',
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
                $expoUser->expo_title,
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
