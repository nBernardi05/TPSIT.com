<div class="container-fluid p-5 bg-primary text-white text-center">
  <h1>Cerca Utenti</h1>
  <p>Puoi cercare in base all'ID o in base al nome utente</p> 
</div>

<form method="POST">
    <input type="text" id="search" name="usrsearch" placeholder="Inserisci ID o nome per cercare">
    <input type="submit" id="buttsearch">
</form>

<div>
      <?php
      // TODO fixare la ricerca
        if(isset($utenti)){
            echo '<div style="text-align:center">';
            foreach($utenti as $r){
                echo '<a href="Userpage?usr=' . $r->User_ID . '"><div class="found">';
                echo '<img src="images/avatar/' . $r->Percorso_immagine . '" class="pic">';
                echo '<h4 class="names">' . $r->nome_utente . "<b><i>#" . $r->User_ID . "</i></b></h4>";
                echo '<p class="type">' . $r->Nome_Categoria . '</p>';
                echo '</div></a>';
            }
            echo '</div>';
        }
      ?>
</div>


</body>
</html>