<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createProfile extends FormRequest
{
    private $PROF_CONTENT_LENGTH = '500';
  
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
        extract(get_object_vars($this));
    
        return [
              'prof_content' => "required|max:{$PROF_CONTENT_LENGTH}"
          ];
    }
    
    public function messages()
    {
        extract(get_object_vars($this));
        
        return [
            'prof_content.required' => '入力してください',
            'prof_content.max' => "{$PROF_CONTENT_LENGTH}文字以内で入力してください",
        ];
    }
}
