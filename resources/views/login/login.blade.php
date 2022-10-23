@extends('layout.index')

@section('content')
    <section id="contact-us" class="contact-us section">
        <div class="container">
            <h1>Login</h1>
            <div class="contact-head wow fadeInUp" data-wow-delay=".4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="form-main">
                            <form class="form" method="post" action="{{route('userLogin')}}" autocomplete="off">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-6">
                                        <div class="form-group message">
                                            <span>Email </span>@error('email')<span class="error">({{$message}})</span>@enderror
                                            <input type="text" name="email" placeholder="Email" value="{{ old('email') }}"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-6">
                                        <div class="form-group message">
                                            <span>Password </span>@error('password')<span class="error">({{$message}})</span>@enderror
                                            <input type="password" name="password" placeholder="password" autocomplete="new-password"/>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group contacts-button button contact-button">
                                            <button type="submit" class="btn mouse-dir white-bg">Login<span class="dir-part"></span></button>
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

