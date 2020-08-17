<?php

namespace App\Http\Controllers;

use App\Content;
use App\Http\Requests\CreateReport;
use App\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
  //コンストラクタで認証
  public function __construct()
  {
    $this->middleware('auth');
  }
  
  
  
  /**
   * 日誌投稿
   * @param CreateReport $request
   * @return \Illuminate\Http\Response
   */
  public function create(CreateReport $request)
  {
    $report = new Report();
    $report->user_id = Auth::user()->id;
    $report->report_title =$request->get('report_title');
    $report->about = $request->get('about') || '';
    $report->save();
    
  
    Auth::user()->reports()->save($report->fill($request->all()));
    
    return response($report, 201);
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