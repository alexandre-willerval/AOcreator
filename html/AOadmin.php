<?php if(!defined('securityCheck')) { die('Erreur : Accès direct à cette page interdit !'); } ?>
<?php if(!isset($_SESSION["admin"])) { $_SESSION["admin"] = new Admin(); } ?>
    <table class="table table-striped has-icon">
      <thead>
        <tr>
          <th><i class="fas fa-user"></i></th>
          <th>Nom</th>
          <th>Droits</th>
          <th>Email</th>
          <th>Date création</th>
          <th>Date dernière connexion</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
<?php $userList = $_SESSION["admin"]->getUserList(); foreach($userList as $user) { ?>
        <tr>
          <td><img src="<?php echo $user["thumbnail"]; ?>" class="img-circle" alt="Photo de profil" /></td>
          <td data-toggle="tooltip" data-placement="bottom" title="Bloquer l'utilisateur"><?php echo $user["forename"]." ".$user["surname"]; ?></td>
<?php if($user["rights"] == 0) { ?>
          <td><span class="badge badge-danger">Utilisateur bloqué</span></td>
<?php } elseif($user["rights"] == 1) { ?>
          <td><span class="badge badge-primary">Utilisateur enregistré</span></td>
<?php } elseif($user["rights"] == 2) { ?>
          <td><span class="badge badge-success">Administrateur</span></td>
<?php } ?>         
          <td><a href="mailto:<?php echo $user["email"]; ?>"><?php echo $user["email"]; ?></a></td>
          <td><?php echo $user["firstConnection"]; ?></td>
          <td><?php echo $user["lastConnection"]; ?></td>
          <td>
<?php if($user["email"]==$_SESSION["user"]->getEmail()) { ?>
            <em>utilisateur actuellement connecté</em>
<?php } else { ?>
            <form class="form-inline" method="post" action="index.php?action=AOadmin">
              <div class="o-switch btn-group btn-group-toggle" data-toggle="buttons" role="group">
                <label class="btn btn-secondary btn-jquery<?php echo ($user["rights"]==0?" active":""); ?>" data-id="<?php echo $user["id"]; ?>" title="Bloquer l'utilisateur">
                  <input name="user_rights" value="0" autocomplete="off" type="radio"<?php echo ($user["rights"]==0?' checked="checked"':''); ?> />
                  <i class="fas fa-ban"></i>
                </label>
                <label class="btn btn-secondary btn-jquery<?php echo ($user["rights"]==1?" active":""); ?>" data-id="<?php echo $user["id"]; ?>" title="Autoriser l'utilisateur">
                  <input name="user_rights" value="1" autocomplete="off" type="radio"<?php echo ($user["rights"]==1?' checked="checked"':''); ?> />
                  <i class="fas fa-check"></i>
                </label>
                <label class="btn btn-secondary btn-jquery<?php echo ($user["rights"]==2?" active":""); ?>" data-id="<?php echo $user["id"]; ?>" title="Donner les droits d'administrateur">
                  <input name="user_rights" value="2" autocomplete="off" type="radio"<?php echo ($user["rights"]==2?' checked="checked"':''); ?> />
                  <i class="fas fa-star"></i>
                </label>
              </div>
              <input type="hidden" name="user_id" value="<?php echo $user["id"]; ?>" />
              <input type="hidden" name="user_name" value="<?php echo $user["forename"]." ".$user["surname"]; ?>" />
              <button type="submit" id="submit<?php echo $user["id"]; ?>" class="btn btn-sm btn-primary ml-2" disabled="true" title="Enregistrer">
                <i class="fas fa-save"></i>
              </button>
            </form>
<?php } ?>
          </td>
        </tr>
<?php } ?>
      </tbody>
    </table>
    
    <script>
      $(function () {
        $(".btn-jquery").click(function(event) {
          $("#submit"+event.currentTarget.dataset.id).prop("disabled", false);
        });
      });
    </script>