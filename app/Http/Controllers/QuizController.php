<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('quizzes.index', [
          'quizzes' => Quiz::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('quizzes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validatedData = $request->validate([
            'question' => 'required|max:255',
            'answer_a' => 'required|max:255',
            'answer_b' => 'required|max:255',
            'answer_c' => 'required|max:255',
            'answer_d' => 'required|max:255',
            'correct_answer' => 'required|in:A,B,C,D',
            'explanation' => 'max:65535',
        ]);
        // Modelを作成
        $Quiz = new Quiz();
        $Quiz->question = $validatedData['question'];
        $Quiz->answer_a = $validatedData['answer_a'];
        $Quiz->answer_b = $validatedData['answer_b'];
        $Quiz->answer_c = $validatedData['answer_c'];
        $Quiz->answer_d = $validatedData['answer_d'];
        $Quiz->correct_answer = $validatedData['correct_answer'];
        $Quiz->explanation = $validatedData['explanation'];

        // ModelをDBに保存
        $Quiz->save();

        // 一覧ページを表示
        // ※ リロードされたときに、もう一度データが保存されないようにリダイレクトさせる
        return redirect(route('quizzes.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return view('quizzes.show', [
          'quiz' => Quiz::find($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if (!Quiz::destroy($id)) {
          // 400 Bad Request
          return response()->json([
            'message' => 'Failed to delete.',
          ], 400);
        }

        // 204 No Content
        return response()->noContent();
    }
}