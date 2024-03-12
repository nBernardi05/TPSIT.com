<?php

namespace App\Controllers;

use App\Models\Account;

class Accesso extends BaseController
{
    public function index(): string
    {
        $model = model(account::class);
        if(isset($_POST["logid"]) && isset($_POST["logpsw"])){
            $model->login(array(null));
        }
        echo view('utils/head', array('style' => 'accesso', 'title' => 'Accedi'));
        echo view("utils/header");
        echo model("mustuse");
        return view('accesso');
    }
}
?>