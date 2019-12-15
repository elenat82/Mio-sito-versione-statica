<?php session_start(); ?>
<!doctype html>
<html class="profilo">
<head>
<meta charset="ISO8859-1">
<title>Il tuo profilo - gocce vini e birre</title>
<link href="css/reset.css" rel="stylesheet" type="text/css">
<link href="css/stili.css" rel="stylesheet" type="text/css">
<link href="css/profilo.css" rel="stylesheet" type="text/css">
<link rel="icon" href="immagini/favicon-gocce.ico" />
</head>
<body>
<?php include('includes/template_header.php'); 	
include ('includes/connessione_db.php');  ?>
<?php 
//if (isset($_POST["first"])) {
if (!empty($_POST)) {	
@$nome=mysql_real_escape_string($connessione, trim($_POST['nome']));
@$cognome=mysql_real_escape_string($connessione, trim($_POST['cognome']));
@$ragione_sociale=mysql_real_escape_string($connessione, trim($_POST['ragione_sociale']));
@$cf_piva=mysql_real_escape_string($connessione, trim($_POST['cf_piva']));
@$indirizzo=mysql_real_escape_string($connessione, trim($_POST['indirizzo']));
@$nome_comune=mysql_real_escape_string($connessione, trim($_POST['nome_comune']));
@$nome_provincia=mysql_real_escape_string($connessione, trim($_POST['nome_provincia']));
@$cap=mysql_real_escape_string($connessione, trim($_POST['cap']));
@$paese=mysql_real_escape_string($connessione, trim($_POST['paese']));
@$telefono=mysql_real_escape_string($connessione, trim($_POST['telefono']));
$istruzione="UPDATE utenti SET 
					nome = '".$nome."',
					cognome = '".$cognome."',
					ragione_sociale = '".$ragione_sociale."',
					cf_piva = '".$cf_piva."',
					indirizzo = '".$indirizzo."',
					nome_comune = '".$nome_comune."',
					nome_provincia = '".$nome_provincia."',
					cap = '".$cap."',
					paese = '".$paese."',
					telefono = '".$telefono."' 
					WHERE mail='".$_SESSION['loggato']."' ";
					$query_modifica = mysqli_query($connessione, $istruzione);
//echo $istruzione;
if (!$query_modifica) {
	die("Errore nella modifica: " . mysqli_error($connessione));
}
}
echo "<h2>Il tuo profilo</h2>";
echo "<br>";
echo "<br>";
$mail=$_SESSION["loggato"];
$query = "SELECT * FROM utenti WHERE mail= '".$mail."'";
// qui mi dice "no database selected perchè la funzione di sopra è deprecata"
$risultatoquery = mysqli_query($connessione, $query) or die('vmfkldanblàq');  
//mysql_fetch_array è deprecata dalla versione 5.5.0
while($riga=mysqli_fetch_array($risultatoquery) ){
		echo "<div class='info'>";
		echo "<table>";
  		echo "<tr class='alt'>";
  		echo "<th >E-mail</th>";
    	echo "<td >".$riga['mail']."</td>";
      	echo "</tr>";
  		echo "<tr>";
  		echo "<th >Nome</th>";
    	echo "<td >".$riga['nome']."</td>";
      	echo "</tr>";
  		echo "<tr class='alt'>";
  		echo "<th >Cognome</th>";
    	echo "<td >".$riga['cognome']."</td>";
      	echo "</tr>";
  		echo "<tr>";
  		echo "<th >Ragione Sociale</th>";
    	echo "<td >".$riga['ragione_sociale']."</td>";
      	echo "</tr>";
  		echo "<tr class='alt'>";
  		echo "<th >Codice fiscale / P.IVA</th>";
    	echo "<td >".$riga['cf_piva']."</td>";
      	echo "</tr>";
  		echo "<tr>";
  		echo "<th >Indirizzo</th>";
    	echo "<td >".$riga['indirizzo']."</td>";
      	echo "</tr>";
  		echo "<tr class='alt'>";
  		echo "<th >Comune</th>";
    	echo "<td >".$riga['nome_comune']."</td>";
      	echo "</tr>";
  		echo "<tr>";
  		echo "<th >Provincia</th>";
    	echo "<td >".$riga['nome_provincia']."</td>";
      	echo "</tr>";
  		echo "<tr class='alt'>";
  		echo "<th >Cap</th>";
    	echo "<td >".$riga['cap']."</td>";
      	echo "</tr>";
  		echo "<tr>";
  		echo "<th >Paese</th>";
    	echo "<td >".$riga['paese']."</td>";
      	echo "</tr>";
  		echo "<tr class='alt'>";
  		echo "<th >Telefono</th>";
    	echo "<td >".$riga['telefono']."</td>";
      	echo "</tr>";
		echo "</table>";	
	}
 ?>

<p><a href="modifica-profilo.php">Modifica i tuoi dati</a></p>

</div>
<?php 
			mysqli_close($connessione); 
			?>
<?php include('includes/template_footer.php');  ?>

</body>
</html>