<?php

namespace App\Controllers;

use App\Models\Profile;

class Search extends BaseController
{
    public function index(): string
    {
        $model = model(profile::class);
        $users = $model->searchUsers(array(null));
        echo view('utils/head', array('title' => 'Cerca utenti', 'style' => 'search'));
        echo view("utils/header");
        echo model("mustuse");
        return view('search', ['utenti' => $users]);
    }
}
?>