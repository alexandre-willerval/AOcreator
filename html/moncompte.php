<?php if(!defined('securityCheck')) { die('Erreur : Accès direct à cette page interdit !'); } ?>
    <div class="row justify-content-center">
      <div class="col-12 col-sm-8 col-md-6 col-lg-4">
        <div class="row mb-3">
          <div class="col-sm-3">
            <img src="<?php echo $_SESSION["user"]->getThumbnail(); ?>" class="img-fluid rounded-circle" alt="photo de profil" />
          </div>
          <div class="col-sm-9">
            <h3><?php echo $_SESSION["user"]->getCompleteName(); ?></h3>
<?php $rights = $_SESSION["user"]->getRights();
if($rights == 0) { ?>
            <span class="badge badge-danger">Utilisateur bloqué</span>
<?php } elseif($rights == 1) { ?>
            <span class="badge badge-primary">Utilisateur enregistré</span>
<?php } elseif($rights == 2) { ?>
            <span class="badge badge-success">Administrateur</span>
<?php } ?>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <p><i class="fas fa-plus-square"></i> Créé le <?php echo $_SESSION["user"]->getFirstConnection(); ?></p>
            <p><i class="fas fa-history"></i> Dernière connexion le <?php echo $_SESSION["user"]->getLastConnection(); ?></p>
            <p><i class="fas fa-address-card"></i> <?php echo $_SESSION["user"]->getJob(); ?></p>
            <p><i class="fas fa-users"></i> <?php echo $_SESSION["user"]->getTeam(); ?></p>
            <p><i class="fas fa-phone"></i> <?php echo $_SESSION["user"]->getPhone(); ?></p>
            <p><i class="fas fa-envelope"></i> <a href="mailto:<?php echo $_SESSION["user"]->getEmail(); ?>"><?php echo $_SESSION["user"]->getEmail(); ?></a></p>
            <p><i class="fas fa-building"></i> <?php echo $_SESSION["user"]->getAddress(); ?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <p class="font-italic text-muted my-3">Ces données sont issues de Plazza. Pour les modifier (ainsi que le mot de passe de ton compte), 
                il faut donc le faire directement depuis Plazza.</p>
          </div>
        </div>
      </div>
    </div>
