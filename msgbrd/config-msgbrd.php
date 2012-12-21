<?php

require('confidential.php');

if ($dbc = mysql_connect(DBHOST, DBUSER, DBPW))
{
  if (!mysql_select_db(DBNAME))
  {
    trigger_error("Could not select the database!<br />MySQL Error:"
                  . mysql_error());
    exit();
  }
}
else
{
  trigger_error("Could not connect to MySQL<br />MySQL Error:"
                . mysql_error());
  exit();
}

function show_msg($msg, $color="red")
{
  echo "<p style='color:$color'>$msg</p>";
}

function escape_data($data)
{
  if (function_exists('mysql_real_escape_string'))
  {
    global $dbc;
    $data = mysql_real_escape_string(trim($data), $dbc);
    $data = strip_tags($data);
  }
  else
  {
    $data = mysql_escape_string(trim($data));
    $data = strip_tags($data);
  }

  return $data;
}

function retrieve_messages()
{
  global $dbc;

  $query = "SELECT `subject`, `msg_txt`, `date`, `prnt_id`, `msg_id`, `name`"
    . " FROM `msgs` ORDER BY `prnt_id`, `date`";
  $result = mysql_query($query) or trigger_error("An error happened");

  if (mysql_affected_rows() > 0)
  {
    $tag_switch = FALSE;
    while ($msgs = mysql_fetch_array($result, MYSQLI_ASSOC))
    {
      $msgs['subject'] = stripslashes($msgs['subject']);
      $msgs['msg_txt'] = stripslashes($msgs['msg_txt']);
      if ($msgs['prnt_id'] == $msgs['msg_id'])
      {
        ($tag_switch) ? print "</div><div class='comment_box'>"
          : print "<div class='comment_box'>";
        $tag_switch = TRUE;
        echo "<h3>{$msgs['subject']}</h3>";
        echo "<p>{$msgs['msg_txt']}</p>";
        echo "<br />by: {$msgs['name']} ";
        echo "<a href='#' class='unfold'>Comments</a>";
        echo "<div class='foldable'><hr />";
        echo "<form>";
        echo "<input type=hidden name='prnt_id' value={$msgs['prnt_id']} />";
        echo "<input type=hidden name='subject' value='' />";
        echo "<textarea name='msg_txt' cols=80 rows=10>";
        echo "Enter your comment here...</textarea><br />";
        echo "Name: <input type='text' name='name' maxlength='31' />&nbsp;";
        echo "Password: <input type='password' name='passwd' />&nbsp;";
        echo "<button type='button' class='post'>";
        echo "Post Comment</button></form>";
        echo "<span class='sent'></span></div>";
      }
      else
      {
        echo "<div class='foldable'><hr />";
        echo "{$msgs['msg_txt']}<br />";
        echo "by: {$msgs['name']}<br />";
        echo "</div>";
      }
    }
    if ($tag_switch) echo "</div>";
  }
}

?>
