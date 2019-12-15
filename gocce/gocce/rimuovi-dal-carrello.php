<?php session_start(); 
//header("Location: ".$_SERVER['HTTP_REFERER']);
?>
<!doctype html>
<html class="rimuovi-dal-carrello">
<head>
<meta charset="ISO8859-1">
<title>Rimuovi dal carrello - gocce vini e birre</title>
<link href="css/reset.css" rel="stylesheet" type="text/css">
<link href="css/amministrazione.css" rel="stylesheet" type="text/css">
<link rel="icon" href="immagini/favicon-gocce.ico" />
</head>
<body>
  <div id="logo"><a href="index.php"><img src="immagini/logo-gocce2.png" alt="logo-gocce" height="100"></a></div>
<?php include ('includes/connessione_db.php'); ?>
<?php 
echo "<h2>Rimozione prodotto</h2>";
echo "<br>";
echo "<br>";


$prod_rim=$_GET["id"];
//id_prodotto è un numero quindi non vuole gli apici
$query_rim = "DELETE FROM dettaglio_ordine WHERE id_prodotto= ".$prod_rim." AND id_ordine= ".$_SESSION['generazione_ordine'];

$risultatoquery_rim = mysqli_query($connessione, $query_rim) or die('vmfkldanblàq');  
//mysql_fetch_array è deprecata dalla versione 5.5.0
	
	if ($risultatoquery_rim) {
echo "<p>Il prodotto &egrave; stato rimosso dal carrello</p>";
echo "<p>Torna al <a href='riepilogo-carrello.php'>carrello</a></p>";
}
else {
  echo "<p>La rimozione del prodotto non è andata a buon fine</p>";
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