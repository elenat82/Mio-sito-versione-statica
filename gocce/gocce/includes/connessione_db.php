<?php 
$connessione= mysqli_connect("62.149.150.210", "Sql742520", "z63ymqp8me" ) or die('impossibile connettersi al database'); //questa funzione è deprecata dalla versione PHP 5.5.0 (a casa ho la 5.5.11)
mysqli_select_db ($connessione, 'Sql742520_2') or die('fffffffffff');
//prova di una alternativa alla funzione deprecata
//$database=mysql_query("USE db_gocce", $connessione);
 ?>