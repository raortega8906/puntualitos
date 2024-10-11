<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'check_in_check_out_issue',
        'description',
        'time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
