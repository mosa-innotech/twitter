<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Follower;
use App\Tweet;
use Auth;
use App\Http\Resources\User as UserResource;

class UsersController extends Controller
{

    public function index($id){
        $user = new User();
        $potentialFollowers = $users = $user->get();
        $user = $user->find($id);

        $tweet = new Tweet;
        $tweets = $tweet->where("user_id" , $id)->get();


        $tweetsCollection = array();
        foreach($tweets as $tweet){
            $newTweet = $tweet;
            $comments = Tweet::find($tweet->id)->comments;
            $newTweet['comments'] = $comments;
            $tweetsCollection[] = $newTweet;
        }

        $tweets = $tweetsCollection;

        return view('userprofile', compact('user', 'potentialFollowers', 'tweets'));

    }


    public function follow(Request $request){
            $user = Auth::user();
            $follower = new Follower;
            $follower->user_id = $user->id;
            $follower->follower_id = $request->user_id;
            $follower->following = 1;
            $follower->save();
            return redirect('home');
    }


    public function editProfileDisplay(){
        $currentUser =  Auth::user();
        $currentUserId =  $currentUser->id;
        $user = new User();
        $user = $user->find($currentUserId);

        return view('editprofile', compact('user'));
    }


    public function editProfile(Request $request){
            $currentUser = Auth::user();

            $user = new User;
            $currentUserId =  $currentUser->id;
            $user = $user->find($currentUserId);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->telephone = $request->telephone;
            $user->gender = $request->gender;
            $user->save();
            return redirect('home');
    }


    public function getAllUsers(){
        $users = User::get();
        return new UserResource($users);
    }



}
