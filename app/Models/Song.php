<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Song extends Model
{
    use HasFactory;

    // If I wanted to edit the model (turn off the timestamps, change the connecton, change the ID name) I would put it here

    // Updating model structure so that the users function returns the belongsToMany method. Once this relationship is defined, I can tell which users favorited which song in the controller.
    public function users(): BelongsToMany {
        return $this->belongsToMany(User::class);
    }
}
