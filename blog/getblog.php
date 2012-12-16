<?php
  $source = $_GET["s"];
  $num = intval($_GET["n"]);

  require "connect-database.php";
  connect_database("a6989280_blogs");

  $sql = "SELECT `Name`,`Link`,`FeedLink` FROM `Blogs` WHERE `Name`='"
         . $source . "'";
  $result = mysql_query($sql) or die(mysql_error());
  $row = mysql_fetch_array($result);

  $blogName = $row['Name'];
  $blogLink = $row['Link'];
  $xml = $row['FeedLink'];

  $xmlDoc = new DOMDocument();
  $xmlDoc->load($xml);

  echo "<span style='float:right'>From <a target='_blank' href='"
       . $blogLink . "'>" . $blogLink . "</a></span><br><br>";

  $entry = $xmlDoc->getElementsByTagName("entry");
  echo "<hr>";
  for ($i = 0; $i < $num; $i++)
  {
    $entryTitle = $entry->item($i)->getElementsByTagName("title")
                  ->item(0)->nodeValue;
    $entryContent = $entry->item($i)->getElementsByTagName("content")
                    ->item(0)->nodeValue;

    echo "<h3>" . $entryTitle . "</h3>";
    echo $entryContent;
    echo "<hr>";
  }

  echo "<p>Please go to <a href='" . $blogLink . "' target='_blank'>"
       . $blogName . "</a> for more posts.</p>";

  mysql_close();
?>