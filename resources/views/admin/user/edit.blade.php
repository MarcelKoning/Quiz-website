@extends('layout.admin')

@section('content')
    <section id="contact-us" class="contact-us section">
        <div class="container">
            <h1>Edit User</h1>
            <div class="contact-head wow fadeInUp" data-wow-delay=".4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="form-main">
                            <form class="form" method="post" action="{{route('adminUserUpdate', $user)}}" autocomplete="off">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-6">
                                        <div class="form-group">
                                            <span>Username </span>@error('username')<span class="error">({{$message}})</span>@enderror
                                            <input name="username" type="text" placeholder="Username" required="required" value="{{ old('username', $user->username) }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group message">
                                            <span>User Role </span>@error('role')<span class="error">({{$message}})</span>@enderror
                                            <select name="role" autocomplete="off">
                                                @foreach($roles as $role)
                                                    @if(old('role') == $role->id)
                                                        <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                                                    @elseif($user->role_id == $role->id)
                                                        <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                                                    @else
                                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-12">
                                        <div class="form-group message">
                                            <span>Email </span>@error('email')<span class="error">({{$message}})</span>@enderror
                                            <input type="text" name="email" placeholder="Email" value="{{ old('email', $user->email) }}"/>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group contacts-button button contact-button">
                                            <button type="submit" class="btn mouse-dir white-bg">Edit User<span class="dir-part"></span></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

