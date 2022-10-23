@extends('layout.index')

@section('content')
    <section id="contact-us" class="contact-us section">
        <div class="container">
            <h1>Register</h1>
            <div class="contact-head wow fadeInUp" data-wow-delay=".4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="form-main">
                            <form class="form" method="post" action="{{route('userStore')}}" autocomplete="off">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-6">
                                        <div class="form-group">
                                            <span>Username </span>@error('username')<span class="error">({{$message}})</span>@enderror
                                            <input name="username" type="text" placeholder="Username" required="required" value="{{ old('username') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-6">
                                        <div class="form-group message">
                                            <span>Email </span>@error('email')<span class="error">({{$message}})</span>@enderror
                                            <input type="text" name="email" placeholder="Email" value="{{ old('email') }}"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-6">
                                        <div class="form-group message">
                                            <span>Password </span>@error('password')<span class="error">({{$message}})</span>@enderror
                                            <input type="password" name="password" placeholder="password" autocomplete="new-password" value="{{ old('password') }}"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-6">
                                        <div class="form-group message">
                                            <span>Confirm password </span>
                                            <input type="password" name="password_confirmation" placeholder="Confirm password" autocomplete="new-password" value="{{ old('password_confirmation') }}"/>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group contacts-button button contact-button">
                                            <button type="submit" class="btn mouse-dir white-bg">Register<span class="dir-part"></span></button>
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

