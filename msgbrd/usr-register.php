<?php

require_once("config-msgbrd.php");

$name = check_name($_POST["name"]);
$email = check_email($_POST["email"]);
$passwd = check_passwd($_POST["passwd"],
                       $_POST["name"],
                       $_POST["confirm_passwd"]);

if ($name && $passwd && $email)
{
  $query1 = "SELECT `name` FROM `users` WHERE `name`='$name'";
  $result1 = mysql_query($query1) or die(mysql_error());
  $query2 = "SELECT `email` FROM `users` WHERE `email`='$email'";
  $result2 = mysql_query($query2) or die(mysql_error());

  if (mysql_num_rows($result1) != 0)
    show_msg("There is an account assigned to that name.");
  if (mysql_num_rows($result2) != 0)
    show_msg("That email address has already been registered.");
  if (mysql_num_rows($result1) == 0 && mysql_num_rows($result2) == 0)
  {
    $query = "INSERT INTO `users` (`name`, `passwd`, `email`)"
      . " VALUES ('$name', SHA1('$passwd'), '$email')";
    mysql_query($query) or die(mysql_error());
    show_msg("Registration succeed!", "green");
  }
}

mysql_close();

?>
