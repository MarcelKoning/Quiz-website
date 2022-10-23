@extends('layout.index')

@section('content')
    <section class="container card-row-section">
        <h1>Quizzes</h1>
        <form class="d-flex navbar-search col-4" method="get" action="{{ route('quiz') }}">
            <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
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
