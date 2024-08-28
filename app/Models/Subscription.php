<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Subscription extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'start_date',
        'renewable_date',
    ];
    public function user():HasOne{
        return $this->hasOne(user::class);
    }

}
