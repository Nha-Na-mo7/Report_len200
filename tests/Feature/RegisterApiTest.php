<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterApiTest extends TestCase
{
  use RefreshDatabase;
  
  /**
   * @test
   **/
  public function _ユーザー新規登録API() {
  
      // 仮のユーザーの入力でーたを用意
      $data = [
        'name' => 'ちかもとこうじ',
        'email' => 'example@gmail.com',
        'password' => '111111',
        'password_confirmation' => '111111'
      ];
      
      //routes/api.phpに記述したルート定義に沿って、registerにPOST通信で$dataをリクエストした時のレスポンスを$responseに代入
      $response = $this->json('POST', route('register'), $data);
      
      // ユーザー登録されていればfirst()でとってこれる
      // テスト内容は「入力でーたのname」と、登録された$userのnameが同一であること
      $user = User::first();
      $this->assertEquals($data['name'], $user->name);
      
      $response->assertStatus(201)->assertJson(['name' => $user->name]);
      
  }

}
