@foreach ($potentialFollowers as $potentialFollower)
    <form method="post" action="follow">
        @csrf
        <input type="hidden" name="user_id" value="{{ $potentialFollower->id }}" />
        <div class="potential-follower">
            <div class="row">
                <div class="col-md-2">
                    <img src="images/tweet-profile-icon.png" style="width: 35px; border-radius: 20px;" />
                </div>
                <div class="col-md-5">
                    <a href="/user/{{ $potentialFollower->id }}">{{ $potentialFollower->name }}</a>
                </div>
                <div class="col-md-5 align-right">
                    <button class="btn btn-sm btn-twitter">Follow</button>
                </div>
            </div>
        </div>
    </form>
@endforeach
