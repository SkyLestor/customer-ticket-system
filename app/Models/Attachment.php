<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attachment extends Model
{
    protected $fillable = ['ticket_id', 'file_path', 'file_name'];

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    public function getUrlAttribute(): string
    {
        return route('attachment.download', $this);
    }

    public function getIsImageAttribute(): bool
    {
        return in_array(
            strtolower(pathinfo($this->file_name, PATHINFO_EXTENSION)),
            ['jpg', 'jpeg', 'png', 'gif', 'webp']
        );
    }
}
