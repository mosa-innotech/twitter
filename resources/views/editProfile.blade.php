@extends('layouts.twitter-main')

@section('isactivepage')
    active
@endsection

@section('content')
<div class="container">
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
                                <form id="edit-profile-form" name="tweet-form" method="post" action="/edit-profile">
                                @csrf
                                <div class="row">
                                    <div class="col-xs-4 col-md-3 align-right">
                                        First Name:
                                    </div>
                                    <div class="col-xs-8 col-md-9">
                                        <input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}" required />
                                    </div>
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col-xs-4 col-md-3 align-right">
                                        Last Name:
                                    </div>
                                    <div class="col-xs-8 col-md-9">
                                        <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}" required />
                                    </div>
                                </div>
                                <br />

                                <div class="row">
                                    <div class="col-xs-4 col-md-3 align-right">
                                        Email:
                                    </div>
                                    <div class="col-xs-8 col-md-9">
                                        <input type="text" class="form-control" name="email" value="{{ $user->email }}" required />
                                    </div>
                                </div>
                                <br />

                                <div class="row">
                                    <div class="col-xs-4 col-md-3 align-right">
                                        Telephone:
                                    </div>
                                    <div class="col-xs-8 col-md-9">
                                        <input type="text" class="form-control" name="telephone" value="{{ $user->telephone }}" required />
                                    </div>
                                </div>
                                <br />

                                <div class="row">
                                    <div class="col-xs-4 col-md-3 align-right">
                                        Gender:
                                    </div>
                                    <div class="col-xs-8 col-md-9">
                                        <input type="text" class="form-control" name="gender" value="{{ $user->gender }}" required maxlength="1" />
                                    </div>
                                </div>
                                <br />
                                <div class="align-right">
                                    <button class="btn btn-twitter btn align-right"
                                    style="background-color: #1da1f2; color:white;">Edit Profile</button>
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
