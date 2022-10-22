@extends('layout.index')

@section('content')


    <div class="container card-row-section">
        <div class="quiz-head">
            <h1>Quizzes</h1>
            <a class="btn btn-primary" href="{{ route('quizCreate') }}">Add Quiz <i class="fa-solid fa-plus"></i></a>
        </div>
        <div class="quiz-head">
            <form class="d-flex navbar-search col-4" method="get" action="{{ route('adminQuiz') }}">
                <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
        <div class="row card-row">
            @foreach( $quizzes as $quiz)
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $quiz->name }}</h5>
                            <p class="card-text">{{ $quiz->description }}</p>
                            <a href="{{ route('quizShow', $quiz) }}" class="btn btn-primary">View Quiz</a>
                            <a href="{{ route('quizEdit', $quiz) }}" class="btn btn-primary">Edit Quiz</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
