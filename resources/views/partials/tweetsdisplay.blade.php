@foreach ($tweets as $tweet)
<div class="row">
    <div class="col-xs-12 col-md-12">
        <div class="tweet">
            {{ $tweet->tweet }}
            <br />
            <div class="user align-right">
                - {{  $tweet->user_id }} @ {{  $tweet->created_at }}


                @php
                if(isset( $tweet->can_delete)){
                    @endphp

                        <form name="delete-form" method="post" action="/delete-tweet">
                            @csrf
                            <input type="hidden" name="_method"  value="DELETE"/>
                            <input type="hidden" name="tweet_id" value="{{ $tweet->id }}" />
                            <button class="btn btn-sm  btn-twitter">Delete</button>
                        </form>

                        <br /><br />
                    @php
                }
                @endphp

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
