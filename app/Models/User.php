<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // public function assignRole(string $role): void
    // {
    //     $this->assignRole($role);  // Assigns the role using the Spatie package method
    // }

    public function role_details(){
        return $this->belongsTo('App\Models\Role_user', 'id', 'user_id');
    }

    public function roles(){
        //return $this->belongsToMany('App\Models\Role');
        return $this->belongsToMany(Role::class, 'role_users', 'user_id', 'role_id');
    }
    


    public function hasRole($role){
        if($this->roles()->where('name', $role)->first()){
            return true; 
        }
        return false; 
    }
}
