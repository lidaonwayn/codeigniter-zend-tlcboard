<?php /* Smarty version Smarty-3.0.7, created on 2011-04-19 03:28:45
         compiled from "application/views/test/facebook_connect.tpl" */ ?>
<?php /*%%SmartyHeaderCode:214014dad016d0d8854-13107598%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ee0992c40dac00a093d27472c57bb9a693775023' => 
    array (
      0 => 'application/views/test/facebook_connect.tpl',
      1 => 1302454467,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '214014dad016d0d8854-13107598',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
    <head>
        <title>My Bugdevelopers :: facebook integration</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
    </head>
    <body>
        <div id="fb-root"></div>
        <script>
            
          window.fbAsyncInit = function() {
            FB.init({
              appId   : '<?php echo $_smarty_tpl->getVariable('appID')->value;?>
',
              session : <?php echo $_smarty_tpl->getVariable('json_sess')->value;?>
,
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
              
        </script>

        <fb:login-button autologoutlink="true"></fb:login-button>
           <?php if ($_smarty_tpl->getVariable('json_sess')->value!='null'){?>
            <pre>
               <?php echo print_r($_smarty_tpl->getVariable('users')->value);?>

            </pre>
           <?php }?>
 
</html>
