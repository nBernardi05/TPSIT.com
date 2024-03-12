<?php
namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\Query;
class Profile extends Model
{
  
  public function checkUserPass($data){
    $conn = db_connect();
    try{
      //echo "<script>alert('ciao')</script>";
      $par = ['id' => $data['id'], 'pass' => $data['pass']];
      if(!isset($data['order'])){$data['order']='';}
      $query = $conn->query('select * from utente, avatar, categoria_utente where User_ID = :id: and avatar.id = avatar and categoria_utente.id = tipo_utente and password = :pass:' . $data['order'], $par);
      $result = $query->getResult();
      return $result[0];
    }catch(Exception $e){
      echo $e->getMessage();
      return null;
    }
  }
  
  public function login($data){
    $conn = db_connect();
    if(isset($_POST["logid"]) && isset($_POST["logpsw"])){
      $usr = $_POST["logid"];
      $psw = $_POST["logpsw"];
      if($psw!=" "){
        try{
          $userref = $this->checkUserPass(array('id' => $usr, 'pass' => $psw));
          if($userref==null){
            echo '<h3>Controlla i dati inseriti</h3>';
            return false;
          }
          setcookie("logged", $userref->User_ID, time() + (86400 * 300), "/");
          echo '<h3 style="color:white; background-color:#0d6efd; text-align:center; padding:5px;">Accesso eseguito</h3>';
          return true;
        }catch(Exception $e){
          echo $e->getMessage();
          return null;
        }
      }
    }

  }

  public function register($data){    // TODO: implement registration
    $conn = db_connect();
    if(isset($_POST["regusern"]) && isset($_POST["regpsw"])){
      $usr = $_POST["regusern"];
      $psw = $_POST["regpsw"];
      if(strlen($usr)>2 && $psw!=" "){
        try{
          $par = ['usr' => $usr, 'psw' => $psw];
          $query = $conn->query('insert into utente (nome_utente, password, numero_followers, numero_seguiti, tipo_utente, avatar) values(:usr:, :psw:, 0, 0, 1, 1)', $par);
          $result = $query->getResult();
          setcookie("logged", $userref->User_ID, time() + (86400 * 300), "/");
          echo "<h3>Registrazione eseguita</h3>";
          echo 'Ecco il tuo id: ' . $this->checkUserPass(array('id'=>'*', 'pass'=>'*', 'order'=>' order by User_ID desc'))->User_ID;
          return true;
        }catch(Exception $e){
          echo $e->getMessage();
          return null;
        }
      }
    }
  }
}
?>