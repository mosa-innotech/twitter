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
                                <form name="tweet-form" method="post" action="/edit-tweet">
                                    @csrf
                                    <textarea name="tweet" class="form-control" placeholder="What's happening?">{{ $tweet->tweet }}</textarea>
                                    <input type="hidden" name="tweet_id" value="{{ $tweet->id }}" />
                                    <br />
                                    <div class="align-right">
                                        <button class="btn btn-twitter align-right">Edit Tweet</button>
                                    </div>
                                </form>
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
