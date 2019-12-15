<?php session_start(); ?>
<!doctype html>
<html class="carrello">
<head>
<meta charset="ISO8859-1">
<title>Scegli la quantit&agrave; - gocce vini e birre</title>
<link href="css/reset.css" rel="stylesheet" type="text/css">
<link href="css/stili.css" rel="stylesheet" type="text/css">
<link href="css/carrello.css" rel="stylesheet" type="text/css">
<link rel="icon" href="immagini/favicon-gocce.ico" />
</head>
<body>
<?php include('includes/template_header.php'); 
include ('includes/connessione_db.php');  	
	 ?>

<div id="pagina-quantita">
  
  <br>
  <h2>Scegli la quantit&agrave;</h2>
  <?php

  //l'id del prodotto mi arriva dal get
  $acquistato=$_GET["id"];

  //l'id dell'utente mi arriva dalla session $_SESSION["id_loggato"]

//seleziono il prodotto il cui id corrisponde a quello che mi arriva dal get
$query_prodotto_acquistato = "SELECT * FROM prodotti WHERE id_prodotto = ".$acquistato."";
$risultatoquery_prodotto_acquistato= mysqli_query($connessione, $query_prodotto_acquistato) or die(mysql_error());
	while($riga_prodotto_acquistato=mysqli_fetch_array($risultatoquery_prodotto_acquistato)){
		$nome_prodotto=$riga_prodotto_acquistato['nome_prodotto'];
    $id_prodotto=$riga_prodotto_acquistato['id_prodotto'];
    $prezzo_prodotto=$riga_prodotto_acquistato['prezzo_listino'];

	
echo "<div class='car'>";
    echo "<table>";
      echo "<tr>";
      echo "<th >ID prodotto</th>";
      echo "<td >".$id_prodotto."</td>";
        
      echo "<th >Nome prodotto</th>";
      echo "<td >".$nome_prodotto."</td>";
        
      echo "<th >Prezzo</th>";
      echo "<td >".$prezzo_prodotto."</td>";
        
      echo "<th >Seleziona la quantit&agrave;</th>";
      echo "<td ><form action='riepilogo-carrello.php' method='post'>";
      echo "<select name='quantita'>";
      echo "<option value='6'>6 bottiglie</option>";
      echo "<option value='12'>12 bottiglie</option>";
      echo "<option value='18'>18 bottiglie</option>";
      echo "<option value='24'>24 bottiglie</option>";
      echo "<option value='30'>30 bottiglie</option>";
      echo "<option value='36'>36 bottiglie</option>";
      echo "<option value='42'>42 bottiglie</option>";
      echo "<option value='48'>48 bottiglie</option>";
      echo "<option value='54'>54 bottiglie</option>";
      echo "<option value='60'>60 bottiglie</option>";
      echo "</select>";

      echo "<input type='hidden' name='idpr' value='".$id_prodotto."'></input>";
      echo "<input type='hidden' name='prezzo' value='".$prezzo_prodotto."'></input>";

      echo "<input type='submit' value='scegli'></input></td>";
      echo "</form>";
        echo "</tr>";
   echo "</table>"; 

}
   echo "<br>"; 
echo "<small>per quantit&agrave; superiori alle 60 bottiglie per prodotto contattre il servizio clienti attraverso l'apposito form nella pagina Contatti</small>";
?>
</div>
<br>
<br>
<br>
<?php 
			mysqli_close($connessione); 
			?>
<?php include('includes/template_footer.php'); ?>
</body>
</html>