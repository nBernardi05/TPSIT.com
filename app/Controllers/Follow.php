<?php

namespace App\Controllers;

use App\Models\Profile;

class Follow extends BaseController
{
    public function index(): string
    {
        $profile = model(profile::class);
        $usr = $profile->getUserById(['id'=>$_GET['usr']]);
        //$users = $model->searchUsers(array(null));
        echo view('utils/head', array('title' => 'Follow', 'style' => 'segu'));
        echo view("utils/header");
        echo model("mustuse");
        return view('seg', ['tipo' => $_GET['page'], 'user' => $usr, 'fol' => 'checked', 'seg' => '']);
    }
}
?>