<?php
session_start();
$title = "page de connexion";
$css_path = "AjoutUser/ajoutUser.css";
$script = "AjoutUser/ajoutUser.js";
ob_start();
//pattern reggex de control des imput
$patternMail = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
$patternPassword = '/^^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[@*%!\-_\$]).{6,}$/';
$patternUser = '/^[A-Z][a-zéèàïâëêô]{2,29}$/';
$patternFonction ='/^[A-Za-zéèàïâëêç]{3,30}|[A-Za-zéèàïâëêç]{3,30}[\s]*[A-Za-zéèàïâëêç]{3,30}$/';
//msg d'erreur
$msgError = "<span class='error'>Erreur compte non créer,un ou plusieurs champs invalide</span>";
$msgErrorDoublon = "<span class='error'>Erreur un compte est déjà associé à cette adresse mail</span>";
//variable qui prend un booleen si value input preg_match avec reggex, en fonction de sa valeur conserve ou non la value du champ
$validUser = (isset($_POST["user"]) && preg_match($patternUser,$_POST["user"]));
$validPassword = (isset($_POST["password"])&& preg_match($patternPassword,$_POST["password"]));
$validEmail = (isset($_POST["email"])&& preg_match($patternMail,$_POST["email"]));
$validFonction = (isset($_POST["fonction"])&& preg_match($patternFonction,$_POST["fonction"]));
// variable si erreur dans le formulaire à l'envoie (true) affiche un message d'erreur ou si doublon d'email
$formError = false;
$errorTwiceMail = false;

if(isset($_SESSION["erreurDoublon"])){
    $errorTwiceMail = true;
    session_unset();
}
elseif(isset($_POST["user"],$_POST["email"],$_POST["password"],$_POST["fonction"])){
    if(!empty($_POST["fonction"]) && !empty($_POST["user"]) && !empty($_POST["email"]) && !empty($_POST["password"])){

        if(preg_match($patternUser,$_POST["user"]) && preg_match($patternMail,$_POST["email"]) && preg_match($patternPassword,$_POST["password"]) && preg_match($patternFonction,$_POST["fonction"])){
            
            $_SESSION["createUser"] = $_POST["user"];
            $_SESSION["createEmail"] = $_POST["email"];
            $_SESSION["createPassword"] = $_POST["password"];
            $_SESSION["createUserFonction"] = $_POST["fonction"];

            header("Location:../../index.php");
        }
        else{
            $formError = true;    
        }
    }
    else{
        $formError = true;
    }
}

?>
<h1>Ajouter un Utilisateur</h1>
<form method="post">
<div>
    <label for="user">Utilisateur:</label>
    <input type="text" id="user" name="user" value="<?=$validUser?$_POST["user"]:""?>" autofocus autocomplete="off"><span></span> 
</div>
<div>
    <label for="password">Mot de passe</label>
    <input type="password" id="password" name="password" value="<?=$validPassword?$_POST["password"]:""?>" autofocus autocomplete="off"><span></span>
</div>
<div>
    <label for="email">Email :</label>
    <input type="email" id="email" name="email" value="<?=$validEmail?$_POST["email"]:""?>" autofocus autocomplete="off"><span></span>
</div>
<div>
    <label for="fonction">Fonction</label>
    <input type="text" id="fonction" name="fonction" value="<?=$validFonction?$_POST["fonction"]:""?>" autofocus autocomplete="off"><span></span>
</div>
<div class="formButton">
    <button type="submit">Enregistrer</button>
    <button type="reset">Annuler</button>
</div>
<div>
<?=$formError?$msgError:""?>
<?=$errorTwiceMail?$msgErrorDoublon:""?>
</div>
<a href="../Connexion/connexion.php">Retour à l'accueil</a>
</form>

<?php
    $content = ob_get_clean();
    require_once "../Layout/doctype.php";
?>
