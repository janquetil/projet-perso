<section class="section hero">
  <!-- HEADER -->
  <div class="block headDiv">
    <header id='headerColor' class="header">
      <a id='nikoumouk' href="home.php" class="header-logo">Nikoumouk</a>

      <span class="navbar-burger burger" data-target="navMenu">
        <span></span>
        <span></span>
        <span></span>
      </span>

      <nav class="header-menu">
        <div id="navMenu" class="navbar-menu">
          <?php
          if ($_SESSION['pseudo'] == 'firling'){
            ?>
            <a href="admin.php" id='admin'>Administration</a>
            <?php
          }
          else {
            ?>
            <a href="changeMdp.php" id='changemdp'>Changer MDP</a>
            <?php
          }
          ?>
          <a href="nouveaute.php" id='nouveaute'>Dernière sortie</a>
          <a href="home.php" id='list'>Liste anime/manga</a>
          <a href="modify.php" id='modList'>Modifier la liste</a>
          <a href="#" id='deco'>Déconnexion</a>
        </div>
      </nav>
    </header>
  </div>
</section>
