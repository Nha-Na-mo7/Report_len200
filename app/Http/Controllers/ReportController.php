<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Content;
use App\Http\Requests\CreateReport;
use App\Http\Requests\StoreComment;
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
  public function create(CreateReport $request)
  {
    Log::debug('ReportController : create : 日誌作成');
    $report = new Report();
    $keep_id = $report->id;
    $content = new Content();

    // reportsテーブルへタイトル・副題を格納
    Auth::user()->reports()->save($report->fill($request->all()));
    $report->id = $keep_id;
    Log::debug($report->id);
  
    Log::debug('create : id : '.$report->id);
    Log::debug('create : user_id : '.$report->user_id);
    Log::debug('create : report_title : '.$report->report_title);
    
    // contentsテーブルへ本文を格納
    $content->report_id = $report->id;
    $content->content = $request->get('content');
    $content->save();
    
    Log::debug('========= 日誌を作成しました =========');
    
    return response($report, 201);
  }
  
  /**
   * 日誌一覧の取得
   */
  public function index($user_id = null)
  {
    Log::debug('ReportController : index : 日誌一覧取得');
    // 引数に指定がなかった場合、全ての日誌一覧を取得する
    if($user_id == null) {
      Log::debug('日誌一覧取得 : 引数オプショナルの場合(全部取得)');
      // withメソッドでリレーションを事前ロード
      $reports = Report::with(['owner'])->orderBy(Report::CREATED_AT, 'desc')->paginate();
  
      return $reports;
    }
    Log::debug('日誌一覧取得 : $user_idがある場合');
    // withメソッドでリレーションを事前ロード
    $reports = Report::where('user_id', $user_id)->with(['owner'])->orderBy(Report::CREATED_AT, 'desc')->paginate();
  
  
    return $reports;
  }

  
  /**
   * 日誌詳細の取得
   */
  public function show(string $report_id)
  {
    Log::debug('ReportController : show : 日誌詳細取得');
    // withメソッドでリレーションを事前ロード
    // whereを使って事前にレポートIDで絞り込みをする
    $reports = Report::where('id', $report_id)->with(['owner', 'contents', 'comments.author'])->first();

    return $reports ?? abort(404);
  }
  
  /**
   * 日誌へコメントを投稿
   * @param Report $report
   * @param StoreComment $request
   * @return \Illuminate\Http\Response
   */
  public function addComment(Report $report, StoreComment $request)
  {
    Log::debug('ReportController : addComment : 日誌へコメントを投稿');
    Log::debug('addComment :Auth::user()->id : '.Auth::user()->id);
    Log::debug('addComment :リクエスト $request->get("comment") : '.$request->comment);
    
    $comment = new Comment();
    $comment->comment = $request->get('comment');
    $comment->user_id = Auth::user()->id;
    $report->comments()->save($comment);
  
    //authorリレーションをロードするためにコメントを取得し直す
    $new_comment = Comment::where('id', $comment->id)->with('author')->first();
    Log::debug('new_comment : '.$new_comment);
  
    return response($new_comment, 201);
  }
  
  /**
   * 日誌を削除する
   * @param String $report_id
   * @return false|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
   */
  public function destroy(String $report_id)
  {
    Log::debug('ReportController : destroy : 日誌の削除');
    
    //ログインユーザーの持つreportsに$report_idと合致するものがあるか
    $report = Auth::user()->reports()->find($report_id);
    
    if( $report ) {
  
      // reports_idが$idと合致するレコードを削除。
      // レポートに紐づけられたコメントを全て削除
      $comments = $report->comments->where('report_id', $report_id);
      foreach ($comments as $comment) {
        $comment->delete();
      }
      // 本文を削除
      $report->contents->where('report_id', $report_id)->first()->delete();
      //最後に該当のreportを削除。
      $report->delete();
    } else {
      return response(200);
    }
    return response(200);
    // return redirect('/')->with('flash_message', __('Deleted.'));
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