<?php

namespace Domain\Monitor\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'level',
        'level_name',
        'message',
        'logged_at',
        'context',
        'extra'
    ];
}
