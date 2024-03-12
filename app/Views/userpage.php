<div class="container-fluid p-5 bg-primary text-white text-center">
  <h1 id="prof">NOME-UTENTE#ID</h1>
  <p>Profilo</p> 
</div>
    <div>
        <?php
        //echo model("userpage");
        if(isset($usr)){
          echo '<script>document.getElementById("prof").innerText="' . $usr->nome_utente .'#' . $usr->User_ID . '"; </script>';

          echo '<div id="main">';
          echo '<img class="profilepic" src="images/avatar/' . $usr->Percorso_immagine . '" style="width:10%">';
          echo '<div id="rag"><h3 class="un">' . $usr->nome_utente , '<b><i>#' . $usr->User_ID . '</b></i></h3>';
          echo '<p class="tipo">' . $usr->Nome_Categoria . "</p></div><br>";
          echo '<h4 class="fol">Follower: ' . $usr->numero_followers  ."</h4>";
          echo '<h4 class="fol">Seguiti: ' . $usr->numero_seguiti ."</h4>";
          if(!isset($_COOKIE["logged"])){
            echo '<h3>Accedi/Registrati per seguire</h3>';
          }else if($_COOKIE["logged"]!=$usr->User_ID){
            echo '<form method="POST">';
            $y = $seg;
            if($y==null){
              echo '<input type="submit" value="segui" name="segui">';
            }else {
              echo '<input type="submit" value="non seguire più" name="nseg">';
            }
            echo '</form></div>';
          }
        }
        ?>
    </div>

</body>
</html>

