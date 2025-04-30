<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analysis extends Model
{
    use HasFactory;

    protected $table = 'analysis';

    protected $fillable = [
        'user_id',
        'column',
        'image',
        'description',
        'log',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
