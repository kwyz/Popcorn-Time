<?php 
include 'dbconnect.php';
session_start();
$film = implode($_POST);
$user = $_SESSION['user'];

if(!mysql_query("INSERT INTO favorit (id_user,id_film) VALUES('$user','$film') "))
        {
            $mysqls = mysql_query("DELETE FROM favorit WHERE id_film = '".$film."' AND id_user = '".$user."'");
        }

else{
   $msq = mysql_query("INSERT INTO favorit (id_user,id_film) VALUES('$user','$film') ");
}
?>