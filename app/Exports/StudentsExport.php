<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;


class StudentsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }


    public function headings(): array
    {
        return [
            'ID',
            'Student Name',
            'Email',
            'Academic Year',
            'Department',
            'Course',
            'Division'
        ];
    }


    public function collection()
    {
        return new Collection($this->data);
    }
}
