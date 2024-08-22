<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Exercise extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'photo'
        
    ];
    public function program():HasOne{
        return $this->hasOne(program::class);
    }
}
