<?php
//	ob_start();
	session_start();

//	if(!isset($_POST['Submit']))
//		return;

//	$username = $_POST['username'];
//	$pass = $_POST['password'];

if($_POST){
	$username = $_SESSION['login'];
	$pass = $_SESSION['password'];
	$nome_prof = $_POST['nome_prof'];

	$cognome = $_POST['cognome'];
	$nome = $_POST['nome'];
	$classe = $_POST['classe'];

	$materia = $_POST['materia'];
	$voto = $_POST['voto'];

	$conn = @mysql_connect("localhost","root","");
	@mysql_select_db("registro_classe", $conn) or die("database non trovato");
	$sql="SELECT login,password FROM Docenti WHERE login='$username' and password='$pass'";

	$ris = @mysql_query($sql) or die("query fallita 1");
	$righe = mysql_num_rows($ris);
	if ($righe==0){
		mysql_close($conn);
		echo "<a href='a_1.php'>Errore, utente non valido</a>";
		exit;
	}

	$sql="SELECT Chiave,Cognome,Nome,Classe FROM allievi WHERE Cognome='$cognome' and Nome='$nome' and Classe='$classe'";
	$query_alunni = @mysql_query($sql) or die("query fallita 2");

	$righe = mysql_num_rows($query_alunni);
	if (($righe == 0) || ($righe > 1)){
		mysql_close($conn);
		echo "<a href='a_1.php'>Errore, alunno non valido, oppure esistono più alunni con gli stessi dati</a>";
		exit;
	}

	$sql = "SELECT Chiave,Nome FROM Materie WHERE nome='$materia'";
	$query_materie = @mysql_query($sql) or die("query fallita 3");
	$righe = mysql_num_rows($query_materie);
	if($righe == 0){
		mysql_close($conn);
		echo "<a href='a_1.php'>Errore, materia non valida</a>";
		exit;
	}

	$riga = mysql_fetch_array($query_alunni);
	$idalunno = $riga["Chiave"];
//	echo $idalunno." , ";
//	echo $riga["Cognome"] . " , ";
//	echo $riga["Nome"] . " , ";
//	echo $riga["Classe"]."<HR>";
	$id_mat = mysql_result($query_materie,0,0);
	$mat = mysql_result($query_materie,0,1);
//	echo "La materia prescelta per l'inserimento è: ".$mat."<BR>";
	$data2 = "2012-11-11";

//se il campo data2 sul database è di tipo date usare la funzione mysql STR_TO_DATE
//	$sql="INSERT INTO voti (data,chiave_materia,chiave_allievo,voto, data2) VALUES('$data','$id_mat','$idalunno','$voto',STR_TO_DATE('12/12/2012', '%d/%m/%Y'))";
	$sql="INSERT INTO voti (data,chiave_materia,chiave_allievo,voto, data2) VALUES('$data','$id_mat','$idalunno','$voto','$data2')";
	$ris = @mysql_query($sql) or die("Aggiornamento voti non effettuato");
	mysql_close($conn);

//	header("Location: esa_2.php");
$_SESSION["prof"]= "gionni";
header("Location: " . $_SERVER['REQUEST_URI'], true, 303);
//header('Location: '. $_SERVER['PHP_SELF'] , true, 303);

   exit();
}

echo "<br>****<br>";
print_r($_SESSION);
	echo "<B>Benvenuto Prof. ".$nome_prof."</B><BR><HR>";
	echo "Totale righe aggiornate: ".mysql_affected_rows($conn)."<BR>";
unset($_SESSION["prof"]);
echo "<br>----<br>";
print_r($_SESSION);
?>
