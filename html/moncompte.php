    <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
        <div class="row">
          <div class="col-sm-3">
            <img src="<?php echo $_SESSION["user"]->getThumbnail(); ?>" class="img-responsive img-circle" alt="photo de profil" />
          </div>
          <div class="col-sm-9">
            <h3><?php echo $_SESSION["user"]->getCompleteName(); ?></h3>
<?php $rights = $_SESSION["user"]->getRights();
if($rights == 0) { ?>
            <span class="label label-danger">Utilisateur bloqué</span>
<?php } elseif($rights == 1) { ?>
            <span class="label label-primary">Utilisateur enregistré</span>
<?php } elseif($rights == 2) { ?>
            <span class="label label-success">Administrateur</span>
<?php } ?>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <br/>
            <p><span class="glyphicon glyphicon-check" aria-hidden="true"></span> Créé le <?php echo $_SESSION["user"]->getFirstConnection(); ?></p>
            <p><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Dernière connexion le <?php echo $_SESSION["user"]->getLastConnection(); ?></p>
            <p><span class="glyphicon icon-address_book" aria-hidden="true"></span> <?php echo $_SESSION["user"]->getTeam(); ?></p>
            <p><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> <?php echo $_SESSION["user"]->getJob(); ?></p>
            <p><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> <?php echo $_SESSION["user"]->getPhone(); ?></p>
            <p><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <?php echo $_SESSION["user"]->getEmail(); ?></p>
            <p><span class="glyphicon icon-office" aria-hidden="true"></span> <?php echo $_SESSION["user"]->getAddress(); ?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <br/>
            <blockquote>
              <p><em><small>Ces données sont issues de Plazza. Pour les modifier (ainsi que le mot de passe de ton compte), 
                il faut donc le faire directement depuis Plazza.</small></em></p>
            </blockquote>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <br/>
            <a href="index.php?page=accueil" class="btn btn-default" role="button">
              <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Retour à l'accueil
            </a>
            <br/><br/>
          </div>
        </div>
      </div>
    </div>
