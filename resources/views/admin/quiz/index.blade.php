@extends('layout.index')

@section('content')


    <div class="container card-row-section">
        <h1>Quizzes</h1><a class="btn btn-primary" href="{{ route('quizCreate') }}">Add Quiz <i class="fa-solid fa-plus"></i></a>
        <div class="row card-row">
            @foreach( $quizzes as $quiz)
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $quiz->name }}</h5>
                            <p class="card-text">{{ $quiz->description }}</p>
                            <a href="#" class="btn btn-primary">View Quiz</a>
                            <a href="#" class="btn btn-primary">Edit Quiz</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
