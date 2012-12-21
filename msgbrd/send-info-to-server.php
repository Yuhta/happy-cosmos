<?php

require_once('config-msgbrd.php');

$prnt_id = escape_data($_POST["prnt_id"]);
$subject = escape_data($_POST["subject"]);
$msg_txt = escape_data($_POST["msg_txt"]);
$name = escape_data($_POST["name"]);
$passwd = escape_data($_POST["passwd"]);

$query1 = "SELECT `name` FROM `users` "
  . "WHERE `name`='$name' AND `passwd`=SHA1('$passwd')";
$result1 = mysql_query($query1) or die(mysql_error());

if (mysql_affected_rows() != 1)
  show_msg("User name or password are incorrect.");
else if ($prnt_id == 0 && $subject == "")
  show_msg("Subject cannot be empty.");
else
{
  $row = mysql_fetch_array($result1, MYSQL_NUM);
  if ($prnt_id != 0)
  {
    $query2 = "INSERT INTO `msgs` (`name`, `msg_txt`, `prnt_id`) "
      . "VALUES ('$row[0]', '$msg_txt', '$prnt_id')";
    $com_or_sub = "comment";
  }
  else
  {
    $query2 = "INSERT INTO `msgs` (`name`, `subject`, `msg_txt`) "
      . "VALUES ('$row[0]', '$subject', '$msg_txt')";
    $com_or_sub = "subject";
  }
  mysql_query($query2) or die(mysql_error());

  $query3 = "UPDATE `msgs` SET `prnt_id`=`msg_id` WHERE `prnt_id` IS NULL";
  mysql_query($query3) or die(mysql_error());

  show_msg("Your $com_or_sub has been submitted.", "green");
}

mysql_close();
exit();

?>
