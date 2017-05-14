<?php 
session_start();
include 'dbconnect.php';
include 'file.php';
?>
<html class="all_page">
<title>
	Popcorn-Time
</title>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script src="script.js"></script>
	<link href="style.css" rel="stylesheet" type="text/css" />
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
		}?>
		
	</div>
	<div class="drop-down">
			<a href="" class="drop-menu">...</a>
			<div class="nav">
				<form method="post">
				<input type="search" name="query" class="search" placeholder="Search...">
				<button  id="search_button" name="search" type="submit"></button>
				<script type="text/javascript">
    				document.getElementById("myButton").onclick = function () {
        			location.href = "https://popcorn-time-mustuc.c9users.io/search.php";
    				};
</script>
					</form>
					

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
		
	<div class="look"><?php
		var_dump($raw_results);

		?>
		<form method="post">
			<button class="prev_film" name="previous" type="submit"></button>
		</form>
		<center>
		
          <?php
         $page_number = 0;
          if (!isset($_SESSION['page_number'])) {
    			$_SESSION['page_number'] = 0;
		  } 	
          if(isset($_POST['previous'])){
			if($page_number != 0){
				$page_number -= 10;
			}
          }
          
          if(isset($_POST['next'])){
				$page_number += 10;
          }
 
					if(isset($_POST['search'])){
						$query = $_POST['query'];
						$query = htmlspecialchars($query);
						$query = mysql_real_escape_string($query);
						$raw_results = mysql_query("SELECT * FROM filme WHERE `Denumire` LIKE '%".$query."%'");
						
							for($i = 0;$i<mysql_num_rows($raw_results);$i++){           
								$arrs[] =  mysql_fetch_array($raw_results,MYSQL_ASSOC);
							
								
        					foreach ($arrs as $date) {
           						$adress = $date['Poster'];
					        	$film_adres = $date['adres'];
        					}
							}
						?>
           					 <<div class="elem-film">
                <a href="movie-watch.php?id_film=<?php echo $adress_film; ?> "class="link"> <img class="poster"  src = "<?php echo $poster['Poster'] ?>"></a>
                <?php
                if(isset($_SESSION['user']))
				{
					?>
                <img id="like" id_film="<?php echo $adress_film; ?>" onclick="changeImage(this)" src="img/<?php echo $check?"like":"no-like"?>.png"  / >
                <?php
					
				}
                ?>
            </div>	
                <?php }?>
        </center>
        <form method="post">
        	<button class="next_film" name="next" type="submit" alt="Urmatoare"></button>
        </form>
        
	</div>
	
			<script type="text/javascript">
			function changeImage(el) {
    console.log(el.src)
    if (el.src.indexOf("img/no-like.png") > 0) {
        el.src = "img/like.png";
        $.post( "query_add_to_fav.php", { film: el.getAttribute("id_film")} );
       
    } else {
        el.src = "img/no-like.png";
    $.post("delete_add_to_fav.php",{del: el.getAttribute("id_film")});
    }
       
}
			</script>
	</center>
		
		</div>
	</div>
	


</body>

</html>