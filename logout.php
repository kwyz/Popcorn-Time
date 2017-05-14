<?php
session_start();

if(!isset($_SESSION['user']))
{
 header("Location: Main.php");
}
else if(isset($_SESSION['user'])!="")
{
 header("Location: user-page.php");
}

if(isset($_GET['logout']))
{
 session_destroy();
 unset($_SESSION['user']);
 header("Location: Main.php");
}
?>