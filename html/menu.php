  <nav class="navbar navbar-dark bg-dark navbar-expand-md">
    <div class="container">
      <a class="navbar-brand" href="index.php?page=accueil">
        <img src="<?php echo $_SESSION['frameworks']['BOOSTED_PATH'] ?>img/orange_logo.svg" alt="Home" title="Accueil"/>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsing-navbar" aria-controls="collapsing-navbar" aria-expanded="false" aria-label="Menu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse justify-content-between collapse" id="collapsing-navbar">
        <ul class="navbar-nav">
<?php $menuList = $_SESSION["bdd"]->getMenuList($_SESSION["user"]->getRights());
foreach($menuList as $menuItem) { ?>
          <li class="nav-item<?php echo ($menuItem['name'] == $_SESSION['page']->getName())?' active':''; ?>">
            <a class="nav-link" href="index.php?page=<?php echo $menuItem["name"]; ?>">
              <i class="<?php echo $menuItem["icon"]; ?>"></i> <?php echo $menuItem["title"].PHP_EOL; ?>
            </a>
          </li>
<?php } ?>
        </ul>
        <ul class="navbar-nav">
<?php if($_SESSION["user"]->getRights()==0) { ?>
          <li class="nav-item active">
            <a class="nav-link" href="index.php?page=connexion">
              <i class="fas fa-sign-in-alt"></i> Se connecter
            </a>
          </li>
<?php } else { ?>
          <li class="navbar-brand d-none d-lg-block">
            <img src="<?php echo $_SESSION["user"]->getThumbnail(); ?>" class="rounded-circle" alt="photo de profil" />
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <?php echo $_SESSION["user"]->getName(); ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-right" role="menu">
              <li>
                <a class="dropdown-item" href="index.php?page=moncompte">
                  <i class="fas fa-user"></i> Mon compte
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="index.php?action=deconnexion">
                  <i class="fas fa-sign-out-alt"></i> Se déconnecter
                </a>
              </li>
            </ul>
          </li>
<?php } ?>
        </ul>
      </div>
    </div>
  </nav>
