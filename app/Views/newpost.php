<div class="container-fluid p-5 bg-primary text-white text-center">
  <h1>Crea un post</h1>
  <p>Stai creando un post come <b><?= $thisu->nome_utente . '#<em>' . $thisu->User_ID; ?></em></b></p> 
</div>
<main>
    <form method="POST">
      <textarea name="corpo" placeholder="A cosa stai pensando?" class="corpo" cols="4" rows="5" wrap="hard" maxlength="300"></textarea>
      <input type="url" name="image" placeholder="LINK IMMAGINE (VUOTO = NESSUNA IMMAGINE)" class="img">
      <input type="submit" class="btnsub" value="Pubblica">
    </form>
</main>
</body>
</html>