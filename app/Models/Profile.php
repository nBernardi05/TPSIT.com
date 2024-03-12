<?php
namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\Query;
class Profile extends Model
{
  
  public function searchUsers($data){
    //$ts = $data[0];
    $conn = db_connect();
    if(isset($_POST["usrsearch"])){
      try{
        //echo "<script>alert('ciao')</script>";
        $query = $conn->query('select * from utente, avatar, categoria_utente where ( User_ID like "%' . $_POST["usrsearch"] . '%" or nome_utente like "%' .$_POST["usrsearch"] . '%" ) and avatar.ID = avatar and categoria_utente.ID = tipo_utente');
        $result = $query->getResult();
        return $result;
      }catch(Exception $e){
        echo $e->getMessage();
        return null;
      }
    }
  }
  
  public function getUserById($data){
    $conn = db_connect();
    try{
      //echo "<script>alert('ciao')</script>";
      $par = ['id' => $data['id']];
      $query = $conn->query('select * from utente, avatar, categoria_utente where User_ID = :id: and avatar.id = avatar and categoria_utente.id = tipo_utente', $par);
      $result = $query->getResult();
      return $result[0];
    }catch(Exception $e){
      echo $e->getMessage();
      return null;
    }
  }
  public function getUserLogged($data){
    $conn = db_connect();
        if(isset($_COOKIE["logged"])){
          return $this->getUserById(['id' => $_COOKIE["logged"]]);
        }else{
            //echo "Non loggato";
            return null;
        }
      }

      public function checkFollow($data){
        $conn = db_connect();
        try{
          $par = array('userl' => $data['useruno'], 'usershow' => $data["userdue"]);
          $query = $conn->query("select * from utente, follow where ID_segue = :userl: and ID_seguito = :usershow: and User_ID = :usershow: ", $par);
          $result = $query->getResult();
          if(isset($result[0])){
            return $result[0];
          }else{
            return null;
          }
        }catch(Exception $e){
          echo $e->getMessage();
          return null;
        }
      }

      public function followUnfollow($data){
        $conn = db_connect();
        $fo = $this->checkFollow(array('useruno' => $this->getUserLogged(null)->User_ID, 'userdue' => $data['puser']->User_ID));
        if(isset($data['segui'])){
          if($fo==null){    // segui
            try{
              $par = array('myid' => $this->getUserLogged(array(null))->User_ID, 'hisid' => $data['puser']->User_ID, 'nf' => ($data['puser']->numero_followers)+1, 'ns' => ($this->getUserLogged(array(null))->numero_seguiti)+1);
              //var_dump($par);
              $query = $conn->query("insert into follow (ID_segue, ID_seguito) values( :myid: , :hisid: )", $par);
              $query = $conn->query("update utente set numero_followers = :nf: where User_ID = :hisid:", $par);
              $query = $conn->query("update utente set numero_seguiti = :ns: where User_ID = :myid:", $par);
              $data['segui'] = null;
              return true;
            }catch(Exception $e){
              echo $e->getMessage();
              return false;
            }
          }
        }
        if(isset($data['nseg'])){     // non seguire più
          if($fo!=null){
            try{
              $par = array('myid' => $this->getUserLogged(array(null))->User_ID, 'hisid' => $data['puser']->User_ID, 'nf' => ($data['puser']->numero_followers)-1, 'ns' => ($this->getUserLogged(array(null))->numero_seguiti)-1, 'recordid' => $fo->ID);
              $query = $conn->query("delete from follow where ID = :recordid:", $par);
              $query = $conn->query("update utente set numero_followers = :nf: where User_ID = :hisid:", $par);
              $query = $conn->query("update utente set numero_seguiti = :ns: where User_ID = :myid:", $par);
              $data['nseg'] = null;
              return true;
            }catch(Exception $e){
              echo $e->getMessage();
              return false;
            }
          }
        }
      }
      /**
       * Dammi tutte le immagini
       * (Utile per selezionare una nuova immagine profilo)
       */
      public function getAllAvatar($data){
        $conn = db_connect();
        try{
          if(!isset($data['where'])){
            $data['where'] = '';
          }
          $query = $conn->query('select * from avatar ' . $data['where']);
          return $query->getResult();
        }catch(Exception $e){
          $e->getMessage();
          return null;
        }
      }

      public function changeProfilePic($data){
        if(isset($data['img'])){
          if($data['img']!=null){
            $id = $this->getUserLogged(null)->User_ID;
            $conn = db_connect();
            try{
              $pars = ['newav' => $data['img'], 'id' => $id];
              $query = $conn->query('update utente set avatar = :newav: where User_ID = :id:', $pars);
              return true;
            }catch(Exception $e){
              $e->getMessage();
              return false;
            }
          }
        }
      }
      public function changeBio($data){
        if(isset($data['newbio'])){
          $conn = db_connect();
          $pars = array('id' => $this->getUserLogged(null)->User_ID, 'bio' => $data['newbio']);
          $query = $conn->query('update utente set bio = :bio: where User_ID = :id:', $pars);
        }
      }
  
}
?>