
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('tweet-component', require('./components/TweetComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

lastTweet = 0;
const sdsdsdsd = new Vue({
   el: '#tweetsWrapper',
   data() {
       return{
            tweets: [],
            lastTweet: 0,
            tweetsObjectArray: {}
       }

   },

   methods: {
       updateTweets(){
           axios.get("/api/tweetsbynumber/3")
               .then((response) => {
                   for (var i = 0; i < (response.data.data).length; i++) {
                       this.tweets.push(response.data.data[i]);
                       lastTweet = response.data.data[i].id;

                       
                   }
           });

           console.log(this.tweetsObjectArray);
       },

       scroll(tweets){
           window.onscroll = () => {
               if ((window.innerHeight + window.scrollY) >= (document.body.offsetHeight -0.5)) {

                   axios.get("/api/tweetsbynumberfromlast/3/" + lastTweet)
                       .then((response) => {
                           for (var i = 0; i < (response.data.data).length; i++) {

                               this.tweets.push(response.data.data[i]);
                                lastTweet = response.data.data[i].id;
                           }
                   });
               }
           };

       }
   },

       mounted(){
           this.updateTweets(this.tweets);
           this.scroll();
       }
});
