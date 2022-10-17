<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Answer;
use App\Models\Room;
use App\Models\UserRoom;
use Illuminate\Support\Facades\Redirect;

class QuizController extends Controller
{
    public function index()
    {

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function show($name, Quiz $quiz)
    {
        $allQuestions = Question::where('quiz_id', $quiz->id )->get();

        $array = array();
        foreach($allQuestions as $question)
        {
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
        $array = json_decode($request->input("array"));

        $timeInSeconds = $quiz->timer * 60;

        $room = new Room;

        $room->capacity = $array[0]->capacity;
        $room->type = $quiz->type;
        $room->save();

        $user_room = new UserRoom;

        $user_room->user_id = 1;
        $user_room->room()->associate($room);
        $user_room->time = $timeInSeconds - $array[0]->timer;
        $user_room->score = $array[0]->score;
        $user_room->save();


        foreach ($array as $object)
        {
            $answer = new Answer;

            $answer->question_id = $object->question->id;
            $answer->user_id = 1;
            $answer->room()->associate($room);
            if($object->is_correct === "incorrect")
            {
                $answer->answer = "";
            }
            else
            {
                $answer->answer = $object->answer;
            }
            $answer->is_correct = $object->is_correct;
            $answer->save();
        }
        return Redirect::to('/quiz/'.$name.'/'.$quiz->id);

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
