<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateReport extends FormRequest
{
    private $TITLE_LENGTH = '50';
    private $ABOUT_LENGTH = '150';
    private $CONTENT_MIN_LENGTH = '150';
    private $CONTENT_MAX_LENGTH = '250';
    
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
            'report_title' => "required|max:{$TITLE_LENGTH}",
            'about' => "max:{$ABOUT_LENGTH}",
            'content' => "required|between:{$CONTENT_MIN_LENGTH}, {$CONTENT_MAX_LENGTH}"
        ];
    }
    
    public function messages()
    {
        extract(get_object_vars($this));
        
        return [
            'report_title.required' => 'タイトルを入力してください',
            'report_title.max' => "タイトルは、{$TITLE_LENGTH}文字以内で入力してください",
            'about.max' => "副題は、{$ABOUT_LENGTH}文字以内で入力してください",
            'content.required' => '本文は入力必須です',
            'content.between' => "本文は{$CONTENT_MIN_LENGTH}文字以上、{$CONTENT_MAX_LENGTH}文字以内で入力してください",
        ];
    }
}
