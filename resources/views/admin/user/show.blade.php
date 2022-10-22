@extends('layout.index')

@section('content')
    <section id="contact-us" class="contact-us section">
        <div class="container">
            <h1>User</h1>
            <div class="contact-head wow fadeInUp" data-wow-delay=".4s"
                 style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="form-main">
                            <div class="row">
                                <div class="col-lg-6 col-6">
                                    <div class="form-group quizValue">
                                        <span class="quizText">Username: </span>
                                        <span>{{ $user->username }}</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group message quizValue">
                                        <span class="quizText">User Role: </span>
                                        <span>{{ $user->role->name}}</span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group message quizValue">
                                        <span class="quizText">Hint Heading: </span>
                                        <span>{{ $user->email }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
