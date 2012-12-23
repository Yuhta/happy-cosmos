<?php

require_once("config-msgbrd.php");

$name = escape_data($_POST["name"]);
$passwd = escape_data($_POST["passwd"]);

$query1 = "SELECT `name` FROM `users`"
  . " WHERE `name`='$name' AND `passwd`=SHA1('$passwd')";
mysql_query($query1) or die(mysql_error());

if (mysql_affected_rows() != 1)
  show_msg("User name or current password are incorrect.");
else if ($_POST["new_passwd"] == "" && $_POST["email"] == "")
  show_msg("Nothing has been changed.", "green");
else
{
  if ($_POST["new_passwd"] != "")
    $new_passwd = check_passwd($_POST["new_passwd"],
                               $_POST["name"],
                               $_POST["confirm_passwd"]);
  if ($_POST["email"] != "")
    $email = check_email($_POST["email"]);

  if ($_POST["new_passwd"] == "" && $email)
  {
    $query2 = "UPDATE `users` SET `email`='$email'"
      . " WHERE `name`='$name'";
    mysql_query($query2) or die(mysql_error());
    show_msg("Your email has been changed.", "green");
  }
  else if ($_POST["email"] == "" && $new_passwd)
  {
    $query2 = "UPDATE `users` SET `passwd`=SHA1('$new_passwd')"
      . " WHERE `name`='$name'";
    mysql_query($query2) or die(mysql_error());
    show_msg("Your password has been changed.", "green");
  }
  else if ($_POST["new_passwd"] != "" && $new_passwd
           && $_POST["email"] != "" && $email)
  {
    $query2 = "UPDATE `users`"
      . " SET `passwd`=SHA1('$new_passwd'), `email`='$email'"
      . " WHERE `name`='$name'";
    mysql_query($query2) or die(mysql_error());
    show_msg("Your password and email has been changed.", "green");
  }
}

mysql_close();

?>
