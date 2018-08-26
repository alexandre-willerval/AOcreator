    <table class="table table-striped has-icon">
      <thead>
        <tr>
          <th><span class="glyphicon glyphicon-user" aria-hidden="true"></span></th>
          <th>Nom</th>
          <th>Droits</th>
          <th>Email</th>
          <th>Date création</th>
          <th>Date dernière connexion</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
<?php $userList = $_SESSION["bdd"]->getUserList(); 
foreach($userList as $user) { ?>
        <tr>
          <td><img src="<?php echo $user["thumbnail"]; ?>" class="img-circle" alt="Photo de profil" /></td>
          <td><?php echo $user["forename"]." ".$user["surname"]; ?></td>
<?php if($user["rights"] == 0) { ?>
          <td><span class="label label-danger">Utilisateur bloqué</span></td>
<?php } elseif($user["rights"] == 1) { ?>
          <td><span class="label label-primary">Utilisateur enregistré</span></td>
<?php } elseif($user["rights"] == 2) { ?>
          <td><span class="label label-success">Administrateur</span></td>
<?php } ?>         
          <td><a href="mailto:<?php echo $user["email"]; ?>"><?php echo $user["email"]; ?></a></td>
          <td><?php echo $user["firstConnection"]; ?></td>
          <td><?php echo $user["lastConnection"]; ?></td>
          <td>
<?php if($user["email"]==$_SESSION["user"]->getEmail()) { ?>
            <em>utilisateur actuellement connecté</em>
<?php } else { ?>
            <form class="form-inline" method="post" action="index.php?action=AOadmin">
              <div class="btn-group" data-toggle="buttons" role="group">
                <label class="btn btn-sm btn-secondary btn-jquery<?php echo ($user["rights"]==0?" active":""); ?>" data-id="<?php echo $user["id"]; ?>" data-toggle="tooltip" data-trigger="manual" data-placement="bottom" title="Bloquer l'utilisateur">
                  <input name="user_rights" value="0" autocomplete="off" type="radio"<?php echo ($user["rights"]==0?' checked="checked"':''); ?> />
                  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </label>
                <label class="btn btn-sm btn-secondary btn-jquery<?php echo ($user["rights"]==1?" active":""); ?>" data-id="<?php echo $user["id"]; ?>" data-toggle="tooltip" data-trigger="manual" data-placement="bottom" title="Autoriser l'utilisateur">
                  <input name="user_rights" value="1" autocomplete="off" type="radio"<?php echo ($user["rights"]==1?' checked="checked"':''); ?> />
                  <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                </label>
                <label class="btn btn-sm btn-secondary btn-jquery<?php echo ($user["rights"]==2?" active":""); ?>" data-id="<?php echo $user["id"]; ?>" data-toggle="tooltip" data-trigger="manual" data-placement="bottom" title="Donner les droits d'administrateur">
                  <input name="user_rights" value="2" autocomplete="off" type="radio"<?php echo ($user["rights"]==2?' checked="checked"':''); ?> />
                  <span class="glyphicon glyphicon-certificate" aria-hidden="true"></span>
                </label>
              </div>
              <input type="hidden" name="user_id" value="<?php echo $user["id"]; ?>" />
              <input type="hidden" name="user_name" value="<?php echo $user["forename"]." ".$user["surname"]; ?>" />
              <button type="submit" id="submit<?php echo $user["id"]; ?>" class="btn btn-sm btn-primary btn-submit" disabled="true" data-toggle="tooltip" data-placement="bottom" title="Enregistrer">
                <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
              </button>
            </form>
<?php } ?>
          </td>
        </tr>
<?php } ?>
      </tbody>
    </table>
    <a href="index.php?page=accueil" class="btn btn-default" role="button">
      <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Retour à l'accueil
    </a>
    <br/><br/>
    
    <script>
      $(function () {
        $(".btn-jquery").tooltip();
        $(".btn-submit").tooltip();
        $(".btn-jquery").mouseenter(function(event) {
          $(event.currentTarget).tooltip("show");
        });
        $(".btn-jquery").mouseleave(function(event) {
          $(event.currentTarget).tooltip("hide");
        });
        $(".btn-jquery").click(function(event) {
          $("#submit"+event.currentTarget.dataset.id).prop("disabled", false);
        });
      });
    </script>