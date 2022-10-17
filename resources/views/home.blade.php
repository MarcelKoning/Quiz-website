@extends('layout.index')


@section('content')
    <section class="container card-row-section">
        <h1>Quizzes</h1>
        <form class="d-flex navbar-search col-4" method="get" action="{{ route('home') }}">
            <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        <br />
        <div class="quiz-list">
            <div class="row card-row">
                @foreach( $quizzes as $quiz)
                    <div class="col-sm-6 col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $quiz->name }}</h5>
                                <p class="card-text">{{ $quiz->description }}</p>
                                <a href="{{route('playQuiz', [$quiz->name, $quiz])}}" class="btn btn-primary">Play Quiz</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
