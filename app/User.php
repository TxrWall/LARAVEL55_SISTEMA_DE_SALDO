<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Balance;
use App\Models\History;

class User extends Authenticatable
{
    use Notifiable;

    protected $files = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function balance()
    {
        return $this->hasOne(Balance::class);
    }

    public function history()
    {
        return $this->hasMany(History::class);
    }

    public function getAccount($account)
    {
        return $this->where('name', 'LIKE', "%$account%")
            ->orWhere('email', $account)
            ->first();
    }
}
