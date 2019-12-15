<?php session_start(); ?>
<!doctype html>
<html class="accedi">
<head>
<meta charset="ISO8859-1">
<title>Accedi a gocce - vini e birre</title>
<link href="css/reset.css" rel="stylesheet" type="text/css">
<link href="css/accedi.css" rel="stylesheet" type="text/css">
<link rel="icon" href="immagini/favicon-gocce.ico" />
</head>
<body>
<div id="logo"><a href="index.php"><img src="immagini/logo-gocce.png" width="240" height="220" alt="logo-gocce"></a></div>
<div id="accesso">
  <h1>Accedi al tuo account su <span>gocce </span>ed inizia lo shopping sul tuo store di vini e birre!</h1>
  <br>
  <h2>Inserisci i dati richiesti:</h2>
  <br>
  <?php include ('includes/connessione_db.php'); ?>
  <?php	echo "<form action='$_SERVER[PHP_SELF]' method='post' name='registrazione'>"; ?>
  <p>E-mail</p>
  <input type="text" name="mail" required>
  <br>
  <p>Password</p>
  <input type="password" name="password" required>
  <br>
  <input type="submit" name="accedi" value="accedi" >
  </form>
</div>
<?php 
if(@$_POST["mail"] != "" && @$_POST["password"]!= "" ){//se i due campi non sono vuoti
$query_utenti="SELECT * FROM utenti WHERE mail='$_POST[mail]' AND password='$_POST[password]'";
$risultato = mysqli_query($connessione, $query_utenti) or die(mysql_error());
	if ('mysqli_query'==false) {//se non viene trovato nessun utente nel database
	echo "Errore nell'esecuzione della query";
	}//chiusura secondo if
	$num_righe = mysqli_num_rows($risultato) or die(mysql_error());
	
		if ($num_righe == 1) {//se viene trovato un solo risultato corrispondente
			while($riga=mysqli_fetch_array($risultato)){
			if ($riga['livello_accesso']=='0') {//se il risultato è l'amministratore
			$_SESSION["admin"]=$_POST["mail"];
			echo "<div class='alert'>";
				echo "<p>Benvenuto amministratore!</p>";
				echo "<p>Accedi al tuo sito cliccando <a href='index.php'>qui</a></p>";
				echo "<br>";
				echo "</div>";
			}//chiusura quarto if dentro il terzo if
			
				else {//se il risultato è uno solo ma non è amministratore
				echo "<div class='alert'>";
				echo "<p>Benvenuto!</p>";
				echo "<br>";
				echo "<p>Inizia il tuo shopping cliccando <a href='index.php'>qui</a></p>";
				echo "<br>";
				echo "</div>";
				//metto nella session la mail
				$_SESSION["loggato"] = $_POST["mail"];
				$_SESSION["id_loggato"] =$riga["id_utente"];
				
				}//chiusura else del quarto if
				}//chiusura while

		}//chiusura terzo if
	
	else {//se viene trovato più di un risultato corrispondente
	echo "<div class='alert'>";
	echo "<p>Accesso non eseguito!</p>";
	echo "<br>";
	echo "<a href='accedi.php'<p>Riprova</p></a>";
	echo "</div>";
	}//chiusura else del secondo if

}//chiusura del primo if
else {//se  i campi sono vuoti
if (isset($_POST["first"])) {//se sono stati inviati dati tramite il post vuol dire che non è il primo accesso
echo "<input type='hidden' nome='first'value='false'>";
echo "<div class='alert'>";
echo "<p>i campi richiesti sono obbligatori</p>";
echo "<br>";
echo "<a href='accedi.php'<p>Riprova</p></a>";
echo "</div>";
}//chiusura if dentro else
else {//apertura else dentro else del primo if
//e npon sono stati inviati dati tramite il post vuol dire che è il primo accesso 
echo "<input type='hidden' name='first' value='true'>";
}//chiusura else dentro else
}//chiusura else



				 ?>
<?php
mysqli_close($connessione); 
?>
</body>
</html>
