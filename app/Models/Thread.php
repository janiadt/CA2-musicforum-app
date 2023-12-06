<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\Post;

class Thread extends Model
{
    use HasFactory;

    // Using the belongsTo method to establish a one to many relationship. One user can have many threads.
    public function users(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }
    // Using the hasMany method to establish a one to many relationship with the post model
    public function posts(): HasMany {
        return $this->hasMany(Post::class);
    }
    // Here's my array of the enum values in my database. I'm just going to do it this way, since enums are evil
    public static function arr(){
        return $array = ['Pop', 'Rock', 'Jazz', 'EDM', 'Country', 'Punk Rock', 'Indie', 'Progressive Rock', 'Dance', 'Disco'];
    }

    // Adding views to the fillable array, to allow saving through methods.
    protected $fillable = ['views', 'image'];
}
