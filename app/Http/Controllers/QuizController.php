<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{
  // 追加
  public function store(Request $request)
  {
    //　　入力内容を検証

    // データを保存

    return view('quizzes.index');
  }

  // 削除
  public function destroy($id)
  {
    return json_encode(['message' => 'ID:'.$id.'を削除']);
  }
}