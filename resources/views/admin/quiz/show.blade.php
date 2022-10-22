@extends('layout.index')

@section('content')
    <section id="contact-us" class="contact-us section">
        <div class="container">
            <h1>Quiz</h1>
            <div class="contact-head wow fadeInUp" data-wow-delay=".4s"
                 style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="form-main">
                            <div class="row">
                                <div class="col-lg-6 col-6">
                                    <div class="form-group quizValue">
                                        <span class="quizText">Quiz Name: </span>
                                        <span>{{ $quiz->name }}</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group message quizValue">
                                        <span class="quizText">Quiz Type: </span>
                                        <span>{{ $quizType[0]->name }}</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group message quizValue">
                                        <span class="quizText">Hint Heading: </span>
                                        <span>{{ $quiz->h_name }}</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group message quizValue">
                                        <span class="quizText">Answer Heading: </span>
                                        <span>{{ $quiz->correct_answer }}</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group message quizValue">
                                        <span class="quizText">Timer: </span>
                                        <span>{{ $quiz->timer }} minutes</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group message quizValue">
                                        <span class="quizText">Category: </span>
                                        <span>{{ $quizCategory[0]->name }}</span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group message quizValue">
                                        <span class="quizText">Description: </span>
                                        <span>{{ $quiz->description }}</span>
                                    </div>
                                </div>
                                <div id="Questions" class="form-group col-12">
                                    <div class="question row col-lg-12 col-12 align-items-center">
                                        <div class="form-group col-1 number">
                                            <span></span>
                                        </div>
                                        <div class="form-group col-5 quizText">
                                            <span>Questions:</span>
                                        </div>
                                        <div class="form-group col-5 quizText">
                                            Answers:
                                        </div>
                                    </div>
                                    <?php
                                    $questionCount = 1;
                                    $answerCount = 1;
                                    $arrayCount = 1;
                                    ?>
                                    @foreach($questions as $question)
                                        <div class="question row col-lg-12 col-12 align-items-center @if($arrayCount % 2 == 0) oddRow @endif">
                                            <div class="form-group col-1 number">
                                                <span id="Question-1">{{ $arrayCount }}</span>
                                            </div>
                                            <div class="form-group col-5">
                                                <span>{{ $question->question }}</span>
                                            </div>
                                            <div class="form-group col-5">
                                                <span>{{ $question->correct_answer }}</span>
                                            </div>
                                        </div>
                                        <?php $arrayCount++; ?>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
