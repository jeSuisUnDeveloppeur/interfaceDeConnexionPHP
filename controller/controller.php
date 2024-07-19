<?php 
    require_once 'modele/modele.php';

    function addUser($nom,$email,$password,$fonction){
        $nom = fieldVerification($nom);
        $email = fieldVerification($email);
        $password = fieldVerification($password);
        $password = password_hash($password,PASSWORD_DEFAULT);
        $fonction = fieldVerification($fonction);  
        $doublon = verifierDoublons($email);
        if($doublon == 0){
            createUser($nom,$email,$password,$fonction);
            return true;
        }
        else{
            return false;      
        }
    }

    function connectUser($user,$password,$email){
        $user = fieldVerification($user);
        $password = fieldVerification($password);
        $email = fieldVerification($email);
        if(password_verify($password,readPassword($user,$email))){
            return true;
        }
        else{
            return false;
        }
        
    }
?>