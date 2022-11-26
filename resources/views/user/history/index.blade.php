@extends('layout.user')

@section('content')
    <section class="container card-row-section">
        <div class="quiz-head">
            <h1>Quizzes history</h1>
        </div>
        <form class="d-flex navbar-search col-5" method="get" action="{{ route('userQuizHistory') }}">
            <div class="row">
                <div class="col-md-6">
                    <input class="form-control me-2" name="search" type="search" placeholder="Search"
                           aria-label="Search">
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
                    <th scope="col">Category</th>
                    <th scope="col">Score</th>
                    <th scope="col">Time</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $userRooms as $userRoom)
                    <tr class="clickable-row" data-href="{{ route('userShowQuizHistory', $userRoom) }}" onclick="pageUrl(this)">
                        <td>{{ $userRoom->room->quiz->name }}</td>
                        <td>{{ $userRoom->room->quiz->category->name }}</td>
                        <td>{{ $userRoom->score }}</td>
                        <td>{{ gmdate("i:s", $userRoom->time)  }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="d-flex">
                {!! $userRooms->links() !!}
            </div>
        </div>
    </section>

    <script>
        function pageUrl(element) {
            window.open(element.getAttribute("data-href"), "_self");
        }
    </script>
@endsection
