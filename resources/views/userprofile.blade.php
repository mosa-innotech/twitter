@extends('layouts.twitter-main')

@section('isactivepage')
    active
@endsection

@section('content')
<div class="container">

    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div> --}}

    <div class="row">
        <div class="col-md-4">
            <div style="height: 150px; background-color: #1DA1F2;">

            </div>
            <div style="height: 150px; background-color: #fff; padding: 20px;">
                <h2>Mosa</h2>
                <p>
                    Tweets (0)
                </p>
            </div>
            <div style=" margin-top: 20px; background-color: #fff; padding: 20px;">
                <h2>People to follow</h2>
                @include('partials.potentialfollowers')
            </div>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md -12">

                    <div class="tweet-box">

                    <div class="top-area">
                        <div class="row">
                            <div class="col-xs-2 col-md-2">
                                <div class="images-container">
                                    <img class="profile-icon" src="/images/tweet-profile-icon.png" alt="profile" />

                                </div>
                            </div>
                            <div class="col-xs-9 col-md-10">
                                <h1>Welcome to {{ $user->name }}'s page</h1>
                                <p>
                                    Email: {{ $user->email }}
                                </p>
                                <p>
                                    Registration Date: {{ $user->created_at }}
                                </p>

                            </div>
                        </div>
                    </div>

                    <div class="tweet-view-area">
                        <div class="row">
                            <div class="col-md-12">
                                <h2>{{ $user->name }}'s Tweets</h2>
                                <br /><br />
                                <?php
                                    if(isset($tweets) && ($tweets!==null)){
                                ?>
                                    @include('partials.tweetsdisplay')
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>

                    

                    </div>




                </div>
        </div>
    </div>



    </div>

</div>
@endsection
