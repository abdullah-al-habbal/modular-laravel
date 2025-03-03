<?php

namespace Modules\Student\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Student\Database\Factories\StudentFactory;
use Modules\StudentParent\Models\StudentParent;
use Modules\User\Models\User;

class Student extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'phone_number',
        'address',
        'city',
        'state',
        'zip',
        'student_parent_id',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(StudentParent::class, 'student_parent_id');
    }

    protected static function newFactory(): StudentFactory
    {
        return StudentFactory::new();
    }
}
