<?php 
include 'dbconnect.php';
session_start();
$del = $_POST['del'];
$user = $_SESSION['user'];
print_r($_POST);
print_r($_SESSION);


$delsqls = mysql_query("DELETE FROM favorit WHERE id_film = '".$del."' AND id_user = '".$user."'");
        


?>