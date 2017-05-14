<?php
  $servername = "localhost";
  $username = "mustuc";
  $password = "";
  $db = "dbtest";
  $conn = mysql_connect("localhost", "mustuc", "") or die("Error connecting to database: ".mysql_error());
  mysql_select_db("dbtest") or die(mysql_error());
  ?> 