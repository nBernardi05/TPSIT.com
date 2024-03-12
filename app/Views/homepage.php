<div class="container-fluid p-5 bg-primary text-white text-center">
  <h1>TPSIT.com</h1>
  <p>Il social per gli informatici</p> 
</div>
<main>

  <div>
    <form method="GET">
      <input type="radio" class="btn-check" name="feed" id="option5" autocomplete="off" value="esplora" <?= $esp; ?> <?= $_POST['nolog']; ?> onchange="this.form.submit()">
      <label class="btn" for="option5" title="Visualizza tutti i post presenti sulla piattaforma">Esplora</label>

      <input type="radio" class="btn-check" name="feed" id="option6" value="seguiti" autocomplete="off" <?= $seg; ?> <?= $_POST['nolog']; ?> onchange="this.form.submit()">
      <label class="btn" for="option6" title="Visualizza solo i post di quelli che segui">Seguiti</label>
    </form>
  </div>
  <br><br>
    <a href="<?= $_POST['nuov']; ?>">
      <button type="button" class="btn btn-outline-primary npo" <?= $_POST['nolog']; ?>>Nuovo Post</button>
      <!-- <div class="newp">
        <img src="images/new.png" class="icon">
        <h2 class="np">Nuovo post</h2>
      </div> -->
    </a>
    <div class="container text-center">
      <?php
        foreach($posts as $p){
          if($p->foto != null and $p->foto != ''){
            echo '<div class="card" style="width: 18rem; ">';
            echo '<img src="' . $p->foto . '" class="card-img-top" alt="Image">';
            echo '<div class="card-body">';
            echo '<img src="images/avatar/' . $p->Percorso_immagine . '" style="width:10%">';
            echo '<h5 class="card-title" style="display:inline;">' . $p->nome_utente .'<b>#' . $p->User_ID . '</b></h5>';
            echo '<h6 class="card-subtitle mb-2 text-body-secondary">' .$p->Nome_Categoria .'</h6>';
            echo '<p class="card-text">' . $p->corpo . '</p>';
            echo '<a href="#" class="btn btn-primary" style="margin-left:10px;">Mi piace +' . $p->numero_like . '</a>';
            echo '<a href="#" class="btn btn-primary" style="margin-left:10px;">Commenta</a></div></div>';
          }else {
            echo '<div class="card" style="width: 18rem;"><div class="card-body">';
            echo '<img src="images/avatar/' . $p->Percorso_immagine . '" style="width:10%">';
            echo '<h5 class="card-title" style="display:inline;">' . $p->nome_utente .'<b>#' . $p->User_ID . '</b></h5>';
            echo '<h6 class="card-subtitle mb-2 text-body-secondary">' .$p->Nome_Categoria .'</h6>';
            echo '<p class="card-text">' . $p->corpo . '</p>';
            echo '<a href="#" class="btn btn-primary" style="margin-left:10px;">Mi piace +' . $p->numero_like . '</a>';
            echo '<a href="#" class="btn btn-primary" style="margin-left:10px;">Commenta</a></div></div>';
          }
        }
      ?>
      

      <!-- <div class="post">
        <img src="images/avatar/man1.png" class="profpic">
        <div class="abc">
          <h3 class="usrnm">Marco<b>#2</b></h3>
          <p class="smal">Moderatore</p>
        </div>
        <p class="corp">shjsjsdj sdjdjdkdk asjskdklkldkdk skskksksks akakalal adsklsl skaaakalm akaam </p>
        <div class="but">
          <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
            <form method="POST">
              <input type="checkbox" class="btn-check" id="btncheck1" autocomplete="off" name="like" onchange="this.form.submit()">
              <label class="btn btn-outline-primary" for="btncheck1">Mi Piace +12</label>
              <input type="hidden" name="id">
            </form>
          </div>
        </div>
      </div> -->
      

    </section>
</main>

</body>
</html>
