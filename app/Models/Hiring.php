<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hiring extends Model
{
    use HasFactory;

    protected $fillable = [
        'position',
        'description',
        'requirements',
        'location',
    ];

    public function career()
    {
        return $this->hasMany(Career::class);
    }
}
