<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Comment;
use App\Tweet;
use App\Tweetlike;
use App\User;
use App\UserDetails;
use App\Follower;
use Auth;
use App\Http\Resources\Tweet as TweetResource;


class TweetsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->middleware('auth');
        $users = new User;
        $potentialFollowers = $users = $users->get();
        $user = Auth::user();
        $follower = new Follower;
        $followers = $follower->where("user_id" , $user->id)->where("following" , 1)->get(array('id'))->toArray();
        $tweet = new Tweet;

        // $potentialFollowers = $users->whereIn("id" , $followers)->get();
        //$tweets = $tweet->whereIn("user_id", $followers)->get();

        $tweets = Tweet::orderBy('created_at', 'desc')->get();
        $tweetsCollection = array();

        foreach($tweets as $tweet){
            $newTweet = $tweet;
            $newTweet['comments'] =  Tweet::find($tweet->id)->comments;

            $newTweet['liked'] = false;
            $tweetLike = \DB::table('Tweetlikes')->where('user_id', $user->id)
            ->where('tweet_id', $tweet->id)->orderBy('created_at', 'DESC')->first();
            if(isset($tweetLike->like) && ($tweetLike->like == "1")){
                $newTweet['liked'] = true;
            }
            //$tweeter = User::find($tweet->user_id);
            //var_dump(Tweet::find($tweet->id)->user);

            $newTweet['user'] = Tweet::find($tweet->id)->user;


            if($user->id == $tweet->user_id){
                $newTweet['has_permissions'] = 1;
            }
            $tweetsCollection[] = $newTweet;
        }

        $tweets = $tweetsCollection;

        return view('home', compact('tweets', 'potentialFollowers', 'sitename'));

    }

    public function saveTweet(Request $request){
        $this->middleware('auth');
        $user = Auth::user();
        $tweet = new Tweet;
        $tweet->user_id = $user->id;
        $tweet->tweet = $request->tweet;
        $tweet->save();
        return redirect('home');
    }

    public function saveComment(Request $request){
        $user = Auth::user();
        $comment = new Comment;
        $comment->user_id = $user->id;
        $comment->tweet_id = $request->tweet_id;
        $comment->comment = $request->comment;
        $comment->save();
        return redirect('home');
    }

    public function deleteTweet(Request $request){

        $tweet = Tweet::find($request->tweet_id);
        if($tweet){
            Tweet::destroy($request->tweet_id);
        }
        return redirect('home');
    }

    public function editTweet(Request $request){
        $tweet = Tweet::find($request->tweet_id);
        $tweet->tweet = $request->tweet;
        $tweet->save();
        return redirect('homepage');
    }

   public function editTweetDisplay($id)
   {
       $tweet = Tweet::find($id);
       return view('editTweet', compact('tweet'));
   }

   public function likeTweet(Request $request){
       $user = Auth::user();
       $tweetLike = new Tweetlike;
       $tweetLike->user_id = $user->id;
       $tweetLike->tweet_id = $request->tweet_id;
       $tweetLike->like = $request->like;
       $tweetLike->save();
       return redirect('home');
   }

    public function getAllTweets(){
        $tweets = Tweet::get();
        return new TweetResource($tweets);
    }

    public function getTweetsByNumber($number){
        $tweets = Tweet::limit($number)->get();
        return new TweetResource($tweets);
    }

}
