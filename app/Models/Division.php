<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    public function divisionname()
    {
        return $this->belongsTo(StudentEducationalDetails::class,'division_id', 'id');
    }
}
