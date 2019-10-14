<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Référencement manga/anime</title>

    <!-- CSS -->

    <link rel="stylesheet" href="src/css/bulma.min.css">
    <link rel="stylesheet" href="src/css/mainhome.css">
    <link rel="stylesheet" href="src/css/mainNew.css">

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


        ?>

        <section class="section">
          <div class="block">
            <h2 class="title title-site">Dernière sortie (Manga)</h2>
            <div class="container">
              <div class="columns">
                <?php

                exec('python3 manga.py 2>&1', $resultatPy);
                $h = sizeof($resultatPy);
                $j = 0;

                for($i = 0; $i < $h; $i+=4){
                  if ($j != 0 and $j % 3 == 0) {
                    ?>
                    </div>
                    <div class="columns">
                    <?php
                  }
                  ?>

                  <div class="column box">
                    <h4 class="title is-4"><?php echo $resultatPy[$i+1]; ?></h3>
                    <table>
                      <tr class="content-img">
                        <td><?php echo $resultatPy[$i]; ?></td>
                        <td class="last-chapter">
                          <h5 class="subtitle">Dernier Chapitre :</h5>
                          <?php
                          echo $resultatPy[$i+2];
                          echo "<br/>";
                          if (strpos($resultatPy[$i+3], "minute") !== false){
                            echo "Il y a environ ".$resultatPy[$i+3];
                          } else {
                            echo "Il y a ".$resultatPy[$i+3];
                          }
                          ?>
                        </td>
                      </tr>
                    </table>
                  </div>

                  <?php
                  $j++;
                }

                ?>
              </div>
            </div>
          </div>
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
        if(url.includes('nouveaute.php')){
          $('#nouveaute').addClass('disabled');
          $('#nouveaute').css({"color": '#038ff9'});
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
