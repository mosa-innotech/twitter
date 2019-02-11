<div class="row">
    <div class="col-xs-12 col-md-12">

        @foreach ($tweet->comments as $comment)
            <div class="single-comment">
                {{ $comment->comment }}<br />
                by - {{ $comment->user_id }}
                <br />
            </div>
        @endforeach
    </div>
</div>

<div class="row">
    <div class="col-xs-2 col-md-2">
        <div class="images-container">
            <img class="profile-icon" src="images/tweet-profile-icon.png" alt="profile" />
        </div>
    </div>
    <div class="col-xs-9 col-md-10">
        <form name="comment-form" method="post" action="/comment">
            @csrf
            <textarea name="comment" class="form-control" placeholder="Comment here"></textarea>
            <br />
            <input type="hidden" name="tweet_id" value="{{  $tweet->id }}" />
            <div class="align-right">
                <button class="btn btn-twitter btn-sm align-right">Comment</button>
            </div>
        </form>
    </div>
</div>
