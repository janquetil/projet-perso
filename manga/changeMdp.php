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

        ?>
        <div class="block container">
          <form class="formMod" method="post">
            <div class="field">
              <label class="label">Mot de passe</label>
              <div class="control">
                <input class="input" name="pass1" type="text" placeholder="Mot de passe 1" id="password1">
              </div>
            </div>
            <div class="field">
              <label class="label">Confirmer</label>
              <div class="control">
                <input class="input" name="pass2" type="text" placeholder="Mot de passe 2" id="password2" disabled="disabled">
              </div>
            </div>
            <div class="field is-grouped">
              <div class="control">
                <button class="button is-link" id='buttonSubmit' disabled="disabled">Submit</button>
              </div>
            </div>
          </form>
        </div>
        <?php
        if(!empty($_POST['pass1'])){
          $req = $cnx->prepare('update login set password=:pass where id=:id');
          $req->bindValue(':pass', sha1($_POST['pass1']), PDO::PARAM_STR);
          $req->bindValue(':id', $_SESSION['idMembre'], PDO::PARAM_INT);
          $req->execute();
          ?>
          <div class="block container">
            <h5 class="title is-5 modificationSuccess">
              La modification du mot de passe est un succès.
            </h5>
          </div>
          <?php
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
        if(url.includes('changeMdp.php')){
          $('#changemdp').addClass('disabled');
          $('#changemdp').css({"color": '#038ff9'});
        }
    	});

      $("#password1").keyup(function(){
        $('.badge').text($('#password1').val().length);

        if($('#password1').val().length >= 1) {
          $('#password1').addClass('is-success');
        }
        else {
          $('#password1').removeClass('is-success');
        }

        if($('#password1').val().length >= 4) {
          document.getElementById("password2").removeAttribute("disabled");
        }
        else {
          document.getElementById("password2").setAttribute("disabled", "disabled");
        }
      });

      $("#password2").keyup(function(){
        if($('#password1').val() == $('#password2').val()){
          $('#password2').addClass('is-success');
          $('#password2').removeClass('is-danger');
          document.getElementById("buttonSubmit").removeAttribute("disabled");
        }
        else {
          $('#password2').removeClass('is-success');
          $('#password2').addClass('is-danger');
          document.getElementById("buttonSubmit").setAttribute("disabled", "disabled");
        }
      });

    </script>
  </body>
</html>
