<?php

namespace App\Models;

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{

    use HasFactory;

    protected $fillable = ['title', 'description', 'priority', 'status', 'user_id'];

    protected $casts = [
        'priority' => TicketPriority::class,
        'status' => TicketStatus::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function attachments(): Ticket|HasMany
    {
        return $this->hasMany(Attachment::class);
    }
}
