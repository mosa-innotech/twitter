@foreach ($tweets as $tweet)
<div class="row">
    <div class="col-xs-12 col-md-12">
        <div class="tweet">
            <div class="tweet-content">
                {{ $tweet->tweet }}
            </div>

            <br />
             {{  $tweet->user->name }} @ {{  $tweet->created_at }}
            @php
            if(isset( $tweet->has_permissions)){
                @endphp
                    <a href="/edit-tweet/{{ $tweet->id }}"  class="float-left-section">Edit</a> |

                    @php
                    if(isset( $tweet->liked) && ($tweet->liked==true)){
                    @endphp
                    <form name="like-form" method="post" action="/like-tweet" class="float-left-section">
                        @csrf
                        <input type="hidden" name="tweet_id" value="{{ $tweet->id }}" />
                        <input type="hidden" name="like" value="0" />
                        <button class="btn btn-sm btn-twitter">Unlike</button>
                    </form>

                    @php
                    }
                    else{
                    @endphp
                    <form name="like-form" method="post" action="/like-tweet" class="float-left-section">
                        @csrf
                        <input type="hidden" name="tweet_id" value="{{ $tweet->id }}" />
                        <input type="hidden" name="like" value="1" />
                        <button class="btn btn-sm  btn-twitter">Like</button>
                    </form>

                    @php
                    }
                    @endphp

                    <form name="delete-form" method="post" action="/delete-tweet" class="float-left-section">
                        @csrf
                        <input type="hidden" name="_method"  value="DELETE"/>
                        <input type="hidden" name="tweet_id" value="{{ $tweet->id }}" />
                        <button class="btn btn-sm  btn-twitter">Delete</button>
                    </form>
                    <br /><br />
                @php
            }
            @endphp

            <br />
            <div class="user align-right">
                <div class="row">
                    <div class="col-md-11 offset-md-1">
                        @include('partials.commentsdisplay')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
