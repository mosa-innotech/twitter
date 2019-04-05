<template>
    <div>
        <div class="comment-display">
            
            {{ comment.comment }} <br />
        </div>
        <div class="comment-meta">
            - {{ comment.user_id }} <a href="#">Like</a> <a href="#">Retweet</a>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
        },
        props: ['comment']
    }
</script>
