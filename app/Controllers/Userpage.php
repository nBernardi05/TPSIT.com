<?php

namespace App\Controllers;

use App\Models\Profile;

class Userpage extends BaseController
{
    public function index(): string
    {
        $model = model(profile::class);
        $userfound = $model->getUserById(['id' => $_GET['usr']]);
        $ul = $model->getUserLogged(array(null));
        /**
         * useruno -> utente che segue
         * userdue -> utente seguito
         */
        if($ul==null){$ul = $userfound;}
        $pars = array('useruno' => $ul->User_ID, 'userdue' => $userfound->User_ID);
        $seg = $model->checkFollow($pars);
        if(isset($_POST['segui'])){
            $model->followUnfollow(array('puser' => $userfound, 'segui' => $_POST['segui']));
        }
        if(isset($_POST['nseg'])){
            $model->followUnfollow(array('puser' => $userfound, 'nseg' => $_POST['nseg']));
        }
        $userfound = $model->getUserById(['id' => $_GET['usr']]);
        echo view('utils/head', array('style' => 'userpage', 'title' => $userfound->nome_utente));
        echo view("utils/header");
        echo model("mustuse");
        return view('userpage', ['usr' => $userfound, 'seg' => $seg]);
        
    }
}
?>
