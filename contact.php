<!DOCTYPE html>
<html>

  <head>
    <meta name="author" content="Gongchuo Lu">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="happy-cosmos.css">
    <?php require_once('msgbrd/config-msgbrd.php'); ?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js">
    </script>
    <script src="msgbrd/msgbrd.js"></script>
    <title>Contact - Happy Cosmos</title>
  </head>

  <body>
    <div id="container">
      <div>
        <h1>Happy Cosmos</h1>
        Gongchuo's Personal Website
      </div>
      <div id="menu">
        <div class="menu-button">
          <a href="index.html">About</a>
        </div>
        <div class="menu-button">
          <a href="work.html">Work</a>
        </div>
        <div class="menu-button">
          <a href="blog.php">Blog</a>
        </div>
        <div class="menu-button_activated">Contact</div>
      </div>
      <div id="content">
        <p>
          <span class="sc">Please feel free</span> to contact me via
          my email
          <a href="mailto:gongchuo.lu@gmail.com">gongchuo.lu@gmail.com</a>;
          I will get back to you as soon as possible.
        </p>
        <p>
          You can also find me on
          <a href="http://www.linkedin.com/pub/gongchuo-lu/1b/b25/23b/"
             target="_blank">
            LinkedIn
          </a>
          and
          <a href="https://github.com/Yuhta/" target="_blank">
            GitHub
          </a>
          for more details about my professional information and
          projects.
        </p>
        <p>
          Or, if you prefer, you can use the message board below to
          leave me a message.
        </p>
        <div id="msgbrd">
          <h2>My Message Board</h2>
          <!-- <span class="comment_sent"></span> -->
          <?php retrieve_messages(); ?>
        </div>
      </div>
      <div id="footer">
        <hr />
        &copy; 2012 by Gongchuo Lu
        <a href="http://jigsaw.w3.org/css-validator/check/referer"
           target="_blank"
           style="float:right;">
          <img style="border:0;width:88px;height:31px;"
               src="http://jigsaw.w3.org/css-validator/images/vcss-blue"
               alt="Valid CSS!">
        </a>
      </div>
    </div>
  </body>

</html>
