
<!DOCTYPE html>
<html>
<title>
	Popcorn-Time
</title>
<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
		<script src="script.js"></script>
		<link href="style.css" rel="stylesheet" type="text/css" />
		<link href="log-reg-style.css" rel="stylesheet" type="text/css" />
		<meta charset="utf-8">
	</head>
	<body class="body">
		<div class="header">
			
			<a href="Main.php" name="main" class="title">Popcorn Time</a>
			<a href="reg.php" class="reg">Inregistrare</a>
			<a href="logare.php" class="log">Autentificare</a>
		</div>
		<div class="drop-down">
			<a href="" class="drop-menu">...</a>
			<div class="nav">
				<input type="search" name="" class="search" placeholder="Search...">
				<ul>
					<li><a class="aa" href="Main.php">Toate</a></li>
					<li><a class="aa" href="category.php?id_gen=1">Drama</a></li>
					<li><a class="aa" href="category.php?id_gen=2">Actiune</a></li>
					<li><a class="aa" href="category.php?id_gen=3">Razboi</a></li>
					<li><a class="aa" href="category.php?id_gen=4">Documetal</a></li>
					<li><a class="aa" href="category.php?id_gen=5">Comedie</a></li>
					<li><a class="aa" href="category.php?id_gen=6">Mistica</a></li>
					<li><a class="aa" href="category.php?id_gen=7">Musicl</a></li>
					<li><a class="aa" href="category.php?id_gen=8">Detectiv</a></li>
					<li><a class="aa" href="category.php?id_gen=9">Criminal</a></li>
					<li><a class="aa" href="category.php?id_gen=10">Aventura</a></li>
					<li><a class="aa" href="category.php?id_gen=22">Romance</a></li>
					<li><a class="aa" href="category.php?id_gen=12">Trillerr</a></li>
					<li><a class="aa" href="category.php?id_gen=13">Fantasy</a></li>
					<li><a class="aa" href="category.php?id_gen=15">Western</a></li>
					<li><a class="aa" href="category.php?id_gen=16">Istoric</a></li>
					<li><a class="aa" href="category.php?id_gen=14">Melodrama</a></li>
					<li><a class="aa" href="category.php?id_gen=18">Desene Animate</a></li>
					<li><a class="aa" href="category.php?id_gen=17">Pentru Familie</a></li>
					<li><a class="aa" href="category.php?id_gen=20">Horror</a></li>
					<li><a class="aa" href="category.php?id_gen=19">Pentru Copii</a></li>
					<li><a class="aa" href="category.php?id_gen=21">Biografie</a></li>
					<li><a class="aa" href="category.php?id_gen=11">Fantastica</a></li>
				</ul>
				
			</div>
			
		</div>
		<div class="look">
	
			<div id="log-form">
			<form method="post">
				<p><input class="name-log" type="text" value= "" name="email" placeholder="Your Nickname" required /></p>
				<p><input type="password" class="pass-log" value= "" name="pass" placeholder="Your Password" required /></p>
				<p><button id="btn-log" type="submit" name="send-btn">Logare</button></p>
				<form>
			</div>
<?php
session_start();
include_once 'dbconnect.php';
if(isset($_POST['main'])){
	header("Location: Main.php");
	
}

if(isset($_SESSION['user'])!="")
{
 header("Location: user-page.php");
}
if(isset($_POST['send-btn']))
{
 $email = mysql_real_escape_string($_POST['email']);
 $upass = mysql_real_escape_string($_POST['pass']);
 
 $res=mysql_query("SELECT * FROM users WHERE username = '$email' ");
 $row=mysql_fetch_array($res);
 if($row['password']==md5($upass))
 
 {
  $_SESSION['user'] = $row['user_id'];
  header("Location: Main.php");
 }
 else
 {
  ?>
        <p class="eroare_UP">Username-ul /or parola este gresita.</p>
        <?php
 
 
}}
?>

		</div>

	</body>


	</html>