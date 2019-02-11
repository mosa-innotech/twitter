<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Comment;
use App\Tweet;
use App\User;
use App\UserDetails;
use App\Follower;
use Auth;

class TweetsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = new User;
        $potentialFollowers = $users = $users->get();
        $user = Auth::user();
        $follower = new Follower;
        $followers = $follower->where("user_id" , $user->id)->where("following" , 1)->get(array('id'))->toArray();
        $tweet = new Tweet;

        // $potentialFollowers = $users->whereIn("id" , $followers)->get();
        //$tweets = $tweet->whereIn("user_id", $followers)->get();

        $tweets = $tweet->get();
        $tweetsCollection = array();

        foreach($tweets as $tweet){
            $newTweet = $tweet;


            $comments = Tweet::find($tweet->id)->comments;





            $newTweet['comments'] = $comments;

            if($user->id == $tweet->user_id){
                $newTweet['can_delete'] = 1;
            }
            $tweetsCollection[] = $newTweet;
        }

        $tweets = $tweetsCollection;

        return view('home', compact('tweets', 'potentialFollowers', 'sitename'));

    }

    public function saveTweet(Request $request){
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
}
