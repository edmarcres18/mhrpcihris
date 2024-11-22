<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Notification extends Model
{
    use HasFactory;
    use Loggable;

    protected $fillable = ['user_id', 'type', 'data'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
