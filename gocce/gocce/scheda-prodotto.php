<?php session_start(); ?>

<!doctype html>
<html class="scheda-prodotto">
<head>
<meta charset="ISO8859-1">
<!--<meta charset="utf-8">-->
<title>Scheda prodotto - gocce vini e birre</title>
<link href="css/reset.css" rel="stylesheet" type="text/css">
<link href="css/stili.css" rel="stylesheet" type="text/css">
<link href="css/scheda-prodotto.css" rel="stylesheet" type="text/css">
<link rel="icon" href="immagini/favicon-gocce.ico" />
</head>
<body>
<?php include('includes/template_header.php'); ?>
<div id="scheda-prodotto">
  <?php
include ('includes/connessione_db.php');
$prodotto=$_GET['id'];
$query = "SELECT * FROM prodotti WHERE id_prodotto = ".$prodotto."";
$risultatoquery = mysqli_query($connessione, $query) or die(mysql_error());  
//mysql_fetch_array è deprecata dalla versione 5.5.0
	while($riga=mysqli_fetch_array($risultatoquery)){

		echo "<div class='scheda-prodotto'>";

		echo  "<h3>".$riga['nome_prodotto']."</h3>";

		echo "<div class='immagine-prodotto'>";
		echo "<img src=".$riga['nome_immagine']." >";
		echo "</div>";

		echo "<div class='descrizioni-prodotto'>";
		echo "<p><span>".$riga['descrizione_breve']."</span></p>";
		echo "<br>";
		echo "<p class='desc'>".$riga['descrizione_lunga']."</p>";
		echo "<br>";
		echo "<div class='acquisto'>";
		//se c'è lo sconto
		if ($riga['sconto']<>0) {
		echo "<p>Sconto applicato</p>";
					echo "<p>".$riga['sconto']."</p>";
					echo "<p>prezzo di listino:".$riga['prezzo_listino']."&#8364;/litro</p>";
		echo "</br>";
	}
echo "<p>prezzo di listino:".$riga['prezzo_listino']."&#8364;/litro</p>";
		echo "<img src='immagini/altre-immagini/aggiungi-al-carrello.png' height='40'>";
		echo "</div>";
		echo "</div>";

		echo "<div class='tabella'>";


		echo "<table>";
			echo "<tr class='alt'>";
				echo "<th>Abbinamento consigliato</th>";
					echo "<td>".$riga['nome_abbinamento']."</td>";
			echo "</tr>";
			echo "<tr>";
				echo "<th>Colore</th>";
					echo "<td>".$riga['nome_colore']."</td>";
			echo "</tr>";
			echo "<tr class='alt'>";
				echo "<th>Bicchiere consigliato</th>";
					echo "<td>".$riga['nome_bicchiere']."</td>";
			echo "</tr>";
			echo "<tr>";
				echo "<th>Dolcezza</th>";
					echo "<td>".$riga['nome_dolcezza']."</td>";
			echo "</tr>";
			echo "<tr class='alt'>";
				echo "<th>Fermezza</th>";
					echo "<td>".$riga['nome_fermezza']."</td>";
			echo "</tr>";
			echo "<tr>";
				echo "<th>Gradazione</th>";
					echo "<td>".$riga['gradazione']."</td>";
			echo "</tr>";
			echo "<tr class='alt'>";
				echo "<th>Temperatura di servizio</th>";
					echo "<td>".$riga['temperatura']."</td>";
			echo "</tr>";
			echo "<tr>";
				echo "<th>Produttore</th>";
					echo "<td>".$riga['nome_produttore']."</td>";
			echo "</tr>";
			echo "<tr class='alt'>";
				echo "<th>Regione</th>";
					echo "<td>".$riga['nome_regione']."</td>";
			echo "</tr>";
			echo "<tr>";
				echo "<th>Annata</th>";
					echo "<td>".$riga['annata']."</td>";
			echo "</tr>";
			echo "<tr class='alt'>";
				echo "<th>Capacit&agrave;</th>";
					echo "<td>".$riga['cl']."</td>";
			echo "</tr>";
			
		echo "</table>";
echo "<br>";
		
		
		echo "</div>";

		
		
		
		
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