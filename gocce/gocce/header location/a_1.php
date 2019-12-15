<?php
//ob_start();
	session_start();
if($_POST){
//	session_register("login", "password");
	$nome = $_POST['nome'];
	$pass = $_POST['password'];

	if(isset($_SESSION["login"])){
		$nome = $_SESSION["login"];
		$pass = $_SESSION["password"];
	}

	$conn = @mysql_connect("localhost","root","");
	@mysql_select_db("registro_classe", $conn) or die("database non trovato");

	$sql="SELECT Cognome, Login, Password FROM docenti WHERE login='$nome' and password='$pass'";
	$ris = @mysql_query($sql) or die("query fallita");
	mysql_close($conn);

	$righe = mysql_num_rows($ris);
	if($righe==0){
		echo "<a href='a.html'>Errore, utente non valido</a>";
		exit;
	}

	$nome_prof = mysql_result($ris, 0, 0);
	$_SESSION["login"] = $nome;
	$_SESSION["password"] = $pass;

header("Location: " . $_SERVER['REQUEST_URI'] , true, 303);
}
?>
<?php
	echo "<B>Benvenuto Prof. ".$nome_prof."</B><BR><HR>";
	echo "Inserisca i dati dell'alunno, verranno validati <BR>";
	echo "e quindi sarà abilitato all'immissione del voto<BR>";
	echo "<form method=post action='a_2.php'>";
	echo "<input type=hidden name=nome_prof value=".$nome_prof.">";
//	echo "<input type=hidden name=username value=".$nome.">";
//	echo "<input type=hidden name=password value=".$pass.">";
?>
  
<table width="300" border="0" cellspacing="3" cellpadding="2">
  <tr> 
    <td>Cognome</td>
    <td><input name="cognome" type="text"></td>
  </tr>
  <tr> 
    <td>Nome</td>
    <td><input name="nome" type="text"></td>
  </tr>
  <tr> 
    <td>Materia</td>
    <td><input name="materia" type="text"></td>
  </tr>
  <tr> 
    <td><div align="left">Data </div></td>
    <td><input name="data" type="text"></td>
  </tr>
  <tr> 
    <td>Voto</td>
    <td><input name="voto" type="text"></td>
  </tr>
  <tr> 
    <td>Classe</td>
    <td><input name="classe" type="text"></td>
  </tr>
  <tr> 
    <td colspan="2"><div align="center"> 
        <input type="submit" name="Submit" value="<-- inserisci dati -->">
      </div></td>
  </tr>
</table>
<BR>
</form>
