<template>
    <div class="tweet">
        <div class="tweet-content">
            {{ tweet.tweet }}
            <br />
        </div>
        {{ tweet.name }} @ {{ tweet.created_at }} # {{tweet.id}}
        <br /><br />
        <div class="row">
            <div class="col-md-2">
                <!-- <form name="like-form" method="post" action="/like-tweet" class="float-left-section">
                    <input type="hidden" name="tweet_id"  v-model="tweet.id" />
                    <input type="hidden" name="like" value="0" /> -->
                    <button @click="likeTweet" class="btn btn-sm btn-twitter">Unlike</button>
                <!-- </form> -->
            </div>
            <div class="col-md-2">
                <form name="delete-form" method="post" action="/delete-tweet" class="float-left-section">
                    <input type="hidden" name="_method"  value="DELETE"/>
                    <input type="hidden" name="tweet_id" v-model="tweet.id"  />
                    <button class="btn btn-sm  btn-twitter">Delete</button>
                </form>
            </div>
            <div class="col-md-2">

            </div>
        </div>





    </div>
</template>

<script>
    export default {
        mounted() {
            //console.log('Tweet Component mounted.')
        },
        data(){
            return{

            }
        },
        methods: {
            likeTweet(){
                alert(this.tweet.id)
            },

        },
        props: ['tweet']
    }
</script>
<!--
tweet: { 'tweet': 'The Mouses did not wish to offend the Dormouse indignantly. However, he consented to go from here?',
'name': 'Mosa','created_at': '2019-03-28 18:03:06 ' } -->
