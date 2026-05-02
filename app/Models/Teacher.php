<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Teacher extends Model
{
    protected $fillable = [
        'employee_id',
        'user_id',
        'campus',
        'department',
        'position',
        'employment_type',
        'employment_status',
        'date_hired',
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
        'street_no',
        'street',
        'subdivision',
        'barangay',
        'city',
        'province',
        'zip_code',
        'telephone_no',
        'mobile_no',
        'email',
        'highest_educational_attainment',
        'degree',
        'school',
        'year_graduated',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sectionTeachers(): HasMany
    {
        return $this->hasMany(SectionTeacher::class);
    }

    public function sections(): BelongsToMany
    {
        return $this->belongsToMany(Section::class, 'section_teacher');
    }
}
