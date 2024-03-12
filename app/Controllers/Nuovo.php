<?php

namespace App\Controllers;

use App\Models\Profile;
use App\Models\Post;

class Nuovo extends BaseController
{
    public function index(): string
    {
        $model = model(post::class);
        $profile = model(profile::class);
        $myuser = $profile->getUserLogged(null);
        //$chats = $model->getAllChat(array('logged' => $myid));
        //$users = $model->searchUsers(array(null));
        if(isset($_POST['corpo'])){
            $image = null;
            if(isset($_POST['image'])){
                if($_POST['image'] != null && $_POST['image'] != ''){
                    $image = $_POST['image'];
                }
            }
            $pars = ['corpo' => $_POST['corpo'], 'image' => $image, 'User_ID' => $myuser->User_ID];
            if($model->createPost($pars)){
                echo '<h3 style="color:white; background-color:#0d6efd; text-align:center; padding:5px;">Post creato</h3>';
            }else{
                echo '<h3 style="color:white; background-color:#0d6efd; text-align:center; padding:5px;">Errore nella creazione del post</h3>';
            }
        }
        echo view('utils/head', array('title' => 'Nuovo Post', 'style' => 'newpost'));
        echo view("utils/header");
        echo model("mustuse");
        return view('newpost', array('thisu' => $myuser));
    }
}
?>