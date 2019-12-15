<?php session_start(); ?>
<!doctype html>
<html class="catalogo-vini">
<head>
<meta charset="ISO8859-1">
<title>Catalogo vini - gocce vini e birre</title>
<link href="css/reset.css" rel="stylesheet" type="text/css">
<link href="css/stili.css" rel="stylesheet" type="text/css">
<link href="css/vini.css" rel="stylesheet" type="text/css">
<link rel="icon" href="immagini/favicon-gocce.ico" />
</head>
<body>
<?php include('includes/template_header.php'); 
include ('includes/connessione_db.php');?>
<section>
  <h2>Affina la tua ricerca</h2>

  <h2>Scegli per regione</h2>
<?php 
  echo "<form action=".$_SERVER['PHP_SELF']." method='post'>";

$query_regioni = "SELECT DISTINCT nome_regione FROM prodotti WHERE nome_categoria='vini'";
$risultatoquery_regioni = mysqli_query($connessione, $query_regioni)  or die(mysql_error());

  while($riga_regioni=mysqli_fetch_array($risultatoquery_regioni)){

echo "<input type='checkbox' name='regione[]' value='".$riga_regioni['nome_regione']."'>".$riga_regioni['nome_regione']."</input><br>";

}
 ?>

  <h2>Scegli per tipologia</h2>
  <?php  
$query_colore = "SELECT DISTINCT nome_colore FROM prodotti WHERE nome_categoria='vini'";
$risultatoquery_colore = mysqli_query($connessione, $query_colore)  or die(mysql_error());

  while($riga_colore=mysqli_fetch_array($risultatoquery_colore)){

echo "<input type='checkbox' name='colore[]' value='".$riga_colore['nome_colore']."'>".$riga_colore['nome_colore']."</input><br>";

}
 ?>
  <h2>Scegli per fascia</h2>
  
<input type='checkbox' name='prezzo[]' value='0-10'>da 0 a 10 &euro;</input><br>
<input type='checkbox' name='prezzo[]' value='11-30'>da 11 a 30 &euro;</input><br>
<input type='checkbox' name='prezzo[]' value='31-10000000000'>oltre 30 &euro;</input><br>
  <?php  
//$query_prezzo = "SELECT DISTINCT prezzo_listino FROM prodotti WHERE nome_categoria='vini' ORDER BY prezzo_listino ASC";
//$risultatoquery_prezzo = mysqli_query($connessione, $query_prezzo)  or die(mysql_error());

  //while($riga_prezzo=mysqli_fetch_array($risultatoquery_prezzo)){

//echo "<input type='checkbox' name='prezzo[]' value='".$riga_prezzo['prezzo_listino']."'>".$riga_prezzo['prezzo_listino']."</input><br>";

//}

 ?>
<br>
<input type="submit" value="applica filtri" name="filtri"></input>


</form >

<!-- siccome non rimangono ceccati i filtri che ho scelto li faccio visualizzare -->
<?php 
  

  ?>


<!-- faccio un altro form per selezionare di nuovo tutti i vini -->
<?php 
  echo "<form action=".$_SERVER['PHP_SELF']." method='post'>";
  ?>
<br>
<br>
  <input type='checkbox' name='tutti' >Tutti i vini</input><br>
  <br>
  <input type='submit'value="conferma" name="tutti"></input>
  </form>

</section>
<div id="catalogo-vini">
  <?php

//numero di record da mostrare in ogni pagina 
$rec = 20;
// Recupero il numero di pagina corrente.
$page=0;
$j=$page+10;
//se viene passato un numero di pagina tramite url impostalo come valore di $page
if (@$_GET["page"]) {
$page=$_GET["page"];
$j=$page+10;
}
else {
	$page=1;
}


