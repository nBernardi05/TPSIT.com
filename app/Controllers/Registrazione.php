<?php

namespace App\Controllers;

use App\Models\Account;

class Registrazione extends BaseController
{
    public function index(): string
    {
        $model = model(account::class);
        if(isset($_POST["regusern"]) && isset($_POST["regpsw"])){
            $model->register(array(null));
        }
        echo view('utils/head', array('style' => 'registrazione', 'title' => 'Registrati'));
        echo view("utils/header");
        echo model("mustuse");
        return view('registrazione');
    }
}
?>