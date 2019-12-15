<?php session_start(); ?>
<!doctype html>
<html class="inserisci-prodotto">
<head>
<meta charset="ISO8859-1">
<title>Inserisci un prodotto - gocce vini e birre</title>
<link href="css/reset.css" rel="stylesheet" type="text/css">
<link href="css/amministrazione.css" rel="stylesheet" type="text/css">
<link rel="icon" href="immagini/favicon-gocce.ico" />
</head>
<body>
  <div id="logo"> <a href="index.php"><img src="immagini/logo-gocce2.png" alt="logo-gocce" height="100"></a></div>
<?php include ('includes/connessione_db.php'); ?>

<h2>Inserisci un nuovo prodotto</h2>
<br>
<br>
<div class="inserisci_prod">
  <form action="prodotto-inserito.php" method="post">
    <br>
    <label>Nome prodotto</label>
    <input required name="nome_prodotto" type="text" ></input>
    <br>  
    <label >Categoria</label>
    <select name="nome_categoria">
    <?php 
$query_cat = "SELECT nome_categoria FROM categorie";
$risultatoquery_cat = mysqli_query($connessione, $query_cat) or die(mysql_error());  

    while($riga_cat=mysqli_fetch_array($risultatoquery_cat)){
echo "<option required value=".$riga_cat['nome_categoria'].">".$riga_cat['nome_categoria']."</option>";
    }
     ?>
    </select>
    <br>
    <label style="float:left">Descrizione breve</label>
    <textarea name="descrizione_breve" ></textarea>
    <br>
    <label style="float:left">Descrizione lunga</label>
    <textarea name="descrizione_lunga" ></textarea>
    <br>
    <label >Immagine</label>
    <input required name ="nome_immagine" type="file" ></input>
    <br>
    <label >Abbinamento</label>
    <select name="nome_abbinamento">
    <?php 
    $query_abb = "SELECT DISTINCT nome_abbinamento FROM prodotti WHERE nome_categoria='vini'";
$risultatoquery_abb = mysqli_query($connessione, $query_abb) or die(mysql_error());  

    while($riga_abb=mysqli_fetch_array($risultatoquery_abb)){
echo "<option required value=".$riga_abb['nome_abbinamento'].">".$riga_abb['nome_abbinamento']."</option>";
    }
     ?>
    </select>
    
    <br>
    <label >Colore</label>
    <select name="nome_colore">
    <?php 
    $query_col = "SELECT DISTINCT nome_colore FROM prodotti WHERE nome_categoria='vini'";
$risultatoquery_col = mysqli_query($connessione, $query_col) or die(mysql_error());  

    while($riga_col=mysqli_fetch_array($risultatoquery_col)){
echo "<option required value=".$riga_col['nome_colore'].">".$riga_col['nome_colore']."</option>";
    }
     ?>
    </select>
    
    <br>
    <label >Bicchiere</label>

    <select name="nome_bicchiere">
    <?php 
    $query_bicch = "SELECT DISTINCT nome_bicchiere FROM prodotti WHERE nome_categoria='vini'";
$risultatoquery_bicch = mysqli_query($connessione, $query_bicch) or die(mysql_error());  

    while($riga_bicch=mysqli_fetch_array($risultatoquery_bicch)){
echo "<option required value=".$riga_bicch['nome_bicchiere'].">".$riga_bicch['nome_bicchiere']."</option>";
    }
     ?>
    </select>
        <br>
    <label >Dolcezza</label>
    <select name="nome_dolcezza">
    <?php 
    $query_dolc = "SELECT DISTINCT nome_dolcezza FROM prodotti WHERE nome_categoria='vini'";
$risultatoquery_dolc = mysqli_query($connessione, $query_dolc) or die(mysql_error());  

    while($riga_dolc=mysqli_fetch_array($risultatoquery_dolc)){
echo "<option required value=".$riga_dolc['nome_dolcezza'].">".$riga_dolc['nome_dolcezza']."</option>";
    }
     ?>
    </select>
    

    
    <br>
    <label >Fermezza</label>

<select name="nome_fermezza">
    <?php 
    $query_ferm = "SELECT DISTINCT nome_fermezza FROM prodotti WHERE nome_categoria='vini'";
$risultatoquery_ferm = mysqli_query($connessione, $query_ferm) or die(mysql_error());  

    while($riga_ferm=mysqli_fetch_array($risultatoquery_ferm)){
echo "<option required value=".$riga_ferm['nome_fermezza'].">".$riga_ferm['nome_fermezza']."</option>";
    }
     ?>
    </select>
    
    
    <br>
    <label >Gradazione</label>
    <input name="gradazione" type="text" ></input>
    <br>
    <label >Temperatura</label>
    <input name="temperatura" type="text" ></input>
    <br>
<label >Produttore</label>

    <select name="nome_produttore">
    <?php 
    $query_p = "SELECT DISTINCT nome_produttore FROM prodotti WHERE nome_categoria='vini'";
$risultatoquery_p = mysqli_query($connessione, $query_p) or die(mysql_error());  

    while($riga_p=mysqli_fetch_array($risultatoquery_p)){
echo "<option required value=".$riga_p['nome_produttore'].">".$riga_p['nome_produttore']."</option>";
    }
     ?>
    </select>
    
    <br>
    <label >Regione</label>

    <select name="nome_regione">
    <?php 
    $query_reg = "SELECT DISTINCT nome_regione FROM prodotti WHERE nome_categoria='vini'";
$risultatoquery_reg = mysqli_query($connessione, $query_reg) or die(mysql_error());  

    while($riga_reg=mysqli_fetch_array($risultatoquery_reg)){
echo "<option required value=".$riga_reg['nome_regione'].">".$riga_reg['nome_regione']."</option>";
    }
     ?>
    </select>
    
    <br>
    <label >Annata</label>
    <input name="annata" type="text" ></input>
    <br>
<label >Cl</label>
    <input name="cl" type="text" ></input>
    <br>
    <label >Prezzo di listino</label>
    <input required name="prezzo_listino" type="text" value="0"></input>
    <br>
    <label >Pezzi disponibili</label>
    <input required name="pezzi_disponibili" type="text" value="0"></input>
    <br>
<label >Sconto</label>
    <input required name="sconto" type="text" value="0"></input>
    <br>
    <input type="submit" value="Conferma inserimento"></input>
  </form>

<?php 
if (isset($_POST["first"])) {
    echo "<input type='hidden' name='first' value='false'>";
  
  }
  else {
    echo "<input type='hidden' name='first' value='true'>";
  }

   ?>



</div>
<br>
<br>
<br>
<br>

<?php 
		mysqli_close($connessione); 
			?>

</body>
</html>