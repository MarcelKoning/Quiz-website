@extends('layout.index')

@section('content')
    <section id="contact-us" class="contact-us section">
        <div class="container">
            <h1>Create Quiz</h1>
            <div class="contact-head wow fadeInUp" data-wow-delay=".4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="form-main">
                            <form class="form" method="post" action="{{route('quizStore')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-6">
                                        <div class="form-group">
                                            <input name="name" type="text" placeholder="Quiz Name" required="required">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group message">
                                            <input name="type" placeholder="type of quiz (typing or clicking)" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group message">
                                            <input name="h_name" placeholder="(table) header name" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group message">
                                            <input name="h_value" placeholder="(table) header value" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group message">
                                            <input name="timer" placeholder="timer (in minutes)" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group message">
                                            <textarea name="description" placeholder="Description"></textarea>
                                        </div>
                                    </div>
                                    <div id="Questions" class="form-group col-12">
                                        <div id="Default-question-input" class="question row col-lg-12 col-12 align-items-center d-none">
                                            <div class="form-group col-1">
                                                <span id="Question-0">1</span>
                                            </div>
                                            <div class="form-group col-6">
                                                <input name="test" type="text" placeholder="Question">
                                            </div>
                                            <div class="form-group col-5">
                                                <input name="test1" type="text" placeholder="Answer">
                                            </div>
                                        </div>
                                        <div class="question row col-lg-12 col-12 align-items-center">
                                            <div class="form-group col-1">
                                                <span id="Question-1">1</span>
                                            </div>
                                            <div class="form-group col-6">
                                                <input name="question[1]" type="text" placeholder="Question" required="required">
                                            </div>
                                            <div class="form-group col-5">
                                                <input name="answer[1]" type="text" placeholder="Answer" required="required">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group question col-lg-12 col-12">
                                        <button type="button" class="btn btn-primary" onclick="AddQuestion()">Add Question <i class="fa-solid fa-plus"></i></button>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group contacts-button button contact-button">
                                            <button type="submit" class="btn mouse-dir white-bg">Add Quiz<span class="dir-part"></span></button>
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
        var NumberOfQuestions = 1;

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
