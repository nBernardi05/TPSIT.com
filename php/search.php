<!DOCTYPE html>
<html lang="it">
<head>
  <title>Cerca Utente - TPSit.com</title>
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
      #search {
          width: 70%;
          margin-top: 30px;
          height: 50px;
          font-weight:bold;
          color:#1e85bd;
          border-color:#1e85bd;
          border-radius:10px;
      }
      #buttsearch {
          display: inline;
          width: 20%;
          height: 50px;
          background-color:#1e85bd;
          color:white;
          font-weight: bold;
          border-color:#1e85bd;
          border-radius:10px;
      }
      .found {
          width:43%;
          display:inline-block;
          padding:5px;
          border: solid #1e85bd;
          border-radius:10px;
          margin:5px;
      }
      .pic {
          width:10%;
      }
      .names {
          display: inline;
          margin-left:5px;
      }
      .type {
          display:block;
          margin-top:4px;
          font-size:12px;
      }
      a {
          color:black;
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
          <a class="nav-link active" href="">Search</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Chat</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="profile" href="profilo.php">Profilo</a>
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
  <h1>Cerca Utenti</h1>
  <p>Puoi cercare in base all'ID o in base al nome utente</p> 
</div>

<form method="POST">
    <input type="text" id="search" name="usrsearch" placeholder="Inserisci ID o nome per cercare">
    <input type="submit" id="buttsearch">
</form>

<div>
<?php
require("mustuse.php");
?>
      <?php
        try{

            require_once 'databaseOK.php';    // ./
            $conn = Database::getConnection();
          }catch(Exception $e){
            die("muori ");
          }

          if(isset($_POST["usrsearch"])){
            $id = $_POST["usrsearch"];
            try {
                $sql = $conn->prepare('select * from utente, avatar, categoria_utente where (User_ID like "%' . $id . '%" or nome_utente like "%' . $id . '%") and avatar.id = avatar and categoria_utente.id = tipo_utente'); //where codice=".$_ 
                $sql->setFetchMode(PDO::FETCH_ASSOC);
                $sql->execute(); 
                $result =$sql->fetchAll();
                echo '<div style="text-align:center">';
                foreach($result as $r){
                    echo '<a href="userpage.php?usr=' . $r["User_ID"] . '"><div class="found">';
                    echo '<img src="../images/avatar/' . $r["Percorso_immagine"] . '" class="pic">';
                    echo '<h4 class="names">' . $r["nome_utente"] . "<b><i>#" . $r["User_ID"] . "</i></b></h4>";
                    echo '<p class="type">' . $r["Nome_Categoria"] . '</p>';
                    echo '</div></a>';
                }
                echo '</div>';
                /*
                echo "<h3>" . $a["nome_utente"] , '<b><i>#' . $a["User_ID"] . '</b></i></h3>';
                echo "<h3>Tipo utente: " . $a["Nome_Categoria"] . "</h3>";
                echo '<img src="../images/avatar/' . $a["Percorso_immagine"] . '" style="width:10%">';
                echo '<h3>Numero followers: ' . $a["numero_followers"] . "</h3>";
                echo '<h3>Numero seguiti: ' . $a["numero_seguiti"] . "</h3>";*/
              
            } catch (PDOException $e) 
            {
              if($_POST["film"]!=null){
                echo"Codice errore" . $e->getMessage();
              }
              exit();
            }
          }
      ?>
</div>


</body>
</html>