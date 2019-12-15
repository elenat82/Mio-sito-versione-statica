<?php session_start(); ?>
<!doctype html>
<html class="modifica-prodotto">
<head>
<meta charset="ISO8859-1">
<title>Modifica il prodotto - gocce vini e birre</title>
<link href="css/reset.css" rel="stylesheet" type="text/css">
<link href="css/amministrazione.css" rel="stylesheet" type="text/css">
<link rel="icon" href="immagini/favicon-gocce.ico" />
</head>
<body>
  <div id="logo"> <a href="index.php"><img src="immagini/logo-gocce2.png" alt="logo-gocce" height="100"></a></div>
<?php include ('includes/connessione_db.php'); ?>
<?php 
echo "<h2>Modifica il prodotto</h2>";
echo "<br>";
echo "<br>";
$prod=$_GET["id"];
$query = "SELECT * FROM prodotti WHERE id_prodotto= '".$prod."'";

$risultatoquery = mysqli_query($connessione, $query) or die('vmfkldanblàq');  
//mysql_fetch_array è deprecata dalla versione 5.5.0
	while($riga=mysqli_fetch_array($risultatoquery) ){
	echo "<div class='infoprod'>";
	echo "<form action='amministrazione.php' method='post'>";
  	echo "<br>";
  	echo "<label>Nome prodotto</label>";
    echo "<input name='nome_prodotto' type='text' value='".$riga['nome_prodotto']."'></input>";
  	echo "<br>";  
  	echo "<label >Categoria</label>";
    echo "<input name='nome_categoria' type='text' value='".$riga['nome_categoria']."'></input>";
  	echo "<br>";
  	echo "<label >Descrizione breve</label>";
    echo "<textarea name='descrizione_breve'>".$riga['descrizione_breve']."</textarea>";
    echo "<br>";
    echo "<label >Descrizione lunga</label>";
    echo "<textarea name='descrizione_lunga'>".$riga['descrizione_lunga']."</textarea>";
    echo "<br>";
  	echo "<label >Immagine</label>";
	echo "<img src='".$riga['nome_immagine']."'>";
    echo "<input name ='nome_immagine' type='file' value='".$riga['nome_immagine']."'></input>";
    echo "<br>";
  	echo "<label >Abbinamento</label>";
    echo "<input name='nome_abbinamento' type='text' value='".$riga['nome_abbinamento']."'></input>";
    echo "<br>";
  	echo "<label >Colore</label>";
    echo "<input name='nome_colore' type='text' value='".$riga['nome_colore']."'></input>";
    echo "<br>";
  	echo "<label >Bicchiere</label>";
    echo "<input name='nome_bicchiere' type='text' value='".$riga['nome_bicchiere']."'></input>";
    echo "<br>";
  	echo "<label >Dolcezza</label>";
    echo "<input name='nome_dolcezza' type='text' value='".$riga['nome_dolcezza']."'></input>";
   	echo "<br>";
  	echo "<label >Fermezza</label>";
    echo "<input name='nome_fermezza' type='text' value='".$riga['nome_fermezza']."'></input>";
    echo "<br>";
  	echo "<label >Gradazione</label>";
    echo "<input name='gradazione' type='text' value='".$riga['gradazione']."'></input>";
    echo "<br>";
  	echo "<label >Temperatura</label>";
    echo "<input name='temperatura' type='text' value='".$riga['temperatura']."'></input>";
    echo "<br>";
echo "<label >Produttore</label>";
    echo "<input name='nome_produttore' type='text' value='".$riga['nome_produttore']."'></input>";
    echo "<br>";
    echo "<label >Regione</label>";
    echo "<input name='nome_regione' type='text' value='".$riga['nome_regione']."'></input>";
    echo "<br>";
    echo "<label >Annata</label>";
    echo "<input name='annata' type='text' value='".$riga['annata']."'></input>";
    echo "<br>";
echo "<label >Cl</label>";
    echo "<input name='cl' type='text' value='".$riga['cl']."'></input>";
    echo "<br>";
    echo "<label >Prezzo di listino</label>";
    echo "<input name='prezzo_listino' type='text' value='".$riga['prezzo_listino']."'></input>";
    echo "<br>";
    echo "<label >Pezzi disponibili</label>";
    echo "<input name='pezzi_disponibili' type='text' value='".$riga['pezzi_disponibili']."'></input>";
    echo "<br>";
echo "<label >Sconto</label>";
    echo "<input name='sconto' type='text' value='".$riga['sconto']."'></input>";
    echo "<br>";
	echo "<input type=hidden name='vecchia_immagine' value='".$riga['nome_immagine']."'>";
	echo "<input type=hidden name='first' value='true'>";
    echo "<br>";
   	echo "<input type='submit' value='Conferma le modifiche'></input>";
	echo "</form>";


  //metto nella sessione l'id del prodotto da modificare
$_SESSION['prod_da_modificare']=$riga['id_prodotto'];
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