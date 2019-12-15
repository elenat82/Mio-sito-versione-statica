<?php session_start(); ?>
<!doctype html>
<html class="amministrazione">
<head>
	<meta charset="ISO8859-1">
	<title>Amministrazione</title>
	<link href="css/amministrazione.css" rel="stylesheet" type="text/css">
	<link rel="icon" href="immagini/favicon-gocce.ico"  />
</head>
<body>
	<div id="logo"> <a href="index.php"><img src="immagini/logo-gocce2.png" alt="logo-gocce" height="100"></a></div>
   
 <?php include ('includes/connessione_db.php'); ?>



<?php
//se i dati provengono dal post aggiornarli
 if (!empty($_POST)) {	
@$nome_prodotto=mysqli_real_escape_string($connessione, trim($_POST['nome_prodotto']));
@$nome_categoria=mysqli_real_escape_string($connessione, trim($_POST['nome_categoria']));
@$descrizione_breve=mysqli_real_escape_string($connessione, trim($_POST['descrizione_breve']));
@$descrizione_lunga=mysqli_real_escape_string($connessione, trim($_POST['descrizione_lunga']));

if (empty($_POST['nome_immagine'])) {
//se nome immagine vuoto
@$nome_immagine = mysqli_real_escape_string($connessione, trim($_POST['vecchia_immagine']));
}
else{
@$nome_immagine=mysqli_real_escape_string($connessione, trim($_POST['nome_immagine']));
}
@$nome_abbinamento=mysqli_real_escape_string($connessione, trim($_POST['nome_abbinamento']));
@$nome_colore=mysqli_real_escape_string($connessione, trim($_POST['nome_colore']));
@$nome_bicchiere=mysqli_real_escape_string($connessione, trim($_POST['nome_bicchiere']));
@$nome_dolcezza=mysqli_real_escape_string($connessione, trim($_POST['nome_dolcezza']));
@$nome_fermezza=mysqli_real_escape_string($connessione, trim($_POST['nome_fermezza']));
@$gradazione=mysqli_real_escape_string($connessione, trim($_POST['gradazione']));
@$temperatura=mysqli_real_escape_string($connessione, trim($_POST['temperatura']));
@$nome_produttore=mysqli_real_escape_string($connessione, trim($_POST['nome_produttore']));
@$nome_regione=mysqli_real_escape_string($connessione, trim($_POST['nome_regione']));
@$annata=mysqli_real_escape_string($connessione, trim($_POST['annata']));
@$cl=mysqli_real_escape_string($connessione, trim($_POST['cl']));
@$prezzo_listino=mysqli_real_escape_string($connessione, trim($_POST['prezzo_listino']));
@$pezzi_disponibili=mysqli_real_escape_string($connessione, trim($_POST['pezzi_disponibili']));
@$sconto=mysqli_real_escape_string($connessione, trim($_POST['sconto']));
$istruzione="UPDATE prodotti SET 
					nome_prodotto = '".$nome_prodotto."',
					nome_categoria = '".$nome_categoria."',
					descrizione_breve = '".$descrizione_breve."',
					descrizione_lunga = '".$descrizione_lunga."',
					nome_immagine = '".$nome_immagine."',
					nome_abbinamento = '".$nome_abbinamento."',
					nome_colore = '".$nome_colore."',
					nome_bicchiere = '".$nome_bicchiere."',
					nome_dolcezza = '".$nome_dolcezza."',
					nome_fermezza = '".$nome_fermezza."',
					gradazione = '".$gradazione."',
					temperatura = '".$temperatura."',
					nome_produttore = '".$nome_produttore."',
					nome_regione = '".$nome_regione."',
					annata = '".$annata."',
					cl = '".$cl."',
					prezzo_listino = '".$prezzo_listino."',
					pezzi_disponibili = '".$pezzi_disponibili."',
					sconto = '".$sconto."'
					WHERE id_prodotto='".$_SESSION['prod_da_modificare']."' ";

					$query_modifica = mysqli_query($connessione, $istruzione);
//echo $istruzione;
if (!$query_modifica) {
	die("Errore nella modifica: " . mysqli_error($connessione));
}
}
?>



    <section id="dashboard">
