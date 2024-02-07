
  
<?php
//echo '<div class="col-sm-4">';
/* soluzione deprecata */
/*
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "sakila";
$port="3306";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;port=$port", $username, $password);  //
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die;
  }


echo "<br>";



try {
  $sql =  "SELECT * FROM actor";
  $result = $conn->query($sql);
} catch (PDOException $e) 
{
  echo"Codice errore" . $e->getMesssage();
  exit();
}
var_dump($result);

foreach ($result as $row) {
  echo   "codice: " . $row["actor_id"]. " - nome: " . $row["first_name"];
}
*/

/* soluzione migliore */
try{

  require_once 'databaseOK.php';    // ./
  $conn = Database::getConnection();
}catch(Exception $e){
  die("muori ");
}


// select
$result = "";
try {
  if($_POST["film"]!=null){
    $sql = $conn->prepare("select * from tpsit01_film_moreinfo, film, actor, film_actor where film.film_id = " . $_POST["film"] .  " and film.film_id = tpsit01_film_moreinfo.film_id AND film.film_id = film_actor.film_id AND actor.actor_id = film_actor.actor_id"); //where codice=".$_ 
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    $sql->execute(); 
    $result =$sql->fetchAll();
  }
} catch (PDOException $e) 
{
  if($_POST["film"]!=null){
    echo"Codice errore" . $e->getMessage();
  }
  exit();
}

/**
 * se è diverso da 0 o 1 viene preso come 0
 */
  $cod = $_POST["det"];
  if($cod !=null){
    if($cod == 1){
      $a = $result[0];
      echo "<h2>" .$a["title"] . "</h2>";
        if($a["imagepath01"]!=NULL or $a["imagepath01"]!=""){
          echo "<img src=" . $a["imagepath01"] . ">";
        }
        if($a["imagepath02"]!=NULL or $a["imagepath02"]!=""){
          echo "<img src=" . $a["imagepath02"] . ">";
        }
        if($a["imagepath03"]!=NULL or $a["imagepath03"]!=""){
          echo "<img src=" . $a["imagepath03"] . ">";
        }
      echo "<p>" . $a["smalldescription"] . "</p>";
      echo "<p>" . $a["fulldescription"] . "</p>";

      echo "<h3>Attori</h3>";
      foreach($result as $actor) {
        echo "<p>" . $actor["last_name"] . " ";
        echo $actor["first_name"] . "</p>";
      }
    }else{
      $a = $result[0];
      echo "<h2>" . $a["title"] . "</h2>";
      if($a["imagepath01"]!=NULL){
        echo "<img src=" . $a["imagepath01"] . ">";
      }
      echo "<p>" . $a["smalldescription"] . "</p>";
    }
}
  



$path1 = $_POST["path"];
  if($path1!=null and $path1 != "" and $_POST["idpathloc"]!=null) {
    try {
      $sql = $conn->prepare("update tpsit01_film_moreinfo set imagepath01 = '" . $path1 . "' where film_id = " . $_POST["idpathloc"]); //where codice=".$_ 
      $sql->setFetchMode(PDO::FETCH_ASSOC);
      $sql->execute(); 
      $result =$sql->fetchAll();
      echo "Modifiche effettuate";
    } catch (PDOException $e) 
    {
      echo "err";
    }
  }

  $fid = $_POST["film_id"];
  $p1 = $_POST["img1"];
  $p2 = $_POST["img2"];
  $p3 = $_POST["img3"];
  $sd = $_POST["smalldescription"];
  $fd = $_POST["fulldescription"];

  if($fid!=null and $sd!=null and $fd!=null) {
    try {
      if($p1==""){
        $p1 = NULL;
      }
      if($p2==""){
        $p2 = NULL;
      }
      if($p3==""){
        $p3 = NULL;
      }
      //echo "insert into tpsit01_film_moreinfo (film_id, imagepath01, imagepath02, imagepath03, smalldescription, fulldescription) values (" . $fid . ", " . $p1 . ", " . $p2 . ", " . $p3 . ", " . $sd . ", " . $fd . ")";
      $sql = $conn->prepare("insert into tpsit01_film_moreinfo (film_id, imagepath01, imagepath02, imagepath03, smalldescription, fulldescription) values (" . $fid . ", '" . $p1 . "', '" . $p2 . "', '" . $p3 . "', '" . $sd . "', '" . $fd . "')"); //where codice=".$_ 
      $sql->setFetchMode(PDO::FETCH_ASSOC);
      $sql->execute(); 
      $result =$sql->fetchAll();
      echo "Aggiunto con successo";
    } catch (PDOException $e) 
    {
        echo"Codice errore" . $e->getMessage();

      exit();
    }
  } 

  $idc = $_POST["idcan"];
  if($idc!=null and $idc != "") {
    try {
      $sql = $conn->prepare("delete from tpsit01_film_moreinfo where film_id = " . $idc); //where codice=".$_ 
      $sql->setFetchMode(PDO::FETCH_ASSOC);
      $sql->execute(); 
      $result=$sql->execute(); 
      $conn->commit();
      $result =$sql->fetchAll();
      echo "Cancellazione eseguita";
    } catch (PDOException $e) 
    {
      echo "err";
    }
  }


/*

// insert 
// begin the transaction
//$codice="11"; 
//$descrizione="'riga 11'";

$conn->beginTransaction();

  // :-( // $sql = $conn->prepare("insert into prova (codice, descrizione) values($codice, '$descrizione')");
  $sql = $conn->prepare("insert into actor (actor_id, first_name, last_name) values(:codice, :nome, :cognome)");

  $codice="999"; 
  $nome="antonio";
  $cognome="de curtis";

  $sql->bindParam(':codice', $codice);
  $sql->bindParam(':nome', $nome);
  $sql->bindParam(':cognome', $cognome);
try {
  $result=$sql->execute(); 
  var_dump($result);
  
  $conn->commit();
  echo "New records created successfully";

} catch(PDOException $e) {
  // roll back the transaction if something failed
  $conn->rollback();
  echo "Error insert: " . $e->getMessage();
}

*/

/*
// update

$conn->beginTransaction();

  // :-($sql = $conn->prepare("update prova set descrizione= '$descrizione' where codice=$codice");
  $sql = $conn->prepare("update actor set first_name=:nome where actor_id=:codice");
  $sql->bindParam(':codice', $codice);
  $sql->bindParam(':nome', $nome);
  $codice=999; 
  $nome="antonio (totò)";
try {   
  $result=$sql->execute(); 
  $conn->commit();
  echo "New records updated successfully";

} catch(PDOException $e) {
  // roll back the transaction if something failed
  $conn->rollback();
  echo "Error update: " . $e->getMessage();
}
var_dump($result);
*/

/*
// delete
$codice=999; 
$conn->beginTransaction();
try {
  $sql = $conn->prepare("delete from actor where actor_id=$codice");
  $result=$sql->execute(); 
  $conn->commit();
  echo "New records deleted successfully";

} catch(PDOException $e) {
  // roll back the transaction if something failed
  $conn->rollback();
  echo "Error delete: " . $e->getMessage();
}
var_dump($result);

$conn = null;

//echo '</div>';*/
?>