<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreComment extends FormRequest
{
    private $COMMENT_LENGTH = '250';
  
    /**
       * Determine if the user is authorized to make this request.
       *
       * @return bool
       */
      public function authorize()
      {
          return true;
      }
  
      /**
       * Get the validation rules that apply to the request.
       *
       * @return array
       */
      public function rules()
      {
          // これをつけると、$this->を省略できる
          // https://qiita.com/Hiraku/items/dfb6590a49b6986f663a
          extract(get_object_vars($this));
    
          return [
              'comment' => "required|max:{$COMMENT_LENGTH}",
          ];
      }
      
      public function messages()
      {
          extract(get_object_vars($this));
    
          return [
              'comment.required' => "入力してください",
              'comment.max' => "{$COMMENT_LENGTH}文字以内で入力してください",
          ];
      }
}
