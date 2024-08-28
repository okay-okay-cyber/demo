<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Program extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'description',
        'duration_days',
        'photo',
        'exercise_id',
    ];

    public function exercise(): BelongsTo{
        return $this -> belongsTo(Exercise::class);
    }
}
