<?php

namespace App\Core\Entity;
use Illuminate\Database\Eloquent\Model;
class Task extends Model
{
    protected $fillable = ['task_name', 'is_completed', 'user_id'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
