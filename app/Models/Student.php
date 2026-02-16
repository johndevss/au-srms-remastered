<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'user_id',
        'campus',
        'program',
        'admit_type',
        'year_level',
        'school_year',
        'term',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'gender',
        'civil_status',
        'citizenship',
        'date_of_birth',
        'birthplace',
        'religion',
        'current_street_no',
        'current_street',
        'current_subdivision',
        'current_barangay',
        'current_city',
        'current_province',
        'current_zip_code',
        'permanent_street_no',
        'permanent_street',
        'permanent_subdivision',
        'permanent_barangay',
        'permanent_city',
        'permanent_province',
        'permanent_zip_code',
        'telephone_no',
        'mobile_no',
        'email',
        'last_school_type',
        'last_school_name',
        'last_school_program',
        'last_school_date_of_graduation',
        'last_school_year',
        'last_school_year_level',
        'last_school_term',
        'father_first_name',
        'father_last_name',
        'father_middle_initial',
        'father_suffix',
        'father_mobile_no',
        'father_email',
        'father_occupation',
        'mother_first_name',
        'mother_last_name',
        'mother_middle_initial',
        'mother_suffix',
        'mother_mobile_no',
        'mother_email',
        'mother_occupation',
        'guardian_first_name',
        'guardian_last_name',
        'guardian_middle_initial',
        'guardian_suffix',
        'guardian_mobile_no',
        'guardian_email',
        'guardian_occupation',
        'guardian_relationship',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
