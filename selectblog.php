<?php
  require "connect-database.php";
  connect_database("a6989280_blogs");

  $sql = "SELECT `Order`,`Name` FROM `Blogs` ORDER BY `Order`";
  $result = mysql_query($sql) or die(mysql_error());

  while ($row = mysql_fetch_array($result))
  {
    echo "<option value='" . $row['Name'] . "'";
    if ($row['Order'] == 0)
      echo " selected='selected'";
    echo ">" . $row['Name'] . "</option>";
  }

  mysql_close();
?>
