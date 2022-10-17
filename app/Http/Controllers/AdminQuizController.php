<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\Quiz;

class AdminQuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::all();

        return view('admin.quiz.index', compact('quizzes'));
    }

    public function show(Quiz $quiz)
    {

    }

    public function create()
    {
        return view('admin.quiz.create');
    }

    public function store(Request $request)
    {
        $quiz = new Quiz;
        $quiz->name = $request->input('name');
        $quiz->description = $request->input('description');
        $quiz->type = $request->input('type');
        $quiz->h_name = $request->input('h_name');
        $quiz->h_value = $request->input('h_value');
        $quiz->save();

        $questions = $request->input('question.*');
        $answers = $request->input('answer.*');

        $arrayLength = count($questions);

        for($i = 0; $i < $arrayLength; $i++)
        {
            $question = new Question;
            if($questions[$i] == null)
            {
                $question->question = "";
            }
            else
            {
                $question->question = $questions[$i];
            }
            if($answers[$i] == null)
            {
                $question->correct_answer = "";
            }
            else
            {
                $question->correct_answer = $answers[$i];
            }
            $question->type = "";
            $question->quiz()->associate($quiz);
            $question->save();
        }

        return redirect('admin/quiz');
    }


    public function edit()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
