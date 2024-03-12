<div class="container-fluid p-5 bg-primary text-white text-center">
  <h1>TPSIT.com</h1>
  <p>Il social per gli informatici</p> 
</div>

<h2>Registrati</h2>
    <form method="POST">
      <label for="usr">Nome utente: </label>
      <input type="text" name="regusern" id="usr">
      <label for="psw">Password: </label>
      <input type="password" name="regpsw" id="psw">
      <input type="submit">
    </form>

    <div>
        <?php
            echo model("registrazione");
        ?>

    </div>





</body>
</html>