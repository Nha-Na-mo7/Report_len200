<?php

namespace Tests\Feature;

use App\Report;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class ReportDetailApiTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * @test
     */
    public function _日誌詳細ページ、正しいJSONがレスポンスされる()
    {
      factory(Report::class)->create();
      $report = Report::first();
      Log::debug('huhuhu: '.$report->id);
      
      $response = $this->json('GET', route('report.show', ['report_id' => $report->id]));
      
      $response->assertStatus(200)
          ->assertJsonFragment([
              'id' => $report->id,
              'owner' => [
                  'name' => $report->owner->name,
              ],
              'report_title' => $report->report_title
          ]);
    }
  
}
