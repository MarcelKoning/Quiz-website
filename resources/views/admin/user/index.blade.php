@extends('layout.admin')

@section('content')


    <div class="container card-row-section">
        <div class="quiz-head">
            <h1>Users</h1>
            <a class="btn btn-primary" href="{{ route('adminUserCreate') }}">Add User <i class="fa-solid fa-plus"></i></a>
        </div>
        <div class="quiz-head">
            <form class="d-flex navbar-search col-4" method="get" action="{{ route('adminUser') }}">
                <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
        <div class="row card-row">
            @foreach( $users as $user)
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $user->username }}</h5>
                            <p class="card-text">{{ $user->email }}</p>
                            <a href="{{ route('adminUserShow', $user) }}" class="btn btn-primary">View User</a>
                            <a href="{{ route('adminUserEdit', $user) }}" class="btn btn-primary">Edit User</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
