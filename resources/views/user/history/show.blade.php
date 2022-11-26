@extends('layout.user')

@section('content')
    <div>
        @foreach( $userRooms as $userRoom)
            <span>{{ $userRoom->room->quiz->name }}</span>
            <br/>
            <span>{{ $userRoom->room->quiz->category->name }}</span>
            <br/>
            <span>{{ $userRoom->score }}</span>
            <br/>
            <span>{{ gmdate("i:s", $userRoom->time)  }}</span>
            <br/>
        @endforeach
    </div>
@endsection
