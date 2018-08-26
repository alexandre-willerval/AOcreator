    <form id="expressForm" method="post" action="express.php" target="_blank">
      <label>Quelles briques de rédaction veux-tu télécharger ?</label>
<?php $brickList = $_SESSION["bdd"]->getBrickList(0);
foreach($brickList as $brick) { ?>
      <div>                        
        <input type="checkbox" class="o-checkbox" name="<?php echo $brick["id"]; ?>" id="<?php echo $brick["id"]; ?>">
        <label for="<?php echo $brick["id"]; ?>"><em><?php echo stripslashes($brick["category"]); ?></em> - <?php echo stripslashes($brick["title"]); ?></label>
      </div>
<?php } ?>
      <br/>
      <input type="hidden" name="username" value="<?php echo $_SESSION["user"]->getCompleteName(); ?>" />
      <button type="submit" class="btn btn-primary btn-submit" data-toggle="tooltip" data-placement="bottom" title="">
        <span class="glyphicon glyphicon-flash" aria-hidden="true"></span> Fusionner les briques en un seul document
      </button>
    </form>
    <br/>
    <a href="index.php?page=accueil" class="btn btn-default" role="button">
      <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Retour à l'accueil
    </a>
    <br/><br/>

    <script>
      $(function () {
        $(".o-checkbox").change(function() {
          $(".btn-submit").tooltip("destroy");
        });
        $("#expressForm").submit(function() {
          if($(".o-checkbox:checked").length == 0) {
            $(".btn-submit").attr("title", "Erreur : Au moins une brique doit être sélectionnée.");
            $(".btn-submit").tooltip("show");
            return false;
          } else {
            return true;
          }
        });
      });
    </script>