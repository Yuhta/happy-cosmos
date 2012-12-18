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

  $query = "select `m`.`subject`, `m`.`msg_txt`, `m`.`date`, "
    . "`m`.`prnt_id`, `m`.`msg_id`, `m`.`usr_id`, `u`.`name`, "
    . "`u`.`usr_id` from `msgs` as `m`, `users` as `u` "
    . "where (`m`.`usr_id` = `u`.`usr_id`) "
    . "order by `m`.`prnt_id`, `m`.`date`;";
  $result = mysql_query($query) or trigger_error("An error happened");

  if (mysql_affected_rows() > 0)
  {
    $tag_switch = FALSE;
    while ($msgs = mysql_fetch_array($result, MYSQLI_ASSOC))
    {
      if ($msgs['prnt_id'] == $msgs['msg_id'])
      {
        ($tag_switch) ? print "</div><div class='comment_box'>"
          : print "<div class='comment_box'>";
        $tag_switch = TRUE;
        echo "<h3>{$msgs['subject']}</h3>";
        echo "<p>{$msgs['msg_txt']}</p>";
        echo "<br />by: {$msgs['name']} ";
        echo "<a href='#' class='get_comments'>Comments</a>";
        echo "<div class='comments'><hr />";
        echo "<form id='reply'>";
        echo "<textarea name='msg_txt' class='msg_txt' cols=80 rows=10>";
        echo "Enter your comment here...</textarea><br />";
        echo "<input type=hidden name='prnt_id' value={$msgs['prnt_id']} />";
        echo "Name: <input type='text' name='name' />&nbsp";
        echo "Password: <input type='password' name='passwd' />&nbsp";
        echo "<button type='button' id='post_reply'>";
        echo "Post Comment</button></form>";
        echo "<span class='comment_sent'></span></div>";
      }
      else
      {
        echo "<div class='comments'><hr />";
        echo "{$msgs['msg_txt']}<br />";
        echo "by: {$msgs['name']}<br />";
        echo "</div>";
      }
    }
    if ($tag_switch) echo "</div>";
  }
}

?>
