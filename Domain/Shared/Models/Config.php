<?php

namespace Domain\Shared\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name', 'title', 'value'];
}
