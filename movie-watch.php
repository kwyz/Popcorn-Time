<?php 
session_start();
include 'dbconnect.php';
?>
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
		<?php 
		if(!isset($_SESSION['user']))
				{
		?>
		<a href="Main.php" class="title">Popcorn Time</a>
		<a href="reg.php" class="reg">Inregistrare</a>
		<a href="logare.php" class="log">Autentificare</a>
		<?php 
				}
		if(isset($_SESSION['user']))
				{
		?>
		<a href="Main.php" class="title">Popcorn Time</a>
		<a href="user-page.php" class="reg">Profil</a>
		<a href="logout.php?logout"  class="log">Ieşire</a>
		<?php 
		}?>>
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
		<?php 
			
			require __DIR__ . '/file.php';
			$submit_id = $_GET['id_film'];
			AddPlayer($submit_id);
		?>
	</div>
	</div>
</body>

</html>