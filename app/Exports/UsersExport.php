<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Username',
            'Image',
            'Email Verified',
            'Created',
            'Updated'
        ];
    }

    public function collection()
    {
        return User::all();
    }
}
