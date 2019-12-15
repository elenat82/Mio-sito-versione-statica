<?php session_start(); ?>
<!doctype html>
<html class="index">
<head>
<meta charset="ISO8859-1">
<title>Home - gocce vini e birre</title>
<link href="css/reset.css" rel="stylesheet" type="text/css">
<link href="css/stili.css" rel="stylesheet" type="text/css">
<link rel="icon" href="immagini/favicon-gocce.ico" />
<!-- lightbox -->
<script src="lightbox/js/jquery-1.11.0.min.js"></script>
<script src="lightbox/js/lightbox.min.js"></script>
<link href="lightbox/css/lightbox.css" rel="stylesheet" />
<!-- carousel-->
<link rel="stylesheet" href="owl-carousel/owl.carousel.css">
<link rel="stylesheet" href="owl-carousel/owl.theme.css">
<!-- <script src="jquery-1.9.1.min.js"></script> -->
<script src="assets/owl-carousel/owl.carousel.js"></script>
<script type="text/javascript">
$(document).ready(function() {
 
  var owl = $("#owl-example");
 
  owl.owlCarousel({
      items : 10, //10 items above 1000px browser width
      itemsDesktop : [1000,5], //5 items between 1000px and 901px
      itemsDesktopSmall : [900,3], // betweem 900px and 601px
      itemsTablet: [600,2], //2 items between 600 and 0
      itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
  });
 
  // Custom Navigation Events
  $(".next").click(function(){
    owl.trigger('owl.next');
  })
  $(".prev").click(function(){
    owl.trigger('owl.prev');
  })
  $(".play").click(function(){
    owl.trigger('owl.play',1000); //owl.play event accept autoPlay speed as second parameter
  })
  $(".stop").click(function(){
    owl.trigger('owl.stop');
  })
 
});
</script>

<?php 

include('includes/controlloeta.php'); 

if (empty($_POST['giorno']) AND empty($_SESSION['loggato']) AND empty($_SESSION['id_loggato']) ) {
echo "<meta http-equiv='refresh' content='0; url=maggiorenne.html'>";

}
 ?>
</head>
<body>
<?php include('includes/template_header.php'); 

include ('includes/connessione_db.php');  	

	 
	 ?>
<section id="banner"> <img src="immagini/altre-immagini/banner-expo.png"> </section>
<div id="pageContent">
  <h2>prodotti novita'</h2>
  <?php 
$queryx = "SELECT * FROM prodotti ORDER BY id_prodotto DESC LIMIT 5";
// qui mi dice "no database selected perchè la funzione di sopra è deprecata"
$risultatoqueryx = mysqli_query($connessione, $queryx) or die(mysql_error());  
//mysql_fetch_array è deprecata dalla versione 5.5.0
$ix=0;
echo "<div id='novita' >";
	while($rigax=mysqli_fetch_array($risultatoqueryx)){
		
		echo "<div class='prodotto' >";
		echo  "<h3><a href='scheda-prodotto.php?id=".$rigax['id_prodotto']."'>".$rigax['nome_prodotto']."</a></h3>";
		echo "<a href=".$rigax['nome_immagine']." rel='lightbox'><img src=".$rigax['nome_immagine']." height='200' data-lightbox=".$ix."></a>";
		echo "<p>prezzo di listino:".$rigax['prezzo_listino']."&#8364;/litro</p>";
		echo "<a href='quantita.php?id=".$rigax['id_prodotto']."'><img src='immagini/altre-immagini/aggiungi-al-carrello.png' height='40'></a>";
		echo "</div>";
		
		
	$ix++;
	}
	echo "</div>";
 ?>

<br>
<br>
<br>
<br>
<br>
<br>
<div id="scorr">
<div id="owl-example" class="owl-carousel owl-theme">
	<?php 

	$query_carousel = "SELECT * FROM prodotti";

$risultatoquery_carousel = mysqli_query($connessione, $query_carousel) or die(mysql_error());  


	while($riga_carousel=mysqli_fetch_array($risultatoquery_carousel)){
		
		
		echo "<div class='item'>";
		echo "<p style='font-family:arial; padding-top:40px; color:#949494; font-weight:bold;'>";
		echo "<a style='text-decoration:none; color:inherit' href='scheda-prodotto.php?id=".$riga_carousel['id_prodotto']."'>".$riga_carousel['nome_prodotto']."</a>";
		echo "</p></div>";
																													
	}

  
   ?>
 
</div>

</div>


<br>
<br>
<br>

  <h2>prodotti in promozione</h2>
  <?php 
$query = "SELECT * FROM prodotti WHERE in_evidenza = '1' ";
// qui mi dice "no database selected perchè la funzione di sopra è deprecata"
$risultatoquery = mysqli_query($connessione, $query) or die(mysql_error());  
//mysql_fetch_array è deprecata dalla versione 5.5.0
$i=0;
echo "<div id='promozione'>";
	while($riga=mysqli_fetch_array($risultatoquery)){
		
		echo "<div class='prodotto'>";
		echo  "<h3><a href='scheda-prodotto.php?id=".$riga['id_prodotto']."'>".$riga['nome_prodotto']."</a></h3>";
		echo "<a href=".$riga['nome_immagine']." rel='lightbox'><img src=".$riga['nome_immagine']." height='200' data-lightbox=".$i."></a>";
		echo "<p>prezzo di listino:".$riga['prezzo_listino']."&#8364;/litro</p>";
		echo "<img src='immagini/altre-immagini/aggiungi-al-carrello.png' height='40'>";
		echo "</div>";
		
		
	$i++;
	}
	echo "</div>";
 ?>
</div>
<?php 
			mysqli_close($connessione); 
			?>
<?php include('includes/template_footer.php'); ?>
</body>
</html>