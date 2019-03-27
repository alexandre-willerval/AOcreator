<?php if(!defined('securityCheck')) { die('Erreur : Accès direct à cette page interdit !'); } ?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <title><?php echo $_SESSION["page"]->getTitle(); ?></title>
  <link rel="icon" href="<?php echo $_SESSION['frameworks']['BOOSTED_PATH'] ?>img/orange_logo.svg" />

  <!-- Boosted CSS-->
    <link rel="stylesheet" href="<?php echo $_SESSION['frameworks']['BOOSTED_PATH'] ?>css/orangeHelvetica.min.css" />
    <link rel="stylesheet" href="<?php echo $_SESSION['frameworks']['BOOSTED_PATH'] ?>css/orangeIcons.min.css" />
    <link rel="stylesheet" href="<?php echo $_SESSION['frameworks']['BOOSTED_PATH'] ?>css/boosted.min.css" />
  <!-- /Boosted CSS-->

  <!-- font-awesome -->
  <link rel="stylesheet" href="<?php echo $_SESSION['frameworks']['FONT_AWESOME_PATH'] ?>fontawesome-all.min.css" />

  <!-- Complementary styles and correction of a nav-pills bug-->
  <style>.nav-pills > li > a:hover, .nav-pills > li > a:active, .nav-pills > li.active > a:focus { background-color: #000; }</style>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="<?php echo $_SESSION['frameworks']['JQUERY_PATH'] ?>jquery.min.js"></script>
  <!-- jQuery validate -->
  <!-- <script src="bower_components/jquery-validation/dist/jquery.validate.min.js"></script> -->
  <!-- jQuery sortable -->
  <script src="<?php echo $_SESSION['frameworks']['JQUERY_UI_PATH'] ?>jquery-ui.min.js"></script>
  <!-- chartjs -->
  <script src="<?php echo $_SESSION['frameworks']['CHART_JS_PATH'] ?>Chart.bundle.min.js"></script>
  <!-- Include all compiled plugins bootstrap + Poppersjs -->
  <script src="<?php echo $_SESSION['frameworks']['BOOSTED_PATH'] ?>js/boosted.bundle.min.js"></script>
