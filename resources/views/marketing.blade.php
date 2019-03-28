<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
        <link rel="icon" href="images/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.css">


        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/twitter-marketing.css') }}" rel="stylesheet">

    </head>

    <body>
        <div id="app">

            <header>
                <div class="row">
                    <div class="col-xs-10 col-md-10 headline">
                        <img src="{{ asset('images/maga.gif') }}" />&nbsp; <span class="headline-text"> Tweeter - The future of social media</span>
                    </div>
                </div>

            </header>
            <div class="fold"></div>
            <div class="bird-fold"></div>

            <div class="say-hello">
                {{-- <h1>Hello everyone</h1> --}}
            </div>

            <div class="brag">
                <h2 class="headline-text">
                    So you think you can Tweet huh??
                </h2>

                <h2 class="tlt">OLD TWITTER IS DEAD</h2>

                <div class="container">
                    <p class="typed">

                    </p>
                </div>

            </div>
<br /><br /><br /><br />
        </div>
        <script src="https://unpkg.com/scrollreveal@4"></script>


        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.9"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/textillate/0.4.0/jquery.textillate.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/lettering.js/0.6.1/jquery.lettering.min.js"></script>


    	<script>
    		ScrollReveal().reveal('.headline-text', { delay: 2000 ,  rotate: {x: 20, y: 100, z: 0, }, duration: 2000});
    		ScrollReveal().reveal('.typed', { delay: 500 ,  rotate: {x: 120, y: 80, z: 0, }, duration: 7000});
    		ScrollReveal().reveal('.headline', { delay: 1000 , duration: 1000});
            ScrollReveal().reveal('.say-hello', { delay: 1000 });

            var typed = new Typed('.typed', {
              strings: ["", "Well let me tell you something. Twitter is no more and the best thing out there is Tweeter. Twitter is an American online news and social networking service on which users post and interact with messages known as 'tweets'. Tweets were originally restricted to 140 characters, but on November 7, 2017, this limit was doubled for all languages except Chinese, Japanese, and Korean. "],
              typeSpeed: 20
            });

            $(function () {
            	$('.tlt').textillate();
                $('.tlt').textillate({
                    in: {
                      	// set the effect name
                        effect: 'hinge',

                        // set the delay factor applied to each consecutive character
                        delayScale: 1.5,

                        // set the delay between each character
                        delay: 100,

                        // set to true to animate all the characters at the same time
                        sync: false,

                        // randomize the character sequence
                        // (note that shuffle doesn't make sense with sync = true)
                        shuffle: false,

                        // reverse the character sequence
                        // (note that reverse doesn't make sense with sync = true)
                        reverse: false,

                        // callback that executes once the animation has finished
                        callback: function () {}
                      },

                      // out animation settings.
                        out: {
                         effect: 'hinge',
                         delayScale: 1.5,
                         delay: 50,
                         sync: false,
                         shuffle: false,
                         reverse: false,
                         callback: function () {}
                       }
                  });
            });

    	</script>

    </body>
</html>
