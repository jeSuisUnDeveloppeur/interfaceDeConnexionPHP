<?php
$title = "page d'accueil'";
$css_path = "Accueil/accueil.css";
$script = "Accueil/accueil.js";

ob_start();
   session_start();
    if(!((isset($_SESSION["connecter"]) && $_SESSION["connecter"] == $_SESSION["connectUser"]))){
        header('Location:../../index.php');
 }
?>
<p class="connected"><b>profil connecté:</b> <?=$_SESSION["connecter"]?><a href="../../index.php"><img class ="deconnect" src="../../ressources/img/power-off-solid.svg" alt="bouton de déconnection"/></a></p>
<h1>Bienvenue sur le site des développeurs web et web mobile</h1>




<?php
    $content = ob_get_clean();
    require_once "../Layout/doctype.php";
?>