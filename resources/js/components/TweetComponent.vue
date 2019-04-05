<template>

    <div class="tweet">
        <div class="tweet-content">
            {{ tweet.tweet }}
        </div>
        <br />
        by {{ tweet.user_id }} @ {{ tweet.created_at }}
        <br />
        <img src="/images/like.png" :class="{ 'displaying' : likeActive }"  class="likeUnlikeBtn" @click="likeTweet(tweet.id)"/>
        <img src="/images/unlike.png" :class="{ 'displaying' : unlikeActive }" class="likeUnlikeBtn" @click="unlikeTweet(tweet.id)"/>
        No of likes: {{tweet.number_of_likes}}

        <br /><br />
        <div class="user align-right">
            <div class="row">
                <div class="col-md-11 offset-md-1">

                    <comments-component  :tweetId="tweet.id"></comments-component>

                    <br />
                    <div class="row">
                        <div class="col-xs-2 col-md-2">
                            <div class="images-container">
                                <img class="profile-icon" src="images/tweet-profile-icon.png" alt="profile" />
                            </div>
                        </div>
                        <div class="col-xs-9 col-md-10">
                            <textarea v-model="newComment" name="comment" class="form-control" placeholder="Comment here"></textarea>
                            <br />
                            <input type="hidden" name="tweet_id" value="" />
                            <div class="align-right">
                                <button @click="makeComment" class="btn btn-twitter btn-sm align-right">Comment</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

     </div>
</template>

<script>
    export default {
        mounted() {
            if(this.tweet.liked_by_user == "1"){
                this.unlikeActive = true;
                this.likeActive = false;
            }
        },
        data() {
            return{
                 tweets: [],
                 likeActive: true,
                 unlikeActive: false,
                 newComment : ""
            }
        },

        methods:{
            makeComment(){
                axios.post('/api/new-comment', {
                    tweet_id: this.tweet.id,
                    user_id: currentLoggedInUserUserId,
                    comment: this.newComment
                  })
                  .then(function (response) {
                    console.log(response);
                  })
                  .catch(function (error) {
                    console.log(error);
                  });
            },

            likeTweet(tweetId){

                this.likeActive = false;
                this.unlikeActive = true;

                this.tweet.number_of_likes++;

                axios.post('/api/like-tweet', {
                    tweet_id: tweetId,
                    like: '1',
                    user_id: currentLoggedInUserUserId
                  })
                  .then(function (response) {
                    console.log(response);
                  })
                  .catch(function (error) {
                    console.log(error);
                  });
            },
            unlikeTweet(tweetId){

                this.likeActive = true;
                this.unlikeActive = false;
                this.tweet.number_of_likes--;
                axios.post('/api/like-tweet', {
                    tweet_id: tweetId,
                    like: '0',
                    user_id: currentLoggedInUserUserId
                  })
                  .then(function (response) {
                    console.log(response);
                  })
                  .catch(function (error) {
                    console.log(error);
                  });
            }
        },
        props: ['tweet']
    }
</script>
