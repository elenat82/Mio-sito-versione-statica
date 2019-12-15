<?php session_start(); ?>
<!doctype html>
<html class="modifica-profilo">
<head>
<meta charset="ISO8859-1">
<title>Modifica il tuo profilo - gocce vini e birre</title>
<link href="css/reset.css" rel="stylesheet" type="text/css">
<link href="css/stili.css" rel="stylesheet" type="text/css">
<link href="css/profilo.css" rel="stylesheet" type="text/css">
<link rel="icon" href="immagini/favicon-gocce.ico" />
</head>
<body>
<?php include('includes/template_header.php'); 	?>
<?php include ('includes/connessione_db.php'); ?>
<?php 
echo "<h2>Modifica il tuo profilo</h2>";
echo "<br>";
echo "<br>";
$mail=$_SESSION["loggato"];
$query = "SELECT * FROM utenti WHERE mail= '".$mail."'";

$risultatoquery = mysqli_query($connessione, $query) or die('vmfkldanblàq');  
//mysql_fetch_array è deprecata dalla versione 5.5.0
	while($riga=mysqli_fetch_array($risultatoquery) ){
	echo "<div class='info'>";
	echo "<form action='profilo.php' method='post'>";
  	echo "<br>";
  	echo "<label>E-mail</label>";
    echo "<input disabled name='mail'type='text' value=".$riga['mail']."></input>";
  	echo "<br>";  
  	echo "<label >Nome</label>";
    echo "<input name='nome' type='text' value=".$riga['nome']."></input>";
  	echo "<br>";
  	echo "<label >Cognome</label>";
    echo "<input name='cognome' type='text' value=".$riga['cognome']."></input>";
    echo "<br>";
  	echo "<label >Ragione Sociale</label>";
    echo "<input name ='ragione_sociale' type='text' value=".$riga['ragione_sociale']."></input>";
    echo "<br>";
  	echo "<label >Codice fiscale / P.IVA</label>";
    echo "<input name='cf_piva' type='text' value=".$riga['cf_piva']."></input>";
    echo "<br>";
  	echo "<label >Indirizzo</label>";
    echo "<input name='indirizzo' type='text' value='".$riga['indirizzo']."'></input>";
    echo "<br>";
  	echo "<label >Comune</label>";
    echo "<input name='nome_comune' type='text' value=".$riga['nome_comune']."></input>";
    echo "<br>";
  	echo "<label >Provincia</label>";
    echo "<input name='nome_provincia' type='text' value=".$riga['nome_provincia']."></input>";
   	echo "<br>";
  	echo "<label >Cap</label>";
    echo "<input name='cap' type='text' value=".$riga['cap']."></input>";
    echo "<br>";
  	echo "<label >Paese</label>";
    echo "<input name='paese' type='text' value=".$riga['paese']."></input>";
    echo "<br>";
  	echo "<label >Telefono</label>";
    echo "<input name='telefono' type='text' value=".$riga['telefono']."></input>";
	echo "<input type=hidden name='first' value='true'>";
    echo "<br>";
   	echo "<input type='submit' value='Conferma le modifiche'></input>";
	echo "</form>";
	}
 ?>
</div>
<?php 
		mysqli_close($connessione); 
			?>
<?php include('includes/template_footer.php'); ?>
</body>
</html>