<?php

namespace App\Controllers;

use App\Models\Profile;

class Profilo extends BaseController
{
    public function index(): string
    {
        $model = model(profile::class);
        $loggeduser = $model->getUserLogged(array(null));
        if($loggeduser==null){
            echo '<script>alert("Nessun utente loggato"); window.location.href="/";</script>';
            return 'Prima accedi';
        }
        $avatars = $model->getAllAvatar(null);
        foreach($avatars as $a){
            if(isset($_POST[$a->ID])){
                $_POST[$a->ID] = $a->ID;
                $model->changeProfilePic(array('img' => $_POST[$a->ID]));
                $loggeduser = $model->getUserLogged(array(null));
            }
        }
        if(isset($_POST['editbio'])){
            $model->changeBio(array('newbio' => $_POST['editbio']));
            $loggeduser = $model->getUserLogged(array(null));
        }
        //$_POST["controller"] = $this;
        echo view('utils/head', array('style' => 'profilo', 'title' => 'Il mio profilo', 'script' => 'profilo'));
        echo view("utils/header");
        echo model("mustuse");
        return view('profilo', array('utente' => $loggeduser, 'avatar' => $avatars));
    }
}
?>