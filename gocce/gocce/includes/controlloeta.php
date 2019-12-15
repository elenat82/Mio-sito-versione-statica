<?php
@$giorno=$_POST["giorno"];
@$mese=$_POST["mese"];
@$anno=$_POST["anno"];

$date1 = $anno . "-" . $mese . "-" .$giorno;
$dataoggi =  date('Y-m-d');

if (abs(strtotime($dataoggi) - strtotime($date1)) < 567993600) {
	header("location: /gocce/nonpuoientrare.php");
}
?>

<?php
ini_set('display_errors','On');
error_reporting(E_ALL);
?>