<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['profile'];
    
    /** JSONに含める属性 */
    protected $visible = [
        'author', 'profile'
    ];
    
    /**
     * リレーション - usersテーブル
     * @returns \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
      return $this->belongsTo('App\User', 'user_id', 'id', 'users');
    }
    
}
