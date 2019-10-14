<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Référencement manga/anime</title>

    <!-- CSS -->

    <link rel="stylesheet" href="src/css/bulma.min.css">
    <link rel="stylesheet" href="src/css/mainhome.css">

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

        $resultat = $cnx->prepare("select * from liste where idUser=:idUs");
        $resultat->bindValue(':idUs', $_SESSION['idMembre'], PDO::PARAM_STR);
        $resultat->execute();
        $listManga = $resultat->fetchAll();
        if(!empty($listManga[0][0])) {
          ?>
          <section class="section">
            <!-- HEADER -->
            <div class="block">
              <div class="container">
                <div class="search-box">
                  <input class="search-txt" type="text" id="searchBox" placeholder="Recherche">
                  <a href="#" class="search-btn">
                    <i class="fas fa-search"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="block">
              <div class="container">
                <table class="table tableCentre is-fullwidth">
                  <thead>
                    <tr id='tableBoss'>
                      <td>Nom</td>
                      <td>N° épisode</td>
                      <td>Lien</td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($listManga as $ligne) { ?>
                      <tr id="tableBod">
                        <td class="nomAnime"><?php echo $ligne[1]; ?></td>
                        <td><?php echo $ligne[2]; ?></td>
                        <?php
                        if (!empty($ligne[3])) {
                          if(strpos($ligne[3], "http") === false) {
                            if (strpos($ligne[3], "www") === false) { ?>
                              <td><a href="http://www.<?php echo $ligne[3]; ?>" target="_blank">Lien</a></td>
                              <?php
                            }
                            else { ?>
                              <td><a href="http://<?php echo $ligne[3]; ?>" target="_blank">Lien</a></td>
                              <?php
                            }
                          }
                          else { ?>
                            <td><a href="<?php echo $ligne[3]; ?>" target="_blank">Lien</a></td>
                            <?php
                          }
                        }
                        else {
                          ?>
                          <td>Pas de lien</td>
                          <?php
                        }
                        ?>
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
          include('src/suggestion.php');
        }
        else {
          ?>
          <section class="section">
            <div class="block">
              <div class="container">
                <div class="banner">
                  <h3 class="title">Tu n'as actuellement rien comme manga/anime d'enregistré.</h3>
                  <h4 class="title">Commence par en ajouter un en cliquant <a href='modify.php'><b>ICI</b></a> !</h3>
                </div>
              </div>
            </div>
          </section>

          <?php
          include('src/suggestion.php');
        }

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
        if(url.includes('home.php')){
          $('#list').addClass('disabled');
          $('#list').css({"color": '#038ff9'});
        }
    	});

      $('#searchBox').keyup(function(){
        var nomAnime = $('.nomAnime');
        nomAnime.each(function(elementAnime){
          if(!$(this).text().toLowerCase().includes($('#searchBox').val())){
            $(this).parent().hide();
          }
          else {
            $(this).parent().show();
          }
        });
      });
    </script>
  </body>
</html>
