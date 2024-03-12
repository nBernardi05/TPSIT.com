<?php
namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\Query;
class Direct extends Model
{
    public function getAllChat($data){
        $conn = db_connect();
        try{
            if(isset($data['logged'])){
                $par = array('this' => $data['logged']->User_ID);
                $query = $conn->query("select * from utente, chat where (User_ID = Utente_a OR User_ID = Utente_b) AND User_ID = :this:", $par);
                return $query->getResult();
            }
            return null;
        }catch(Exception $e){
            return null;
        }
    }


}
?>