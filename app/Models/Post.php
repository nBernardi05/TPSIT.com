<?php
namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\Query;
class Post extends Model
{
    public function getFeed($data){
        $conn = db_connect();
        if(isset($data['feed'])){
            if($data['feed']=='esplora'){
                try{
                    $query = $conn->query('SELECT * FROM utente, post, avatar, categoria_utente WHERE utente.User_ID = post.User_ID AND avatar = avatar.ID AND tipo_utente = categoria_utente.ID order by ID_post desc');
                    return $query->getResult();
                }catch(Exception $e){
                    echo $e->getMessage();
                    return null;
                }
            }else if($data['feed']=='seguiti'){
                try{
                    $par = ['myid' => $data['myusr']->User_ID];
                    $query = $conn->query('SELECT * FROM utente, post, avatar, categoria_utente, follow WHERE utente.User_ID = post.User_ID AND avatar = avatar.ID AND tipo_utente = categoria_utente.ID AND ID_segue = :myid: AND ID_seguito = utente.User_ID ORDER BY ID_post desc', $par);
                    return $query->getResult();
                }catch(Exception $e){
                    echo $e->getMessage();
                    return null;
                }
            }else if($data['feed']=='utente'){
                try{
                    $par = ['usid' => $data['selus']];
                    $query = $conn->query('SELECT * FROM utente, post, avatar, categoria_utente WHERE utente.User_ID = post.User_ID AND avatar = avatar.ID AND tipo_utente = categoria_utente.ID AND utente.User_ID = :usid: ORDER BY ID_post desc', $par);
                    return $query->getResult();
                }catch(Exception $e){
                    echo $e->getMessage();
                    return null;
                }
            }
        }
    }

    public function createPost($data){
        $conn = db_connect();
        try{
            if(isset($data)){
                $query = $conn->query('insert into post (corpo, User_ID, foto) values(:corpo:, :User_ID:, :image:)', $data);
                return true;
            }
        }catch(Exception $e){
            echo $e->getMessage();
            return false;
        }
    }


}
?>