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

function check_name($name)
{
  if (preg_match("/^\w{2,}$/", stripslashes(trim($name))))
    $n = escape_data($name);
  else
  {
    $n = FALSE;
    show_msg("Please enter a valid user name!  User names can contain"
             . " only letters, numbers, and underscores, and should be"
             . " at least 2 characters long.");
  }
  return $n;
}

function check_email($email)
{
  if (preg_match("%^[A-Za-z0-9._\%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$%",
                 stripslashes(trim($email))))
    $e = escape_data($email);
  else
  {
    $e = FALSE;
    show_msg("Please enter a valid email address!");
  }
  return $e;
}

function check_passwd($passwd, $name, $confirm_passwd)
{
  if ($passwd == $name)
  {
    $p = FALSE;
    show_msg("Your password cannot be the same as the user name!");
  }
  else if ($passwd != $confirm_passwd)
  {
    $p = FALSE;
    show_msg("Your password does not match the confirmed password!");
  }
  else if (preg_match("/^.{6,}$/", stripslashes(trim($passwd))))
    $p = escape_data($passwd);
  else
  {
    $p = FALSE;
    show_msg("Password should be at least 6 characters long.");
  }
  return $p;
}

?>
