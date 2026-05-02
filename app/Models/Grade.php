<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = [
        'student_id',
        'section_id',
        'teacher_id',
        'subject',
        'quarter_1',
        'quarter_2',
        'quarter_3',
        'quarter_4',
        'final_grade',
    ];

    protected static function booted(): void
    {
        static::saving(function (Grade $grade) {
            $quarters = collect([
                $grade->quarter_1,
                $grade->quarter_2,
                $grade->quarter_3,
                $grade->quarter_4,
            ])->filter(fn($q) => !is_null($q));

            $grade->final_grade = $quarters->isNotEmpty()
                ? round($quarters->avg(), 2)
                : null;
        });
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}