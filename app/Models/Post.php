<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Thread;

class Post extends Model
{
    use HasFactory;

    // A user can have many posts on the same thread.
    public function users(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function threads(): BelongsTo {
        return $this->belongsTo(Thread::class, 'thread_id');
    }
    
}
