<!DOCTYPE html>

<?php

function age() {
  $dateAnniv = '22-07-2000';
  $dateNow = date('d-m-Y');
  $annee = intval(substr($dateNow, -4)) - intval(substr($dateAnniv, -4));
  $mois = intval(substr($dateNow, -7, 2)) - intval(substr($dateAnniv, -7, 2));
  $jour = intval(substr($dateNow, 0, 2)) - intval(substr($dateAnniv, 0, 2));
  $anniv = false;

  if ($mois == 0) {
    if ($jour < 0) {
      $annee--;
    }
    elseif ($jour == 0) {
      $anniv = true;
    }
  }
  elseif ($mois < 0) {
    $annee--;
  }

  if ($anniv) {
    echo $annee." ans aujourd'hui";
  }
  else {
    echo $annee." ans";
  }
}

?>

<html>

  <head>

    <meta charset="utf-8">
    <title> Julien Anquetil</title>

    <!-- CSS -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css">
    <link rel="stylesheet" href="src/css/main.css">

    <!-- CSS -->

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- FONT -->

    <!-- meta SED -->
    <meta name="description" content="CV de Julien Anquetil Etudiant en SIO">
    <meta name="keywords" content="anquetil, webdesign, webmaster, Julien Anquetil, SIO, CV, cybersecurity, cybersécurité, sécurité informatique, développement">
    <!-- meta SED -->

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1">
  </head>

  <body>

    <!-- HEADER -->
    <div class="block headDiv">
      <header id='headerColor' class="header">
        <a href="#" class="header-logo">Mon CV</a>

        <span class="navbar-burger burger" data-target="navMenu">
          <span></span>
          <span></span>
          <span></span>
        </span>

        <nav class="header-menu">
          <div id="navMenu" class="navbar-menu">
            <a href="#">Accueil</a>
            <a href="#">À propos</a>
            <a href="#">Mes travaux</a>
            <a class="js-scrollTo" href="#contact">Contact</a>
          </div>
        </nav>
      </header>
    </div>
    <!-- HEADER -->

    <!-- BANNER -->
    <div class="block" id='bannerID'>
      <div class="banner">
        <img src="src/img/bg3.jpg" alt="Photo prise par Simon Abrams sur Unsplash" class="vanner-image">
        <div class="banner-content">
          <h1 class="title is-1">CV en ligne de Julien Anquetil</h1>
          <h2 class="subtitle">Découvrez mes capacités</h2>
          <button class="button is-link" id="open_modal">Mon CV</button>
        </div>
      </div>
    </div>
    <!-- BANNER -->

      <!-- MODAL -->
      <div class="modal own-modal" id="modal_to_open">
        <div class="modal-background"></div>
        <div class="modal-card">
          <header class="modal-card-head">
            <p class="modal-card-title">Mon CV</p>
            <button class="delete" aria-label="close" id="close_modal"></button>
          </header>
          <section class="modal-card-body">
            <!-- CONTENU -->
            <img src="src/img/cv.jpg">
            <!-- CONTENU -->
          </section>
          <footer class="modal-card-foot">
            <a href="../src/pdf/CV Anquetil Julien.pdf" download="cv Anquetil Julien.pdf">télécharger le pdf</a>
          </footer>
        </div>
      </div>
      <!-- MODAL -->

    <!--- SECTION : A PROPOS -->
    <div class="block" id='aboutID'>
      <h2 class="subtitle heading-site">À propos</h2>
      <div class="container about">
        <div class="columns">
          <div class="column about-single-element">
            <i class="fas fa-database icon"></i>
            <p>
              Je m'appelle Julien Anquetil, j'ai <?php echo age(); ?>. Je vis actuellement à Rennes, en tant qu'étudiant en BTS SIO option SLAM.
              
            </p>
          </div>
          <div class="column about-single-element">
            <i class="fas fa-images icon"></i>
            <p>
              Hoc inmaturo interitu ipse quoque sui pertaesus excessit e vita aetatis nono anno atque vicensimo cum quadriennio imperasset.
              natus apud Tuscos in Massa Veternensi, patre Constantio Constantini fratre imperatoris, matreque Galla sorore Rufini et Cerealis,
              quos trabeae consulares nobilitarunt et praefecturae.
            </p>
          </div>
          <div class="column about-single-element">
            <i class="fas fa-code icon"></i>
            <p>
              Vbi curarum abiectis ponderibus aliis tamquam nodum et codicem difficillimum Caesarem convellere nisu valido cogitabat,
              eique deliberanti cum proximis clandestinis conloquiis et nocturnis qua vi, quibusve commentis id fieret,
              antequam effundendis rebus pertinacius incumberet confidentia, acciri mollioribus scriptis per simulationem tractatus publici.
            </p>
          </div>
        </div>
      </div>
    </div>
    <!--- SECTION : A PROPOS -->



    <!-- CONTACT -->
    <section id="contact">
      <div class="block">
        <footer class="footer">
          <h2 class="heading-site">Contactez-moi</h2>
          <div class="footer-contact-form">
            <form class="" action="#contact" method="post">

              <div class="field">
                <label class="label">Nom</label>
                <div class="control">
                  <input class="input" type="text" placeholder="Votre Nom" name="nom" id="nom" required>
                </div>
              </div>

              <div class="field">
                <label class="label">Prenom</label>
                <div class="control">
                  <input class="input" type="text" placeholder="Votre Prenom" name="prenom" id="prenom" required>
                </div>
              </div>

              <div class="field">
                <label class="label">Email</label>
                <div class="control">
                  <input class="input" type="email" placeholder="exemple@exemple.com" name="mail" id="mail" required>
                </div>
              </div>

              <div class="field">
                <label class="label">Message</label>
                <div class="control">
                  <textarea class="textarea" name="msg" id="msg" required></textarea>
                </div>
              </div>

              <input class="button is-link" type='submit' id='submitForm' value='Envoyer' />


            </form>
            <div id='msgReponse' class="message-body">

            </div>

          </div>
          <div class="footer-informations">
            <ul>
              <li>
                <a href="https://www.linkedin.com/in/julien-anquetil-0b7173176/">
                  <i class="fab fa-linkedin"></i>
                </a>
              </li>

              <li>
                <a href="#">
                  <i class="fab fa-facebook-square"></i>
                </a>
              </li>

              <li>
                <a href="#">
                  <i class="fab fa-twitter-square"></i>
                </a>
              </li>
            </ul>
          </div>
        </footer>
      </div>
    </section>
    <!-- CONTACT -->

    <!-- SCRIPT -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="src/js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>
    	$(document).ready(function() {
    		$('.js-scrollTo').on('click', function() { // Au clic sur un élément
    			var page = $(this).attr('href'); // Page cible
    			var speed = 750; // Durée de l'animation (en ms)
    			$('html, body').animate( { scrollTop: $(page).offset().top }, speed ); // Go
    			return false;
    		});

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
    	});
    </script>
    <!-- SCRIPT -->

  </body>

</html>
