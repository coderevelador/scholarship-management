<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AppliedScholarshipAll implements FromCollection, WithHeadings
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
            'Id',
            'Scholarship Name',
            'Student Name',
            'Year',
            'Department',
            'Course Name',
            'Division Name',
            'Annual Income',
            'Mark Percetage',
            'Submission Date',
            'Status',
        ];
    }


     public function collection()
    {

        return new Collection($this->data);
    }
}
