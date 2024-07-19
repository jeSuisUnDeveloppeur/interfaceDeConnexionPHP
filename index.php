<?php
    require_once 'controller/controller.php';
try{
    session_start();
    
    if(isset($_SESSION["connecter"])){
        session_destroy();
    }

    if(!(isset($_SESSION["createUser"],$_SESSION["createPassword"]) || isset($_SESSION["connectUser"],$_SESSION["connectPassword"]))){
    
        header('Location:templates/Connexion/connexion.php');
    }

    elseif(isset($_SESSION["createUser"],$_SESSION["createEmail"],$_SESSION["createPassword"],$_SESSION["createUserFonction"])){
        
        $newUser = addUser($_SESSION["createUser"],$_SESSION["createEmail"],$_SESSION["createPassword"],$_SESSION["createUserFonction"]);
        if($newUser){
            $_SESSION["canConnect"] = true;
            header('Location:templates/Connexion/connexion.php');
        }
        else{
            $_SESSION["erreurDoublon"] = true;
            header('Location:templates/AjoutUser/ajoutUser.php');
        }

    }
    elseif(isset($_SESSION["connectUser"],$_SESSION["connectEmail"],$_SESSION["connectPassword"])){
        
        $nom = $_SESSION["connectUser"];
        $email = $_SESSION["connectEmail"];
        $password = $_SESSION["connectPassword"];

        $connexionValid =  connectUser($nom,$password,$email);
        if($connexionValid){
            $_SESSION["connecter"] = $_SESSION["connectUser"];
            header('Location:templates/Accueil/accueil.php');
        }
        else{
            
            $_SESSION["connexionInvalid"] = true;
            header('Location:templates/Connexion/connexion.php');
        }
    }
}
catch(Exception $e){
    printf("Erreur : %s",$e->getMessage());
}

?>