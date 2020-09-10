<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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

    // Jsonで表示させる項目
    protected $visible = [
        'name', 'id'
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    
    /**
     * リレーション - reportsテーブル
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reports()
    {
      return $this->hasMany('App\Report');
    }
    
    /**
     * リレーション - commentsテーブル
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
      return $this->hasMany('App\Comment');
    }
  
    /**
     * リレーション - profilesテーブル
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profiles()
    {
      return $this->hasOne('App\Profile');
    }
}
