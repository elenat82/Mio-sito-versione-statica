<script type="text/javascript" src="jquery-1.9.1.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	$(function () {
		$("#reg").change();
	});

	$('#reg').on('change', function() {
//		var formData = $("#idform").serialize() + "&partedoc=table";
		var formData = $("#idform").serialize();
		var url = $("#hidden1").attr('value');
//alert(url+" "+formData);
		jQuery.post(url, formData, function(data) {
			jQuery("#provincediv").html(data);
		});
	});
});
</script>

<?php
	require_once("es63_sql.php");

	$azione = $_SERVER['PHP_SELF'];
	$metodo = "post";

	$s = "<form method=$metodo action=$azione id=idform>";
	$s .= "<input type=hidden id=hidden1 value=es63ter_2.php></input>";
	$s .= "<table border=0 align=left width=25%>";
	$s .= "<tr><td>Nome</td><td><input type=text name=nome value=a></input></td><td></td></tr>";
	$s .= "<tr><td>Cognome</td><td><input type=text name=cognome value=a></input></td><td></td></tr>";
	$s .= ("<tr><td>Regione</td><td><select name=regione id=reg>".getRegioni()."</select></td><tr>");
	$s .= ("<tr><td>Provincia</td><td><div id=provincediv><select name=provincia id=prov></select></div></td><tr>");
	$s .= ("<td><input type=submit name=invia value=invia></input></td></tr>");
	$s .= "</table></form>";

	echo $s;

	if(!empty($_POST))
		print_r ($_POST);

function getRegioni(){
	$username="root";
	$password="";
	$database="testsql";
	$scelta = $_POST["scelta"];
	$chiave = $_POST["chiave"];

	$sql = new classeSQL("localhost", $username, $password, $database);
	$sql->connetti();

	$query1 = "select distinct regione from citta order by regione asc";
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