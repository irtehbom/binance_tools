<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models;
use App\Role;

class User extends Authenticatable {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_key', 'api_secret','tokens','ip_address','trial_started'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles() {
        return $this
                        ->belongsToMany('App\Role')
                        ->withTimestamps();
    }

    public function authorizeRoles($roles) {
        if ($this->hasAnyRole($roles)) {
            return true;
        } else {
            \Session::flash('message', ' <div class="alert alert-danger">Please select a package to access this feature</div>');

            return redirect()->to('/admin/orders/add')->send();
        }    
        
    }

    public function hasAnyRole($roles) {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role) {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public function favourites() {
        return $this->hasOne('App\Models\Favourites');
    }

}
