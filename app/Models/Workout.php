<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Workout extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'description',
        'photo',
        'exercise_id',
    ];

    public function exercise(): BelongsTo{
        return $this -> belongsTo(Exercise::class);
    }
}
