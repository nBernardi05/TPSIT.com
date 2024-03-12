<?php

namespace App\Controllers;

use App\Models\Profile;
use App\Models\Direct;

class Chat extends BaseController
{
    public function index(): string
    {
        $model = model(direct::class);
        $profile = model(profile::class);
        $myid = $profile->getUserLogged(null);
        $chats = $model->getAllChat(array('logged' => $myid));
        //$users = $model->searchUsers(array(null));
        echo view('utils/head', array('title' => 'Chat', 'style' => 'chat'));
        echo view("utils/header");
        echo model("mustuse");
        return view('conversazioni', array('chat' => $chats, 'myuser' => $myid));
    }
}
?>