<script type="text/javascript" src="http://connect.facebook.net/es_LA/all.js"></script>
<script type="text/javascript">
<!--
FB.init({ appId: '214990375184904', status: true, cookie: true, xfbml: true });

FB.Event.subscribe('auth.login', function() {
    window.location.reload();
});

FB.Event.subscribe('auth.logout', function() {
    window.location.reload();
});
//-->
</script>

    <div class="profile">
      <?php if(!$fb_me): ?>
      <img src="assets/main/images/unknown_user.gif" alt="" class="pic" />
      <p>Hello! Please login with your FB account!</p>
      <fb:login-button perms="email"></fb:login-button>
      <?php else: ?>
      <img src="https://graph.facebook.com/<?php echo $fb_uid; ?>/picture" alt="" class="pic" />
      <p><?php echo $fb_me['name']; ?><br />
        <a href="profile/<?php echo $fb_uid; ?>" style="text-decoration:underline">My Profile</a>
        | <a href="" onclick="FB.logout();" style="text-decoration:underline">Logout</a></p>
      <?php endif; ?>
    </div>