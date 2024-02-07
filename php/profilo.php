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
          <a class="nav-link active" id="profile">Profilo</a>
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
  <h1>Il mio profilo</h1>
  <p>TPSIT.com</p> 
</div>
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
          if(isset($_COOKIE["logged"])){
            $id = $_COOKIE["logged"];
            try {
                $sql = $conn->prepare("select * from utente, avatar, categoria_utente where User_ID = " . $id . " and avatar = avatar.ID and tipo_utente = categoria_utente.id"); //where codice=".$_ 
                $sql->setFetchMode(PDO::FETCH_ASSOC);
                $sql->execute(); 
                $result =$sql->fetchAll();
                $a = $result[0];
                
                echo "<h3>" . $a["nome_utente"] , '<b><i>#' . $a["User_ID"] . '</b></i></h3>';
                echo "<h3>Tipo utente: " . $a["Nome_Categoria"] . "</h3>";
                echo '<img src="../images/avatar/' . $a["Percorso_immagine"] . '" style="width:10%">';
                echo '<h3>Numero followers: ' . $a["numero_followers"] . "</h3>";
                echo '<h3>Numero seguiti: ' . $a["numero_seguiti"] . "</h3>";
              
            } catch (PDOException $e) 
            {
              if($_POST["film"]!=null){
                echo"Codice errore" . $e->getMessage();
              }
              exit();
            }
          }else{
              echo "Non loggato";
          }

      ?>


</body>
</html>