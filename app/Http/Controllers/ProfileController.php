<?php

namespace App\Http\Controllers;

use App\Http\Requests\createProfile;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * profileを新規作成する
     * @param createProfile $request
     */
    public function create(createProfile $request)
    {
      Log::debug('ProfileController : createProfile');
      $profile = new Profile();
      
      // $profile->user_id = Auth::user()->id;
      // $profile->profile = $request->('content');
      Auth::user()->profiles()->save($profile->fill($request->all()));
      $profile->save();
  
      return response($profile, 201);
    }
  
    /**
     * profileをeditする
     * @param int $user_id
     * @param createProfile $request
     * @return \Illuminate\Http\Response
     */
    public function edit(int $user_id, createProfile $request)
    {
      Log::debug('ProfileController : editUser : ID='.$user_id);
      // ユーザーIDを元にプロフィールカラムを取得
      $profile = Profile::where('id', $user_id)->first();
      $profile->profile = $request->get('prof_content');
      $profile->save();
      
      return $profile;
    }
    
    /**
     * profile情報を取得する
     *
     */
    public function show(int $user_id)
    {
      Log::debug('ProfileController : getUser : ID='.$user_id);
      $profile = Profile::where('id', $user_id)->first();
  
      return $profile ?? abort(404);
    }
}
