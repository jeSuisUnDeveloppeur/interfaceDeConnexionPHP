<?php
    require_once 'connect.php'; 
    
    //connection à la BDD
    function connect_db(){
        $dsn = "mysql:dbname=".BASE.";host=".SERVER ;
        try{
            $option = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'];
            $connexion = new PDO($dsn,USER,PASSWORD,$option);
        }
        catch(PDOException $e){
            printf("echec de connection : %s \n",$e->getMessage());
            die();
        }
        return $connexion;
    }

    //deconnection de la BDD
    function disconnect_db(){
        return NULL;
    }

    //Nettoyage des entrées avant envoie de la requête
    function fieldVerification($field){
        $field = trim($field);
        $field = htmlspecialchars($field);
        $field = stripslashes($field);
        return $field;
    }

    //fonction insertion de nouvelle utilisateurs dans la bdd
    function createUser($nom,$email,$password,$fonction){
        $connexion = connect_db();
        $sql = "INSERT INTO utilisateurs VALUES (NULL,:email,:nom,:password,:fonction);";
        $reponse = $connexion->prepare($sql);
        $reponse->bindValue(':email',$email,PDO::PARAM_STR);
        $reponse->bindValue(':nom',$nom,PDO::PARAM_STR);
        $reponse->bindValue(':password',$password,PDO::PARAM_STR);
        $reponse->bindValue(':fonction',$fonction,PDO::PARAM_STR);
        $reponse->execute();
        $connexion = disconnect_db();
    }

    //fonction de vérification de doublons
    function verifierDoublons($email){
        $connexion = connect_db();
        $sql = "SELECT* FROM utilisateurs WHERE email_user = :email;";
        $reponse = $connexion->prepare($sql);
        $reponse->bindValue(':email',$email,PDO::PARAM_STR);
        $reponse->execute();
        $connexion = disconnect_db();
        return $reponse->rowCount();
    }


    //permet de lire le mot de passe 
    function  readPassword($nom,$email){
        $connexion = connect_db();     
        $sql ="SELECT pwd_user FROM utilisateurs WHERE login_user = :nom AND email_user = :email ";
        $reponse = $connexion->prepare($sql);
        $reponse->bindValue('nom',$nom,PDO::PARAM_STR);
        $reponse->bindValue('email',$email,PDO::PARAM_STR);
        $reponse->execute();
        $row = $reponse->fetch(PDO::FETCH_ASSOC);
        return $row["pwd_user"];
    }



?>