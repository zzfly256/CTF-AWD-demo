<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['editBtnAction', 'deleteBtnAction', 'infoBtnAction'];

    public function getEditBtnActionAttribute()
    {
        if (Auth::user()->id != 1) {
            return "alert('该用户不能使用编辑功能')";
        } else {
            return "window.location.href='/edit'";
        }
    }
    public function getDeleteBtnActionAttribute()
    {
        return "alert('该用户不能使用删除功能')";
    }
    public function getInfoBtnActionAttribute()
    {
        return "alert('该用户不能查看宣言')";
    }
}
