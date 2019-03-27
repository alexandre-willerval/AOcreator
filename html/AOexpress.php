<?php if(!defined('securityCheck')) { die('Erreur : Accès direct à cette page interdit !'); } ?>
    <form id="expressForm" method="post" action="express.php" target="_blank">
      <div class="my-3">
        <label>Quelles briques de rédaction veux-tu télécharger ?</label>
      </div>
<?php $brickList = $_SESSION["bdd"]->getBrickList(0); foreach($brickList as $brick) { ?>
      <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" name="<?php echo $brick["id"]; ?>" id="<?php echo $brick["id"]; ?>">
        <label class="custom-control-label" for="<?php echo $brick["id"]; ?>">
          <em><?php echo stripslashes($brick["category"]); ?></em> - <?php echo stripslashes($brick["title"]); ?>
        </label>
      </div>
<?php } ?>
      <div class="error-msg text-danger" style="display:none;">
        <label><i class="fas fa-exclamation-triangle"></i> Merci de sélectionner au moins une brique</label>
      </div>
      <input type="hidden" name="username" value="<?php echo $_SESSION["user"]->getCompleteName(); ?>" />
      <button type="submit" class="btn btn-primary my-3" title="">
        <i class="fas fa-bolt"></i> Fusionner les briques en un seul document
      </button>
    </form>

    <script>
      $(function () {
        $(".custom-control-input").change(function() {
          $(".error-msg").hide();
        });
        $("#expressForm").submit(function() {
          if($(".custom-control-input:checked").length == 0) {
            $(".error-msg").show();
            return false;
          } else {
            return true;
          }
        });
      });
    </script>