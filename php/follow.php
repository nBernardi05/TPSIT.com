<?php
    if(!isset($_COOKIE["logged"])){
        return;
    }else{
        try{

            require_once 'databaseOK.php';    // ./
            $conn = Database::getConnection();
          }catch(Exception $e){
            die("muori ");
          }
        $t = $_POST["ftype"];
        if($t=="1"){
            $sql = $conn->prepare("select * from follow, utente, avatar, categoria_utente where User_ID = " . $_POST["film"] .  " and film.film_id = tpsit01_film_moreinfo.film_id AND film.film_id = film_actor.film_id AND actor.actor_id = film_actor.actor_id"); //where codice=".$_ 
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            $sql->execute(); 
            $result =$sql->fetchAll();
        }
    }


?>