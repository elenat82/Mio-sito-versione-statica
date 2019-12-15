<?php session_start(); ?>
<!doctype html>
<html class="prodotto-inserito">
<head>
<meta charset="ISO8859-1">
<title>Prodotto inserito - gocce vini e birre</title>
<link href="css/reset.css" rel="stylesheet" type="text/css">
<link href="css/stili.css" rel="stylesheet" type="text/css">
<link href="css/scheda-prodotto.css" rel="stylesheet" type="text/css">
<link rel="icon" href="immagini/favicon-gocce.ico" />
</head>
<body>
<?php include('includes/template_header.php'); ?>
<div id="prodotto-inserito">
  <?php
include ('includes/connessione_db.php');
?>



<?php 


@$nome_prodotto=mysqli_real_escape_string($connessione, trim($_POST['nome_prodotto']));
@$nome_categoria=mysqli_real_escape_string($connessione, trim($_POST['nome_categoria']));
@$descrizione_breve=mysqli_real_escape_string($connessione, trim($_POST['descrizione_breve']));
@$descrizione_lunga=mysqli_real_escape_string($connessione, trim($_POST['descrizione_lunga']));
@$nome_immagine=mysqli_real_escape_string($connessione, trim($_POST['nome_immagine']));
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


$inserimento = "INSERT INTO prodotti(
                                      nome_prodotto,
                                      nome_categoria,
                                      descrizione_breve,
                                      descrizione_lunga,
                                      nome_immagine,
                                      nome_abbinamento,
                                      nome_colore,
                                      nome_bicchiere,
                                      nome_dolcezza,
                                      nome_fermezza,
                                      gradazione,
                                      temperatura,
                                      nome_produttore,
                                      nome_regione,
                                      annata,
                                      cl,
                                      prezzo_listino,
                                      pezzi_disponibili,
                                      sconto) VALUES ('".$nome_prodotto."',
                                    '".$nome_categoria."',
                                    '".$descrizione_breve."',
                                    '".$descrizione_lunga."',
                                    'immagini/vini/".$nome_immagine."',
                                    '".$nome_abbinamento."',
                                    '".$nome_colore."',
                                    '".$nome_bicchiere."',
                                    '".$nome_dolcezza."',
                                    '".$nome_fermezza."',
                                    '".$gradazione."',
                                    '".$temperatura."',
                                    '".$nome_produttore."',
                                    '".$nome_regione."',
                                    '".$annata."',
                                    '".$cl."',
                                    ".$prezzo_listino.",
                                    ".$pezzi_disponibili.",
                                    ".$sconto.")";

echo $inserimento."<br>";
$query_inserimento = mysqli_query($connessione, $inserimento);

if ($query_inserimento==true) {
  echo "<p>Prodotto inserito con successo</p>";
  $_SESSION['id_prodinserito']=mysqli_insert_id($connessione);
}
else {
   $_SESSION['id_prodinserito']=-1;
  die("Errore inserimento: " . mysqli_error($connessione));
}




$query = "SELECT * FROM prodotti WHERE id_prodotto = ".$_SESSION['id_prodinserito']."";
$risultatoquery = mysqli_query($connessione, $query) or die(mysql_error());  

	while($riga=mysqli_fetch_array($risultatoquery)){
		echo "<div>";
		echo  "<h3>".$riga['nome_prodotto']."</h3>";
		echo "<img src='".$riga['nome_immagine']."' >";
		echo "<p>prezzo di listino:".$riga['prezzo_listino']."&#8364;/litro</p>";
		echo "<img src='immagini/altre-immagini/aggiungi-al-carrello.png' height='40'>";
		echo "</div>";
		}
?>
</div>
<?php 
			mysqli_close($connessione); 
			?>
<?php include('includes/template_footer.php'); ?>
</body>
</html>