<?php
include ('includes/connessione_db.php');
//mettere mysql escape

    $nome_comune = "SELECT nome_comune FROM comuni WHERE nome_provincia ='".$_POST['provincia_residenza']."'";

    $risultato_comuni=mysqli_query($connessione,$nome_comune) or mysql_error($connessione);
    echo mysqli_error($connessione);


    echo "<select name='comune_residenza'>";

    while($riga_comuni = mysqli_fetch_array($risultato_comuni )){
      echo "<option value=".$riga_comuni['nome_comune'].">".$riga_comuni['nome_comune']."</option>";
    }
    echo "</select>";
    ?>