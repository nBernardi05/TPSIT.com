<?php

namespace App\Controllers;

use App\Models\Profile;
use App\Models\Post;

class Home extends BaseController
{
    public function index(): string
    {
        $model = model(profile::class);
        $post = model(post::class);
        $users = $model->searchUsers(array(null));
        $myuser = null;
        $_POST['nolog'] = '';
        $_POST['nuov'] = '';
        if(isset($_COOKIE['logged'])){
            $myuser = $model->getUserLogged(array(null));
            $_POST['nuov'] = 'Nuovo';
        }else{
            $_POST['nolog'] = 'disabled';
        }
        echo view('utils/head', array('title' => 'Homepage', 'style' => 'home'));
        echo view("utils/header");
        echo model("mustuse");
        if(isset($_GET['feed'])){
            if($_GET['feed']=='seguiti'){
                $posts = $post->getFeed(['feed' => 'seguiti', 'myusr' => $myuser]);
                $par = ['seg' => 'checked', 'esp' => '', 'posts' => $posts];
                return view('homepage', $par);
            }
        }else if(isset($_GET['usr'])){
            if($_GET['usr']!=''){
                $posts = $post->getFeed(['feed' => 'utente', 'selus' => $_GET['usr']]);
                $par = ['seg' => '', 'esp' => '', 'posts' => $posts];
                return view('homepage', $par);
            }
        }

        $posts = $post->getFeed(['feed' => 'esplora', 'myusr' => $myuser]);
        $par = ['seg' => '', 'esp' => 'checked', 'posts' => $posts];
        return view('homepage', $par);
    }
}
?>