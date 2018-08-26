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
    <div style="margin-top:20px;">
      <div id="initialisation" class="stepbar-content"<?php echo ($_SESSION["proposal"]->getStep()==1?'':' style="display:none;"'); ?>>
        <div class="row">
          <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
            <form id="step1_form" method="post" action="index.php?action=AOcreator">
              <div class="form-group">
                <label for="title">Quel titre veux-tu donner à ton mémoire technique ?</label>
                <input type="text" name="title" class="form-control" placeholder="Exemple : Lot 4 : Accès internet haut débit" value="<?php echo $_SESSION["proposal"]->getTitle(); ?>" required/>
              </div>
              <div class="form-group">
                <label for="title">Pour quel client ?</label>
                <input type="text" name="clientName" class="form-control" placeholder="Exemple : Mairie de Lille" value="<?php echo $_SESSION["proposal"]->getClientName(); ?>" required/>
              </div>
              <input id="step1_action" type="hidden" name="action" value="" />
              <button id="reset" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon glyphicon-repeat" aria-hidden="true"></span> Réinitialiser</button>
<?php if($_SESSION["proposal"]->getStep()==1) { ?>
              <button id="create" type="submit" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> Passer à l'étape 2</button>
<?php } else { ?>
              <button id="save" type="submit" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Enregistrer les modifications</button>
<?php } ?>
            </form>
          </div>
        </div>
      </div>
      <div id="details" class="stepbar-content"<?php echo ($_SESSION["proposal"]->getStep()==2?'':' style="display:none;"'); ?>>
<?php if($_SESSION["proposal"]->getStep()<2) { ?>
        <div class="row">
          <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
            Tu dois d'abord compléter l'étape 1...
          </div>
        </div>
<?php } else { ?>
        <div role="tabpanel" class="row">
          <div class="col-xs-12 col-md-2">
            <ul class="nav nav-pills nav-stacked sortable" role="tablist">
              <li role="presentation" class="active">
                <a href="#home" data-toggle="tab" aria-controls="home" role="tab">Home</a>
              </li>
              <li role="presentation">
                <a href="#profile" data-toggle="tab" aria-controls="profile" role="tab" >Profile</a>
              </li>
              <li role="presentation">
                <a href="#messages" data-toggle="tab" aria-controls="messages" role="tab" >Messages</a>
              </li>
              <li role="presentation">
                <a href="#settings" data-toggle="tab" aria-controls="settings" role="tab" >Settings</a>
              </li>
            </ul>
            <ul class="nav nav-pills nav-stacked">
              <li>
                <a href="#" id="newtab"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
              </li>
            </ul>
          </div>
          <div class="tab-content col-xs-12 col-md-10" style="border-top:2px black solid;">
            <div class="tab-pane active" id="home" role="tabpanel">
              Lorem ipsum dolor sit
              amet, consectetur adipiscing elit. In iaculis volutpat quam, non
              suscipit arcu accumsan at. Aliquam pellentesque.<a href="#">test focus 4</a>
            </div>
            <div class="tab-pane" id="profile" role="tabpanel">
              Sed ut perspiciatis unde omnis iste natus error sit 
              voluptatem accusantium doloremque laudantium, totam rem aperiam, 
              eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. 
              Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, 
              sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. 
              Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, 
              adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore 
              magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem 
              ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? 
              Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil 
              molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?
            </div>
            <div class="tab-pane" id="messages" role="tabpanel">
              At vero eos et accusamus et iusto odio dignissimos ducimus 
              qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas 
              molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa 
              qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem 
              rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est 
              eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, 
              omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et 
              aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae 
              sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, 
              ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.
            </div>
            <div class="tab-pane" id="settings" role="tabpanel">
              Lorem ipsum dolor sit
              amet, consectetur adipiscing elit. In iaculis volutpat quam, non
              suscipit arcu accumsan at. Aliquam pellentesque.
            </div>
          </div>
        </div>
        <div class="row" style="margin-top:20px;">
          <div class="col-xs-12 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 col-lg-3 col-lg-offset-3">
            <input id="step2_action" type="hidden" name="action" value="" />
            <button id="reset" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon glyphicon-repeat" aria-hidden="true"></span> Réinitialiser</button>
          </div>
          <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3 text-right">
            <button id="update" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> Passer à l'étape 3</button>
          </div>
        </div>
<?php } ?>
      </div>
      <div id="resultat" class="stepbar-content"<?php echo ($_SESSION["proposal"]->getStep()==3?'':' style="display:none;"'); ?>>
        <div class="row">
          <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
<?php if($_SESSION["proposal"]->getStep()<3) { ?>
            Tu dois d'abord compléter les deux premières étapes...
<?php } else { ?>
            Il ne te reste plus qu'à télécharger ton super mémoire technique ! :)
<?php } ?>
          </div>
        </div>
      </div>
    </div>
    <br/>    
    <a href="index.php?page=accueil" class="btn btn-default" role="button">
      <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Retour à l'accueil
    </a>
    <br/><br/>

    <script>
      $(function () {
        $(".stepbar-link").click(function(e) {
          $(".stepbar-content").hide();
          $(e.currentTarget.hash).show();
        });
        $("#step1_form button").click(function(e) {
          $("#step1_action").val(e.currentTarget.id);
          $("#step1_form").submit();
        });
        $(".sortable").sortable();
        $("#newtab").click(function() {
          console.log("TODO");
        });
      });
    </script>