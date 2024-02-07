<!DOCTYPE html>
<html lang="it">
<head>
  <title>Profilo - TPSit.com</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <meta name="author" content="Bernardi Nicola">
  <meta name="description" content="TPSitcom, il primo Twitter dell'informatica">
  <style>
      table {
          border:solid;
          width:100%;
      }
      td, tr {
          border:solid;
          font:100%;
          text-align:center;
          height:60px;
      }
      label {
          display:block;
          text-align:center;
      }
      input {
          width:100%;
          text-align:center;
      }
      input[type=submit] {
          margin-left:0px;
          margin-top:5px;
          margin-bottom:10px;
      }
      input[type=text] {
        width:100%;
        text-align:center;
      }
      form {
        text-align:center;
      }
      #main {
          padding:7px;
          margin-top:5px;
      }
      .profilepic {
          width:15%;
          display:inline-block;
      }
      #rag {
          width:auto;
          display:inline-block;
          margin-left:7px;
          clear:right;
      }
      .tipo {
          font-size:12px;
          margin-top:3px;
          width:50%;
      }
      .un {
          margin-bottom:3px;
          width:50%;
          
      }
      .fol {
          display:inline-block;
          font-size:20px;
      }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="../">TPSIT.com</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="../">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="search.php">Search</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Chat</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="profile">Profilo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="accesso.php" id="log">Accedi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="registrazione.php" id="reg">Registrati</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="" id="logout" style="display:none;" onclick="document.cookie='logged=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid p-5 bg-primary text-white text-center">
  <h1 id="prof">NOME-UTENTE#ID</h1>
  <p>Profilo</p> 
</div>
<?php
require("mustuse.php");
?>

    <div>
        <?php
        try{
            require_once 'databaseOK.php';    // ./
            $conn = Database::getConnection();
          }catch(Exception $e){
            die("muori ");
          }


            if(isset($_GET["usr"])){
                $id = $_GET["usr"];
                $sql = $conn->prepare('select * from utente, avatar, categoria_utente where User_ID = ' . $id . ' and avatar.id = avatar and categoria_utente.id = tipo_utente'); //where codice=".$_ 
                $sql->setFetchMode(PDO::FETCH_ASSOC);
                $sql->execute(); 
                $result =$sql->fetchAll();
                $a = $result[0];
                if($a!=null){
                  echo '<script>document.getElementById("prof").innerText="' . $a["nome_utente"] .'#' . $a["User_ID"] . '"; </script>';

                  echo '<div id="main">';
                  echo '<img class="profilepic" src="../images/avatar/' . $a["Percorso_immagine"] . '" style="width:10%">';
                  echo '<div id="rag"><h3 class="un">' . $a["nome_utente"] , '<b><i>#' . $a["User_ID"] . '</b></i></h3>';
                  echo '<p class="tipo">' . $a["Nome_Categoria"] . "</p></div><br>";
                  echo '<h4 class="fol">Follower: ' . $a["numero_followers"] . "</h4>";
                  echo '<h4 class="fol">Seguiti: ' . $a["numero_seguiti"] . "</h4>";
                  if(!isset($_COOKIE["logged"])){
                    echo '<h3>Accedi/Registrati per seguire</h3>';
                  }else if($_COOKIE["logged"]!=$a["User_ID"]){
                    echo '<form method="POST">';
                    $ul = $_COOKIE["logged"];
                    $sq = $conn->prepare('select * from utente, follow where ID_segue = ' . $ul . ' and ID_seguito = ' . $a["User_ID"] . ' and User_ID = ' . $a["User_ID"]); //where codice=".$_ 
                    $sq->setFetchMode(PDO::FETCH_ASSOC);
                    $sq->execute(); 
                    $res =$sq->fetchAll();
                    $y = $res[0];
                    if($y==null){
                      echo '<input type="submit" value="segui" name="segui">';
                    }else {
                      echo '<input type="submit" value="non seguire più" name="nseg">';
                    }
                    echo '</form></div>';
                  }
                }else {
                  echo "<script>alert('Nessun utente trovato'); location.href = 'search.php'</script>";
                }
              }

        ?>
        <?php
            $a = $_GET["usr"];
            $ul = $_COOKIE["logged"];
            $sq = $conn->prepare('select * from utente, follow where ID_segue = ' . $ul . ' and ID_seguito = ' . $a . ' and User_ID = ' . $a); //where codice=".$_ 
            //var_dump($res); return;
            $sq->setFetchMode(PDO::FETCH_ASSOC);
            $sq->execute(); 
            $res =$sq->fetchAll();
            $y = $res[0];
            if(array_key_exists('segui', $_POST) && $y==null) { 
                try{
                    require_once 'databaseOK.php';    // ./
                    $conn = Database::getConnection();
                  }catch(Exception $e){
                    die("muori ");
                  }
                  //echo "ciao"; return;
                  $id = $_GET["usr"];
                  $x = $_COOKIE["logged"];
                  $sql = $conn->prepare('select * from utente where User_ID = ' . $id); //where codice=".$_ 
                  $sql->setFetchMode(PDO::FETCH_ASSOC);
                  $sql->execute(); 
                  $result =$sql->fetchAll();
                  $userview = $result[0];
                  
                  $conn->beginTransaction();

                    // :-( // $sql = $conn->prepare("insert into prova (codice, descrizione) values($codice, '$descrizione')");
                    $sql = $conn->prepare("insert into follow (ID_segue, ID_seguito) values(:x, :id)");


                    $sql->bindParam(':x', $x);
                    $sql->bindParam(':id', $id);
                    try {
                      $result=$sql->execute(); 
                      //var_dump($result);
                      
                      $conn->commit();
                      echo "<h3>Hai iniziato a seguire questo utente.</h3>";
                      $sql = $conn->prepare('update utente set numero_followers = ' . $userview["numero_followers"]+1 . " where User_ID = " . $id); //where codice=".$_ 
                      $sql->setFetchMode(PDO::FETCH_ASSOC);
                      $sql->execute(); 
                      $result =$sql->fetchAll();
                    }catch(PDOException $ex){
                      echo $ex->getMessage();
                    }
                  //$a = $result[0];
                  // TODO: se è null aggiungi 1 ai follower e segnalo tra i followers
            } 
        ?>
    </div>

</body>
</html>

