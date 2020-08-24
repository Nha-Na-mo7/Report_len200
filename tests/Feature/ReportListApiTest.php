<?php

namespace Tests\Feature;

use App\Report;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class ReportListApiTest extends TestCase
{
  use RefreshDatabase;
  
  /**
   * @test
   */
  public function _レポートリスト・正しい構造のJSONの返却()
  {
    $this->withoutExceptionHandling();
  
    factory(Report::class, 10)->create();
    
    $response = $this->json('GET', route('report.index'));
    
    // 生成した日誌データを作成日・降順(新しい順)で取得
    $reports = Report::with(['owner'])->orderBy('created_at', 'desc')->get();
    
    // data項目の期待値
    $expected_data = $reports->map(function ($report) {
      return [
          'id' => $report->id,
          'owner' => [
              'name' => $report->owner->name,
          ],
      ];
    })->all();
    
    $response->assertStatus(200)
        // レスポンスJSONのdata項目に含まれる要素が10個であること
        ->assertJsonCount(10, 'data')
        // data項目が期待値と合致すること
        ->assertJsonFragment([
            "data" => $expected_data,
        ]);
    
  }
}
