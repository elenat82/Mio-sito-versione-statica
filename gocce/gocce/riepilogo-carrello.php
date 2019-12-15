<?php session_start(); 

//unset($_SESSION);
//if (true) {
//return;
//}
?>
<!doctype html>
<html class="riepilogo-carrello">
<head>
	<meta charset="ISO8859-1">
	<title>Riepilogo carrello - gocce vini e birre</title>
	<link href="css/reset.css" rel="stylesheet" type="text/css">
	<link href="css/stili.css" rel="stylesheet" type="text/css">
	<link href="css/carrello.css" rel="stylesheet" type="text/css">
	<link rel="icon" href="immagini/favicon-gocce.ico" />
</head>
<body>
	<?php include('includes/template_header.php'); 	
	include ('includes/connessione_db.php');  ?>
	<?php
	$temp1=0;
//se non mi arriva niente dal post (quindi l'utente sta solo visualizzando il carrello e non ha cliccato su Aggiungi al carrello)
if (empty($_POST)) {

	//controllo se esiste già un carrello
$contr="SELECT * FROM (ordini JOIN dettaglio_ordine on ordini.id_ordine=dettaglio_ordine.id_ordine) JOIN prodotti on dettaglio_ordine.id_prodotto=prodotti.id_prodotto WHERE ordini.id_utente = ".$_SESSION['id_loggato']." AND ordini.nome_stato_ordine ='carrello'";
$query_contr = mysqli_query($connessione, $contr) or die(mysqli_error($connessione));

echo "<table id='tabcar'>";
if ($query_contr<>false AND mysqli_num_rows($query_contr)>0 AND (isset($_SESSION['generazione_ordine']))) {


while($righe_contr= mysqli_fetch_array($query_contr)) {
echo "<tr>";
      echo "<th >Nome prodotto</th>";
	echo "<td>".$righe_contr['nome_prodotto']."</td>";
	echo "<th >Quantit&agrave; selezionata</th>";
	echo "<td>".$righe_contr['numero_pezzi']."  bottiglie</td>";
	echo "<th >Prezzo d'acquisto</th>";
	echo "<td>".$righe_contr['prezzo_vendita']."  Euro </td>";
	//print_r($righe_contr);
	echo "<td><a href='rimuovi-dal-carrello.php?id=".$righe_contr['12']."'>Rimuovi dal carrello</a></td>";
//print_r($righe_contr);
	echo "</tr>";	   
}//chiusura while 
$tot="SELECT SUM(numero_pezzi*prezzo_vendita) as totale from dettaglio_ordine WHERE id_ordine = ".$_SESSION['generazione_ordine'];
   $query_tot=mysqli_query($connessione, $tot) or die(mysqli_error($connessione));
   $riga_tot = mysqli_fetch_array($query_tot);

   $temp1=$riga_tot['totale'];
}//chiusura if diverso da false
else {
	echo "<p>Non ci sono prodotti nel carrello</p>";
}


   echo "</table>"; 

   
	echo "<div id='tot'>";
   echo "<p>totale imponibile: ".$temp1."</p>";
  
   echo "<p>Iva:".($temp1*0.2)."</p>";
   
   echo "<p>Totale pagamento:<strong>".($temp1*1.2)."</strong></p>";
   
   echo "</div>";
}//chiusura if empty

