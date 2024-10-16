<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'beginning',
        'finished',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
