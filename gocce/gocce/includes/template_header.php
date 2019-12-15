<header>
  <div id="carrello">
    <p><a href="contatti.php">Contattaci!</a></p>
    <ul>
      <li><a href="riepilogo-carrello.php"><img src="immagini//altre-immagini/carrello.png" alt="Vai al carrello" title="Vai al carrello" height="40"></a></li>
    </ul>
  </div><!--chiusura carrello -->
  <div id="header-top">
 
      <?php 
//se l'utente è loggato e non è amministratore 
  if(isset($_SESSION["loggato"]) AND (!isset($_SESSION["admin"]))) {
echo "<p class='loggato'>Benvenuto<strong> ".$_SESSION['loggato']." </strong>!</p>";
echo " <ul>";
echo "<li><a href='logout.php'>Esci</a></li>";
echo "<li><a href='profilo.php'><img src='immagini/altre-immagini/profilo.png' alt='vai al tuo profilo' title='vai al tuo profilo'></a></li>";
}
// se l'utente non è loggato e non è amministratore
if (!isset($_SESSION["loggato"]) AND (!isset($_SESSION["admin"]))) {
echo "<li><a href='accedi.php' title='vai alla pagina di accesso'>accedi</a></li>";
echo "<li><a href='registrati.php' title='vai alla pagina di registrazione'>registrati</a></li>";
}

// se l'utente è loggato ed è l'amministratore
if (isset($_SESSION["admin"]) AND (!isset($_SESSION["loggato"]))) {
echo "<p class='loggato'>Benvenuto<strong> ".$_SESSION['admin']." </strong>!</p>";
  echo "<li><a href='logout.php'>Esci</a></li>";
echo "<li><a href='amministrazione.php' title='vai alla pagina di amministrazione'><img src='immagini/altre-immagini/rotella.png' height='40' /></a></li>";
}

 ?>
      
      
    </ul>
  </div><!--chiusura header-top -->
  <div id="header-bottom">
    <div id="logo"> <a href="index.php"><img src="immagini/logo-gocce2.png" alt="logo-gocce"></a></div>
    <nav>
      <p>cosa vuoi bere?</p>
      <ul>
        <li class="primolink"><a href="vini.php">vini</a></li>
      </ul>
    </nav>
  </div><!--chiusura header-bottom -->
</header>