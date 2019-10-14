<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Référencement manga/anime</title>

    <!-- CSS -->

    <link rel="stylesheet" href="src/css/bulma.min.css">
    <link rel="stylesheet" href="src/css/mainhome.css">
    <link rel="stylesheet" href="src/css/mainMod.css">

    <!-- CSS -->

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- FONT -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <?php
    session_start();
    include('src/_inc_parametres.php');
    include('src/_inc_connexion.php');


    if($_SESSION['prio'] == 'user'){
      if (time() - $_SESSION['last_time_see'] < 1800) {
        $_SESSION['last_time_see'] = time();
        //on affiche le menu
        include('src/header.php');

        if(isset($_POST['modif'])){
          if ($_POST['actualisation'] == 'NON') {

            if(isset($_POST['linkApres']) and $_POST['linkApres'] == 'Pas de lien enregistré'){
              $link = "";
            }
            elseif (isset($_POST['linkApres']) and $_POST['linkApres'] != 'Pas de lien enregistré') {
              $link = $_POST['linkApres'];
            }
            else {
              $link = $_POST['link'];
            }

            if(isset($_POST['ActuAuto'])){
              $check = 'OUI';
            }
            else {
              $check = 'NON';
            }

            $req = $cnx->prepare('update liste set noEpisode=:noEp, lien=:link, actuAuto=:actu where id=:id');
            $req->bindValue(':noEp', $_POST['noEp'], PDO::PARAM_INT);
            $req->bindValue(':link', $link, PDO::PARAM_STR);
            $req->bindValue(':actu', $check, PDO::PARAM_STR);
            $req->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
            $req->execute();
            ?>
            <div class="block container">
              <h5 class="title is-5 modificationSuccess">La modification du manga <b><?php echo $_POST['name']; ?></b> à été effectué avec succès.</h4>
            </div>
            <?php
          }
          else {
            $link = $_POST['link'];
            $noEp = $_POST['ancienEp'];
            if(strstr($link, $noEp)){
              $link = str_replace($noEp, $_POST['noEp'], $link);
              $req = $cnx->prepare('update liste set noEpisode=:noEp, lien=:link where id=:id');
              $req->bindValue(':noEp', $_POST['noEp'], PDO::PARAM_INT);
              $req->bindValue(':link', $link, PDO::PARAM_STR);
              $req->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
              $req->execute();
              ?>
              <div class="block container">
                <h5 class="title is-5 modificationSuccess">
                  La modification du manga <b><?php echo $_POST['name']; ?></b> à été effectué avec succès.
                  <br>
                  Le lien à été modifié automatiquement.
                </h5>
              </div>
              <?php
            }
            else {
              $req = $cnx->prepare('update liste set noEpisode=:noEp, lien=:link, actuAuto="NON" where id=:id');
              $req->bindValue(':noEp', $_POST['noEp'], PDO::PARAM_INT);
              $req->bindValue(':link', $link, PDO::PARAM_STR);
              $req->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
              $req->execute();
              ?>
              <div class="block container">
                <h5 class="title is-5 modificationPresqueSuccess">
                  Impossible de modifier le lien de <b><?php echo $_POST['name']; ?></b> automatiquement.
                  <br>
                  Le numero de l'épisode à été modifier, mais l'actualisation du lien automatique à été désactivé.
                </h5>
              </div>
              <?php
            }
          }
        }
        elseif (isset($_POST['suppr'])) {
          $req = $cnx->prepare('delete from liste where id=:id');
          $req->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
          $req->execute();
          ?>
          <div class="block container">
            <h5 class="title is-5 modificationSuccess">
              La suppression du manga <b><?php echo $_POST['name']; ?></b> à été effectué avec succès.
            </h5>
          </div>
          <?php
        }

        $resultat = $cnx->prepare("select * from liste where idUser=:idUs");
        $resultat->bindValue(':idUs', $_SESSION['idMembre'], PDO::PARAM_STR);
        $resultat->execute();
        $listManga = $resultat->fetchAll();
        ?>
        <section class="section" id='contenuTable'>
          <?php
          if(!empty($listManga[0][0])) {
            ?>
              <!-- HEADER -->
              <div class="block">
                <div class="container">
                  <table class="tableCentre table is-fullwidth">
                    <thead>
                      <tr id='tableBoss'>
                        <td>Nom</td>
                        <td>N° épisode</td>
                        <td>Lien</td>
                        <td><abbr title="Actualisation automatique du lien lors du changement manuel de l'épisode. Il se désactive automatique si il y a un problème.">Atcu</abbr></td>
                        <td>Modifier</td>
                        <td>Supprimer</td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($listManga as $ligne) { ?>
                        <tr>
                          <form method="post">
                            <input type="hidden" name="id" value="<?php echo $ligne[0]; ?>">
                            <input type="hidden" name="actualisation" value="<?php echo $ligne[4]; ?>">
                            <input type="hidden" name="name" value="<?php echo $ligne[1]; ?>">
                            <input type="hidden" name="ancienEp" value="<?php echo $ligne[2]; ?>">
                            <td><?php echo $ligne[1]; ?></td>
                            <td><input type='text' name='noEp' value='<?php echo $ligne[2]; ?>'></td>
                            <?php
                            if ($ligne[4]=='NON') {
                              if (!empty($ligne[3])) {
                                ?>
                                <td>
                                  <input type="text" name="link" value="<?php echo $ligne[3]; ?>">
                                </td>
                                <?php
                              }
                              else {
                                ?>
                                <td>
                                  <input type="text" name="linkApres" value="Pas de lien enregistré">
                                </td>
                                <input type="hidden" name="link" value="<?php echo $ligne[3]; ?>">
                                <?php
                              }
                            }
                            else {
                              ?>
                              <td><?php echo $ligne[3]; ?></td>
                              <input type="hidden" name="link" value="<?php echo $ligne[3]; ?>">
                              <?php
                            }
                            ?>
                            <td>
                              <?php
                              if ($ligne[4] == 'NON') {
                                ?>
                                <input type="checkbox" name="ActuAuto">
                                <?php
                              }
                              else {
                                ?>
                                <input type="checkbox" name="ActuAuto" disabled="disabled" checked>
                                <?php
                              }
                              ?>
                            </td>
                            <td>
                              <input type="submit" name="modif" class="modifForm" value="">
                            </td>
                            <td>
                              <input type="submit" name="suppr" class="supprForm" onclick="return confirm('Etes vous sûr de vouloir supprimer ce manga/anime ?')" value="">
                            </td>
                          </form>
                        </tr>
                        <?php
                      }

                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </section>
            <?php
          }
          else {
            ?>
              <div class="block">
                <div class="container">
                  <div class="banner">
                    <h3 class="title">Tu n'as actuellement rien comme manga/anime d'enregistré.</h3>
                    <h4 class="title">Commence par en ajouter juste en dessous!</h3>
                  </div>
                </div>
              </div>
            <?php
          }
          ?>
          </section>
          <section class="section">
            <form class='formMod' method="post" id="formAdd">
              <div class="field">
                <label class="label">Nom de l'anime/manga</label>
                <div class="control">
                  <input class="input" type="text" name="nomManga" id="nomManga" placeholder="un zgeg tout dûr part à l'aventure" required>
                </div>
              </div>

              <div class="field">
                <label class="label">Numero de l'épisode</label>
                <div class="control">
                  <input class="input" type="number" step="any" name="numEp" id='numEp' value='1' min='1' required>
                </div>
              </div>

              <div class="field">
                <label class="label">Lien vers l'épisode (optionnel mais recommendé)</label>
                <div class="control">
                  <input class="input" name="link" id='link' type="text" placeholder="https://zgeg.com/">
                </div>
              </div>

              <div class="field">
                <div class="control">
                  <label class="checkbox" id='mabActu'>
                    <input type="checkbox" disabled="disabled" name="actuAuto" id="actuAuto">
                    Actualisation du lien automatiquement après changement manuel de l'épisode (Attention: Bien verifier que dans le lien, uniquement le numero de l'épisode change).
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;Le numero de l'épisode doit être le même que celui du lien!!!
                  </label>
                </div>
              </div>

              <div class="field is-grouped">
                <div class="control">
                  <button id='addManga' class="button is-link" name='submit'>Ajouter</button>
                </div>
                <div class="control">
                  <button id='cancel' class="button is-text">Annuler</button>
                </div>
              </div>

            </form>

            <div class="field modificationSuccess" id='reponseAdd'></div>
          </section>
          <?php
        }
        else {
          $_SESSION = array();
          session_destroy();
          header('Location: home.php');
          exit();
        }
      }
      else {
        header('Location: index.php');
        exit();
      }
      ?>

    <script type="text/javascript" src="src/js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script>
      $('#deco').click(function(event){

        event.preventDefault();

        $.post(
          'deconnexion.php',

          {
            bite: 'zgeg'
          },

          function(data){
            if(data.includes("success")){
              window.location.replace("index.php");
            }
          },

          'text'
        );
      });

      $(document).ready(function() {

        var nbClick = 0;

        (function() {
          var burger = document.querySelector('.burger');
          var nav = document.querySelector('#'+burger.dataset.target);

          burger.addEventListener('click', function(){
            burger.classList.toggle('is-active');
            nav.classList.toggle('is-active');
            if(nbClick == 0){
              $('#'+burger.dataset.target).css({"background-color": "rgba(128, 128, 128, 0.3)"});
              $('#navMenu').removeClass('navbar-menu');
              $('#navMenu').addClass('menu-list')
            }
            if(nbClick % 2 == 0){;
              $('#'+burger.dataset.target).css({"display": "table"});
            }
            else {
              $('#'+burger.dataset.target).css({"display": "none"});
            }

            nbClick = nbClick + 1
          });
        })();

        var url = document.location.href;
        if(url.includes('modify.php')){
          $('#modList').addClass('disabled');
          $('#modList').css({"color": '#038ff9'});
        }
    	});

      $('#link').keyup(function(){
        if($('#link').val().length > 0){
          document.getElementById("actuAuto").removeAttribute("disabled");
        }
        else {
          document.getElementById("actuAuto").setAttribute("disabled", "disabled");
          document.getElementById("actuAuto").checked = false;
        }
      });

      $('#addManga').click(function(e){

        e.preventDefault();

        var checkbox;
        if (document.getElementById("actuAuto").checked) {
          checkbox = 'OUI';
        }
        else {
          checkbox = 'NON';
        }

        $.post(
          'addFile.php',

          {
            nom: $('#nomManga').val(),
            numEp: $('#numEp').val(),
            link: $('#link').val(),
            actu: checkbox
          },

          function(data){
            if(data.includes("success")){
              $('#reponseAdd').html("<h3 class='has-text-red'>Ajouté avec succès</h3>");
                window.location.replace("modify.php");
            }
            else {
              $('#reponseAdd').html("<h3 class='has-text-red'>"+data+"</h3>");
            }
          },

          'text'
        );
      });
    </script>
  </body>
</html>
