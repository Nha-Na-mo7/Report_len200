<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /** jsonに含める属性 */
    protected $visible = [
        'author', 'comment',
    ];
    
    //
    // /**
    //  * リレーション - reportsテーブル
    //  * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    //  */
    // public function reports()
    // {
    //   return $this->belongsTo('App\Report', 'report_id', 'id', 'reports');
    // }
    
    /**
     * リレーション - usersテーブル
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
      return $this->belongsTo('App\User', 'user_id', 'id', 'users');
    }
}