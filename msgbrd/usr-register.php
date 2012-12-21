<?php

require_once("config-msgbrd.php");

if (preg_match("/^\w{2,}$/",
               stripslashes(trim($_POST['name']))))
  $name = escape_data($_POST['name']);
else
{
  $name = FALSE;
  show_msg("Please enter a valid user name!  User names can contain"
           . " only letters, numbers, and underscores, and should be"
           . " at least 2 characters long.");
}

if (preg_match("%^[A-Za-z0-9._\%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$%",
               stripslashes(trim($_POST['email']))))
  $email = escape_data($_POST['email']);
else
{
  $email = FALSE;
  show_msg("Please enter a valid email address!");
}

if ($_POST['passwd'] == $_POST['name'])
{
  $passwd = FALSE;
  show_msg("Your password cannot be the same as the user name!");
}
else if ($_POST['passwd'] != $_POST['confirm_passwd'])
{
  $passwd = FALSE;
  show_msg("Your password does not match the confirmed password!");
}
else if (preg_match("/^.{6,}$/",
                    stripslashes(trim($_POST['passwd']))))
  $passwd = escape_data($_POST['passwd']);
else
{
  $passwd = FALSE;
  show_msg("Password should be at least 6 characters long.");
}

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
    $result = mysql_query($query) or die(mysql_error());
    show_msg("Registration succeed!", "green");
  }
}

mysql_close();

?>
