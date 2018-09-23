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
    <h1 class="border-bottom border-light mt-3"><?php echo $_SESSION["page"]->getTitle(); ?></h1>
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

<?php if($_SESSION["page"]->hasRetour()) { ?>
    <!-- Back to Home -->
    <div class="row">
      <div class="col-12">
        <a href="index.php?page=accueil" class="btn btn-secondary my-3" role="button">
          <i class="fas fa-long-arrow-alt-left"></i> Retour à l'accueil
        </a>
      </div>
    </div>
    <!-- /Back to Home -->
<?php } ?>    
  </div>
  
</body>

</html>