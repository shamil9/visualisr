<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UnconfirmedUser extends Model
{
    protected $fillable = ['user_id', 'token'];

    /**
     * Activate users account
     *
     * @return App\User
     */
    public function setActive()
    {
        $user = User::find($this->user_id);
        $user->active = 1;
        $user->save();

        $this->delete();

        return $user;
    }
}
