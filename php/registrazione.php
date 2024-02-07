<!DOCTYPE html>
<html lang="it">
<head>
  <title>TPSit.com</title>
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
    <a class="navbar-brand" href="#">TPSIT.com</a>
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
          <a class="nav-link" href="accesso.php">Accedi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="">Registrati</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container-fluid p-5 bg-primary text-white text-center">
  <h1>TPSIT.com</h1>
  <p>Il social per gli informatici</p> 
</div>

<h2>Registrati</h2>
    <form method="POST">
      <label for="usr">Nome utente: </label>
      <input type="text" name="regusern" id="usr">
      <label for="psw">Password: </label>
      <input type="password" name="regpsw" id="psw">
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
              $usr = $_POST["regusern"];
              $psw = $_POST["regpsw"];
              if($usr==null || $psw==null){
                  echo "controlla i dati inseriti";
                  return;
              }
              if(strlen($usr)>2 && $psw!=" "){
                $conn->beginTransaction();

                    // :-( // $sql = $conn->prepare("insert into prova (codice, descrizione) values($codice, '$descrizione')");
                    $sql = $conn->prepare("insert into utente (nome_utente, password, numero_followers, numero_seguiti, tipo_utente, avatar) values(:usr, :psw, 0, 0, 1, 1)");


                    $sql->bindParam(':usr', $usr);
                    $sql->bindParam(':psw', $psw);
                    try {
                    $result=$sql->execute(); 
                    //var_dump($result);
                    
                    $conn->commit();
                    echo "<h3>Registrato con successo</h3>";
                    try{
                        $sql = $conn->prepare("select * from utente"); //where codice=".$_ 
                        $sql->setFetchMode(PDO::FETCH_ASSOC);
                        $sql->execute(); 
                        $result =$sql->fetchAll();
                        $x = -1;
                        foreach($result as $i){
                            if($i["User_ID"]>$x){
                                $x = $i["User_ID"];
                            }
                        }
                        echo "Il tuo ID: " . $x;
                        setcookie("logged", $x, time() + (86400 * 300), "/");

                    }catch(PDOException $ex) {
                        echo "Error insert: " . $ex->getMessage();
                    }

                    } catch(PDOException $e) {
                    // roll back the transaction if something failed
                    $conn->rollback();
                    echo "Error insert: " . $e->getMessage();
                    echo "\nRegistrazione non riuscita";
                    }
                  
              }else {
                  echo "<h3>Registrazione non effettuata</h3>";
                  echo "<p>L'username deve essere di almeno 3 caratteri e la password deve essere diversa da uno spazio";
              }




        ?>

    </div>





</body>
</html>