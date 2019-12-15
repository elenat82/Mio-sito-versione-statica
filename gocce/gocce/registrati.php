<?php session_start(); ?>
<!doctype html>
<html class="registrati">
<head>
  <meta charset="ISO8859-1">
  <title>Registrati su gocce - vini e birre</title>
  <link href="css/reset.css" rel="stylesheet" type="text/css">
  <link href="css/registrati.css" rel="stylesheet" type="text/css">
  <link rel="icon" href="immagini/favicon-gocce.ico" />
</head>
<body>
  <div id="logo"><img src="immagini/logo-gocce.png" width="240" height="220" alt="logo-gocce"></div>
  <div id="registrazione">
    <h1>Crea il tuo account su <span>gocce </span>ed inizia lo shopping sul tuo store di vini e birre!</h1>
    <br>
    <h2>Inserisci i dati richiesti:</h2>
    <br>
    <?php

    include ('includes/connessione_db.php');


    echo "<form id='idform' action=$_SERVER[PHP_SELF] method='post' name='registrazione'>";
    echo "<input type='hidden' id='hidden1' value ='select.php'</input>";
    ?>
    <p>E-mail</p>
    <input type="text" name="mail" required>
    <br>
    <p>Password</p>
    <input type="password" name="password" required>
    <br>
    <p>Ripeti password</p>
    <input type="password" name="ripeti-password" required>
    <br>
    <p>Nome</p>
    <input type="text" name="nome" required>
    <br>
    <p>Cognome</p>
    <input type="text" name="cognome" required>
    <br>
    <p>Ragione Sociale</p>
    <input type="text" name="ragione-sociale" >
    <br>
    <p>Codice fiscale / Partita IVA </p>
    <input type="text" name="codice-fiscale" >
    <br>
    <p>Indirizzo </p>
    <input type="text" name="indirizzo" >
    <br>
    <?php 



    echo "<p>Provincia</p>";
    $nome_provincia = "SELECT nome_provincia FROM province";
    $risultato_province = mysqli_query($connessione, $nome_provincia); 
    echo "<select id='prov' name='provincia_residenza'>";
    while($riga_province=mysqli_fetch_array($risultato_province)){
      echo "<option value=".$riga_province['nome_provincia'].">".$riga_province['nome_provincia']."</option>";
    }
    echo "</select>";
?>

<script type="text/javascript" src="jquery-1.9.1.js"></script>

<script type="text/javascript">
$(document).ready(function(){
  //$(function () {
  //  $("#prov").change();
  //});

  $('#prov').on('change', function() {
    
//    var formData = $("#idform").serialize() + "&partedoc=table";
    var formData = $("#idform").serialize();
    var url = $("#hidden1").attr('value');
    //alert(''+url);  questo alert concatena l'url e lo fa diventare una stringa e lo mostra a video
//alert(url+" "+formData);
    jQuery.post(url, formData, function(data) {
      //alert(''+data);  questo alert mi fa vedere i dati che vanno a comporre la select del form
      jQuery("#comunidiv").html(data);
    });
  });
});
</script>


<?php


    echo "<p>Comune</p>";


echo "<div id='comunidiv'>";
    
    echo "</div>";

    ?>
    <p>Cap</p>
    <input type="text" name="cap">
    <br>
    <p>Paese</p>
    <input type="text" value="Italia" name="paese">
    <br>
    <p>Telefono</p>
    <input type="text" name="telefono">
    <br>
    <input type="submit" name="iscriviti" value="iscriviti" >
  </form>
</div>
<?php 
@$mail=mysqli_real_escape_string($connessione, trim($_POST["mail"]));
@$password=mysqli_real_escape_string($connessione, trim($_POST["password"]));
@$ripetipassword=mysqli_real_escape_string($connessione, trim($_POST["ripeti-password"]));
@$nome=mysqli_real_escape_string($connessione, trim($_POST["nome"]));
@$cognome=mysqli_real_escape_string($connessione, trim($_POST["cognome"]));
print_r($_POST) ;
//se i primi cinque campi non sono vuoti
if($mail != "" && $password != "" && $ripetipassword != "" && $nome != "" && $cognome != ""){//apertura primo if
			//se il campo password e ripeti password sono uguali
			if ($password == $ripetipassword) {//apertura secondo if
				//se l'utente non è già presente nel database
				$query_utenti="SELECT * FROM utenti WHERE mail='$mail'";
				$risultato = mysqli_query($connessione, $query_utenti);
				$num_righe = mysqli_fetch_array($risultato);
					if ($num_righe==0) {//apertura terzo if
           
           $insert="INSERT INTO utenti (mail, password, nome, cognome) 
          VALUES ('".$mail."','".$password."','".$nome."', '".$cognome."')";

           $query_registrazione = mysqli_query($connessione, $insert); // scrivo sul DB questi valori	
					
          echo "<div class='alert'>";
					echo "<p>Sei stato registrato con successo!</p>";
					echo "<br>";
					echo "<br>";
					echo "<p>Fail il log-in per iniziare il tuo shopping<p>";
					echo "<p>clicca <a href='accedi.php'>qui</a></p>";
					echo "</div>";
					//metto nella session la mail
					$_SESSION["loggato"] = $_POST["mail"];
					}//chiusura terzo if
					else {
           echo "<div class='alert'>";
           echo "<p>Sei gi&agrave; presente nel database!</p>";
           echo "<br>";
           echo "<p>Fail il log-in per iniziare il tuo shopping</p>";
           echo "<p>clicca <a href='accedi.php'>qui</a></p>";
           echo "</div>";
         }
					}//chiusura secondo if
					else {
            echo "<div class='alert'>";
            echo "<p>il campo password ed il campo ripeti password devono essere uguali!</p>";
            echo "<br>";
            echo "<a href='registrati.php'<p>Riprova</p></a>";
            echo "</div>";
          }
}//chiusura primo if
else {//apertura else
  if (isset($_POST["first"])) {
    echo "<input type='hidden' nome='first'value='false'>";
    echo "<div class='alert'>";
    echo "<p>i campi richiesti sono obbligatori</p>";
    echo "<br>";
    echo "<a href='accedi.php'<p>Riprova</p></a>";
    echo "</div>";
	}//chiusura if dentro else
	else {
		echo "<input type='hidden' name='first' value='true'>";
	}
}//chiusura else
?>
<?php
mysqli_close($connessione); 
?>
</body>
</html>