<?php

namespace Tests\Feature;

use App\Content;
use App\Report;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

// =================================
// 日誌投稿のAPI
// ・ログインしていなければ投稿ができない
// ・レスポンスは201(CREATED)
// ・日誌のIDは、ランダムな文字列16桁。
// ・DBに挿入されていることを確認
// ・DBがエラーの場合は投稿を行わない。
// =================================

class ReportSubmitApiTest extends TestCase
{
  use RefreshDatabase;
  
  protected function setUp(): void
  {
    parent::setUp(); // TODO: Change the autogenerated stub
  
    $this->user = factory(User::class)->create();
  }
  
  /**
   * @test
   */
  public function _日誌投稿が無事に行えるAPI()
  {
    $this->withoutExceptionHandling();
    // 仮の入力でーたを用意
    $data = [
        'report_title' => 'テスト用レポートタイトル 羅生門',
        'about' => 'テスト用レポート副題 芥川龍之介',
        'content' => '或日の暮方の事である。一人の下人が、羅生門の下で雨やみを待つてゐた。廣い門の下には、この男の外に誰もゐない。唯、所々丹塗の剥げた、大きな圓柱に、蟋蟀が一匹とまつてゐる。羅生門が、朱雀大路にある以上は、この男の外にも、雨やみをする市女笠や揉烏帽子が、もう二三人にんはありさうなものである。それが、この男の外には誰もゐない。'
    ];
    //
    $response = $this->actingAs($this->user)->json('POST', route('report.create'), $data);
    
    //新規投稿なので201
    $report = Report::first();
    $content = Content::first();
    $this->assertEquals($data['report_title'], $report->report_title);
    $this->assertEquals($data['content'], $content->content);
    $this->assertEquals($report->id, $content->report_id);
  
    $response->assertStatus(201);
    
    //ID桁数が16桁であること
    $this->assertRegExp('/^[0-9a-zA-Z]{16}$/', $report->id);
  }
  /**
   * @test
   */
  public function _副題がなくても日誌投稿が無事に行えるAPI()
  {
    $this->withoutExceptionHandling();
    // 仮の入力でーたを用意
    $data = [
        'report_title' => 'テスト用レポートタイトル 羅生門',
        'about' => '',
        'content' => '或日の暮方の事である。一人の下人が、羅生門の下で雨やみを待つてゐた。廣い門の下には、この男の外に誰もゐない。唯、所々丹塗の剥げた、大きな圓柱に、蟋蟀が一匹とまつてゐる。羅生門が、朱雀大路にある以上は、この男の外にも、雨やみをする市女笠や揉烏帽子が、もう二三人にんはありさうなものである。それが、この男の外には誰もゐない。'
    ];
    //
    Log::debug('日誌APItest(副題なしver)');
    $response = $this->actingAs($this->user)->json('POST', route('report.create'), $data);
  
    //新規投稿なので201
    $report = Report::first();
    $content = Content::first();
    $this->assertEquals($data['about'], $report->about);
    $this->assertEquals($data['content'], $content->content);
  
    $response->assertStatus(201);
  
    //ID桁数が16桁であること
    $this->assertRegExp('/^[0-9a-zA-Z]{16}$/', $report->id);
  }
}
