<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweetlike extends Model
{
    protected $fillable = ['user_id', 'tweet_id', 'like'];

}
