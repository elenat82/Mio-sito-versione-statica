<?php
	require_once("es63_sql.php");

	$s .= ("<select name=provincia id=prov>".getProvince()."</select>");
	echo $s;

function getProvince(){
	$username="root";
	$password="";
	$database="testsql";
	$scelta = $_POST["scelta"];
	$chiave = $_POST["chiave"];

	$sql = new classeSQL("localhost", $username, $password, $database);
	$sql->connetti();

	$regione = mysql_real_escape_string($_POST['regione']);
	$query1 = "select nome from citta where regione like '$regione'";
	$ris1 = $sql->esegui($query1) or die("Errore nella query.");
	$dati = $sql->getArrayFromResultset($ris1);
	$sql->disconnetti();

	$s = "";
	for($i = 0; $i < count($dati); $i++){
		foreach($dati[$i] as $valore)
			$s .= "<option value=\"$valore\">$valore</option>\n";
	}

	return $s;
}

?>