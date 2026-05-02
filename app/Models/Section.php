<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Section extends Model
{
    protected $fillable = [
        'section_code',
        'campus',
        'program',
        'year_level',
        'school_year',
        'term',
    ];

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'section_student');
    }

    public function sectionTeachers(): HasMany
    {
        return $this->hasMany(SectionTeacher::class);
    }

    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(Teacher::class, 'section_teacher')
            ->withPivot('subject');
    }
}