<div id="riassunto-prodotti">
<h3>Prodotti</h3>
<h4>Categoria vini</h4>
<p><a href="inserisci-prodotto.php">Inserisci un nuovo vino</a></p>
<?php 
//ora i prodotti sono aggiornati se prima c'erano dati nel post
$query_vendita = "SELECT * FROM prodotti WHERE stato_produzione = '1' && nome_categoria = 'vini'";

$risultatoquery_vendita = mysqli_query($connessione, $query_vendita) or die(mysql_error());
echo "<table>";
$i=0;
$n=1;

	while($riga_vendita=mysqli_fetch_array($risultatoquery_vendita)){
		if(($i%2)==0) {
			$colore="rgba(255,255,255,0.5)";
		}
          else {
          	$colore="rgba(192,192,192,0.5)";
          } 
echo "<tr>";
echo "<td>".$n."</td>";
		echo  "<td style='background-color:".$colore.";'>".$riga_vendita['nome_prodotto']."</td>";
		echo "<td><a href='modifica-prodotto.php?id=".$riga_vendita['id_prodotto']."'>Modifica</a></td>";
		echo "<td><a href='cancellazione-prodotto.php?id=".$riga_vendita['id_prodotto']."'>Elimina</a></td>";
		echo "</tr>";
		
		
	$i++;	
	$n++;
	
	}
	echo "</table>";

 ?>

 <h4>Categoria birre</h4>
<p><a href="inserisci-prodotto">Inserisci una nuova birra</a></p>
<?php 
$query_vendita1 = "SELECT * FROM prodotti WHERE stato_produzione = '1' && nome_categoria = 'birre'";

$risultatoquery_vendita1 = mysqli_query($connessione, $query_vendita1) or die(mysql_error());
echo "<table>";
$i1=0;
$n1=1;

	while($riga_vendita1=mysqli_fetch_array($risultatoquery_vendita1)){
		if(($i1%2)==0) {
			$coloreb="rgba(255,255,255,0.5)";
		}
          else {
          	$coloreb="rgba(192,192,192,0.5)";
          } 
echo "<tr>";
echo "<td>".$n1."</td>";
		echo  "<td style='background-color:".$coloreb.";'>".$riga_vendita1['nome_prodotto']."</td>";
		echo "<td><a href='#'>Modifica</a></td><td><a href='#'>Elimina</a></td>";
		echo "</tr>";
		
		
	$i1++;	
	$n1++;
	
	}
	echo "</table>";

 ?>
</div>



<div id="riassunto-clienti">
<h3>Clienti</h3>
<br>
<p><a>Inserisci un nuovo utente</a></p>
<?php 
$query_clienti = "SELECT * FROM utenti WHERE utente_attivo = '1' && livello_accesso = '1'";

$risultatoquery_clienti = mysqli_query($connessione, $query_clienti) or die(mysql_error());
echo "<table>";
$j=0;
$m=1;

	while($riga_clienti=mysqli_fetch_array($risultatoquery_clienti)){
		if(($j%2)==0) {
			$colore1="rgba(255,255,255,0.5)";
		}
          else {
          	$colore1="rgba(192,192,192,0.5)";
          } 
echo "<tr>";
echo "<td>".$m."</td>";
		echo  "<td style='background-color:".$colore1.";'>".$riga_clienti['nome']." ".$riga_clienti['cognome']."</td>";
		echo "<td><a href='#'>Modifica</a></td><td><a href='#'>Elimina</a></td>";
		echo "</tr>";
		
		
	$j++;	
	$m++;
	
	}
	echo "</table>";

 ?>
</div>



    </section>


</body>
</html>