//se non è stato premuto il bottone imposta filtri
if(empty($_POST['filtri'])) {
  //allora seleziona tutti i prodotti
  $criteriofiltri="id_prodotto>-1";
}
else {
    //se è stato premuto il bottone seleziona comunque tutti i prodotti e poi aggiungi il criterio regione
    $criteriofiltri="id_prodotto>-1";
    //$regione è un array
    //se non è vuota la scelta della regione
    if(!empty($_POST['regione'])) {

      $regione=$_POST['regione'];
      //print_r($regione);
    
      if (count($regione) > 0) {

        $criteriofiltri.= (" and nome_regione in (");

        for ($i=0; $i<count($regione); $i++) {

          $criteriofiltri.= ("'".$regione[$i]."', ");
        }

        $criteriofiltri.= ("'__')");
      }

    }


    //se non è vuota la scelta del colore
if(!empty($_POST['colore'])) {

    $colore=$_POST['colore'];
    //print_r($regione);
  
    if (count($colore) > 0) {

      $criteriofiltri.= (" and nome_colore in (");

      for ($i=0; $i<count($colore); $i++) {

        $criteriofiltri.= ("'".$colore[$i]."', ");
      }

      $criteriofiltri.= ("'__')");
    }
  }

if(!empty($_POST['prezzo'])) {
    $prezzo=$_POST['prezzo'];
    //print_r($regione);
  
    if (count($prezzo) > 0) {

      for ($i=0; $i<count($prezzo); $i++) {

        $criteriofiltri.= (" and (prezzo_listino BETWEEN ");

        $prezzoTMP = explode("-", $prezzo[$i]);

        $criteriofiltri.= $prezzoTMP[0] . " AND " . $prezzoTMP[1];
        
        $criteriofiltri.= (") ");
      }

    }
  }

  }//chiusura dell'else dell'if se il bottone filtri è stato premuto


if (!empty($_POST['tutti'])) {
  $criteriofiltri="id_prodotto>-1";
}
echo "<div class='filtri-selezionati'";
echo "<p>Hai applicato i seguenti filtri: </p>";
echo "<br>";
echo "<p><span>Regione:     </span> ";
for ($r=0; $r<count(@$regione); $r++) {

         echo @$regione[$r].",   ";
        }

        echo "<span>Colore:     </span>";
for ($s=0; $s<count(@$colore); $s++) {

         echo @$colore[$s].",   ";
        }

        echo "<span>Fascia di prezzo:     </span>";
for ($f=0; $f<count(@$prezzo); $f++) {

         echo @$prezzo[$f]."   </p>";
        }
echo "</div>";


$query="SELECT id_prodotto FROM prodotti WHERE ".$criteriofiltri ;
//echo $query;


// Uso mysql_num_rows per contare il totale delle righe presenti all'interno della tabella agenda
$tutte_le_righe = mysqli_num_rows(mysqli_query($connessione, $query));
// Tramite una semplice operazione matematica definisco il numero totale di pagine
$totale_pagine = ceil($tutte_le_righe / $rec);
// Calcolo da quale record iniziare
$first = ($page - 1) * $rec;
$query = "SELECT * FROM prodotti WHERE nome_categoria='vini' AND ".$criteriofiltri." ORDER BY id_prodotto LIMIT " .$first.", ".$rec;
$risultatoquery = mysqli_query($connessione, $query)  or die(mysql_error());
//$i=0;
  while($riga=mysqli_fetch_array($risultatoquery)){
//    $i++;
    echo "<div class='singolo-prodotto'>";
        echo  "<h3>".$riga['nome_prodotto']."</h3>";
    //echo "<p class='breve'>".$riga['descrizione_breve']."</p>";
    echo "<a href=scheda-prodotto.php?id=".$riga['id_prodotto']." target='_blank'><img src=".$riga['nome_immagine']." height='200'></a>";
    echo "<p>prezzo di listino:".$riga['prezzo_listino']."&#8364;/litro</p>";
    echo "<a href='quantita.php?id=".$riga['id_prodotto']."' target='_blank'><img src='immagini/altre-immagini/aggiungi-al-carrello.png' height='40'></a>";
    echo "</div>";
    }




 ?>
  <ul>
    <?php
// Se le pagine totali sono più di 1...
// stampo i link per andare avanti e indietro tra le diverse pagine!
if ($totale_pagine > 1){
  if ($page> 1){
    echo "<li class='prec'><a href=".$_SERVER['PHP_SELF']."?page=".($page - 1).">";
    echo "Pagina Indietro</a>&nbsp;</li>";
  } 
  if ($totale_pagine > $page){
    echo "<li class='succ'><a href=".$_SERVER['PHP_SELF']."?page=".($page + 1).">";
    echo "Pagina Avanti</a></li>";
  } 
}
?>
  </ul>
</div>
<?php 
      mysqli_close($connessione); 
      ?>
<?php include('includes/template_footer.php'); ?>



</body>
</html>