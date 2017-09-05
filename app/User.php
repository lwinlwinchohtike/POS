<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Http\AuthTrait\OwnRecord;
class User extends Authenticatable
{
    use Notifiable;
     use OwnRecord;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','is_admin','is_super'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
   
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_users');
    }

    public function hasAccess(array $permissions) : bool
    {

        // check if the permission is available in any role
        foreach ($this->roles as $role) {
        
            if($role->hasAccess($permissions)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Checks if the user belongs to role.
     */
    public function inRole(string $roleSlug)
    {
        return $this->roles()->where('slug', $roleSlug)->count() == 1;
    }

    public function hasPermission($permission){
        if($this->roles() != null){
            $user_permissions = $this->roles()->first()->permissions;
            if(array_key_exists($permission,$user_permissions)){
                if($user_permissions[$permission]){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }

        }
        return false;
    }
}
