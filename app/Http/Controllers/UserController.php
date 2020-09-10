<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * UserテーブルからIDを元にカラムを取得する
     */
    public function getUser(int $user_id)
    {
      Log::debug('UserController: getUser : ID='.$user_id);
      
      $user = User::where('id', $user_id)->first();
      
      return $user ?? abort(404);
    }

}
