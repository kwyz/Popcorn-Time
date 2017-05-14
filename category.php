

<?php 
session_start();
include 'dbconnect.php';
include 'query_add_to_fav.php';
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
				<button id="search_button" name="search" type="submit"></button>
				<?php 
				if(isset($_POST['search'])){
					$search_query = mysql_real_escape_string($_POST['query']);
					$_SESSION['search_query'] = $search_query;
					header("Location: search.php");
				}
				?>
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
					<script>
					$(document).ready(function(){
    			$("a").click(function(){
    				console.log(this);
    			 $(this).toggleClass("active");
					 });
				});
					</script>
				</ul>
				
			</div>
		</div>
		
	<div class="look">
		<?php
		$curent_page = (empty($_GET["page"])?0:(int)$_GET["page"]);
		    $limit = 10 *  $curent_page;
		    $id_gen = $_GET['id_gen'];
		?>
		<form method="GET">
			<input hidden name="page" value="<?php echo $curent_page <= 0 ? 0 : ($curent_page - 1)?>">
			<button class="prev_film" name="previous" type="submit"></button>
		</form>
	<center>
		<?php
		
           $sql = mysql_query("SELECT Poster From `filme` WHERE gen = '".$id_gen."' LIMIT ".$limit.", 10");
       
			for($i = 0;$i<mysql_num_rows($sql);$i++){           
				$arr[] =  mysql_fetch_array($sql,MYSQL_ASSOC);
					
           foreach ($arr as $poster) {
           $adress = $poster['Poster'];
           $msql= mysql_query("SELECT adres FROM `filme` WHERE Poster = '".$adress."'");
           $arr_adres[] = mysql_fetch_array($msql,MYSQL_ASSOC);
           foreach($arr_adres as $adress){
           		$adress_film = $adress['adres'];
           }}
           $check = mysql_num_rows(mysql_query("SELECT *FROM `favorit`WHERE `id_film` ='".$adress_film."' AND `id_user` ='".$_SESSION['user']."'"));
           
           ?>
           
            <div class="elem-film">
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
                		
                <?php
                }?>
                		 
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
     <form method="GET">
						<input hidden name="page" value="<?php echo $curent_page + 1; ?>">
        	<button class="next_film_search" name="next" type="submit" alt="Urmatoare"></button>
        				</form>
            </div> 
</body>
</html>