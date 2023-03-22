<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AppliedScholarshipSingleExports implements FromCollection, WithHeadings
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
            'Annual Income',
            'Mark Percentage',
            'Submission Date',
            'Status',
            'student_name',
            'year',
            'department',
            'course',
            'division'
        ];
    }


    public function collection()
    {

        return new Collection($this->data);
    }
}
