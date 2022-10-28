@extends('layout.user')

@section('content')
    <section class="container card-row-section">
        <div class="quiz-head">
            <h1>Quizzes</h1>
            <a class="btn btn-primary" href="{{ route('userCreateQuiz') }}">Add Quiz <i class="fa-solid fa-plus"></i></a>
        </div>
        <form class="d-flex navbar-search col-5" method="get" action="{{ route('userQuiz') }}">
            <div class="row">
                <div class="col-md-6">
                    <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                </div>
                <div class="col-md-6 quizValue">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </div>
                <?php $count = 0;?>
                <span class="quizText">Categories</span>
                @foreach($quizCategories as $quizCategory)
                    <div class="col-md-4">
                        <span>{{ $quizCategory->name }}</span>
                        <input type="radio" name="category" value="{{ $quizCategory->id }}"/>
                    </div>
                    <?php $count++ ?>
                @endforeach

            </div>
        </form>
        <br/>
        <div class="container mt-5">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Category</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $quizzes as $quiz)
                    <tr>
                        <td>{{ $quiz->name }}</td>
                        <td>{{ $quiz->description }}</td>
                        <td>{{ $quiz->category->name }}</td>
                        <td><a href="{{ route('userEditQuiz', $quiz) }}"><i class="fa-solid fa-pen-to-square"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="d-flex">
                {!! $quizzes->links() !!}
            </div>
        </div>
    </section>
@endsection
