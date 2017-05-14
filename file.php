<meta charset="utf-8">
<?php
session_start();
include_once 'dbconnect.php';
require __DIR__ . '/vendor/autoload.php';
use Sunra\PhpSimple\HtmlDomParser;


if (__FILE__ == $_SERVER['SCRIPT_FILENAME']){
	
	// ###############################################################
	// #      Genereaza codul html dupa id-ul de pe my-hit.ru        #
	// # ___________________________________________________________ #
	// # - 1 argument - id filmului                                  #
	// # - 2 argument - seteaza titlul dorit - daca nui il genereaza # - obtional
	// ###############################################################
	// --- codul generat e in fix ca acel care lai facut manual pentru sup. vs bat.
	
	// AddPlayer('419657'); 
	
	
	
	
	// ##############################################################
	// #       Genereaza lista de filme cu categoria indicata       #
	// # __________________________________________________________ #
	// #  - 1 argument - categoria in rusa ca pe siteul my-hit.ru   #
	// #  - 2 argument - numarul de filme necesare                  # - obtional (10)
	// #  - 3 argument - de la al citulea film se inceme numararea  # - obtional (0)
	// ##############################################################
	$transalte = array(
		"Драма" => "1",
		"Боевик" => "2",
		"Военный" => "3",
		"Документальный" => "4",
		"Комедия" => "5",
		"Мистика" => "6",
		"Мюзикл" => "7",
		"Спорт" => "8",
		"Детектив" => "9",
		"Криминал" => "10",
		"Приключения" => "11",
		"Романтический" => "12",
		"Триллер" => "13",
		"Фэнтези" => "14",
		"Вестерн" => "15",
		"Исторический" => "16",
		"Мелодрама" => "17",
		"Мультфильм" => "18",
		"Семейный" => "19",
		"Ужасы" => "20",
		"Детский" => "21",
		"Биография" => "22",
		"Фантастика" => "23"
	);
	  $gen = array(
	  "Драма",
	  "Боевик",
	  "Военный",
	  "Документальный",
	  "Комедия",
	  "Мистика",
	  "Мюзикл",
	  "Спорт",
	  "Детектив",
	  "Криминал",
	  "Приключения",
	  "Романтический",
	  "Триллер",
	  "Фэнтези",
	  "Вестерн",
	  "Исторический",
	  "Мелодрама",
	  "Мультфильм",
	  "Семейный",
	  "Ужасы",
	  "Детский",
	  "Биография"); 
	   
	  foreach ($gen as $value) {
		   
			$movies = movieList("$value", 50 , 0);
			echo $value;
			for ($i = 0; $i < count($movies); $i++) {
				for ($j = 0; $j < count($movies[$i]["category"]); $j++) {
					if (isset($transalte[$movies[$i]["category"][$j]]))
						$movies[$i]["category"][$j] = $transalte[$movies[$i]["category"][$j]];
				}
			}
   
	foreach($movies as $movie) {
		$movie_id = $movie["id"];
		$movie_title = $movie["title"];
		$movie_image_url = $movie["image"];
		$movie_gen = join(", ", $movie["category"]);
		
		echo "ID: " . $movie["id"] . "<br>";
		echo "Titlu: " . $movie["title"] . "<br>";
		echo "Image: " . $movie["image"] . "<br>";
		echo "Category: " . join(", ", $movie["category"]);
		$mysql = mysql_query("INSERT INTO filme (adres,Poster,Denumire,gen) VALUES('$movie_id','$movie_image_url','$movie_title','$movie_gen')");
	
		$last_id=mysql_insert_id();
		foreach ($movie["category"] as $c) 
			if (!mysql_query("INSERT INTO film-gen (id_film,id_gen) VALUES('$last_id','$c')"))
			$die =  mysql_query("INSERT INTO filmegen (id_film,id_gen) VALUES('$last_id','$c')");
			echo $die;
				printf("Errormessage: %s\n", mysql_error());
		$get_query = mysql_query("SELECT * FROM filme LIMIT 5");
			 $rowspan=mysql_fetch_array($get_query);
		echo "<br>";
			
	  }
	} 
   
}
			// $get_query = mysql_query("SELECT * FROM filme LIMIT 5");
			// while($rowspan=mysql_fetch_array($get_query)) {
			//     var_dump($movie_gen);
			//     echo '<pre>' . print_r($rowspan, true) . '</pre>';
			// }
		  
			

function AddPlayer($id, $title = "") {
	
	$find = false;
	$html = HtmlDomParser::file_get_html("https://my-hit.org/film/" . $id . "/");

	if (empty($title))
		$title = $html->find(".nav-list li", 0)->plaintext;

	foreach($html->find('script') as $element) {
		$js = trim($element->innertext);
		$js = str_replace("'//", "'", $js);
		$js = str_replace("\"//", "\"", $js);
		$js = str_replace("'/", "'https://my-hit.org/", $js);
		$js = str_replace("\"/", "\"https://my-hit.org/", $js);
		 
		if ($find = strpos($js, "var flashvars", 0) === 0) { ?>
			<!--<meta charset="utf-8">-->
			<script type="text/javascript" src="https://my-hit.org/themes/kino_v5/js/pack.js?v=20"></script>
			<center>
				<div class="player">
					<div style="max-width: 760px;" class="col-xs-12 center-block">
						<div class="text-center" style="margin-bottom: 6px;">
							<strong><?php echo $title; ?></strong>
						</div>
						<div class="player" id="hitplayer" style="width:700px; height:414px;"></div>
						<script>
							<?php echo $js; ?>
						</script>"
					</div>
				</div>
			</center>
	<?php break;
		}
	}
	
	if (!$find) echo "<h1>Sorry movie was removed or don't exists";

	
}



function movieList($category, $limit = 10, $offset = 0) {
	
	$html = HtmlDomParser::file_get_html("https://my-hit.org/film/");
	
	$categoryUrl = "";
	foreach($html->find(".nav-list li a") as $element) {
		if (strcmp(trim($element->plaintext), $category) == 0) {
			$categoryUrl = "https://my-hit.org/" . $element->href;
			break;
		}
	}
	
	if (!$categoryUrl) return false;
	
	$page = 1;
	$offset = abs($offset);
	$limit = abs($limit);
	$movie = array();
	
	while (1) {
		
		$html = HtmlDomParser::file_get_html($categoryUrl . "/?p=" . $page++);
		foreach($html->find("#film-list .row") as $element) {
			if ($offset-- > 0) continue;
			if (!$limit--) break 2;
		
			$fild = "data-film-id";
			$id = $element->find(".div-film-poster", 0)->$fild;
			$title = $element->find(".div-film-poster", 0)->parent()->title;
			$image = $element->find(".div-film-poster img", 0)->src;
			
			$element = $element->find(".col-xs-9 > ul.list-unstyled", 1);
			$element = $element->find("li", 0);
	
			$category = array();
		   
			echo $cHtml->plaintext;
			foreach($element->find("a") as $element)
				$category[] = $element->plaintext;
			
			array_push($movie, array(
				"id" => $id,
				"image" => "https://my-hit.org/" . $image,
				"title" => $title,
				"category" => $category
			));
			
		}
	 
	}
	
	return $movie;
}

?>