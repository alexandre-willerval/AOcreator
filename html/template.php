<!DOCTYPE html>
<html lang="fr">

<head>
<?php $_SESSION["page"]->loadHead(); ?>
</head>

<body>
  
  <!-- Menu -->
<?php $_SESSION["page"]->loadMenu(); ?>
  <!-- /Menu -->
  
  <div class="container">
     
    <!-- Title -->
    <div class="page-header">
      <h1><?php echo $_SESSION["page"]->getTitle(); ?></h1>
    </div>
    <!-- /Title -->
    
<?php if($_SESSION["page"]->hasMessage()) { ?>
    <!-- Message -->
    <div class="alert alert-<?php echo $_SESSION["page"]->getType(); ?> alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <?php echo $_SESSION["page"]->getMessage().PHP_EOL; ?>
    </div>
    <!-- /Message -->
<?php } ?>
    
    <!-- Content -->
<?php $_SESSION["page"]->loadContent(); ?>
    <!-- /Content -->
    
  </div>
  
</body>

</html>