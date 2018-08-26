  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <title><?php echo $_SESSION["page"]->getTitle(); ?></title>
  <link rel="icon" href="bower_components/boosted/dist/images/logo-orange.png" />

  <!-- Boosted CSS-->
    <link rel="stylesheet" href="bower_components/boosted/dist/css/orangeHelvetica.min.css" />
    <link rel="stylesheet" href="bower_components/boosted/dist/css/orangeIcons.min.css" />
    <link rel="stylesheet" href="bower_components/boosted/dist/css/bootstrap-orange2015.min.css" />
    <link rel="stylesheet" href="bower_components/boosted/dist/css/boosted2015.min.css" />
  <!-- /Boosted CSS-->

  <!-- Complementary styles and correction of a nav-pills bug-->
  <!--<link rel="stylesheet" href="bower_components/jquery-sortable/source/css/jquery-sortable.css" />-->
  <style>.nav-pills > li > a:hover, .nav-pills > li > a:active, .nav-pills > li.active > a:focus { background-color: #000; }</style>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="bower_components/jquery/dist/jquery.min.js"></script>
  <!-- jQuery validate -->
  <script src="bower_components/jquery-validation/dist/jquery.validate.min.js"></script>
  <!-- jQuery sortable -->
  <!--<script src="bower_components/jquery-sortable/source/js/jquery-sortable-min.js"></script>-->
  <script src="js/jquery-ui.min.js"></script>
  <!-- Include all compiled plugins bootstrap, bootstrap accessibility plugin and boosted specific components (below), or include individual files as needed -->
  <script src="bower_components/boosted/dist/js/boosted.min.js"></script>
