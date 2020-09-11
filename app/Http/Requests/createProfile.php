<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createProfile extends FormRequest
{
    private $PROFILE_LENGTH = '500';
  
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
              'profile' => "required|max:{$PROFILE_LENGTH}"
          ];
    }
    
    public function messages()
    {
        extract(get_object_vars($this));
        
        return [
            'profile.required' => '入力してください',
            'profile.max' => "{$PROFILE_LENGTH}文字以内で入力してください",
        ];
    }
}
