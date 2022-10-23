@extends('layout.admin')

@section('content')
    <section id="contact-us" class="contact-us section">
        <div class="container">
            <h1>Edit Quiz</h1>
            <div class="contact-head wow fadeInUp" data-wow-delay=".4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="form-main">
                            <form class="form" method="post" action="{{route('quizUpdate', $quiz)}}">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-6">
                                        <div class="form-group">
                                            <span>Quiz Name </span>@error('name')<span class="error">({{$message}})</span>@enderror
                                            <input name="name" type="text" placeholder="Quiz Name" required="required" autocomplete="off" value="{{ old('name', $quiz->name) }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group message">
                                            <span>Quiz Type </span>@error('type')<span class="error">({{$message}})</span>@enderror
                                            <select name="type" autocomplete="off">
                                                @foreach($quizTypes as $type)
                                                    @if(old('type') == $type->id)
                                                        <option value="{{ $type->id }}" selected>{{ $type->name }}</option>
                                                    @elseif($quiz->type_id == $type->id)
                                                        <option value="{{ $type->id }}" selected>{{ $type->name }}</option>
                                                    @else
                                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group message">
                                            <span>Hint Heading </span>@error('h_name')<span class="error">(The hint heading field is required.)</span>@enderror
                                            <input name="h_name" placeholder="ex. Description" autocomplete="off" value="{{ old('h_name', $quiz->h_name) }}" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group message">
                                            <span>Answer Heading </span>@error('h_value')<span class="error">(The answer heading field is required.)</span>@enderror
                                            <input name="h_value" placeholder="ex. Country" autocomplete="off" value="{{ old('h_value', $quiz->h_value) }}" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group message">
                                            <span>Timer </span>@error('timer')<span class="error">({{$message}})</span>@enderror
                                            <input type="number" name="timer" placeholder="timer (in minutes)" autocomplete="off" value="{{ old('timer', $quiz->timer) }}" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group message">
                                            <span>Category </span>@error('category')<span class="error">({{$message}})</span>@enderror
                                            <select name="category" autocomplete="off">
                                                @foreach($quizCategories as $category)
                                                    @if(old('category') == $category->id)
                                                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                                    @elseif($quiz->category_id == $category->id)
                                                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                                    @else
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group message">
                                            <span>Description </span>@error('description')<span class="error">({{$message}})</span>@enderror
                                            <textarea name="description" placeholder="Description" autocomplete="off" >{{ old('description', $quiz->description) }}</textarea>
                                        </div>
                                    </div>
                                    <div id="Questions" class="form-group col-12">
                                        <div id="Default-question-input" class="question row col-lg-12 col-12 align-items-center d-none">
                                            <div class="form-group col-1 number">
                                                <span id="Question-0">1</span>
                                            </div>
                                            <div class="form-group col-5">
                                                <input name="test" type="text" placeholder="Question" autocomplete="off">
                                            </div>
                                            <div class="form-group col-5">
                                                <input name="test1" type="text" placeholder="Answer" autocomplete="off">
                                            </div>
                                        </div>
                                        <?php
                                        $questionCount = 1;
                                        $answerCount = 1;
                                        $arrayCount = 1;
                                        ?>
                                        @if($errors->has('question') || $errors->has('answer') || $errors->any())
                                            @foreach( old('question') as $key => $row)
                                                <div class="question row col-lg-12 col-12 align-items-center">
                                                    <div class="form-group col-1 number">
                                                        <span id="Question-1">{{$questionCount}}</span>
                                                    </div>
                                                    <div class="form-group col-5">
                                                        @error('question.'.$questionCount)<span class="error">The question field is required</span>@enderror
                                                        <input name="question[{{$questionCount}}]" type="text" placeholder="Question" autocomplete="off" value="{{ $row }}">
                                                    </div>
                                                    <div class="form-group col-5">
                                                        @error('answer.'.$answerCount)<span class="error">The answer field is required</span>@enderror
                                                        <input name="answer[{{$answerCount}}]" type="text" placeholder="Answer" autocomplete="off" value="{{old('answer.'.$key)}}">
                                                    </div>
                                                </div>
                                                <?php $answerCount++; $questionCount++; ?>
                                            @endforeach
                                        @else
                                            @foreach($questions as $question)
                                                <div class="question row col-lg-12 col-12 align-items-center">
                                                    <div class="form-group col-1 number">
                                                        <span id="Question-1">{{ $arrayCount }}</span>
                                                    </div>
                                                    <div class="form-group col-5">
                                                        <input name="question[{{$arrayCount}}]" type="text" placeholder="Question" autocomplete="off" required="required" value="{{ $question->question  }}">
                                                    </div>
                                                    <div class="form-group col-5">
                                                        <input name="answer[{{ $arrayCount }}]" type="text" placeholder="Answer" autocomplete="off" required="required" value="{{ $question->correct_answer }}">
                                                    </div>
                                                </div>
                                                <?php $arrayCount++; ?>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="form-group question col-lg-12 col-12">
                                        <button type="button" class="btn btn-primary" onclick="AddQuestion()">Add Question <i class="fa-solid fa-plus"></i></button>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group contacts-button button contact-button">
                                            <button type="submit" class="btn mouse-dir white-bg">Edit Quiz<span class="dir-part"></span></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        @if($errors->has('question') || $errors->has('answer') || $errors->any())
        var NumberOfQuestions = {{$questionCount}};
        @else
        var NumberOfQuestions = {{$arrayCount}} -1;
        @endif

        function AddQuestion()
        {
            NumberOfQuestions++

            var questionField = document.getElementById("Default-question-input");

            var clone = questionField.cloneNode(true);

            // change clone's id
            clone.setAttribute('id', '');

            // change clone's class
            clone.setAttribute('class', 'question row col-lg-12 col-12 align-items-center')

            // change clone's child element id
            clone.getElementsByTagName('span')[0].id = "Question-" + NumberOfQuestions

            // change clone's child element input name
            clone.getElementsByTagName('input')[0].name = "question[" + NumberOfQuestions + "]"

            clone.getElementsByTagName('input')[1].name = "answer[" + NumberOfQuestions + "]"

            document.getElementById("Questions").appendChild(clone);

            // Change element text
            var questionSpan = document.getElementById("Question-" + NumberOfQuestions);
            questionSpan.innerText = ""+NumberOfQuestions+"";
        }
    </script>
@endsection
