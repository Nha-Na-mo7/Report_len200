<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /** jsonに含める属性 */
    protected $visible = ['users', 'comment'];
    
  
    /**
     * リレーション - reportsテーブル
     * @returns \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reports()
    {
      return $this->belongsTo('App\Report', 'report_id', 'id', 'reports');
    }
    
    /**
     * リレーション - usersテーブル
     * @returns \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
      return $this->belongsTo('App\User', 'user_id', 'id', 'users');
    }
}