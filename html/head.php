<?php $boosted_path = "vendor/orange-opensource/orange-boosted-bootstrap/dist"; ?>  
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <title><?php echo $_SESSION["page"]->getTitle(); ?></title>
  <link rel="icon" href="<?php echo $boosted_path; ?>/images/logo-orange.png" />

  <!-- Boosted CSS-->
    <link rel="stylesheet" href="<?php echo $boosted_path; ?>/css/orangeHelvetica.min.css" />
    <link rel="stylesheet" href="<?php echo $boosted_path; ?>/css/orangeIcons.min.css" />
    <link rel="stylesheet" href="<?php echo $boosted_path; ?>/css/boosted.min.css" />
  <!-- /Boosted CSS-->

  <!-- Complementary styles and correction of a nav-pills bug-->
  <style>.nav-pills > li > a:hover, .nav-pills > li > a:active, .nav-pills > li.active > a:focus { background-color: #000; }</style>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="vendor/components/jquery/jquery.min.js"></script>
  <!-- jQuery validate -->
  <script src="bower_components/jquery-validation/dist/jquery.validate.min.js"></script>
  <!-- jQuery sortable -->
  <script src="vendor/components/jqueryui/jquery-ui.min.js"></script>
  <!-- Include all compiled plugins bootstrap + Poppersjs -->
  <script src="<?php echo $boosted_path; ?>/js/boosted.bundle.min.js"></script>

