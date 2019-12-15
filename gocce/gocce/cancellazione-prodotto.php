<?php session_start(); ?>
<!doctype html>
<html class="cancellazione-prodotto">
<head>
<meta charset="ISO8859-1">
<title>Cancellazione prodotto - gocce vini e birre</title>
<link href="css/reset.css" rel="stylesheet" type="text/css">
<link href="css/amministrazione.css" rel="stylesheet" type="text/css">
<link rel="icon" href="immagini/favicon-gocce.ico" />
</head>
<body>
  <div id="logo"><a href="index.php"><img src="immagini/logo-gocce2.png" alt="logo-gocce" height="100"></a></div>
<?php include ('includes/connessione_db.php'); ?>
<?php 
echo "<h2>Cancellazione prodotto</h2>";
echo "<br>";
echo "<br>";
$prod_canc=$_GET["id"];
//id_prodotto è un numero quindi non vuole gli apici
$query = "DELETE FROM prodotti WHERE id_prodotto= ".$prod_canc."";

$risultatoquery = mysqli_query($connessione, $query) or die('vmfkldanblàq');  
//mysql_fetch_array è deprecata dalla versione 5.5.0
	
	if ($risultatoquery) {
echo "<p>Il prodotto è stato cancellato</p>";
}
else {
  echo "<p>La cancellazione del prodotto non è andata a buon fine</p>";
}

 ?>

</div>
<br>
<br>
<br>
<br>
<?php 
		mysqli_close($connessione); 
			?>

</body>
</html>