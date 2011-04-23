<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
    <head>
        <title>My Bugdevelopers :: facebook integration</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
    </head>
    <body>
        <div id="fb-root"></div>
        <script>
            {literal}
          window.fbAsyncInit = function() {
            FB.init({
              appId   : '{/literal}{$appID}{literal}',
              session : {/literal}{$json_sess}{literal},
              status  : true,
              cookie  : true,
              xfbml   : true
            });

            FB.Event.subscribe('auth.login', function() {
              window.location.reload();
            });
          };

          (function() {
            var e = document.createElement('script');
            e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
            e.async = true;
            document.getElementById('fb-root').appendChild(e);
          }());
              {/literal}
        </script>

        <fb:login-button autologoutlink="true"></fb:login-button>
           {if  $json_sess != 'null'}
            <pre>
               {$users|print_r}
            </pre>
           {/if}
 
</html>
