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
					</form>
						<?php 
					if(isset($_POST['search'])){
					$search_query = mysql_real_escape_string($_POST['query']);
					$_SESSION['search_query'] = $search_query;
					header("Location: search.php");
				}
				?>
				<ul>
					<li><a class="aa" href="#">Toate</a></li>
					<li><a class="aa" href="#">Populare</a></li>
					<li><a class="aa" href="#">Actiune</a></li>
					<li><a class="aa" href="#">Adventura</a></li>
					<li><a class="aa" href="#">Biografic</a></li>
					<li><a class="aa" href="#">Comedie</a></li>
					<li><a class="aa" href="#">Crima</a></li>
					<li><a class="aa" href="#">Documentar</a></li>
					<li><a class="aa" href="#">Drama</a></li>
					<li><a class="aa" href="#">Pentru Familie</a></li>
					<li><a class="aa" href="#">Pentru Familie</a></li>
					<li><a class="aa" href="#">Fiml-Noir</a></li>
					<li><a class="aa" href="#">Istroric</a></li>
					<li><a class="aa" href="#">Horror</a></li>
					<li><a class="aa" href="#">Musical</a></li>
					<li><a class="aa" href="#">Mystery</a></li>
					<li><a class="aa" href="#">Romance</a></li>
					<li><a class="aa" href="#">Sci-Fi</a></li>
					<li><a class="aa" href="#">Sport</a></li>
					<li><a class="aa" href="#">Thiler</a></li>
					<li><a class="aa" href="#">Razboi</a></li>
					<li><a class="aa" href="#">Werstern</a></li>
				</ul>
				
			</div>
			
		</div>
		
	<div class="look"><?php
			$curent_page = (empty($_GET["page"])?0:(int)$_GET["page"]);
		    $limit = 10 *  $curent_page;
		    echo"hey".$limit;
		?>
		<form method="GET">
			<input hidden name="page" value="<?php echo $curent_page <= 0 ? 0 : ($curent_page - 1)?>">
			<button class="prev_film" name="previous" type="submit"></button>
		</form>
		<center>
		
          <?php
          		
		
        	$query = mysql_real_escape_string($_SESSION['search_query']);
			$query = htmlspecialchars($query);
			$query = mysql_real_escape_string($query);
				$raw_results = mysql_query("SELECT * FROM filme WHERE `Denumire` LIKE '%".$query."%' LIMIT ".$limit.", 10");
			//echo mysql_num_rows($raw_results);
						if($raw_results){
							for($i = 0;$i<mysql_num_rows($raw_results);$i++){           
								$arrs[] =  mysql_fetch_array($raw_results,MYSQL_ASSOC);
							}
						if($arrs){
        					foreach ($arrs as $date) {
           						$adress = $date['Poster'];
					        	$film_adres = $date['adres'];
					        	?>
					        	<div class="elem-film">
				                <a href="movie-watch.php?id_film=<?php echo $film_adres; ?> "class="link"> <img class="poster"  src = "<?php echo $date['Poster'] ?>"></a>
				                <a href="javascript:setImageVisible('like', true)"  class="link"><img class="like" src="img/no-like.png"></a>
          					 </div> <?php
        					}
						}
						
							
						}
						else echo "Nici un rezultat";
						?>
					<center><form method="GET">
						<input hidden name="page" value="<?php echo $curent_page + 1; ?>">
        	<button class="next_film_search" name="next" type="submit" alt="Urmatoare"></button>
        				</form>	 </center>
           				
        </center>
        
        
	</div>
	
					<script>
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