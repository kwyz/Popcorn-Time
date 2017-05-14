<script>
/*global $*/</script>
<?php
session_start();
include 'dbconnect.php';
$id_films = (int)0;
 $sqls = mysql_query("DELETE FROM `favorit` WHERE id_film = 0");

if(!isset($_SESSION['user'])){
	header("Location:logare.php");
}
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


			<a href="Main.php" class="title">Popcorn Time</a>
			<a href="user-page.php" class="reg"> Profil</a>
			<a href="logout.php?logout"  class="log">Ieşire</a>
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

			<div class="show">
				<?php
				$curent_page = (empty($_GET["page"])?0:(int)$_GET["page"]);
				 $limit = 10 *  $curent_page;
				 
				?>
				<form method="GET">
			<input hidden name="page" value="<?php echo $curent_page <= 0 ? 0 : ($curent_page - 1)?>">
			<button class="prev_film" name="previous" type="submit"></button>
		</form>
					<center>
					<?php
					$mysquery = mysql_query("SELECT id_film FROM `favorit` WHERE id_user = '".$_SESSION['user']."' LIMIT ".$limit.", 10");
					for($i = 0;$i<mysql_num_rows($mysquery);$i++){           
							$arrays[] =  mysql_fetch_array($mysquery,MYSQL_ASSOC);
							 foreach ($arrays as $identifier) {
							 	$id_filmu = $identifier['id_film'];
								$getsql = mysql_query("SELECT Poster FROM filme WHERE adres = '".$id_filmu."'");
									$masiv[] =  mysql_fetch_array($getsql,MYSQL_ASSOC);
									$check = mysql_num_rows(mysql_query("SELECT *FROM `favorit`WHERE `id_film` ='".$id_filmu."' AND `id_user` ='".$_SESSION['user']."'"));
								foreach($masiv as $posters){
									$posterss = $posters['Poster'];
									
								}}
								
								?>
							
								<div class="elem-film">
                					<a href="movie-watch.php?id_film=<?php echo $id_filmu; ?> "class="link"> <img class="poster"  src = "<?php echo $posters['Poster'] ?>"></a>
                					<img id="like" id_film="<?php echo $id_filmu; ?>" onclick="changeImage(this)" src="img/<?php echo $check?"like":"no-like"?>.png"  / >
           				       </div>
           
							<?php		
							
					
					}
					?>
					<script>
function changeImage(elm) {
    console.log(elm.src)
    if (elm.src.indexOf("img/like.png") > 0) {
         elm.src = "img/no-like.png";
			  $.post("delete_add_to_fav.php",{del: elm.getAttribute("id_film")});
       
    } else {
    	elm.src = "img/like.png";
        $.post( "query_add_to_fav.php", { film: elm.getAttribute("id_film")} );
       
    }}
						</script>
							</center>
     <form method="GET">
						<input hidden name="page" value="<?php echo $curent_page + 1; ?>">
        	<button class="next_film_search" name="next" type="submit" alt="Urmatoare"></button>
        				</form>
            </div> 
			
			
			
			
			</body></html>