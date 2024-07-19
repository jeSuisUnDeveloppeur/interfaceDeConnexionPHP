<?php
$title = "page de connexion";
$css_path = "Connexion/connexion.css";
session_start();

ob_start();

//variable et message de confirmation de création de compte utilisateur
$compteCreer = false;
$msgCompteCreer = "<p class='valid'>Compte ajouter avec succès</p>";

//variable et message d'erreur de connexion
$connexionInvalid = false;
$msgConnexionInvalid = "<p class='error'>Erreur connection : mot de passe ou identifiants incorrects </p>";

//détruit les variables de session existante et affiche le message de confirmation de création de compte utilisateur changer la valeur de $compteCreer à true 
if(isset($_SESSION["canConnect"])){
    $_SESSION = [];
    $compteCreer = true;
}

//si connexion invalide enlève le message de compte créer et permet l'affichage du message d'erreur en changeant l'état des variables
if(isset($_SESSION["connexionInvalid"])){
    $compteCreer = false;
    $connexionInvalid = true;
}

elseif(isset($_POST["userConnect"],$_POST["emailConnect"],$_POST["passwordConnect"]) && !empty($_POST["userConnect"]) && !empty($_POST["emailConnect"]) && !empty($_POST["passwordConnect"])){

    $_SESSION["connectUser"] = $_POST["userConnect"];
    $_SESSION["connectEmail"] = $_POST["emailConnect"];
    $_SESSION["connectPassword"] = $_POST["passwordConnect"];
    header("Location:../../index.php");
}

$msgUser= "<span class='error'>Veuillez entrer un nom d'utilisateur valide</span>";
$msgPassword = "<span class='error'>Veuillez entrer un mot de passe valide </span>";
$msgEmail = "<span class='error'>Veuillez entrer une adresse email valide </span>";

$error1 = (isset($_POST["userConnect"])&& empty($_POST["userConnect"]));
$error2 = (isset($_POST["emailConnect"])&& empty($_POST["emailConnect"]));
$error3 = (isset($_POST["passwordConnect"])&& empty($_POST["passwordConnect"]));


?>

<h1>Connexion MVC</h1>

<form method="post">
    <a href="../AjoutUser/ajoutUser.php">Créer un compte</a>
<div>
    <label for="user">Utilisateur:</label>
    <input type="text" id="user" name="userConnect" autofocus> <?=$error1?$msgUser:""?>
</div>
<div>
    <label for="password">Mot de passe</label>
    <input type="password" id="password" name="passwordConnect" autofocus><?=$error3?$msgPassword:""?>
</div>
<div>
    
    <label for="email">Email :</label>
    <input type="email" id="email" name="emailConnect" autofocus><?=$error2?$msgEmail:""?>
</div>
<div class="formButton">
    <button type="submit">Valider</button>
    <button type="reset" >Annuler</button>
</div>
<?=$compteCreer?$msgCompteCreer:""?>
<?=$connexionInvalid?$msgConnexionInvalid:""?>
</form>


<?php
    $content = ob_get_clean();
    require_once "../Layout/doctype.php";
?>


