    <div class="alert alert-warning" role="alert">
      <i class="fas fa-exclamation-triangle"></i>
      <strong>Attention :</strong> Page en cours de développement...
    </div>

<?php if(!isset($_SESSION["stats"])) { $_SESSION["stats"] = new Stats(); } ?>
    <div class="row">
      <div class="col-12 col-md-3">
        <div class="card border-0 mb-3" style="background-color:rgb(75,180,230);">
          <div class="card-body text-center">
            <h1 class="card-title"><?php echo $_SESSION["stats"]->getNumberUsers(); ?></h1>
            <p class="card-text">utilisateurs</p>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-3">
        <div class="card border-0 mb-3" style="background-color:rgb(255,220,0);">
          <div class="card-body text-center">
            <h1 class="card-title"><?php echo $_SESSION["stats"]->getNumberBricks(); ?></h1>
            <p class="card-text">briques de rédaction</p>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-3">
        <div class="card border-0 mb-3" style="background-color:rgb(80,190,135);">
          <div class="card-body text-center">
            <h1 class="card-title"><?php echo $_SESSION["stats"]->getNumberProposals(); ?></h1>
            <p class="card-text">appels d'offre créés</p>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-3">
        <div class="card border-0 mb-3" style="background-color:rgb(145,100,205);">
          <div class="card-body text-center">
            <h1 class="card-title"><?php echo $_SESSION["stats"]->getNumberExpress(); ?></h1>
            <p class="card-text">AOexpress générés</p>
          </div>
        </div>
      </div>
    </div>
