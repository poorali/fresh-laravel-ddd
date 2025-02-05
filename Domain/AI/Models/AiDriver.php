<?php

namespace Domain\AI\Models;

use Domain\AI\Abstracts\AiDriverAbstract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AiDriver extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'class',
        'credentials',
        'enabled',
    ];

    protected $casts = [
        'credentials' => 'array',
        'enabled' => 'boolean',
    ];


    public function requests():HasMany
    {
        return $this->hasMany(AiRequest::class);
    }

    public function scopeByActive(Builder $query, string $name): Builder
    {
        return $query
            ->where('name', $name)
            ->where('enabled',true);
    }

    public function initialize(): AiDriverAbstract
    {
        return new $this->class(json_decode($this->credentials,true));
    }
}
