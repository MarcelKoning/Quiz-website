<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\QuizType;
use App\Models\QuizCategory;


class AdminQuizController extends Controller
{
    public function index(Request $request)
    {
        if(!empty($request->input('search')))
        {
            $quizzes = Quiz::searchquiz($request->input('search'))->get();
        }
        else {
            $quizzes = Quiz::all();
        }

        return view('admin.quiz.index', compact('quizzes'));
    }

    public function show(Quiz $quiz)
    {
        $questions = $quiz->questions()->get();
        $quizType = $quiz->type()->get();
        $quizCategory = $quiz->category()->get();

        return view('admin.quiz.show', compact('quiz', 'questions','quizType', 'quizCategory'));
    }

    public function create()
    {
        $quizTypes = QuizType::all();
        $quizCategories = QuizCategory::all();

        return view('admin.quiz.create', compact('quizTypes', 'quizCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'type' => 'required|numeric',
            'h_name' => 'required|max:255',
            'h_value' => 'required|max:255',
            'timer' => 'required|numeric|min:1',
            'category' => 'required|numeric',
            'description' => 'required',
            'question' => 'required|array|min:1',
            'question.*' => 'required',
            'answer' => 'required|array|min:1',
            'answer.*' => 'required',
        ]);

        $quiz = new Quiz;
        $quiz->name = $request->input('name');
        $quiz->description = $request->input('description');
        $quiz->type_id = $request->input('type');
        $quiz->category_id = $request->input('category');
        $quiz->h_name = $request->input('h_name');
        $quiz->h_value = $request->input('h_value');
        $quiz->timer = $request->input('timer');
        $quiz->save();

        $questions = $request->input('question.*');
        $answers = $request->input('answer.*');

        $arrayLength = count($questions);

        for($i = 0; $i < $arrayLength; $i++)
        {
            $question = new Question;

            $question->question = $questions[$i];
            $question->correct_answer = $answers[$i];
            $question->type = "";
            $question->quiz()->associate($quiz);
            $question->save();
        }

        return redirect('admin/quiz');
    }


    public function edit(Quiz $quiz)
    {
        $quizTypes = QuizType::all();
        $quizCategories = QuizCategory::all();
        $questions = $quiz->questions()->get();

        return view('admin.quiz.edit', compact('quiz', 'questions', 'quizTypes', 'quizCategories'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $request->validate([
            'name' => 'required|max:255',
            'type' => 'required|numeric',
            'h_name' => 'required|max:255',
            'h_value' => 'required|max:255',
            'timer' => 'required|numeric|min:1',
            'category' => 'required|numeric',
            'description' => 'required',
            'question' => 'required|array|min:1',
            'question.*' => 'required',
            'answer' => 'required|array|min:1',
            'answer.*' => 'required',
        ]);

        $quiz->name = $request->input('name');
        $quiz->description = $request->input('description');
        $quiz->type_id = $request->input('type');
        $quiz->category_id = $request->input('category');
        $quiz->h_name = $request->input('h_name');
        $quiz->h_value = $request->input('h_value');
        $quiz->timer = $request->input('timer');
        $quiz->save();

        $questions = $request->input('question.*');
        $answers = $request->input('answer.*');

        $arrayLength = count($questions);

        $questionArray = $quiz->questions()->get();
        $questionArrayLength = count($questionArray) -1;

        for($i = 0; $i < $arrayLength; $i++)
        {
            if($i > $questionArrayLength)
            {
                $question = new Question;

                $question->question = $questions[$i];
                $question->correct_answer = $answers[$i];
                $question->type = "";
                $question->quiz()->associate($quiz);
                $question->save();
            }
            else
            {
                $question = $questionArray[$i];

                $question->question = $questions[$i];
                $question->correct_answer = $answers[$i];
                $question->type = "";
                $question->save();
            }
        }
        return redirect('admin/quiz');
    }

    public function delete()
    {

    }
}
