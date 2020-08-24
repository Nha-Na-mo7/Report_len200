<?php

namespace App\Http\Controllers;

use App\Content;
use App\Http\Requests\CreateReport;
use App\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
  //コンストラクタで認証
  public function __construct()
  {
    // $this->middleware('auth')->except(['index']);
  }
  
  /**
   * 日誌投稿
   */
  public function create(Request $request)
  {
    Log::debug('ReportController : create : 日誌作成');
    $report = new Report();
    $keep_id = $report->id;
    $content = new Content();

    // reportsテーブルへタイトル・副題を格納
    Auth::user()->reports()->save($report->fill($request->all()));
    $report->id = $keep_id;
    Log::debug($report->id);
  
    Log::debug('id : '.$report->id);
    Log::debug('user_id : '.$report->user_id);
    Log::debug('report_title : '.$report->report_title);
    
    // contentsテーブルへ本文を格納
    $content->report_id = $report->id;
    $content->content = $request->get('content');
    $content->save();
    
    return response($report, 201);
  }
  
  /**
   * 日誌一覧の取得
   */
  public function index()
  {
    Log::debug('ReportController : index : 日誌一覧取得');
    // withメソッドでリレーションを事前ロード
    $reports = Report::with(['owner'])->orderBy(Report::CREATED_AT, 'desc')->paginate();
    Log::debug($reports);
    return $reports;
  }
}
// // バリデーション
// public function create(DrillRequest $request)
// {
//
//   // モデルを使って、DBに登録する値をセット
//   // $category = new Category(['category_name' => $request->category_name]);
//   $drill = new Drill;
//   $category = new Category;
//   $problem = new Problem;
//
//   // fillを使って一気にいれるか
//   Auth::user()->drills()->save($drill->fill($request->all()));
//   $last_insert_drills_id = $drill->id; //最後に挿入したカテゴリのIDを取得
//
//   //カテゴリテーブルにカテゴリを格納
//   $category->category_name = $request->category_name;
//   $category->drill_id = $last_insert_drills_id;
//   $category->save();
//
//   //problemsテーブルに問題を格納
//   $problem->fill($request->all());
//   $problem->drill_id = $last_insert_drills_id;
//   $problem->save();
//
//   // $category->drill()->create($request->get('drill'),[]);
//
//
//   // リダイレクトする
//   // その時にsessionフラッシュにメッセージを入れる
//   return redirect('/drills/new')->with('flash_message', __('Registered！登録されました！.'));
// }