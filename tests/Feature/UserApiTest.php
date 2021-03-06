<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserApiTest extends TestCase
{
  use RefreshDatabase;
  
  protected function setUp(): void
  {
    parent::setUp(); // TODO: Change the autogenerated stub
  
    // 1つのUserインスタンスを作成し、テストユーザーにする
    $this->user = factory(User::class)->create();
  }
  
  /**
   * @test
   */
  public function _現在ログイン中のユーザー情報のレスポンスAPI()
  {
    $response = $this->actingAs($this->user)->json('GET', route('user'));
    
    $response
        ->assertStatus(200)
        ->assertJson([
            'name' => $this->user->name,
        ]);
  }
  
  /**
   * @test
   */
  public function _未ログイン状態の時は、空文字を返却する()
  {
    $response = $this->json('GET', route('user'));
    
    $response->assertStatus(200);
    $this->assertEquals("", $response->content());
  }
}