else {
//seleziono i dati dell'utente da mandare nascosti per riempire la tabella ordini
	$default="SELECT indirizzo, nome_comune, cap, nome_provincia, paese FROM utenti WHERE id_utente=".$_SESSION['id_loggato'];
	$query_default=mysqli_query($connessione, $default) or die(mysqli_error($connessione));
	$row=mysqli_fetch_row($query_default);



if (!isset($_SESSION['generazione_ordine'])) {
//riempio la tabella ordini con i valori di default e automaticamente si genera l'id ordine
	$ordine= "INSERT INTO ordini 
	(id_utente, 
		indirizzo, 
		nome_comune,
		cap, 
		nome_provincia, 
		paese) 
VALUES (".$_SESSION['id_loggato'].", 
	'".$row[0]."',
	'".$row[1]."',
	'".$row[2]."',
	'".$row[3]."',
	'".$row[4]."')";

//$row[0] è l'indirizzo, 1 è il cap ecc. ecc.
$risultato_ordine=mysqli_query($connessione, $ordine) or die(mysqli_error($connessione));

//echo $ordine;     //questa query è giusta
//selezione l'ultimo id ordine inserito
//echo mysqli_insert_id($connessione);
//$generazione_ordine="SELECT id_ordine FROM ordini WHERE id_ordine= ".mysqli_insert_id($connessione);
//$query_gen=mysqli_query($connessione, $generazione_ordine) or die(mysqli_error($connessione));
//$riga_gen=mysqli_fetch_row($query_gen);
//metto nella sessione l'id dell'ordine
$_SESSION['generazione_ordine']=mysqli_insert_id($connessione);
}
//print_r($_SESSION);




$carrello = "INSERT INTO dettaglio_ordine (
	id_ordine, 
	id_prodotto,
	numero_pezzi,
	prezzo_vendita) 
VALUES 
(".$_SESSION['generazione_ordine'].",
	".@$_POST['idpr'].",
	".@$_POST['quantita'].",
	".@$_POST['prezzo'].")";
echo "<br>";
//echo "kkkkkkkkkkkkk".$carrello;
//print_r($_POST);


$query_carrello = mysqli_query($connessione, $carrello) or die(mysqli_error($connessione));

$dett="SELECT prodotti.nome_prodotto, dettaglio_ordine.id_prodotto, dettaglio_ordine.numero_pezzi, dettaglio_ordine.prezzo_vendita FROM dettaglio_ordine RIGHT JOIN prodotti on prodotti.id_prodotto=dettaglio_ordine.id_prodotto WHERE  id_ordine = ".$_SESSION['generazione_ordine'] ;
//echo $dett;
$query_dett = mysqli_query($connessione, $dett) or die(mysqli_error($connessione));
//$righe_dett = mysqli_fetch_row($query_dett);


echo "<h2 id='riepcar'>Riepilogo carrello:</h2>";
echo "<table id='tabcar'>";

while($righe_dett= mysqli_fetch_row($query_dett)) {

	echo "<tr>";
      echo "<th >Nome prodotto</th>";
	echo "<td>".$righe_dett[0]."</td>";
	echo "<th >Quantit&agrave; selezionata</th>";
	echo "<td>".$righe_dett[2]."  bottiglie</td>";
	echo "<th >Prezzo d'acquisto</th>";
	echo "<td>".$righe_dett[3]."  Euro </td>";
	echo "<td><a href='rimuovi-dal-carrello.php?id=".$righe_dett[1]."'>Rimuovi dal carrello</a></td>";
	echo "</tr>";
}

echo "</table>";
$tot="SELECT SUM(numero_pezzi*prezzo_vendita) as totale from dettaglio_ordine WHERE id_ordine = ".$_SESSION['generazione_ordine'];
   $query_tot=mysqli_query($connessione, $tot) or die(mysqli_error($connessione));
   $riga_tot = mysqli_fetch_array($query_tot);
	echo "<div id='tot'>";
   echo "<p>totale imponibile: ".$riga_tot['totale']."</p>";
  
   echo "<p>Iva:".($riga_tot['totale']*0.2)."</p>";
   
   echo "<p>Totale pagamento:<strong>".($riga_tot['totale']*1.2)."</strong></p>";
   
   echo "</div>";
}//chiusura dell'else dell'if empty
?>

<form method="post" action="indirizzo-spedizione.php">
	<input type="submit" value="Procedi con l'ordine"></input>
</form>
<?php 
mysqli_close($connessione); 
?>
<?php include('includes/template_footer.php');  ?>

</body>
</html>