<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class SectionTeacher extends Pivot
{
    public $incrementing = true;

    protected $table = 'section_teacher';

    protected $fillable = [
        'section_id',
        'teacher_id',
        'subject',
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }
}
