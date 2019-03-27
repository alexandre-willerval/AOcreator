<?php if(!defined('securityCheck')) { die('Erreur : Accès direct à cette page interdit !'); } ?>
    <div class="row justify-content-center">
      <div class="col-12 col-sm-8 col-md-6 col-lg-4">
        <form method="post" action="index.php?action=connexion">
          <h3>Pour se connecter, utilise tes identifiants Plazza.</h3>
          <div class="form-group">
            <input type="email" class="form-control" id="email" name="email" placeholder="Adresse email" />
          </div>
          <div class="form-group">
            <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" />
          </div>
          <div class="custom-control custom-checkbox">
            <input class="custom-control-input" type="checkbox" id="remember" name="remember" /> 
            <label class="custom-control-label" for="remember">Se souvenir de moi</label>
          </div>
          <div class="text-right">
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-sign-in-alt"></i> Se connecter
            </button>
            <br/><br/>
          </div>
        </form>
      </div>
    </div>
