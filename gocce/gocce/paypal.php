<?php session_start(); 

?>
<!doctype html>
<html class="paypal">
<head>
	<meta charset="ISO8859-1">
	<title>Paypal - gocce vini e birre</title>
	<link href="css/reset.css" rel="stylesheet" type="text/css">
	<link href="css/stili.css" rel="stylesheet" type="text/css">
	<link href="css/carrello.css" rel="stylesheet" type="text/css">
	<link rel="icon" href="immagini/favicon-gocce.ico" />
</head>
<body>
	<?php include('includes/template_header.php'); 	
	include ('includes/connessione_db.php');  ?>
	<?php

$select="SELECT * FROM dettaglio_ordine WHERE id_ordine= ".$_SESSION['generazione_ordine'];
//echo $select;
$risultatoselect = mysqli_query($connessione, $select) or die('ggggggggggggggggggggg'); 
//echo count($risultatoselect);

while($riga_select= mysqli_fetch_array($risultatoselect)) {
//for ($i=0; $i<count($risultatoselect); $i++) {
//$riga_select=mysqli_fetch_row($risultatoselect);
$up="UPDATE prodotti SET pezzi_disponibili= (pezzi_disponibili-".$riga_select['numero_pezzi'].") WHERE id_prodotto= ".$riga_select['id_prodotto']; 
//echo $up;

$risultatoup = mysqli_query($connessione, $up) or die('llllllllllllllllllllll'); 
//$riga_up=mysqli_fetch_array($risultatoup);
}


$ricevuto ="UPDATE ordini SET nome_stato_ordine = 'ricevuto' WHERE id_ordine= ".$_SESSION['generazione_ordine'];
$risultatoricevuto = mysqli_query($connessione, $ricevuto) or die('xxxxxxxxxxxxxxxxxxxxxx'); 
//$riga_ricevuto=mysqli_fetch_array($risultatoricevuto);
//elimino dall'array l'id dell'ordine al cambio di stato del carrello
unset($_SESSION['generazione_ordine']);

mysqli_close($connessione); 
?>
<?php include('includes/template_footer.php');  ?>

</body>
</html>











