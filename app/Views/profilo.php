<div class="container-fluid p-5 bg-primary text-white text-center">
  <h1>Il mio profilo</h1>
  <p>TPSIT.com</p> 
</div>
      <table>
        <tr>
          <td class="title" colspan="3"><span class="smal">Nome utente:</span><?php echo '<h3 class="tit">' . $utente->nome_utente . '</h3>'; ?></td>
          <td class="idbox"><h3 class="id"><?= $utente->User_ID ?></h3><span class="smal">ID:</span></td>
        </tr>
        <tr>
          <td class="prof" rowspan="2"><img src="images/avatar/<?= $utente->Percorso_immagine; ?>" alt="profile picture" id="pp"> 
          <h3 class="hint">Il tuo avatar</h3>
          <div class="otherimg">
            <div>
              
              
                <?php
                foreach($avatar as $a){
                  if($a->Percorso_immagine != $utente->Percorso_immagine){
                    echo '<form method="POST" class="forimg">';
                    echo '<input type="hidden" name="'. $a->ID . '">';
                    echo '<input type="image" class="littleimg" src="images/avatar/' . $a->Percorso_immagine . '">';
                    echo '</form>';
                  }
                }
                ?>
              </form>
            </div>
          </td>
          <td colspan="2" class="sav">
            <form method="POST">
              <input type="text" name="editbio" style="display:none;" id="bioform">
              <div style="vertical-align:center;"><img src="images/save.png" class="icon">
              <input type="submit" class="hint" value="Salva" id="sa"></div>
            </form>
          </td>
          <td class="biografia" rowspan="3" colspan="2">
            <p id="bio" contenteditable="true" oninput="text()"><?= $utente->bio; ?></p>
          </td>
        </tr>
        <tr>
          <td class="nfo">
            <p>Followers</p>
            <h3 class="numerone"><?= $utente->numero_followers; ?></h3>
          </td>
          <td class="nse">
            <p>Seguiti:</p>
            <h3 class="numerone"><?= $utente->numero_seguiti; ?></h3>
          </td>
        </tr>
        <tr>
          <td class="ru" colspan="3">
            <!-- <p>Followers</p> -->
            <h3 class="ruolo"><?= $utente->Nome_Categoria; ?></h3>
          </td>
        </tr>
        <tr>
          <td class="npost">
            <a href="Home?usr=<?=$utente->User_ID; ?>" style="text-decoration:none;">
            <p class="smal">Post pubblicati:</p>
            <h3 class="numerone"><?= $utente->numero_post; ?></h3></a>
          </td>
        </tr>
      </table>
      
            

<!-- Rimanga, prof Molitierno -->
</body>
</html>