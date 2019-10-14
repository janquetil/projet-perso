<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <!-- bulma / css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css">
    <link rel="stylesheet" href="src/css/main.css">
    <!-- bulma / css -->

    <title>Connexion référencement</title>
  </head>
  <body>
    <section class="hero has-background-grey-darker is-fullheight">
      <div class="hero-body">
        <div class="container has-text-centered">
          <div class="column is-4 is-offset-4">
            <h3 class="title has-text-grey-lighter">Connexion</h3>
            <div class="box">
              <figure class="image is-128x128">
                <img class="is-rounded img-centre" src="src/img/sl128.jpg">
              </figure>
              <form id='connexionForm'>
                <div class="field">
                  <div class="control">
                    <input class="input is-large" type="text" placeholder="Votre Login" name="login" id="login" autofocus="" required>
                  </div>
                </div>

                <div class="field">
                  <div class="control">
                    <input class="input is-large" type="password" name="mdp" id="mdp" placeholder="Votre Mot de passe" required>
                  </div>
                </div>

                <div class="field" id="errorConnexion">

                </div>

                <div class="field">
                  <label class="checkbox">
                    <input type="checkbox" name='rememberme' value="remMe" id="remember">
                    Se souvenir
                  </label>
                </div>

                <input type='submit' id="btnConnexion" class="button is-block is-info is-large is-fullwidth" value="Connexion">
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script>
      $('#btnConnexion').click(function(event){

        var form = $('#connexionForm');

        if(!form[0].checkValidity()) {
          form.find(':submit').click();
        }

        event.preventDefault();
        $.post(
          'cnx.php',

          {
            login: $('#login').val(),
            mdp: $('#mdp').val(),
            remember: $('#remember').val()
          },

          function(data){
            if(data.includes("Erreur")){
              $('#mdp').val("");
              $('#errorConnexion').html("<h3 class='has-text-red'>"+data+"</h3>");
            }
            else if (data.includes('success')) {
              window.location.replace("home.php");
            }
          },

          'text'
        );
      });
    </script>
    <?php
      session_start();

      if((isset($_COOKIE['pseudo'], $_COOKIE['password']) AND !empty($_COOKIE['pseudo']) AND !empty($_COOKIE['password']))) {

        if(time() - $_SESSION['last_time_see'] > 1800) {
          $_SESSION = array();
          session_destroy();
        }
        else {
          $_SESSION['last_time_see'] = time();
          header('Location: home.php');
          exit();
        }
      }
      else {
        if(isset($_SESSION['pseudo'])) {

          if(time() - $_SESSION['last_time_see'] > 1800) {
            $_SESSION = array();
            session_destroy();
          }
          else {
            $_SESSION['last_time_see'] = time();
            header('Location: home.php');
            exit();
          }

        }
      }

    ?>
  </body>
</html>
