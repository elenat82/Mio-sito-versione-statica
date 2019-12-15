<?php session_start(); ?>
<!doctype html>
<html class="contatti">
<head>
<meta charset="ISO8859-1">
<title>Contatti - gocce vini e birre</title>
<link href="css/reset.css" rel="stylesheet" type="text/css">
<link href="css/stili.css" rel="stylesheet" type="text/css">
<link href="css/contatti.css" rel="stylesheet" type="text/css">
<link rel="icon" href="immagini/favicon-gocce.ico" />

</head>
<body>
<?php include('includes/template_header.php'); 

include ('includes/connessione_db.php');  	

	 
	 ?>

<div id="contatti">
  <h2>Scrivici</h2>
  <br>
  
  <h3>Compila il form per avere qualsiasi informazione</h3>
  <br>
  
<?php 
echo "<form action='$_SERVER[PHP_SELF]' method='post' name='contatti'>";
echo "<label>Il tuo nome</label>";
echo "<br>";
echo "<input type='text'></input>";
echo "<br>";
echo "<label>Il tuo indirizzo mail</label>";
echo "<br>";
echo "<input type='text'></input>";
echo "<br>";
echo "<label>Il tuo messaggio</label>";
echo "<br>";
echo "<textarea></textarea>";
echo "<br>";
echo "<input type='submit' value='Invia il messaggio'>";
echo "</form>";
	 
	 ?>

</div>

<div id="mappa">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2816.772144703749!2d7.660930600000007!3d45.09041350000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47886db2941a96ab%3A0x9cb2b73b94861b68!2sCorso+Svizzera%2C+185%2C+10149+Torino!5e0!3m2!1sit!2sit!4v1427726353503" width="600" height="450" frameborder="0" style="border:0"></iframe>
</div>
<?php 
			mysqli_close($connessione); 
			?>
<?php include('includes/template_footer.php'); ?>
</body>
</html>