<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Song;
use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    // Updating model structure so that the songs function returns the belongsToMany method. Once this relationship is defined, I can access the user's favorite songs in the controller.
    public function songs(): BelongsToMany {
        return $this->belongsToMany(Song::class);
    }
    
    // Adding the roles relationship to the user model. This user belongsToMany roles.
    public function roles(): BelongsToMany
    {
        // pointing out to laravel that the pivot table is called user_role, since I accidentally didn't follow convention, which is in alphabetic order.
        return $this->belongsToMany(Role::class, 'user_role');
    }

    // This method will check if the user has the input role
    public function hasRole($role){
        return null != $this->roles()->where('name', $role)->first();
    }

    // Same as the previous method, but we're checking an array.
    public function hasTheseRoles($roles){
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    // This method uses the previous methods to check if the user has the input role, and it returns a error if they don't, using the OR operator. We can also check arrays using the is_array method.
    public function authorizeRoles($roles){
        if(is_array($roles)){
            return $this->hasAnyRole($roles) || abort(403, "You are not authorized to perform this action");
        }

        return $this->hasRole($roles) || abort(403, "You are not authorized to perform this action");
    }
}
