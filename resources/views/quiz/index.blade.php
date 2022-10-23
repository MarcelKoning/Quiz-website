@extends('layout.index')

@section('content')
    <section class="container card-row-section">
        <h1>Quizzes</h1>
        <form class="d-flex navbar-search col-5" method="get" action="{{ route('quiz') }}">
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
                </tr>
                </thead>
                <tbody>
                @foreach( $quizzes as $quiz)
                    <tr>
                        <td>{{ $quiz->name }}</td>
                        <td>{{ $quiz->description }}</td>
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
