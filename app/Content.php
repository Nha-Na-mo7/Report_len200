<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = ['content'];
  
    /** JSONに含める属性 */
    protected $visible = [
        'author', 'content'
    ];
    
    /**
     * リレーション - reportsテーブル
     * @returns \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
      return $this->belongsTo('App\Report', 'report_id', 'id', 'reports');
    }
}
