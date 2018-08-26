  <nav class="navbar navbar-default">
    <div class="container-fluid">

      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Menu</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a href="index.php?page=accueil" class="navbar-brand"><img src="bower_components/boosted/dist/images/ORANGE_LOGO_rgb.jpg" alt="Accueil" title="Accueil"/></a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
<?php $menuList = $_SESSION["bdd"]->getMenuList($_SESSION["user"]->getRights());
foreach($menuList as $menuItem) { ?>
          <li<?php echo ($menuItem["name"] == $_SESSION["page"]->getName())?' class="active"':''; ?>>
            <a href="index.php?page=<?php echo $menuItem["name"]; ?>">
              <span class="glyphicon <?php echo $menuItem["icon"]; ?>" aria-hidden="true"></span> <?php echo $menuItem["title"].PHP_EOL; ?>
            </a>
          </li>
<?php } ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
<?php if($_SESSION["user"]->getRights()==0) { ?>
          <li class="active"><a href="index.php?page=connexion"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Se connecter</a></li>
<?php } else { ?>
          <li class="navbar-brand"><img src="<?php echo $_SESSION["user"]->getThumbnail(); ?>" class="img-circle" alt="photo de profil" /></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <?php echo $_SESSION["user"]->getName(); ?> <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="index.php?page=moncompte"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Mon compte</a></li>
              <li><a href="index.php?action=deconnexion"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Se déconnecter</a></li>
            </ul>
          </li>
<?php } ?>
        </ul>
      </div><!-- /.navbar-collapse -->

    </div><!-- /.container-fluid -->
  </nav>
