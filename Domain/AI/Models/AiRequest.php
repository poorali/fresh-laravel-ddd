<?php

namespace Domain\AI\Models;

use Domain\AI\Events\AiRequestWasCreatedEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class AiRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'ai_driver_id',
        'target_id',
        'target_type',
        'system_prompt',
        'user_prompt',
        'response',
        'tag',
    ];
    protected $dispatchesEvents = [
        'created' => AiRequestWasCreatedEvent::class,
    ];

    public function driver(): BelongsTo
    {
        return $this->belongsTo(AiDriver::class, 'ai_driver_id');
    }


    public function target(): MorphTo
    {
        return $this->morphTo();
    }
}
