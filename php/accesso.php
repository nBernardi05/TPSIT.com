<!DOCTYPE html>
<html lang="it">
<head>
  <title>Accedi - TPSit.com</title>
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
          <a class="nav-link active" href="">Accedi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="registrazione.php">Registrati</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container-fluid p-5 bg-primary text-white text-center">
  <h1>TPSIT.com</h1>
  <p>Il social per gli informatici</p> 
</div>

<h2>Accedi</h2>
    <form method="POST">
      <label for="id">ID Utente: </label>
      <input type="number" name="logid" id="id">
      <label for="psw">Password: </label>
      <input type="password" name="logpsw" id="psw">
      <input type="submit">
    </form>

    <div>
        <?php
            try{

                require_once 'databaseOK.php';    // ./
                $conn = Database::getConnection();
              }catch(Exception $e){
                die("muori ");
              }
              $usr = $_POST["logid"];
              $psw = $_POST["logpsw"];
              if($usr==null || $psw==null){
                  echo "controlla i dati inseriti";
                  return;
              }
              if($psw!=" "){
                try {
                    
                      $sql = $conn->prepare("select * from utente where user_id = " . $usr); //where codice=".$_ 
                      $sql->setFetchMode(PDO::FETCH_ASSOC);
                      $sql->execute(); 
                      $result =$sql->fetchAll();
                      $a = $result[0];
                      if($a["password"]==$psw){
                        setcookie("logged", $a["User_ID"], time() + (86400 * 300), "/");
                        echo "<h3>accesso eseguito</h3>";
                      }
                    
                  } catch (PDOException $e) 
                  {
                    if($_POST["film"]!=null){
                      echo"Codice errore" . $e->getMessage();
                    }
                    exit();
                  }
                  
              }else {
                  echo "<h3>Accesso non effettuato</h3>";
                  echo "<p>L'username deve essere di almeno 3 caratteri e la password deve essere diversa da uno spazio";
              }




        ?>

    </div>





</body>
</html>