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

class QuizController extends Controller
{
    public function index(Request $request)
    {
        if (!empty($request->input('search')) && !empty($request->input('category'))) {
            $search = $request->input('search');
            $category = $request->input('category');
            $quizzes = Quiz::whereHas('category', function ($q) use ($search, $category) {
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
            $quizzes = Quiz::where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            })
                ->paginate(15);
            $quizzes->appends(['search' => $search]);
        } elseif (!empty($request->input('category'))) {
            $category = $request->input('category');
            $quizzes = Quiz::where(function ($query) use ($category) {
                $query->where('category_id', 'like', '%' . $category . '%');
            })
                ->paginate(15);
            $quizzes->appends(['search' => $category]);
        } else {
            $quizzes = Quiz::paginate(15);
        }

        $quizTypes = QuizType::all();
        $quizCategories = QuizCategory::all();

        return view('quiz.index', compact('quizzes', 'quizTypes', 'quizCategories'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Quiz $quiz
     * @return \Illuminate\Http\Response
     */
    public function show($name, Quiz $quiz)
    {
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

    }

    public function store(Request $request, $name, Quiz $quiz)
    {
        if (Auth::check()) {

            $user = Auth::user();

            $array = json_decode($request->input("array"));

            // Total time to finish quiz in seconds.
            $timeInSeconds = $quiz->timer * 60;
            // Calculate the amount of questions a quiz has.
            $questionCount = count($quiz->questions()->get());

            $room = new Room;

            $room->quiz_id = $quiz->id;
            $room->capacity = $array[0]->capacity;
            $room->type = $quiz->type->name;
            $room->save();

            $user_room = new UserRoom;

            $user_room->user_id = $user->id;
            $user_room->room()->associate($room);
            // Calculate how long it took to finish the quiz.
            $user_room->time = $timeInSeconds - $array[0]->timer;
            $user_room->score = "".$array[0]->score."/". $questionCount ."";
            $user_room->save();


            foreach ($array as $object) {
                $answer = new Answer;

                $answer->question_id = $object->question->id;
                $answer->user_id = $user->id;
                $answer->userRoom()->associate($user_room);
                if ($object->is_correct === false) {
                    if ($object->answer === "") {
                        $answer->answer = "";
                    } else {
                        $answer->answer = $object->answer;
                    }
                } else {
                    $answer->answer = $object->answer;
                }

                $answer->is_correct = $object->is_correct;
                $answer->save();
            }
            return Redirect::to('/quiz/' . $name . '/' . $quiz->id);
        }
        return Redirect::to('/quiz/' . $name . '/' . $quiz->id);
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
