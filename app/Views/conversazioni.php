<div class="container-fluid p-5 bg-primary text-white text-center">
  <h1>Chat</h1>
  <p>TPSIT.com</p> 
</div>

<h2>Chat</h2>
    <!-- <form method="POST">
      <label for="id">ID Utente: </label>
      <input type="number" name="logid" id="id">
      <label for="psw">Password: </label>
      <input type="password" name="logpsw" id="psw">
      <input type="submit">
    </form> -->
    <div class="center">
        <div class="card w-75 mb-3">
            <div class="card-body">
                <h5 class="card-title">Nuova Chat</h5>
                <form method="POST">
                    <input type="number" class="card-text idb" name="idnewchat" placeholder="Inserisci l'ID e inizia la chat">
                    <input type="submit" class="btn btn-primary" value="Chatta">
                </form>
            </div>
            <?php
                foreach($chat as $c){
                    echo '<div class="card w-75 mb-3"> <div class="card-body">';
                    $chatu = '';
                    if($c->User_a != $myuser->User_ID){
                        $c->User_a->nome_utente . '<b><i>' . $c->User_a->User_ID; }else{ $c->User_b->nome_utente . '<b><i>' . $c->User_b->User_ID;}
                    echo '<h5 class="card-title">' . 'TODO: mettere nome' .'</b></i></h5>';

                }


            ?>
        </div>

    <!-- <div class="card w-50">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a href="#" class="btn btn-primary">Button</a>
        </div> -->
</div>

    </div>

    <div>
        <?php
            //echo model("accesso");




        ?>

    </div>
