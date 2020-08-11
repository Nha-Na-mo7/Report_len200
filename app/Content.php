<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    /**
     * リレーション - reportsテーブル
     * @returns \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reports()
    {
      return $this->belongsTo('App\Report', 'report_id', 'id', 'reports');
    }
}
