<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuizCategory;
use App\Models\QuizType;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Answer;
use App\Models\Room;
use App\Models\UserRoom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserQuizController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if (!empty($request->input('search')) && !empty($request->input('category'))) {
            $search = $request->input('search');
            $category = $request->input('category');
            $quizzes = Quiz::where('user_id', $user->id)
                ->whereHas('category', function ($q) use ($search, $category) {
                    $q->where('id', $category)
                        ->where(function ($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%')
                                ->orWhere('description', 'like', '%' . $search . '%');
                        });
                })
                ->paginate(15);
            $quizzes->appends(['category_id' => $category, 'search' => $search]);
        } elseif (!empty($request->input('search'))) {
            $search = $request->input('search');
            $quizzes = Quiz::where('user_id', $user->id)
                ->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                })
                ->paginate(15);
            $quizzes->appends(['search' => $search]);
        } elseif (!empty($request->input('category'))) {
            $category = $request->input('category');
            $quizzes = Quiz::where('user_id', $user->id)
                ->where(function ($query) use ($category) {
                    $query->where('category_id', 'like', '%' . $category . '%');
                })
                ->paginate(15);
            $quizzes->appends(['search' => $category]);
        } else {
            $quizzes = Quiz::where('user_id', $user->id)->paginate(15);
        }

        $quizTypes = QuizType::all();
        $quizCategories = QuizCategory::all();

        return view('user.quiz.index', compact('user', 'quizzes', 'quizTypes', 'quizCategories'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Quiz $quiz
     * @return \Illuminate\Http\Response
     */
    public function show($name, Quiz $quiz)
    {
        // User show quiz will be a preview of how the quiz will look like when you play it.

        $allQuestions = Question::where('quiz_id', $quiz->id)->get();

        $array = array();
        foreach ($allQuestions as $question) {
            $array[] = $question;
        }

        $totalAmount = count($array);

        $equalAmount = ceil($totalAmount / 4);

        $questions[] = array_chunk($array, $equalAmount);


        return view('quiz.show', compact('quiz', 'questions', 'totalAmount', 'array'));
    }

    public function create()
    {
        $user = Auth::user();

        $quizTypes = QuizType::all();
        $quizCategories = QuizCategory::all();

        return view('user.quiz.create', compact('user','quizTypes', 'quizCategories'));
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

        $user = Auth::user();

        $quiz = new Quiz;
        $quiz->name = $request->input('name');
        $quiz->description = $request->input('description');
        $quiz->user_id = $user->id;
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

        return redirect('user/quiz');

    }

    public function edit(Quiz $quiz)
    {
        $user = Auth::user();

        $quizTypes = QuizType::all();
        $quizCategories = QuizCategory::all();
        $questions = $quiz->questions()->get();

        return view('user.quiz.edit', compact('user', 'quiz', 'questions', 'quizTypes', 'quizCategories'));
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
        return redirect('user/quiz');
    }

    public function delete()
    {

    }
}
