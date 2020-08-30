<?php
//============
//Model Report
//============
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class Report extends Model
{
    // モデルがその属性以外を持たなくなる（fillメソッドに対応しやすいが、カラムが増えるほど足していく必要あり）
    protected $fillable = ['user_id', 'report_title', 'about'];
  
    //プライマリーキーの型を設定
    protected $keyType = 'string';
  
    /** JSONに含める属性 */
    protected $visible = [
        'id', 'owner', 'created_at', 'report_title', 'about'
    ];

    
    //日誌IDの桁数
    const ID_LENGTH = 16;
    
    
    //コンストラクタでsetId()を呼び出し
    public function __construct(array $attributes = [])
    {
      parent::__construct($attributes);
      // Arr::getでidがある = 正しく呼び出されている時 を判定
      if(! Arr::get($this->attributes, 'id')) {
        $this->setId();
      }
    }
  
  
    //id属性に代入
    private function setId()
    {
      $this->attributes['id'] = $this->makeRandomId();
    }
    
    /**
     * ランダムなIDを生成する関数
     * @return string
     */
    private function makeRandomId()
    {
      $id = "";
      //$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $characters = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));
      $characters_length = count($characters);
      
      for ($i = 0; $i < self::ID_LENGTH; $i++){
        $id .= $characters[random_int(0, $characters_length - 1)];
      }
      return $id;
    }
  
  
  
  
    /**
     * リレーション - usersテーブル
     * @returns \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    // モデル名と関係ない名前(owner)のため、belongsToメソッドの引数は省略せずに記載
    public function owner()
    {
      return $this->belongsTo('App\User', 'user_id', 'id', 'users');
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
     * リレーション - contentsテーブル
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function contents()
    {
      return $this->hasOne('App\Content');
    }
    
}
