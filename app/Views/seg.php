<div class="container-fluid p-5 bg-primary text-white text-center">
  <h1><?= $tipo; ?></h1>
  <p>Utente: <?= $user->nome_utente . '<b>#' . $user->User_ID; ?></b></p> 
</div>
<main>

  <div>
    <form method="GET">
      <input type="radio" class="btn-check" name="feed" id="option5" autocomplete="off" value="Followers" <?= $fol; ?> onchange="this.form.submit()">
      <label class="btn" for="option5" title="Visualizza tutti i post presenti sulla piattaforma">Esplora</label>

      <input type="radio" class="btn-check" name="feed" id="option6" value="Seguiti" autocomplete="off" <?= $seg; ?> onchange="this.form.submit()">
      <label class="btn" for="option6" title="Visualizza solo i post di quelli che segui">Seguiti</label>
    </form>
  </div>
  <br><br>

    </section>
</main>

</body>
</html>
