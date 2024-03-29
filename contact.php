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
          <a href="mailto:gongchuo.lu@gmail.com.NOSPAM">
            gongchuo.lu@gmail.com.NOSPAM</a>;
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
          leave me a message.  Please notice that in order to use the
          message board, you have to <a href="msgbrd/register.html"
          target="_blank">register</a> first.  If you have already
          registered and wish to modify your password or email, please
          click <a href="msgbrd/modify.html" target="_blank">here</a>.
        </p>
        <div id="msgbrd">
          <h2>My Message Board</h2>
          <a href="#" class="unfold">Post a New Subject</a>
          <div class="foldable">
            <form>
              <input type="hidden" name="prnt_id" value="0" />
              Subject: <input type="text" name="subject"
                              maxlength="63" size="63" />
              <br />
              <textarea name="msg_txt"
                        cols=80 rows=10>Enter your message here...</textarea>
              <br />
              Name: <input type="text" name="name" maxlength="31" />&nbsp;
              Password: <input type="password" name="passwd" />&nbsp;
              <button type='button' class='post'>Post Subject</button>
            </form>
            <span class="sent"></span>
          </div>
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
