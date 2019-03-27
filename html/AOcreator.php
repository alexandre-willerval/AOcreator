<?php if(!defined('securityCheck')) { die('Erreur : Accès direct à cette page interdit !'); } ?>
<?php if(!isset($_SESSION["proposal"])) { $_SESSION["proposal"] = new Proposal(0); } ?>
    <nav class="o-stepbar xs-labels">
      <ol>
        <li class="stepbar-item <?php echo ($_SESSION["proposal"]->getStep()==1?'current':($_SESSION["proposal"]->getStep()<1?'next':'done')); ?>">
          <a class="stepbar-link" title="Etape 1 : Initialisation" href="#initialisation">
            <span class="step-number">1</span>
            <span class="step-title">Initialisation</span>
          </a>
        </li>
        <li class="stepbar-item <?php echo ($_SESSION["proposal"]->getStep()==2?'current':($_SESSION["proposal"]->getStep()<2?'next':'done')); ?>">
          <a class="stepbar-link" title="Etape 2 : Détails" href="#details">
            <span class="step-number">2</span>
            <span class="step-title">Détails</span>
          </a>
        </li>
        <li class="stepbar-item <?php echo ($_SESSION["proposal"]->getStep()==3?'current':($_SESSION["proposal"]->getStep()<3?'next':'done')); ?>">
          <a class="stepbar-link" title="Etape 3 : Résultat" href="#resultat">
            <span class="step-number">3</span>
            <span class="step-title">Résultat</span>
          </a>
        </li>
      </ol>
    </nav>
    <div class="my-5">
      <div id="initialisation" class="stepbar-content"<?php echo ($_SESSION["proposal"]->getStep()==1?'':' style="display:none;"'); ?>>
<?php include("AOcreator-step1.php"); ?>
      </div>
      <div id="details" class="stepbar-content"<?php echo ($_SESSION["proposal"]->getStep()==2?'':' style="display:none;"'); ?>>
<?php if($_SESSION["proposal"]->getStep()<2) { ?>
        <div class="row justify-content-center">
          <div class="col-12 col-sm-10 col-md-8 col-lg-6">
            Tu dois d'abord compléter l'étape 1...
          </div>
        </div>
<?php } else { include("AOcreator-step2.php"); } ?>
      </div>
      <div id="resultat" class="stepbar-content"<?php echo ($_SESSION["proposal"]->getStep()==3?'':' style="display:none;"'); ?>>
        <div class="row justify-content-center">
          <div class="col-12 col-sm-10 col-md-8 col-lg-6">
<?php if($_SESSION["proposal"]->getStep()<3) { ?>
            Tu dois d'abord compléter les deux premières étapes...
<?php } else { ?>
            Il ne te reste plus qu'à télécharger ton super mémoire technique ! :)
<?php } ?>
          </div>
        </div>
      </div>
    </div>

    <script>
      $(function () {
        $(".stepbar-link").click(function(event) {
          $(".stepbar-content").hide();
          $(event.currentTarget.hash).show();
        });
        $("#form1 button").click(function(event) {
          $("#action1").val(event.currentTarget.id);
          $("#form1").submit();
        });
        $("#form2 button").click(function(event) {
          $("#action2").val(event.currentTarget.id);
          $("#form2").submit();
        });
        $(".sortable").sortable();
        $("#newtab").click(function(event) {
          event.preventDefault();
          console.log("TODO");
        });
      });
    </script>