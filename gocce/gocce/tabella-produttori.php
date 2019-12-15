<?php 
//inizio la connessione
$c=mysql_connect("localhost", "user_gocce", "pwgocce2015" ) or die('impossibile connettersi al database');
//scelgo il database
mysql_select_db("db_gocce", $c);

$queryprod = "UPDATE produttori SET nome_categoria = 'vini' WHERE id_produttore>1";

$risultatoqueryprod = mysql_query($queryprod);



echo $queryprod."<br>";



mysql_close($c);
 ?>