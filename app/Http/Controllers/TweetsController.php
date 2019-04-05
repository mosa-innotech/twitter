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
use App\Http\Resources\Comment as CommentResource;


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

        $tweets = Tweet::orderBy('created_at', 'desc')->limit(30)->get();
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

        return view('home', compact('tweets', 'potentialFollowers', 'sitename', 'user'));

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

    public function getTweetsByNumber(Request $request, $number){
        $tweets = Tweet::limit($number)->orderBy('id', 'DESC')->get();
        $tweetsExtended = [];

        $tweetLike = new Tweetlike;
        foreach ($tweets as $tweet) {
            $tweetId = $tweet["id"];
            $tweetLikes = Tweetlike::limit(1)->where("tweet_id", "=", $tweetId)->where("user_id", "=", $request->user_id)->orderBy('id', 'DESC')->get();
            $likedByUser = 0;
            if(isset($tweetLikes[0]["like"])){
                $likedByUser = $tweetLikes[0]["like"];
            }
            $tweet["liked_by_user"] = $likedByUser;
            $totalTweetsCount = Tweetlike::distinct('user_id')->where("tweet_id", "=", $tweetId)->where("like", "=", "1")->get();
            $tweet["number_of_likes"] = count($totalTweetsCount);

            $tweetsExtended[] = $tweet;
        }

        $tweets = $tweetsExtended;
        return new TweetResource($tweets);
    }

    public function getTweetsByNumberFromStartPoint(Request $request, $number, $id){
        $tweets = Tweet::limit($number)->where("id", "<", $id)->orderBy('id', 'DESC')->get();
        $tweetsExtended = [];

        $tweetLike = new Tweetlike;
        foreach ($tweets as $tweet) {
            $tweetId = $tweet["id"];
            $tweetLikes = Tweetlike::limit(1)->where("tweet_id", "=", $tweetId)->where("user_id", "=", $request->user_id)->orderBy('id', 'DESC')->get();
            $likedByUser = 0;
            if(isset($tweetLikes[0]["like"])){
                $likedByUser = $tweetLikes[0]["like"];
            }
            $tweet["liked_by_user"] = $likedByUser;
            $totalTweetsCount = Tweetlike::distinct('user_id')->
            where("tweet_id", "=", $tweetId)->where("like", "=", "1")->get();
            $tweet["number_of_likes"] = count($totalTweetsCount);
            $tweetsExtended[] = $tweet;
        }

        $tweets = $tweetsExtended;
        return new TweetResource($tweets);
    }

   public function likeTweetViaApi(Request $request){
       $tweetLike = new Tweetlike;

        $previousTweetLike = Tweetlike::limit(1)->where("user_id", "=", $request->user_id)->where("tweet_id", "=", $request->tweet_id)->orderBy('id', 'DESC')->get();
        if(count($previousTweetLike) == 0){
            $tweetLike->user_id = $request->user_id;
            $tweetLike->tweet_id = $request->tweet_id;
            $tweetLike->like = $request->like;

            if($tweetLike->save()){
                return '{"success": "1"}';
            }

            else{
                return '{"success": "0"}';
            }
        }
        else{
            $tweetLikeId = $previousTweetLike[0]["id"];
            $previousTweetLike = TweetLike::find($tweetLikeId);
            $previousTweetLike->like = $request->like;
            $previousTweetLike->save();
            return '{"success": "1"}';
        }
   }

   public function getTweetComments($tweetId){
       $comments = Comment::where("tweet_id", "=", $tweetId)->get();
       return new CommentResource($comments);
   }


   public function newCommentViaApi(Request $request){
       $comment = new Comment;
       $comment->user_id = $request->user_id;
       $comment->tweet_id = $request->tweet_id;
       $comment->comment = $request->comment;
       if($request->comment){
           $comment->save();
           return '{"success": "1"}';
       }
       else{
           return '{"success": "0"}';
       }
   }

}
