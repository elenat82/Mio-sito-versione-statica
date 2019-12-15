<?php session_start(); 

?>
<!doctype html>
<html class="indirizzo-spedizione">
<head>
	<meta charset="ISO8859-1">
	<title>Indirizzo spedizione - gocce vini e birre</title>
	<link href="css/reset.css" rel="stylesheet" type="text/css">
	<link href="css/stili.css" rel="stylesheet" type="text/css">
	<link href="css/carrello.css" rel="stylesheet" type="text/css">
	<link rel="icon" href="immagini/favicon-gocce.ico" />
</head>
<body>
	<?php include('includes/template_header.php'); 	
	include ('includes/connessione_db.php');  ?>
	<?php


if (!empty($_POST)) {	
@$nuovo_indirizzo=mysqli_real_escape_string($connessione, trim($_POST['nuovo_indirizzo']));
@$nuovo_comune=mysqli_real_escape_string($connessione, trim($_POST['nuovo_comune']));
@$nuovo_cap=mysqli_real_escape_string($connessione, trim($_POST['nuovo_cap']));
@$nuova_provincia=mysqli_real_escape_string($connessione, trim($_POST['nuova_provincia']));
@$nuovo_paese=mysqli_real_escape_string($connessione, trim($_POST['nuovo_paese']));

$nuovo="UPDATE ordini SET indirizzo = '".$nuovo_indirizzo."',
					nome_comune = '".$nuovo_comune."',
					cap = '".$nuovo_cap."',
					nome_provincia = '".$nuova_provincia."',
					paese = '".$nuovo_paese."'
					
					WHERE id_ordine =".$_SESSION['generazione_ordine'];
					

					$query_nuovo = mysqli_query($connessione, $nuovo);
//echo $istruzione;
if ($query_nuovo<>false) {
	echo "<div class='alert'>";
				echo "<p>Le tue modifiche sono state confermate!</p>";
				
				echo "</div>";
}
} 

else{ 

	
//seleziono i dati dell'utente dalla tabella ordini
	$indir="SELECT indirizzo, nome_comune, cap, nome_provincia, paese FROM ordini WHERE id_ordine=".$_SESSION['generazione_ordine'];
	$query_indir=mysqli_query($connessione, $indir) or die(mysqli_error($connessione));

	echo "<div id='nuovo'>";
	echo "<h2>Se desideri modificare l'indirizzo di spedizione puoi farlo compilando il seguente form:</h2>";
	echo "<br>";
	echo "<br>";
	echo "<form method='post' action=".$_SERVER['PHP_SELF'].">";
	while($righe_indir= mysqli_fetch_array($query_indir)) {
echo "<label>Indirizzo</label>";
echo "<input type='text' name='nuovo_indirizzo' value ='".$righe_indir['indirizzo']."'></input>";

echo "<label>Comune</label>";
echo "<input type='text' name='nuovo_comune' value ='".$righe_indir['nome_comune']."'></input>";

echo "<label>Cap</label>";
echo "<input type='text' name='nuovo_cap' value ='".$righe_indir['cap']."'></input>";
echo "<br>";
echo "<label>Provincia</label>";
echo "<input type='text' name='nuova_provincia' value ='".$righe_indir['nome_provincia']."'></input>";

echo "<label>Paese</label>";
echo "<input type='text' name='nuovo_paese' value ='".$righe_indir['paese']."'></input>";


	}
	echo "<input type='submit' value='Conferma modifiche'>";
	echo "</form>";

echo "</div>";

}//chiusura else



echo "<div id='paga'>";

echo "<form action='paypal.php' method='post'>";

echo "<input type='submit' value='Effettua il pagamento'></input>";
echo "</form>";
echo "</div>";




mysqli_close($connessione); 
?>
<?php include('includes/template_footer.php');  ?>

</body>
</html>