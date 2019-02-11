@extends('layouts.landing-layout')

@section ('content')
    <div class="row">
        <div class="col-md-6 home-instructions">
            <div class="row">
                <div class="offset-md-3">
                    <h2> Follow your interests.</h2>
                    <h2>Hear what people are talking about.</h2>
                    <h2>Join the conversation.</h2>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class=" home-instructions-right">
                <div class="row top-row">
                    <div class="col-md-3">
                        <img src="images/twitter-logo.png" alt="logo" title="logo"/>
                    </div>
                    <div class="col-md-9">
                        <form method="get" action="login">
                            <button class="btn btn-white" >Login</button>
                        </form>
                    </div>
                </div>


                <h1>See what’s happening in the world right now.</h1>
                <h3>Join Twitter today.</h3>
                <br />
                <form method="get" action="login">
                    <button class="btn btn-white btn-full-width">Login</button>
                </form>

                <form method="get" action="register">
                    <button class="btn btn-white btn-full-width">Signup</button>
                </form>



            </div>
        </div>

    </div>
@endsection

@section('heading-extra')
    - Home
@endsection
