<!DOCTYPE html>
<html>

  <head>
    <meta name="author" content="Gongchuo Lu">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="happy-cosmos.css">
    <script src="blog.js"></script>
    <title>Blog - Happy Cosmos</title>
  </head>

  <body onload="showRSS('Blogger', '3')">
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
        <div class="menu-button_activated">Blog</div>
        <div class="menu-button">
          <a href="contact.html">Contact</a>
        </div>
      </div>
      <div id="content">
        <form>
          <table>
            <tr>
              <td>Select a source:</td>
              <td>
                <select name="source"
                        onchange="showRSS(this.value, num.value)">
                  <?php require "selectblog.php"; ?>
                </select>
              </td>
            </tr>
            <tr>
              <td>Number of posts to view:</td>
              <td>
                <select name="num"
                        onchange="showRSS(source.value, this.value)">
                  <option value="2">2</option>
                  <option value="3" selected="selected">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
              </td>
            </tr>
          </table>
        </form>
        <div id="rssOutput"></div>
      </div>
      <div id="footer">
        <hr>
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
